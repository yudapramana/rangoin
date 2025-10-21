<?php

namespace Database\Seeders;

use App\Models\Attraction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use RuntimeException;

class AttractionsSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/imports/History 历史.xlsx');
        if (! file_exists($path)) {
            throw new RuntimeException("Excel not found at: {$path}");
        }

        // Ambil semua sheet sebagai Collection<Collection<row>>
        $sheets = Excel::toCollection(null, $path);
        $rows   = $sheets->first();           // sheet "History 历史 "
        if ($rows->isEmpty()) return;

        // Row 0 = header → buang
        $rows = $rows->slice(1)->values();

        $order = 1;
        $currentCity = ['id'=>null,'en'=>null,'zh'=>null];

        foreach ($rows as $row) {
            // Kolom berdasar urutan di Excel:
            // 0: "Destinasi Kota / 目的地"
            // 1: "Tempat Wisata / 景点"
            // 2: "Deskripsi描述"
            // 3: "budaya"
            $cityCell    = (string)($row[0] ?? '');
            $nameCell    = (string)($row[1] ?? '');
            $descCell    = (string)($row[2] ?? '');
            $cultureCell = (string)($row[3] ?? '');

            if ($this->filled($cityCell)) {
                $currentCity = $this->parseTriLang($cityCell);
            }

            if (! $this->filled($nameCell)) {
                // baris kosong / pemisah; lewati
                continue;
            }

            $name  = $this->parseTriLang($nameCell);
            $desc  = $this->parseTriLang($descCell);
            $cult  = $this->parseTriLang($cultureCell);

            $baseName = $name['id'] ?: $name['en'] ?: $name['zh'] ?: ('dst-' . uniqid());
            $slug     = Str::slug(Str::limit($baseName, 80, ''));

            Attraction::updateOrCreate(
                ['slug' => $slug],
                [
                    'display_order' => $order++,

                    // Kota (di Excel diulang sekali tiap blok → forward-fill)
                    'city_id' => $currentCity['id'],
                    'city_en' => $currentCity['en'],
                    'city_zh' => $currentCity['zh'],

                    // Nama destinasi
                    'name_id' => $name['id'],
                    'name_en' => $name['en'],
                    'name_zh' => $name['zh'],

                    // Deskripsi
                    'description_id' => $desc['id'],
                    'description_en' => $desc['en'],
                    'description_zh' => $desc['zh'],

                    // Budaya/heritage
                    'culture_id' => $cult['id'],
                    'culture_en' => $cult['en'],
                    'culture_zh' => $cult['zh'],

                    // Label lokasi default = kota
                    'location_label_id' => $currentCity['id'],
                    'location_label_en' => $currentCity['en'],
                    'location_label_zh' => $currentCity['zh'],

                    // Default nilai numerik UI
                    'rating'         => null,
                    'rating_count'   => 0,
                    'tours_count'    => 0,
                    'packages_count' => 0,
                    'expeditions_count' => 0,
                    'starting_price' => null,
                    'currency_code'  => 'IDR',
                    'is_active'      => true,
                ]
            );
        }
    }

    private function filled(?string $s): bool
    {
        if ($s === null) return false;
        $s = preg_replace('/\s+/u', ' ', $s);
        return trim($s) !== '';
    }

    /**
     * Memecah sel menjadi [id,en,zh].
     * Excel Anda biasanya: "Indo\nEnglish\n中文" — tapi fungsi ini juga
     * mendeteksi bagian 中文 secara heuristik (CJK) dan menyusunnya ke 'zh'.
     */
    private function parseTriLang(?string $cell): array
    {
        $cell = (string)($cell ?? '');
        $cell = str_replace(["\r\n", "\r"], "\n", $cell);

        // pecah di newline atau | atau / (kadang ada variasi)
        $rawParts = preg_split("/\n+|\\||\\//u", $cell);
        $rawParts = array_values(array_filter(array_map('trim', $rawParts ?? []), fn($x) => $x !== ''));

        // pisahkan yang mengandung CJK ke zh
        $zh = null; $others = [];
        foreach ($rawParts as $p) {
            if (preg_match('/[\x{4E00}-\x{9FFF}\x{3400}-\x{4DBF}]/u', $p)) {
                $zh = $p; // terakhir yang CJK dianggap zh
            } else {
                $others[] = $p;
            }
        }

        // Urutan umum: ID, EN, ZH
        $id = $others[0] ?? ($rawParts[0] ?? null);
        $en = $others[1] ?? ($rawParts[1] ?? null);
        if ($zh === null) {
            $zh = $rawParts[2] ?? null;
            // Jika id/en ternyata CJK, swap
            if ($id && preg_match('/[\x{4E00}-\x{9FFF}\x{3400}-\x{4DBF}]/u', $id)) { $zh = $id; $id = $others[0] ?? null; }
            if ($en && preg_match('/[\x{4E00}-\x{9FFF}\x{3400}-\x{4DBF}]/u', $en)) { $zh = $en; $en = $others[1] ?? null; }
        }

        return [
            'id' => $id ?: null,
            'en' => $en ?: null,
            'zh' => $zh ?: null,
        ];
    }
}
