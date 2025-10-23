<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


class TourItineraryDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id','day_number',
        'title_id','title_en','title_zh',
        'description_id','description_en','description_zh',
        'location_name_id','location_name_en','location_name_zh',
        'inc_breakfast','inc_lunch','inc_dinner',
        'accommodation_id','accommodation_en','accommodation_zh',
        'image_url',
    ];

    protected $casts = [
        'day_number'   => 'integer',
        'inc_breakfast'=> 'bool',
        'inc_lunch'    => 'bool',
        'inc_dinner'   => 'bool',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /* I18N helpers */
    // public function title(?string $locale = null): string
    // {
    //     $locale = $locale ?? app()->getLocale();
    //     return $this->{"title_{$locale}"} ?? $this->title_en;
    // }

    protected function title(): Attribute
    {
        return Attribute::get(function () {
            $loc = app()->getLocale();
            $map = [
                'id' => 'title_id',
                'en' => 'title_en',
                'zh' => 'title_zh',
            ];
            $col = $map[$loc] ?? 'title_en';

            return $this->getAttribute($col)
                ?? $this->getAttribute('title_en');
        });
    }

    protected function description(): Attribute
    {
        return Attribute::get(function () {
            $loc = app()->getLocale();
            $map = [
                'id' => 'description_id',
                'en' => 'description_en',
                'zh' => 'description_zh',
            ];
            $col = $map[$loc] ?? 'description_en';

            return $this->getAttribute($col)
                ?? $this->getAttribute('description_en');
        });
    }

    protected function location(): Attribute
    {
        return Attribute::get(function () {
            $loc = app()->getLocale();
            $map = [
                'id' => 'location_id',
                'en' => 'location_en',
                'zh' => 'location_zh',
            ];
            $col = $map[$loc] ?? 'location_en';

            return $this->getAttribute($col)
                ?? $this->getAttribute('location_en');
        });
    }

    protected function accommodation(): Attribute
    {
        return Attribute::get(function () {
            $loc = app()->getLocale();
            $map = [
                'id' => 'accommodation_id',
                'en' => 'accommodation_en',
                'zh' => 'accommodation_zh',
            ];
            $col = $map[$loc] ?? 'accommodation_en';

            return $this->getAttribute($col)
                ?? $this->getAttribute('accommodation_en');
        });
    }

    // public function description(?string $locale = null): ?string
    // {
    //     $locale = $locale ?? app()->getLocale();
    //     return $this->{"description_{$locale}"} ?? $this->description_en;
    // }

    // public function accommodation(?string $locale = null): ?string
    // {
    //     $locale = $locale ?? app()->getLocale();
    //     return $this->{"accommodation_{$locale}"} ?? $this->accommodation_en;
    // }

    public function locationName(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{"location_name_{$locale}"} ?? $this->location_name_en;
    }
}
