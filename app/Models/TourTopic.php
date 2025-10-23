<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourTopic extends Model
{
    use HasFactory;

    protected $fillable = ['slug','name_id','name_en','name_zh'];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_topic_pivot');
    }

    public function name(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{"name_{$locale}"} ?? $this->name_en;
    }
}
