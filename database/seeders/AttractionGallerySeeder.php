<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;
use Illuminate\Support\Arr;

class AttractionGallerySeeder extends Seeder
{
    /**
     * Jalankan seeder:
     * php artisan db:seed --class=AttractionGallerySeeder
     */
    // database/seeders/AttractionGallerySeeder.php

    public function run(): void
    {
        // 1) Load mapping dari file yang dihasilkan
        $file = base_path('database/seeders/data/galleryBySlug.php');
    //  ^ simpan file unduhan ke folder ini, atau sesuaikan path-nya
        $galleryBySlug = file_exists($file) ? (function() use ($file){
            $arr = [];
            require $file;   // file ini mendefinisikan $galleryBySlug
            return $galleryBySlug ?? [];
        })() : [];

        // 2) Apply ke DB
        if (!empty($galleryBySlug)) {
            \App\Models\Attraction::whereIn('slug', array_keys($galleryBySlug))
                ->chunkById(100, function($chunk) use ($galleryBySlug){
                    foreach ($chunk as $attr) {
                        $images = array_values(array_filter(array_unique($galleryBySlug[$attr->slug] ?? [])));
                        if (!empty($images)) {
                            $attr->gallery = $images;
                            $attr->save();
                        }
                    }
                });
        }

        // 3) (opsional) auto-fill untuk yang masih kosong (seperti contoh sebelumnya)
        // ...
    }

}
