<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'slug','type','display_order','is_active',
        'name_id','name_en','name_zh','image_url','lat','lng',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
    ];

    public function attractions()
    {
        return $this->hasMany(Attraction::class)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('name_id');
    }
}
