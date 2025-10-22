<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            // Identitas dasar
            $table->string('slug')->unique();                  // unik (contoh: agam, padang, solok-city)
            $table->enum('type', ['kabupaten', 'kota']);       // tipe administratif
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('filter');

            // Multi-bahasa
            $table->string('name_id');                         // Indonesia
            $table->string('name_en')->nullable();             // English
            $table->string('name_zh')->nullable();             // 中文（opsional）

            // Media
            $table->string('image_url')->nullable();           // URL/path gambar representatif

            // Opsional koordinat (boleh dipakai nanti)
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            $table->timestamps();

            // Index umum
            $table->index(['is_active', 'display_order']);
            $table->index(['type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
