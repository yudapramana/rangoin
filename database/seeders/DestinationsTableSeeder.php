<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now   = now();
        $base  = 'images/Destinations/'; // folder di public/

        $rows = [
            // ==================== KABUPATEN ====================
            [
                'slug' => 'agam',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Agam',
                'name_en' => 'Agam Regency',
                'name_zh' => '阿甘',
            ],
            [
                'slug' => 'dharmasraya',
                'type' => 'kabupaten',
                'filter' => 'tropical',
                'name_id' => 'Kabupaten Dharmasraya',
                'name_en' => 'Dharmasraya Regency',
                'name_zh' => null,
            ],
            [
                'slug' => 'kepulauan-mentawai',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Kepulauan Mentawai',
                'name_en' => 'Mentawai Islands Regency',
                'name_zh' => '明达威岛',
            ],
            [
                'slug' => 'lima-puluh-kota',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Lima Puluh Kota',
                'name_en' => 'Lima Puluh Kota Regency',
                'name_zh' => '利马普鲁哥打',
            ],
            [
                'slug' => 'padang-pariaman',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Padang Pariaman',
                'name_en' => 'Padang Pariaman Regency',
                'name_zh' => '巴东帕里亚曼',
            ],
            [
                'slug' => 'pasaman',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Pasaman',
                'name_en' => 'Pasaman Regency',
                'name_zh' => null,
            ],
            [
                'slug' => 'pasaman-barat',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Pasaman Barat',
                'name_en' => 'West Pasaman Regency',
                'name_zh' => null,
            ],
            [
                'slug' => 'pesisir-selatan',
                'type' => 'kabupaten',
                'filter' => 'coastal',
                'name_id' => 'Kabupaten Pesisir Selatan',
                'name_en' => 'Pesisir Selatan Regency',
                'name_zh' => '南佩西西尔',
            ],
            [
                'slug' => 'sijunjung',
                'type' => 'kabupaten',
                'filter' => 'nature',
                'name_id' => 'Kabupaten Sijunjung',
                'name_en' => 'Sijunjung Regency',
                'name_zh' => '西君荣',
            ],
            [
                'slug' => 'solok-regency',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Solok',
                'name_en' => 'Solok Regency',
                'name_zh' => '梭罗克',
            ],
            [
                'slug' => 'solok-selatan',
                'type' => 'kabupaten',
                'filter' => 'mountain',
                'name_id' => 'Kabupaten Solok Selatan',
                'name_en' => 'South Solok Regency',
                'name_zh' => '南梭罗克',
            ],
            [
                'slug' => 'tanah-datar',
                'type' => 'kabupaten',
                'filter' => 'historical',
                'name_id' => 'Kabupaten Tanah Datar',
                'name_en' => 'Tanah Datar Regency',
                'name_zh' => '丹那达塔',
            ],

            // ==================== KOTA ====================
            [
                'slug' => 'bukittinggi',
                'type' => 'kota',
                'filter' => 'historical',
                'name_id' => 'Kota Bukittinggi',
                'name_en' => 'Bukittinggi City',
                'name_zh' => '武吉丁宜',
            ],
            [
                'slug' => 'padang',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Padang',
                'name_en' => 'Padang City',
                'name_zh' => '巴东',
            ],
            [
                'slug' => 'padang-panjang',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Padang Panjang',
                'name_en' => 'Padang Panjang City',
                'name_zh' => '巴东班让',
            ],
            [
                'slug' => 'pariaman',
                'type' => 'kota',
                'filter' => 'coastal',
                'name_id' => 'Kota Pariaman',
                'name_en' => 'Pariaman City',
                'name_zh' => null,
            ],
            [
                'slug' => 'payakumbuh',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Payakumbuh',
                'name_en' => 'Payakumbuh City',
                'name_zh' => '帕亞孔布',
            ],
            [
                'slug' => 'sawahlunto',
                'type' => 'kota',
                'filter' => 'historical',
                'name_id' => 'Kota Sawahlunto',
                'name_en' => 'Sawahlunto City',
                'name_zh' => '沙哇伦多',
            ],
            [
                'slug' => 'solok-city',
                'type' => 'kota',
                'filter' => 'urban',
                'name_id' => 'Kota Solok',
                'name_en' => 'Solok City',
                'name_zh' => null,
            ],
        ];

        // Lengkapi kolom image_url lokal + defaults lain
        foreach ($rows as $i => &$r) {
            // set path lokal (relatif dari public/)
            $r['image_url']     = $base . $r['slug'] . '.jpg';

            // defaults
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
