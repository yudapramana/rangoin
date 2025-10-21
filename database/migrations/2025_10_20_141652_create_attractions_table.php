<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();

            // Identitas & slug
            $table->string('slug')->unique();                    // slug utama (tanpa bahasa)
            $table->unsignedInteger('display_order')->default(0);

            // ====== Field multi-bahasa (ID / EN / ZH) ======
            // Dari Excel: "Destinasi Kota / 目的地"
            $table->string('city_id')->nullable();
            $table->string('city_en')->nullable();
            $table->string('city_zh')->nullable();

            // Dari Excel: "Tempat Wisata / 景点"  (nama destinasi/objek)
            $table->string('name_id');
            $table->string('name_en')->nullable();
            $table->string('name_zh')->nullable();

            // Subjudul/tagline singkat (untuk card UI, opsional)
            $table->string('subtitle_id')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_zh')->nullable();

            // Dari Excel: "Deskripsi描述"
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_zh')->nullable();

            // Dari Excel: "budaya" (narasi budaya/heritage)
            $table->text('culture_id')->nullable();
            $table->text('culture_en')->nullable();
            $table->text('culture_zh')->nullable();

            // Label lokasi pendek untuk card (mis. "Lima Puluh Kota", "Agam")
            $table->string('location_label_id')->nullable();
            $table->string('location_label_en')->nullable();
            $table->string('location_label_zh')->nullable();

            // Badge (mis. "Popular Choice", "Best Value", "Limited Spots")
            $table->string('badge_label_id')->nullable();
            $table->string('badge_label_en')->nullable();
            $table->string('badge_label_zh')->nullable();

            // SEO (opsional, kalau mau di-SSR/OG)
            $table->string('meta_title_id')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_zh')->nullable();
            $table->text('meta_description_id')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_zh')->nullable();

            // ====== Field numerik/statistik untuk UI card ======
            $table->decimal('rating', 2, 1)->nullable();         // contoh: 4.9
            $table->unsignedInteger('rating_count')->default(0); // contoh: 312 ulasan

            // Jumlah item “tours/packages/expeditions” (pakai salah satu atau semuanya)
            $table->unsignedInteger('packages_count')->default(0);   // contoh: 12 Packages
            $table->unsignedInteger('tours_count')->default(0);      // contoh: 10 Tours / 7 Tours
            $table->unsignedInteger('expeditions_count')->default(0);// contoh: 5 Expeditions

            // Harga mulai (untuk “From IDR …”)
            $table->unsignedBigInteger('starting_price')->nullable(); // simpan dalam minor unit (IDR)
            $table->string('currency_code', 3)->default('IDR');

            // Media
            $table->string('image_main')->nullable();   // url/path gambar utama
            $table->string('image_thumb')->nullable();  // url/path thumbnail
            $table->json('gallery')->nullable();        // array url/path

            // Geospasial (opsional)
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            // Flag UI
            $table->boolean('is_popular_choice')->default(false);
            $table->boolean('is_best_value')->default(false);
            $table->boolean('is_limited_spots')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Index yang sering dipakai
            $table->index(['is_active', 'display_order']);
            // $table->index(['is_popular_choice', 'is_best_value', 'is_limited_spots']);
            $table->index(['city_id']); // search/filter cepat berdasarkan kota (ID)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attractions');
    }
}
