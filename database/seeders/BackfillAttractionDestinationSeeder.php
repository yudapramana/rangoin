<?php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BackfillAttractionDestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Peta kata kunci -> slug region (19 daerah Sumbar)
        $map = [
            // Kota
            'bukittinggi'      => 'bukittinggi',
            'padang kota'      => 'padang',
            'padang'           => 'padang',          // hati-hati tabrakan dg kabupaten: kita cek spesifik dulu di bawah
            'pariaman'         => 'pariaman',
            'payakumbuh'       => 'payakumbuh',
            'sawahlunto'       => 'sawahlunto',
            'solok kota'       => 'solok-city',
            // Kabupaten
            'kabupaten agam'   => 'agam',
            'agam'             => 'agam',
            'dharmasraya'      => 'dharmasraya',
            'kepulauan mentawai'=> 'kepulauan-mentawai',
            'mentawai'         => 'kepulauan-mentawai',
            'lima puluh kota'  => 'lima-puluh-kota',
            'padang pariaman'  => 'padang-pariaman',
            'kabupaten padang' => 'padang-pariaman',   // jika ada frasa ambigu "Padang" (kab.)
            'pasaman barat'    => 'pasaman-barat',
            'pasaman'          => 'pasaman',
            'pesisir selatan'  => 'pesisir-selatan',
            'sijunjung'        => 'sijunjung',
            'kabupaten solok'  => 'solok-regency',
            'solok selatan'    => 'solok-selatan',
            'tanah datar'      => 'tanah-datar',
            // Spot populer → region
            'harau'            => 'lima-puluh-kota',   // Lembah Harau
            'maninjau'         => 'agam',              // Danau Maninjau
            'ngarai sianok'    => 'bukittinggi',
            'jam gadang'       => 'bukittinggi',
            'pagai'            => 'kepulauan-mentawai',
            'sipora'           => 'kepulauan-mentawai',
            'siberut'          => 'kepulauan-mentawai',
        ];

        // Ambil id region per slug
        $regions = Destination::pluck('id', 'slug')->all();

        // Generator fungsi pencari region
        $findRegionId = function (Attraction $d) use ($map, $regions) {
            $candidates = [
                $d->city_id, $d->city_en, $d->city_zh,
                $d->location_label_id, $d->location_label_en, $d->location_label_zh,
                $d->name_id, $d->name_en, $d->name_zh,
                $d->description_id, $d->description_en, $d->description_zh,
            ];

            // bangun string gabungan untuk pencarian kata kunci
            $hay = strtolower(implode(' | ', array_filter(array_map(fn($v) => is_string($v) ? $v : '', $candidates))));
            $hay = preg_replace('/\s+/',' ', $hay);

            // Prioritas: frasa yang lebih spesifik dulu
            $priority = [
                'solok kota','padang kota','kabupaten padang','kabupaten solok',
                'lima puluh kota','padang pariaman','pasaman barat',
            ];

            foreach ($priority as $p) {
                if (str_contains($hay, $p) && isset($map[$p]) && isset($regions[$map[$p]])) {
                    return $regions[$map[$p]];
                }
            }

            // General match
            foreach ($map as $needle => $slug) {
                if (str_contains($hay, $needle) && isset($regions[$slug])) {
                    return $regions[$slug];
                }
            }

            // Khusus: kata "Padang" ambigu → prefer kota bila ada kata 'kota' / landmark kota
            if (preg_match('/\bpadang\b/', $hay)) {
                $slug = 'padang';
                return $regions[$slug] ?? null;
            }

            return null;
        };

        $updated = 0;

        Attraction::whereNull('destination_id')->chunkById(200, function ($chunk) use (&$updated, $findRegionId) {
            foreach ($chunk as $d) {
                $rid = $findRegionId($d);
                if ($rid) {
                    $d->destination_id = $rid;
                    $d->save();
                    $updated++;
                }
            }
        });

        $this->command?->info("Backfill complete. Updated {$updated} destination(s).");
    }
}
