<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Helper: bangun URL Special:FilePath yang stabil
        // $fp = fn(string $filename) => "https://commons.wikimedia.org/wiki/Special:FilePath/".rawurlencode($filename)."?width=1600";
        $fp = fn(string $filename) => "https://commons.wikimedia.org/wiki/Special:FilePath/".rawurlencode($filename)."?width=1600";

        $rows = [
            // ==================== KABUPATEN ====================
            [
                'slug' => 'agam',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Agam',
                'name_en' => 'Agam Regency',
                'name_zh' => '阿甘',
                // Danau Maninjau (Agam)
                'image_url' => $fp('Danau_Maninjau_dari_Lawang.jpg'),
            ],
            [
                'slug' => 'dharmasraya',
                'type' => 'kabupaten',
                'filter' => 'tropical',
                'name_id' => 'Kabupaten Dharmasraya',
                'name_en' => 'Dharmasraya Regency',
                'name_zh' => null,
                // Candi Pulau Sawah
                'image_url' => $fp('Candi_Pulau_Sawah,_Dharmasraya.jpg'),
            ],
            [
                'slug' => 'kepulauan-mentawai',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Kepulauan Mentawai',
                'name_en' => 'Mentawai Islands Regency',
                'name_zh' => '明达威岛',
                // Mentawai surfing
                'image_url' => $fp('Surf_holiday_in_the_Mentawai_islands.jpg'),
            ],
            [
                'slug' => 'lima-puluh-kota',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Lima Puluh Kota',
                'name_en' => 'Lima Puluh Kota Regency',
                'name_zh' => '利马普鲁哥打',
                // Kelok 9
                'image_url' => $fp('Fly_Over_Kelok_Sembilan.jpg'),
            ],
            [
                'slug' => 'padang-pariaman',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Padang Pariaman',
                'name_en' => 'Padang Pariaman Regency',
                'name_zh' => '巴东帕里亚曼',
                // (wilayah pesisir tetangga) fallback pantai populer di kawasan Pariaman
                'image_url' => $fp('Pantai_Gandoriah_Pariaman.jpg'),
            ],
            [
                'slug' => 'pasaman',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Pasaman',
                'name_en' => 'Pasaman Regency',
                'name_zh' => null,
                // Monumen Khatulistiwa Bonjol
                'image_url' => $fp('Monumen_Equator_Imam_Bonjol.jpg'),
            ],
            [
                'slug' => 'pasaman-barat',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Pasaman Barat',
                'name_en' => 'West Pasaman Regency',
                'name_zh' => null,
                // Air Bangis
                'image_url' => $fp('Air_bangis.jpg'),
            ],
            [
                'slug' => 'pesisir-selatan',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Pesisir Selatan',
                'name_en' => 'Pesisir Selatan Regency',
                'name_zh' => '南佩西西尔',
                // Teluk Mandeh
                'image_url' => $fp('Pantai_Teluk_Mandeh.jpg'),
            ],
            [
                'slug' => 'sijunjung',
                'type' => 'kabupaten',
                'filter' => 'nature',
                'name_id' => 'Kabupaten Sijunjung',
                'name_en' => 'Sijunjung Regency',
                'name_zh' => '西君荣',
                // Silokek
                'image_url' => $fp('Jembatan_Gantuang_Silokek.jpg'),
            ],
            [
                'slug' => 'solok-regency',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Solok',
                'name_en' => 'Solok Regency',
                'name_zh' => '梭罗克',
                // Danau Singkarak
                'image_url' => $fp('Danau_Singkarak.jpg'),
            ],
            [
                'slug' => 'solok-selatan',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Solok Selatan',
                'name_en' => 'South Solok Regency',
                'name_zh' => '南梭罗克',
                // Seribu Rumah Gadang
                'image_url' => $fp('Seribu_Rumah_Gadang_Solok_Selatan.jpg'),
            ],
            [
                'slug' => 'tanah-datar',
                'type' => 'kabupaten',
                'filter' => 'historical',
                'name_id' => 'Kabupaten Tanah Datar',
                'name_en' => 'Tanah Datar Regency',
                'name_zh' => '丹那达塔',
                // Istano Basa Pagaruyung
                'image_url' => $fp('Istano_Basa_Pagaruyung_2016.jpg'),
            ],

            // ==================== KOTA ====================
            [
                'slug' => 'bukittinggi',
                'type' => 'kota',
                'filter' => 'historical',
                'name_id' => 'Kota Bukittinggi',
                'name_en' => 'Bukittinggi City',
                'name_zh' => '武吉丁宜',
                // Jam Gadang
                'image_url' => $fp('Jam_Gadang_Okt_2020_2.jpg'),
            ],
            [
                'slug' => 'padang',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Padang',
                'name_en' => 'Padang City',
                'name_zh' => '巴东',
                // Masjid Raya Sumbar
                'image_url' => $fp('Grand_Mosque_of_West_Sumatra,_2018.jpg'),
            ],
            [
                'slug' => 'padang-panjang',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Padang Panjang',
                'name_en' => 'Padang Panjang City',
                'name_zh' => '巴东班让',
                // PDIKM Padang Panjang
                'image_url' => $fp('PDIKM_Padang_Panjang.jpg'),
            ],
            [
                'slug' => 'pariaman',
                'type' => 'kota',
                'filter' => 'coastal',
                'name_id' => 'Kota Pariaman',
                'name_en' => 'Pariaman City',
                'name_zh' => null,
                // Pantai Gandoriah Pariaman
                'image_url' => $fp('Pantai_Gandoriah.jpg'),
            ],
            [
                'slug' => 'payakumbuh',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Payakumbuh',
                'name_en' => 'Payakumbuh City',
                'name_zh' => '帕亞孔布',
                // Panorama kota dari Puncak Ngalau
                'image_url' => $fp('Ko_Difoto_Dari_Puncak_Ngalau_-_panoramio.jpg'),
            ],
            [
                'slug' => 'sawahlunto',
                'type' => 'kota',
                'filter' => 'historical',
                'name_id' => 'Kota Sawahlunto',
                'name_en' => 'Sawahlunto City',
                'name_zh' => '沙哇伦多',
                // Ombilin Coal Mine (World Heritage)
                'image_url' => $fp('2003061101_W_Sawahlunto.jpg'),
            ],
            [
                'slug' => 'solok-city',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Solok',
                'name_en' => 'Solok City',
                'name_zh' => null,
                // Balai Kota Solok (banner lebar, tetap bisa ditampilkan)
                'image_url' => $fp('Balai_Kota_Solok_panjang.jpg'),
            ],
        ];

        // set display_order, aktif, timestamps
        foreach ($rows as $i => &$r) {
            $r['display_order'] = $i + 1;
            $r['is_active']     = true;
            $r['created_at']    = $now;
            $r['updated_at']    = $now;

            if (empty($r['filter'])) {
                $r['filter'] = 'general';
            }
        }

        DB::table('destinations')->upsert(
            $rows,
            ['slug'], // unique key
            [
                'type','filter',
                'name_id','name_en','name_zh',
                'image_url','display_order','is_active',
                'updated_at'
            ]
        );
    }
}
