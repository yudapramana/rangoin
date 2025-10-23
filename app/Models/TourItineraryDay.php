<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function title(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_en;
    }

    public function description(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_en;
    }

    public function accommodation(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{"accommodation_{$locale}"} ?? $this->accommodation_en;
    }

    public function locationName(?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{"location_name_{$locale}"} ?? $this->location_name_en;
    }
}
