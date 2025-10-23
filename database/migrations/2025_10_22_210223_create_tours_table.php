<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $t) {
            $t->id();

            // Identitas dasar
            $t->string('code')->unique()->comment('Kode internal, mis. MED-12D-TRIO');
            $t->string('slug')->unique();

            // Judul & tagline (hero)
            $t->string('title_id');
            $t->string('title_en');
            $t->string('title_zh');

            $t->string('tagline_id')->nullable();
            $t->string('tagline_en')->nullable();
            $t->string('tagline_zh')->nullable();

            // Ringkas/lead (deskripsi singkat yang tampil di kartu)
            $t->text('short_desc_id')->nullable();
            $t->text('short_desc_en')->nullable();
            $t->text('short_desc_zh')->nullable();

            // Overview (section “Tour Overview”)
            $t->longText('overview_id')->nullable();
            $t->longText('overview_en')->nullable();
            $t->longText('overview_zh')->nullable();

            // Durasi & kapasitas (ditarik dari kartu)
            $t->unsignedSmallInteger('duration_days')->comment('Mis. 5, 8, 10, 12');
            $t->unsignedSmallInteger('duration_nights')->default(0);
            $t->unsignedSmallInteger('group_min')->nullable();
            $t->unsignedSmallInteger('group_max')->nullable();

            // Lokasi negara/area yang dilalui (chips seperti Italy, Greece, Turkey)
            $t->json('countries')->nullable()->comment('Array of country/area slugs or names');

            // Harga & mata uang tampilan (label price bubble)
            $t->char('currency', 3)->default('USD'); // atau IDR
            $t->unsignedInteger('price')->comment('Harga dasar tampil, dalam minor unit jika ingin (opsional)')->nullable();
            $t->unsignedInteger('sale_price')->nullable();

            // Badge (Top Rated / Newly Added / Only X Spots)
            $t->enum('badge_type', ['none','top_rated','newly_added','limited'])->default('none');
            $t->unsignedSmallInteger('badge_limited_spots')->nullable(); // untuk "Only 3 Spots!"
            $t->string('badge_label_id')->nullable();
            $t->string('badge_label_en')->nullable();
            $t->string('badge_label_zh')->nullable();

            // Rating tampilan di kartu/detail
            $t->decimal('rating_avg', 3, 2)->nullable(); // mis. 4.8
            $t->unsignedInteger('rating_count')->nullable(); // mis. 95

            // Media
            $t->string('hero_image_url')->nullable();
            $t->json('gallery_urls')->nullable();

            // CTA text (opsional)
            $t->string('cta_label_id')->nullable(); // mis. "Cek Ketersediaan" / "Book Now"
            $t->string('cta_label_en')->nullable();
            $t->string('cta_label_zh')->nullable();

            // Status & meta
            $t->enum('status', ['draft','published','archived'])->default('draft');
            $t->timestamp('published_at')->nullable();

            // SEO (opsional)
            $t->string('meta_title_id')->nullable();
            $t->string('meta_title_en')->nullable();
            $t->string('meta_title_zh')->nullable();
            $t->text('meta_description_id')->nullable();
            $t->text('meta_description_en')->nullable();
            $t->text('meta_description_zh')->nullable();

            $t->timestamps();

            $t->index(['status', 'published_at']);
            $t->index('duration_days');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
