<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tour_topics', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('name_id');
            $t->string('name_en');
            $t->string('name_zh');
            $t->timestamps();
        });

        Schema::create('tour_topic_pivot', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tour_id')->constrained()->cascadeOnDelete();
            $t->foreignId('tour_topic_id')->constrained('tour_topics')->cascadeOnDelete();
            $t->unique(['tour_id', 'tour_topic_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_topic_pivot');
        Schema::dropIfExists('tour_topics');
    }
};
