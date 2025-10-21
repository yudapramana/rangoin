<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            // nullable agar aman untuk data lama; kalau region dihapus -> set null
            $table->foreignId('destination_id')
                ->nullable()
                ->after('slug')
                ->constrained('destinations')
                ->nullOnDelete();

            $table->index('destination_id');
        });
    }

    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('destination_id');
        });
    }
};
