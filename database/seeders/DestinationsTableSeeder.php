<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $baseImg = 'images/west-sumatra/'; // simpan gambar Anda di public/images/west-sumatra/
        $now     = now();

        // 12 Kabupaten + 7 Kota = 19
        $rows = [
            // ==================== KABUPATEN ====================
            [
                'slug' => 'agam',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Agam',
                'name_en' => 'Agam Regency',
                'name_zh' => '阿甘',
                'image_url' => $baseImg.'agam.webp',
            ],
            [
                'slug' => 'dharmasraya',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Dharmasraya',
                'name_en' => 'Dharmasraya Regency',
                'name_zh' => null,
                'image_url' => $baseImg.'dharmasraya.webp',
            ],
            [
                'slug' => 'kepulauan-mentawai',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Kepulauan Mentawai',
                'name_en' => 'Mentawai Islands Regency',
                'name_zh' => '明达威岛',
                'image_url' => $baseImg.'kepulauan-mentawai.webp',
            ],
            [
                'slug' => 'lima-puluh-kota',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Lima Puluh Kota',
                'name_en' => 'Lima Puluh Kota Regency',
                'name_zh' => '利马普鲁哥打',
                'image_url' => $baseImg.'lima-puluh-kota.webp',
            ],
            [
                'slug' => 'padang-pariaman',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Padang Pariaman',
                'name_en' => 'Padang Pariaman Regency',
                'name_zh' => '巴东帕里亚曼',
                'image_url' => $baseImg.'padang-pariaman.webp',
            ],
            [
                'slug' => 'pasaman',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Pasaman',
                'name_en' => 'Pasaman Regency',
                'name_zh' => null,
                'image_url' => $baseImg.'pasaman.webp',
            ],
            [
                'slug' => 'pasaman-barat',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Pasaman Barat',
                'name_en' => 'West Pasaman Regency',
                'name_zh' => null,
                'image_url' => $baseImg.'pasaman-barat.webp',
            ],
            [
                'slug' => 'pesisir-selatan',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Pesisir Selatan',
                'name_en' => 'Pesisir Selatan Regency',
                'name_zh' => '南佩西西尔',
                'image_url' => $baseImg.'pesisir-selatan.webp',
            ],
            [
                'slug' => 'sijunjung',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Sijunjung',
                'name_en' => 'Sijunjung Regency',
                'name_zh' => '西君荣',
                'image_url' => $baseImg.'sijunjung.webp',
            ],
            [
                'slug' => 'solok-regency',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Solok',
                'name_en' => 'Solok Regency',
                'name_zh' => '梭罗克',
                'image_url' => $baseImg.'solok-regency.webp',
            ],
            [
                'slug' => 'solok-selatan',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Solok Selatan',
                'name_en' => 'South Solok Regency',
                'name_zh' => '南梭罗克',
                'image_url' => $baseImg.'solok-selatan.webp',
            ],
            [
                'slug' => 'tanah-datar',
                'type' => 'kabupaten',
                'name_id' => 'Kabupaten Tanah Datar',
                'name_en' => 'Tanah Datar Regency',
                'name_zh' => '丹那达塔',
                'image_url' => $baseImg.'tanah-datar.webp',
            ],

            // ==================== KOTA ====================
            [
                'slug' => 'bukittinggi',
                'type' => 'kota',
                'name_id' => 'Kota Bukittinggi',
                'name_en' => 'Bukittinggi City',
                'name_zh' => '武吉丁宜',
                'image_url' => $baseImg.'bukittinggi.webp',
            ],
            [
                'slug' => 'padang',
                'type' => 'kota',
                'name_id' => 'Kota Padang',
                'name_en' => 'Padang City',
                'name_zh' => '巴东',
                'image_url' => $baseImg.'padang.webp',
            ],
            [
                'slug' => 'padang-panjang',
                'type' => 'kota',
                'name_id' => 'Kota Padang Panjang',
                'name_en' => 'Padang Panjang City',
                'name_zh' => '巴东班让',
                'image_url' => $baseImg.'padang-panjang.webp',
            ],
            [
                'slug' => 'pariaman',
                'type' => 'kota',
                'name_id' => 'Kota Pariaman',
                'name_en' => 'Pariaman City',
                'name_zh' => null,
                'image_url' => $baseImg.'pariaman.webp',
            ],
            [
                'slug' => 'payakumbuh',
                'type' => 'kota',
                'name_id' => 'Kota Payakumbuh',
                'name_en' => 'Payakumbuh City',
                'name_zh' => '帕亞孔布',
                'image_url' => $baseImg.'payakumbuh.webp',
            ],
            [
                'slug' => 'sawahlunto',
                'type' => 'kota',
                'name_id' => 'Kota Sawahlunto',
                'name_en' => 'Sawahlunto City',
                'name_zh' => '沙哇伦多',
                'image_url' => $baseImg.'sawahlunto.webp',
            ],
            [
                'slug' => 'solok-city',
                'type' => 'kota',
                'name_id' => 'Kota Solok',
                'name_en' => 'Solok City',
                'name_zh' => null,
                'image_url' => $baseImg.'solok-city.webp',
            ],
        ];

        // Tambah kolom default dan urutan
        foreach ($rows as $i => &$r) {
            $r['display_order'] = $i + 1;
            $r['is_active'] = true;
            $r['created_at'] = $now;
            $r['updated_at'] = $now;
        }

        DB::table('destinations')->upsert(
            $rows,
            ['slug'], // unique key
            ['type','name_id','name_en','name_zh','image_url','display_order','is_active','updated_at']
        );
    }
}
