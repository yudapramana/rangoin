<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attraction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug','display_order','city_id','city_en','city_zh',
        'name_id','name_en','name_zh',
        'subtitle_id','subtitle_en','subtitle_zh',
        'description_id','description_en','description_zh',
        'culture_id','culture_en','culture_zh',
        'location_label_id','location_label_en','location_label_zh',
        'badge_label_id','badge_label_en','badge_label_zh',
        'meta_title_id','meta_title_en','meta_title_zh',
        'meta_description_id','meta_description_en','meta_description_zh',
        'rating','rating_count','packages_count','tours_count','expeditions_count',
        'starting_price','currency_code',
        'image_main','image_thumb','gallery',
        'lat','lng',
        'is_popular_choice','is_best_value','is_limited_spots','is_active',
        'destination_id',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_popular_choice' => 'boolean',
        'is_best_value' => 'boolean',
        'is_limited_spots' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
    ];

    // Scope umum
    public function scopeActive($q)     { return $q->where('is_active', true); }
    public function scopeOrdered($q)    { return $q->orderBy('display_order'); }

    // Ambil teks lokal: $dst->t('name'), $dst->t('description'), $dst->t('location_label') dst.
    public function t(string $base): ?string
    {
        $map = ['id' => 'id', 'en' => 'en', 'zh' => 'zh'];
        $loc = app()->getLocale();
        $suffixes = [$map[$loc] ?? 'id', 'id', 'en', 'zh'];
        foreach (array_unique($suffixes) as $suf) {
            $col = "{$base}_{$suf}";
            if (!empty($this->{$col})) return $this->{$col};
        }
        return null;
    }

    // Ambil 4 featured: popular, best value, limited, dan 1 lainnya sebagai filler
    public static function pickFeaturedFour()
    {
        $ids = [];
        $take = fn($q) => optional($q->active()->ordered()->first(), function ($m) use (&$ids) { $ids[] = $m->id; return $m; });

        $popular = $take(static::where('is_popular_choice', true));
        $best    = $take(static::where('is_best_value', true)->whereNotIn('id', $ids));
        $limited = $take(static::where('is_limited_spots', true)->whereNotIn('id', $ids));
        $filler  = $take(static::whereNotIn('id', $ids));

        // urutan tampilan: 1 besar (popular) + 3 ringkas (best, filler, limited)
        $list = array_values(array_filter([$popular, $best, $filler, $limited]));
        // Jika kurang dari 4, isi dengan destinasi aktif lain
        if (count($list) < 4) {
            $more = static::active()->whereNotIn('id', collect($list)->pluck('id'))
                    ->ordered()->limit(4 - count($list))->get();
            $list = array_merge($list, $more->all());
        }
        return array_slice($list, 0, 4);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}
