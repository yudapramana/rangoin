<?php

namespace App\Console\Commands;

use App\Models\Destination;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CacheDestinationImages extends Command
{
    protected $signature = 'destinations:cache-images
                            {--only= : Comma-separated slugs (e.g. agam,padang)}
                            {--force : Overwrite existing files if already downloaded}
                            {--sleep=300 : Microseconds to sleep between requests (default 300ms)}
                            {--retries=2 : Number of retries for failed requests}
                            {--timeout=25 : Request timeout in seconds}';

    protected $description = 'Download destination image_url to local storage and update DB to local path (Guzzle)';

    /** @var Client */
    private $client;

    public function handle(): int
    {
        // Build UA per policy
        $appName   = config('app.name', 'LaravelApp');
        $appUrl    = config('app.url', 'http://localhost');
        $contact   = env('APP_CONTACT_EMAIL', 'admin@localhost');
        $userAgent = "{$appName}/1.0 ({$appUrl}; {$contact}) Laravel-Guzzle";

        $timeout   = (int) $this->option('timeout');

        $this->client = new Client([
            'timeout'         => $timeout,
            'allow_redirects' => true,
            RequestOptions::HEADERS => [
                'User-Agent' => $userAgent,
                'Referer'    => $appUrl,
                'Accept'     => 'image/avif,image/webp,image/apng,image/*,*/*;q=0.8',
            ],
        ]);

        // Query set
        $query = Destination::query();
        if ($only = $this->option('only')) {
            $slugs = collect(explode(',', $only))->map(fn($s)=>trim($s))->filter()->values();
            if ($slugs->isEmpty()) {
                $this->error('No valid slugs provided to --only');
                return self::FAILURE;
            }
            $query->whereIn('slug', $slugs);
        }

        $destinations = $query->orderBy('display_order')->get();
        if ($destinations->isEmpty()) {
            $this->warn('No destinations found to process.');
            return self::SUCCESS;
        }

        $this->info('Processing '.$destinations->count().' destination(s)...');

        $bar    = $this->output->createProgressBar($destinations->count());
        $bar->start();

        $disk    = Storage::disk('public');
        $force   = (bool) $this->option('force');
        $sleepUs = (int) $this->option('sleep');
        $retries = (int) $this->option('retries');

        foreach ($destinations as $d) {
            try {
                $remote = $d->image_url;

                // Skip jika sudah lokal/empty
                if (!$remote || !Str::startsWith($remote, ['http://','https://'])) {
                    $bar->advance();
                    continue;
                }

                // GET dengan retry + fallback Wikimedia
                [$bodyStream, $contentType] = $this->fetchWithRetryAndFallback($remote, $retries);

                if ($bodyStream === null) {
                    $this->line("\n<fg=yellow>Skip</> {$d->slug}: failed to download - {$remote}");
                    $bar->advance();
                    usleep($sleepUs);
                    continue;
                }

                // Tentukan ekstensi dari content-type
                $ext = $this->guessExtension($contentType, $remote);
                $filename = $d->slug.'.'.$ext;
                $path     = 'destinations/'.$filename;

                if ($disk->exists($path) && !$force) {
                    $localUrl = $disk->url($path);
                    if ($d->image_url !== $localUrl) {
                        $d->update(['image_url' => $localUrl]);
                    }
                    $bar->advance();
                    usleep($sleepUs);
                    continue;
                }

                // Simpan stream → file
                $disk->put($path, $bodyStream, 'public');

                // Update DB ke URL publik
                $localUrl = $disk->url($path);
                $d->update(['image_url' => $localUrl]);

            } catch (\Throwable $e) {
                $this->line("\n<fg=red>Error</> {$d->slug}: ".$e->getMessage());
            }

            $bar->advance();
            usleep($sleepUs); // patuhi rate-limit
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Done.');
        $this->line("Tip: set .env APP_CONTACT_EMAIL=you@example.com untuk User-Agent Wikimedia.");

        return self::SUCCESS;
    }

    /**
     * Download dengan retry dan fallback Wikimedia Special:FilePath jika 403/404.
     *
     * @return array{0: string|null, 1: string|null} [body, contentType]
     */
    private function fetchWithRetryAndFallback(string $url, int $retries): array
    {
        [$body, $ctype, $status] = $this->tryRequest($url, $retries);

        if ($body === null && $this->isWikimediaLike($url) && in_array($status, [403, 404], true)) {
            if ($fallback = $this->wikimediaFallbackUrl($url)) {
                [$body, $ctype] = $this->tryRequest($fallback, $retries);
            }
        }

        return [$body, $ctype];
    }

    /**
     * Lakukan request GET dengan retry backoff sederhana.
     *
     * @return array{0: string|null, 1: string|null, 2: int|null} [body, contentType, status]
     */
    private function tryRequest(string $url, int $retries): array
    {
        $attempt = 0;
        $delayMs = 200;

        do {
            try {
                $res = $this->client->request('GET', $url, [
                    RequestOptions::STREAM => true, // stream response
                ]);

                $status = $res->getStatusCode();
                if ($status >= 200 && $status < 300) {
                    $ctype = $res->getHeaderLine('Content-Type') ?: null;

                    // Baca stream jadi string (cukup aman untuk file gambar ukuran normal)
                    $bodyStream = (string) $res->getBody()->getContents();

                    return [$bodyStream, $ctype, $status];
                }

                // status non-2xx → retry jika 5xx/429
                if (in_array($status, [429, 500, 502, 503, 504], true)) {
                    usleep($delayMs * 1000);
                    $delayMs *= 2;
                } else {
                    return [null, null, $status];
                }
            } catch (GuzzleException $e) {
                // timeout/connection errors → retry
                usleep($delayMs * 1000);
                $delayMs *= 2;
                $status = null;
            }

            $attempt++;
        } while ($attempt <= $retries);

        return [null, null, $status ?? null];
    }

    private function guessExtension(?string $contentType, string $url): string
    {
        $ct = strtolower($contentType ?? '');
        return match (true) {
            str_contains($ct, 'image/webp') => 'webp',
            str_contains($ct, 'image/png')  => 'png',
            str_contains($ct, 'image/jpeg'),
            str_contains($ct, 'image/jpg')  => 'jpg',
            str_contains($ct, 'image/gif')  => 'gif',
            default => pathinfo(parse_url($url, PHP_URL_PATH) ?? '', PATHINFO_EXTENSION) ?: 'jpg'
        };
    }

    private function isWikimediaLike(string $url): bool
    {
        $host = parse_url($url, PHP_URL_HOST) ?: '';
        return Str::contains($host, [
            'wikipedia.org', 'wikimedia.org', 'wikidata.org', 'wikivoyage.org',
            'commons.wikimedia.org', 'upload.wikimedia.org',
        ]);
    }

    /**
     * Build fallback URL ke Special:FilePath berdasarkan nama file di URL awal.
     * Contoh: https://commons.wikimedia.org/wiki/Special:FilePath/<FILENAME>?width=1600
     */
    private function wikimediaFallbackUrl(string $original): ?string
    {
        $path = parse_url($original, PHP_URL_PATH) ?: '';
        $filename = trim(basename($path));
        if ($filename === '' || $filename === '/' || str_contains($filename, '.php')) {
            return null;
        }
        return 'https://commons.wikimedia.org/wiki/Special:FilePath/' . rawurlencode($filename) . '';
        // return 'https://commons.wikimedia.org/wiki/Special:FilePath/' . rawurlencode($filename) . '?width=1600';
    }
}
