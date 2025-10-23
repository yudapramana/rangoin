<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourItineraryDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_itinerary_days', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tour_id')->constrained()->cascadeOnDelete();

            $t->unsignedSmallInteger('day_number'); // Day 1..N
            $t->string('title_id');                 // ex: "Arrival in Venice"
            $t->string('title_en');
            $t->string('title_zh');

            $t->longText('description_id')->nullable();
            $t->longText('description_en')->nullable();
            $t->longText('description_zh')->nullable();

            // Lokasi kota/area utama hari itu (opsional, untuk breadcrumb/timeline)
            $t->string('location_name_id')->nullable();
            $t->string('location_name_en')->nullable();
            $t->string('location_name_zh')->nullable();

            // Inclusions sederhana (sesuai contoh ikon: hotel/meal)
            $t->boolean('inc_breakfast')->default(false);
            $t->boolean('inc_lunch')->default(false);
            $t->boolean('inc_dinner')->default(false);
            $t->string('accommodation_id')->nullable(); // "Hotel Palazzo Vitturi"
            $t->string('accommodation_en')->nullable();
            $t->string('accommodation_zh')->nullable();

            // Media spesifik hari (opsional)
            $t->string('image_url')->nullable();

            $t->timestamps();

            $t->unique(['tour_id','day_number']);
            $t->index('day_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_itinerary_days');
    }
}
