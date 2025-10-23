<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourHighlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_highlights', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tour_id')->constrained()->cascadeOnDelete();

            $t->unsignedSmallInteger('sort')->default(0);
            $t->string('item_id'); // contoh: "4-Star Boutique Hotels"
            $t->string('item_en');
            $t->string('item_zh');

            // Optional icon key (mis. lucide/heroicons name)
            $t->string('icon')->nullable();

            $t->timestamps();

            $t->index(['tour_id','sort']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_highlights');
    }
}
