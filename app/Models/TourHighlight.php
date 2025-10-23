<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id','sort','item_id','item_en','item_zh','icon',
    ];

    protected $casts = [
        'sort' => 'integer',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /* I18N helper */
    public function item(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $attr = "item_{$locale}";
        return $this->{$attr} ?? $this->item_en;
    }
}
