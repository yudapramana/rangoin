<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


class TourTopic extends Model
{
    use HasFactory;

    protected $fillable = ['slug','name_id','name_en','name_zh'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_topic_pivot');
    }

    // public function name(?string $locale = null): string
    // {
    //     $locale = $locale ?? app()->getLocale();
    //     return $this->{"name_{$locale}"} ?? $this->name_en;
    // }

    /**
     * Accessor i18n untuk 'name'
     * Memastikan diperlakukan sbg accessor, bukan relasi.
     */
    protected function name(): Attribute
    {
        return Attribute::get(function () {
            $loc = app()->getLocale();
            // sesuaikan nama kolom Anda
            $map = [
                'id' => 'name_id',
                'en' => 'name_en',
                'zh' => 'name_zh',
            ];
            $col = $map[$loc] ?? 'name_en';

            return $this->getAttribute($col)
                ?? $this->getAttribute('name_en')
                ?? $this->getAttribute('slug');
        });
    }


    /**
     * (opsional) helper tampilan singkat
     */
    public function item(): string
    {
        return $this->name; // akan pakai accessor di atas
    }
}
