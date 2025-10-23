<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\TourHighlight;
use App\Models\TourItineraryDay;
use App\Models\TourTopic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ToursDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            /* ========= TOPICS ========= */
            $topics = collect([
                ['slug' => 'culture',      'name_id' => 'Budaya',     'name_en' => 'Culture',     'name_zh' => '文化'],
                ['slug' => 'nature',       'name_id' => 'Alam',       'name_en' => 'Nature',      'name_zh' => '自然'],
                ['slug' => 'islands',      'name_id' => 'Kepulauan',  'name_en' => 'Islands',     'name_zh' => '群岛'],
                ['slug' => 'beach',        'name_id' => 'Pantai',     'name_en' => 'Beach',       'name_zh' => '海滩'],
                ['slug' => 'valley',       'name_id' => 'Lembah',     'name_en' => 'Valley',      'name_zh' => '峡谷'],
                ['slug' => 'heritage',     'name_id' => 'Warisan',    'name_en' => 'Heritage',    'name_zh' => '遗产'],
                ['slug' => 'mosque',       'name_id' => 'Masjid',     'name_en' => 'Mosque',      'name_zh' => '清真寺'],
                ['slug' => 'waterfall',    'name_id' => 'Air Terjun', 'name_en' => 'Waterfall',   'name_zh' => '瀑布'],
                ['slug' => 'lake',         'name_id' => 'Danau',      'name_en' => 'Lake',        'name_zh' => '湖泊'],
            ])->mapWithKeys(fn($t) => [ $t['slug'] => TourTopic::firstOrCreate(['slug'=>$t['slug']], $t) ]);

            /* handy */
            $attachTopics = function (Tour $tour, array $slugs) use ($topics) {
                $ids = collect($slugs)->map(fn($s) => $topics[$s]->id)->all();
                $tour->topics()->sync($ids);
            };

            /* ========= TOUR 1: 4D3N West Sumatra ========= */
            $tour1 = Tour::updateOrCreate(
                ['code' => 'WS-4D3N', 'slug' => 'west-sumatra-4d3n'],
                [
                    'title_id' => '4H3M — Jelajah Sumatera Barat',
                    'title_en' => '4D3N — West Sumatra Discovery',
                    'title_zh' => '4天3夜 — 西苏门答腊探索',
                    'tagline_id' => 'Padang • Maninjau • Harau',
                    'tagline_en' => 'Padang • Maninjau • Harau',
                    'tagline_zh' => '巴东 • 曼宁焦 • 哈劳谷',
                    'short_desc_id' => 'Eksplor kota, danau vulkanik, dan lembah granit ikonik dalam 4 hari.',
                    'short_desc_en' => 'Explore city charms, volcanic lake, and iconic granite valley in 4 days.',
                    'short_desc_zh' => '4天探索城市魅力、火山湖与标志性峡谷。',
                    'overview_id' => 'Rencana fleksibel mencakup Kota Tua/Chinatown Padang, Jembatan Siti Nurbaya, Gunung Padang, Pantai Padang, Danau Maninjau via Kelok 44 & Puncak Lawang, Lembah Harau dan Kapalo Banda Taram.',
                    'overview_en' => 'Flexible plan covering Padang Old Town/Chinatown, Siti Nurbaya Bridge, Mount Padang, Padang Beach, Lake Maninjau via Kelok 44 & Puncak Lawang, Harau Valley and Kapalo Banda Taram.',
                    'overview_zh' => '灵活行程涵盖巴东老城/唐人街、西蒂·努尔巴亚桥、巴东山、巴东海滩，经44号弯道与拉旺峰前往曼宁焦湖，以及哈劳谷与卡帕洛班达塔拉姆。',
                    'duration_days' => 4,
                    'duration_nights' => 3,
                    'group_min' => 2,
                    'group_max' => 16,
                    'countries' => ['Indonesia','West Sumatra','Padang','Agam','Payakumbuh'],
                    'currency' => 'USD',
                    'price' => 540, // dummy
                    'badge_type' => 'top_rated',
                    'rating_avg' => 4.8,
                    'rating_count' => 95,
                    'hero_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/5/5f/Ricefield_view_in_Minangkabau.jpg',
                    'gallery_urls' => [],
                    'cta_label_id' => 'Cek Ketersediaan',
                    'cta_label_en' => 'Check Availability',
                    'cta_label_zh' => '查询可订性',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );

            $this->addHighlights($tour1, [
                ['sort'=>1, 'id'=>'Kota Tua Padang (Chinatown)','en'=>'Padang Old Town (Chinatown)','zh'=>'巴东老城（唐人街）'],
                ['sort'=>2, 'id'=>'Jembatan Siti Nurbaya','en'=>'Siti Nurbaya Bridge','zh'=>'西蒂·努尔巴亚桥'],
                ['sort'=>3, 'id'=>'Gunung Padang — panorama kota','en'=>'Mount Padang — city panorama','zh'=>'巴东山—城市全景'],
                ['sort'=>4, 'id'=>'Pantai Padang (Taplau) — sunset','en'=>'Padang Beach (Taplau) — sunset','zh'=>'巴东海滩（日落）'],
                ['sort'=>5, 'id'=>'Kelok 44 — rute ikonik','en'=>'Kelok 44 iconic route','zh'=>'44号弯道'],
                ['sort'=>6, 'id'=>'Puncak Lawang — view Danau Maninjau','en'=>'Puncak Lawang — Lake Maninjau view','zh'=>'拉旺峰—曼宁焦湖景观'],
                ['sort'=>7, 'id'=>'Lembah Harau — tebing & air terjun','en'=>'Harau Valley — cliffs & waterfalls','zh'=>'哈劳谷—峭壁与瀑布'],
                ['sort'=>8, 'id'=>'Kapalo Banda Taram — suasana pedesaan','en'=>'Kapalo Banda Taram — rural ambiance','zh'=>'卡帕洛班达塔拉姆—田园风光'],
            ]);

            $this->addItinerary($tour1, [
                [1,
                    ['id'=>'Kedatangan & Jelajah Kota Padang','en'=>'Arrival & Explore Padang City','zh'=>'抵达与游览巴东'],
                    ['id'=>"BIM → check-in. Jelajah Kota Tua (Chinatown), Jembatan Siti Nurbaya, naik Gunung Padang; sunset di Pantai Padang.",
                     'en'=>"Arrive BIM → hotel check-in. Explore Old Town (Chinatown), Siti Nurbaya Bridge, climb Mount Padang; sunset at Padang Beach.",
                     'zh'=>"抵达BIM→入住酒店。游览老城（唐人街）、西蒂·努尔巴亚桥，登巴东山；巴东海滩看日落。"],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'],
                    true,false,false,
                    ['id'=>'Hotel di Padang','en'=>'Hotel in Padang','zh'=>'巴东酒店'],
                ],
                [2,
                    ['id'=>'Menuju Danau Maninjau via Kelok 44','en'=>'To Lake Maninjau via Kelok 44','zh'=>'经44号弯道前往曼宁焦湖'],
                    ['id'=>"Sarapan. Perjalanan ke Maninjau melewati Kelok 44; makan siang tepi danau; Puncak Lawang untuk panorama & opsi paralayang (jika tersedia).",
                     'en'=>"Breakfast. Drive to Maninjau via Kelok 44; lakeside lunch; Puncak Lawang for panorama & optional paragliding (if available).",
                     'zh'=>"早餐后经44号弯道抵达曼宁焦湖；湖畔午餐；登拉旺峰俯瞰全景，可选滑翔伞（视情况）。"],
                    ['id'=>'Agam / Maninjau','en'=>'Agam / Maninjau','zh'=>'阿甘 / 曼宁焦湖'],
                    true,false,false,
                    ['id'=>'Penginapan sekitar Maninjau/Bukittinggi','en'=>'Stay near Maninjau/Bukittinggi','zh'=>'曼宁焦/武吉丁宜周边住宿'],
                ],
                [3,
                    ['id'=>'Payakumbuh & Lembah Harau','en'=>'Payakumbuh & Harau Valley','zh'=>'帕亞孔布与哈劳谷'],
                    ['id'=>"Jelajah Lembah Harau (tebing & air terjun), makan siang; lanjut Kapalo Banda Taram; kembali ke kota untuk makan malam.",
                     'en'=>"Explore Harau Valley (cliffs & waterfalls), lunch; continue to Kapalo Banda Taram; back to town for dinner.",
                     'zh'=>"探索哈劳谷（峭壁与瀑布），午餐；前往卡帕洛班达塔拉姆；返回市区晚餐。"],
                    ['id'=>'Payakumbuh / Harau','en'=>'Payakumbuh / Harau','zh'=>'帕亞孔布 / 哈劳谷'],
                    true,false,false,
                    ['id'=>'Hotel di Payakumbuh/sekitar Harau','en'=>'Hotel in Payakumbuh/Harau area','zh'=>'帕亞孔布/哈劳谷酒店'],
                ],
                [4,
                    ['id'=>'Kembali ke Padang & Kepulangan','en'=>'Return to Padang & Departure','zh'=>'返回巴东与离境'],
                    ['id'=>"Waktu bebas/oleh-oleh di Padang; transfer ke BIM untuk penerbangan pulang.",
                     'en'=>"Free time/souvenir shopping in Padang; transfer to BIM for return flight.",
                     'zh'=>"巴东自由活动/购物；送往BIM机场返程。"],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'],
                    true,false,false,
                    ['id'=>'—','en'=>'—','zh'=>'—'],
                ],
            ]);

            $attachTopics($tour1, ['culture','nature','valley','lake','beach','heritage']);

            /* ========= TOUR 2: 4D3N Padang City ========= */
            $tour2 = Tour::updateOrCreate(
                ['code' => 'PDG-4D3N', 'slug' => 'padang-city-4d3n'],
                [
                    'title_id' => '4H3M — Eksplor Kota Padang',
                    'title_en' => '4D3N — Padang City Highlights',
                    'title_zh' => '4天3夜 — 巴东城市精选',
                    'tagline_id' => 'Old Town • Siti Nurbaya • Masjid Raya • Air Manis • Pulau',
                    'tagline_en' => 'Old Town • Siti Nurbaya • Grand Mosque • Air Manis • Islands',
                    'tagline_zh' => '老城 • 西蒂·努尔巴亚桥 • 大清真寺 • 甜水海滩 • 海岛',
                    'short_desc_id' => 'Paket kota lengkap termasuk wisata pulau & Teluk Buo.',
                    'short_desc_en' => 'Complete city package incl. island trip & Teluk Buo.',
                    'short_desc_zh' => '含海岛行与布奥湾的完整城市套装。',
                    'overview_id' => 'Menjelajah sejarah, arsitektur, kuliner, Air Manis (Batu Malin Kundang), Masjid Raya Sumbar, pulau Pasumpahan/Pamutusan, hingga Desa Wisata Teluk Buo.',
                    'overview_en' => 'Explore history, architecture, cuisine, Air Manis (Malin Kundang Rock), Grand Mosque of West Sumatra, Pasumpahan/Pamutusan islands, and Teluk Buo Tourism Village.',
                    'overview_zh' => '探索历史建筑与美食、甜水海滩（马林昆丹石）、西苏门答腊大清真寺、帕顺帕汉/帕穆图桑海岛与布奥湾旅游村。',
                    'duration_days' => 4,
                    'duration_nights' => 3,
                    'group_min' => 2,
                    'group_max' => 20,
                    'countries' => ['Indonesia','West Sumatra','Padang'],
                    'currency' => 'USD',
                    'price' => 420,
                    'badge_type' => 'newly_added',
                    'rating_avg' => 4.7,
                    'rating_count' => 72,
                    'hero_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/22/Padang_City_as_seen_from_the_peak_of_Gunung_Padang%2C_2017-02-14.jpg',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );

            $this->addHighlights($tour2, [
                ['sort'=>1, 'id'=>'Kota Tua & Chinatown','en'=>'Old Town & Chinatown','zh'=>'老城与唐人街'],
                ['sort'=>2, 'id'=>'Jembatan Siti Nurbaya','en'=>'Siti Nurbaya Bridge','zh'=>'西蒂·努尔巴亚桥'],
                ['sort'=>3, 'id'=>'Gunung Padang','en'=>'Mount Padang','zh'=>'巴东山'],
                ['sort'=>4, 'id'=>'Masjid Raya Sumbar','en'=>'Grand Mosque of West Sumatra','zh'=>'西苏门答腊大清真寺'],
                ['sort'=>5, 'id'=>'Pantai Air Manis — Batu Malin Kundang','en'=>'Air Manis Beach — Malin Kundang Rock','zh'=>'甜水海滩—马林昆丹岩'],
                ['sort'=>6, 'id'=>'Island hopping — Pasumpahan/Pamutusan','en'=>'Island hopping — Pasumpahan/Pamutusan','zh'=>'跳岛游—帕顺帕汉/帕穆图桑'],
                ['sort'=>7, 'id'=>'Desa Wisata Teluk Buo','en'=>'Teluk Buo Tourism Village','zh'=>'布奥湾旅游村'],
            ]);

            $this->addItinerary($tour2, [
                [1,
                    ['id'=>'Sejarah & Arsitektur Padang','en'=>'History & Architecture of Padang','zh'=>'巴东历史与建筑'],
                    ['id'=>'BIM → hotel. Old Town/Chinatown, Jembatan Siti Nurbaya, Gunung Padang; makan malam tepi pantai.',
                     'en'=>'BIM → hotel. Old Town/Chinatown, Siti Nurbaya Bridge, Mount Padang; seaside dinner.',
                     'zh'=>'BIM→酒店。老城/唐人街、西蒂·努尔巴亚桥、巴东山；海边晚餐。'],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'],
                    true,false,false,
                    ['id'=>'Hotel di Padang','en'=>'Hotel in Padang','zh'=>'巴东酒店'],
                ],
                [2,
                    ['id'=>'Masjid Raya & Air Manis','en'=>'Grand Mosque & Air Manis','zh'=>'大清真寺与甜水海滩'],
                    ['id'=>'Sarapan. Masjid Raya Sumbar; lanjut ke Pantai Air Manis (Batu Malin Kundang).',
                     'en'=>'Breakfast. Grand Mosque of West Sumatra; continue to Air Manis Beach (Malin Kundang Rock).',
                     'zh'=>'早餐后参观西苏门答腊大清真寺；前往甜水海滩（马林昆丹岩）。'],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'],
                    true,false,false,
                    ['id'=>'Hotel di Padang','en'=>'Hotel in Padang','zh'=>'巴东酒店'],
                ],
                [3,
                    ['id'=>'Island Hopping & Teluk Buo','en'=>'Island Hopping & Teluk Buo','zh'=>'跳岛与布奥湾'],
                    ['id'=>'Trip ke Pulau Pasumpahan/Pamutusan (snorkeling/relaks); sore ke Desa Wisata Teluk Buo.',
                     'en'=>'Trip to Pasumpahan/Pamutusan Island (snorkeling/relax); late afternoon to Teluk Buo Village.',
                     'zh'=>'前往帕顺帕汉/帕穆图桑岛（浮潜/休闲）；傍晚前往布奥湾旅游村。'],
                    ['id'=>'Kepulauan Padang','en'=>'Padang Islands','zh'=>'巴东外岛'],
                    true,false,false,
                    ['id'=>'Hotel di Padang','en'=>'Hotel in Padang','zh'=>'巴东酒店'],
                ],
                [4,
                    ['id'=>'Waktu bebas & Kepulangan','en'=>'Free time & Departure','zh'=>'自由活动与返程'],
                    ['id'=>'Pagi bebas/oleh-oleh; transfer ke BIM untuk penerbangan pulang.',
                     'en'=>'Free morning/souvenir shopping; transfer to BIM for return flight.',
                     'zh'=>'上午自由活动/伴手礼购买；送往BIM机场返程。'],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'],
                    true,false,false,
                    ['id'=>'—','en'=>'—','zh'=>'—'],
                ],
            ]);

            $attachTopics($tour2, ['culture','heritage','beach','islands','mosque']);

            /* ========= TOUR 3: 7D6N Culture & Nature ========= */
            $tour3 = Tour::updateOrCreate(
                ['code' => 'WS-7D6N', 'slug' => 'west-sumatra-7d6n'],
                [
                    'title_id' => '7H6M — Budaya & Alam Sumatera Barat',
                    'title_en' => '7D6N — West Sumatra Culture & Nature',
                    'title_zh' => '7天6夜 — 西苏门答腊文化与自然',
                    'tagline_id' => 'Padang • Bukittinggi • Payakumbuh • Pariaman',
                    'tagline_en' => 'Padang • Bukittinggi • Payakumbuh • Pariaman',
                    'tagline_zh' => '巴东 • 武吉丁宜 • 帕亞孔布 • 帕里亚曼',
                    'short_desc_id' => 'Ritme santai untuk mengeksplor alam, budaya, ngarai, dan pesisir.',
                    'short_desc_en' => 'Leisurely pace across nature, culture, canyons and coast.',
                    'short_desc_zh' => '以舒适节奏穿越自然、文化、峡谷与海岸。',
                    'overview_id' => 'Singkarak & Lembah Anai, Ngarai Sianok, Pagaruyung, Maninjau–Puncak Lawang, Harau, hingga pantai Pariaman (Angso Duo).',
                    'overview_en' => 'Singkarak & Lembah Anai, Sianok Canyon, Pagaruyung, Maninjau–Puncak Lawang, Harau, and Pariaman coast (Angso Duo).',
                    'overview_zh' => '辛卡拉克湖与阿奈谷、锡亚诺克峡谷、帕加鲁永宫、曼宁焦湖—拉旺峰、哈劳谷，以及帕里亚曼海岸（安索多奥）。',
                    'duration_days' => 7,
                    'duration_nights' => 6,
                    'group_min' => 4,
                    'group_max' => 20,
                    'countries' => ['Indonesia','West Sumatra','Padang','Bukittinggi','Payakumbuh','Pariaman'],
                    'currency' => 'USD',
                    'price' => 990,
                    'badge_type' => 'limited',
                    'badge_limited_spots' => 5,
                    'rating_avg' => 4.9,
                    'rating_count' => 124,
                    'hero_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/71/Jakarta_TMII_-_West_Sumatra_%282025%29_-_img_14.jpg',
                    'status' => 'published',
                    'published_at' => now(),
                ]
            );

            $this->addHighlights($tour3, [
                ['sort'=>1, 'id'=>'Danau Singkarak','en'=>'Lake Singkarak','zh'=>'辛卡拉克湖'],
                ['sort'=>2, 'id'=>'Air Terjun Lembah Anai','en'=>'Lembah Anai Waterfall','zh'=>'阿奈谷瀑布'],
                ['sort'=>3, 'id'=>'Ngarai Sianok','en'=>'Sianok Canyon','zh'=>'锡亚诺克峡谷'],
                ['sort'=>4, 'id'=>'Istano Basa Pagaruyung','en'=>'Pagaruyung Palace','zh'=>'帕加鲁永宫'],
                ['sort'=>5, 'id'=>'Danau Maninjau & Puncak Lawang','en'=>'Lake Maninjau & Puncak Lawang','zh'=>'曼宁焦湖与拉旺峰'],
                ['sort'=>6, 'id'=>'Lembah Harau','en'=>'Harau Valley','zh'=>'哈劳谷'],
                ['sort'=>7, 'id'=>'Pantai Pariaman — Angso Duo','en'=>'Pariaman Coast — Angso Duo','zh'=>'帕里亚曼海岸—安索多奥'],
            ]);

            $this->addItinerary($tour3, [
                [1, ['id'=>'Padang — Kedatangan & Pulau','en'=>'Padang — Arrival & Islands','zh'=>'巴东—抵达与海岛'],
                    ['id'=>'BIM → check-in; opsional island hopping (Pasumpahan/Pamutusan); makan malam.',
                     'en'=>'Arrive BIM → check-in; optional island hopping (Pasumpahan/Pamutusan); dinner.',
                     'zh'=>'抵达BIM→入住；可选跳岛（帕顺帕汉/帕穆图桑）；晚餐。'],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'], true, false, false,
                    ['id'=>'Hotel di Padang','en'=>'Hotel in Padang','zh'=>'巴东酒店'],
                ],
                [2, ['id'=>'Ke Bukittinggi: Singkarak & Lembah Anai','en'=>'To Bukittinggi: Singkarak & Lembah Anai','zh'=>'赴武吉丁宜：辛卡拉克湖与阿奈谷'],
                    ['id'=>'Perjalanan via Danau Singkarak; singgah Air Terjun Lembah Anai; tiba & check-in Bukittinggi.',
                     'en'=>'Route via Lake Singkarak; stop at Lembah Anai Waterfall; arrive & check-in Bukittinggi.',
                     'zh'=>'途经辛卡拉克湖；停留阿奈谷瀑布；抵达并入住武吉丁宜。'],
                    ['id'=>'Bukittinggi','en'=>'Bukittinggi','zh'=>'武吉丁宜'], true, false, false,
                    ['id'=>'Hotel di Bukittinggi','en'=>'Hotel in Bukittinggi','zh'=>'武吉丁宜酒店'],
                ],
                [3, ['id'=>'Ngarai Sianok & Kota Tua','en'=>'Sianok Canyon & Old Town','zh'=>'锡亚诺克峡谷与老城区'],
                    ['id'=>'Jelajah Ngarai Sianok dan area heritage Bukittinggi; belanja di Pasar Atas.',
                     'en'=>'Explore Sianok Canyon & heritage area; shopping at Pasar Atas.',
                     'zh'=>'探索锡亚诺克峡谷与历史街区；上城市场购物。'],
                    ['id'=>'Bukittinggi','en'=>'Bukittinggi','zh'=>'武吉丁宜'], true, false, false,
                    ['id'=>'Hotel di Bukittinggi','en'=>'Hotel in Bukittinggi','zh'=>'武吉丁宜酒店'],
                ],
                [4, ['id'=>'Pagaruyung & Maninjau','en'=>'Pagaruyung & Maninjau','zh'=>'帕加鲁永与曼宁焦'],
                    ['id'=>'Kunjungi Istano Basa Pagaruyung; lanjut ke Maninjau via Kelok 44; Puncak Lawang.',
                     'en'=>'Visit Pagaruyung Palace; continue to Maninjau via Kelok 44; Puncak Lawang.',
                     'zh'=>'参观帕加鲁永宫；经44号弯道前往曼宁焦；登拉旺峰。'],
                    ['id'=>'Tanah Datar / Agam','en'=>'Tanah Datar / Agam','zh'=>'丹那达塔 / 阿甘'], true, false, false,
                    ['id'=>'Hotel area Agam/Maninjau','en'=>'Hotel near Agam/Maninjau','zh'=>'阿甘/曼宁焦酒店'],
                ],
                [5, ['id'=>'Harau & Payakumbuh','en'=>'Harau & Payakumbuh','zh'=>'哈劳与帕亞孔布'],
                    ['id'=>'Eksplor Lembah Harau (tebing, air terjun); suasana pedesaan Kapalo Banda Taram; ke Payakumbuh.',
                     'en'=>'Explore Harau Valley (cliffs, waterfalls); rural vibe at Kapalo Banda Taram; to Payakumbuh.',
                     'zh'=>'探索哈劳谷（峭壁、瀑布）；卡帕洛班达塔拉姆田园风光；至帕亞孔布。'],
                    ['id'=>'Payakumbuh','en'=>'Payakumbuh','zh'=>'帕亞孔布'], true, false, false,
                    ['id'=>'Hotel di Payakumbuh','en'=>'Hotel in Payakumbuh','zh'=>'帕亞孔布酒店'],
                ],
                [6, ['id'=>'Pariaman Coast — Angso Duo','en'=>'Pariaman Coast — Angso Duo','zh'=>'帕里亚曼海岸—安索多奥'],
                    ['id'=>'Menuju Pariaman; island/ beach time di Angso Duo; kembali ke Padang & check-in.',
                     'en'=>'Head to Pariaman; island/beach time at Angso Duo; back to Padang & check-in.',
                     'zh'=>'前往帕里亚曼；安索多奥海岛/海滩时光；返巴东入住。'],
                    ['id'=>'Pariaman • Padang','en'=>'Pariaman • Padang','zh'=>'帕里亚曼 • 巴东'], true, false, false,
                    ['id'=>'Hotel di Padang','en'=>'Hotel in Padang','zh'=>'巴东酒店'],
                ],
                [7, ['id'=>'Kepulangan dari BIM','en'=>'Departure from BIM','zh'=>'BIM离境'],
                    ['id'=>'Waktu bebas; menuju BIM untuk penerbangan pulang.',
                     'en'=>'Free time; head to BIM for return flight.',
                     'zh'=>'自由活动；前往BIM机场返程。'],
                    ['id'=>'Padang','en'=>'Padang','zh'=>'巴东'], true, false, false,
                    ['id'=>'—','en'=>'—','zh'=>'—'],
                ],
            ]);

            $attachTopics($tour3, ['culture','nature','waterfall','valley','lake','beach','heritage']);

        });
    }

    /* ===== Helpers ===== */

    private function addHighlights(Tour $tour, array $items): void
    {
        $rows = collect($items)->map(function ($it) use ($tour) {
            return [
                'tour_id' => $tour->id,
                'sort'    => $it['sort'] ?? 0,
                'item_id' => $it['id'],
                'item_en' => $it['en'],
                'item_zh' => $it['zh'],
                'icon'    => $it['icon'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->all();

        // upsert by (tour_id, item_en)
        \App\Models\TourHighlight::upsert($rows, ['tour_id','item_en'], ['sort','item_id','item_zh','icon','updated_at']);
    }

    /**
     * $defs: array of rows:
     * [ dayNumber, [title_id,title_en,title_zh], [desc_id,desc_en,desc_zh],
     *   [loc_id,loc_en,loc_zh], incBreakfast, incLunch, incDinner, [acc_id,acc_en,acc_zh] ]
     */
    private function addItinerary(Tour $tour, array $defs): void
    {
        foreach ($defs as $row) {
            [$day, $title, $desc, $loc, $b, $l, $d, $acc] = $row;

            TourItineraryDay::updateOrCreate(
                ['tour_id' => $tour->id, 'day_number' => $day],
                [
                    'title_id'   => $title['id'], 'title_en' => $title['en'], 'title_zh' => $title['zh'],
                    'description_id' => $desc['id'], 'description_en' => $desc['en'], 'description_zh' => $desc['zh'],
                    'location_name_id' => $loc['id'], 'location_name_en' => $loc['en'], 'location_name_zh' => $loc['zh'],
                    'inc_breakfast' => (bool)$b, 'inc_lunch' => (bool)$l, 'inc_dinner' => (bool)$d,
                    'accommodation_id' => $acc['id'], 'accommodation_en' => $acc['en'], 'accommodation_zh' => $acc['zh'],
                ]
            );
        }
    }
}
