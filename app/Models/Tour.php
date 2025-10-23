<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','slug',
        'title_id','title_en','title_zh',
        'tagline_id','tagline_en','tagline_zh',
        'short_desc_id','short_desc_en','short_desc_zh',
        'overview_id','overview_en','overview_zh',
        'duration_days','duration_nights','group_min','group_max',
        'countries','currency','price','sale_price',
        'badge_type','badge_limited_spots','badge_label_id','badge_label_en','badge_label_zh',
        'rating_avg','rating_count',
        'hero_image_url','gallery_urls',
        'cta_label_id','cta_label_en','cta_label_zh',
        'status','published_at',
        'meta_title_id','meta_title_en','meta_title_zh',
        'meta_description_id','meta_description_en','meta_description_zh',
    ];

    protected $casts = [
        'countries'      => 'array',
        'gallery_urls'   => 'array',
        'duration_days'  => 'integer',
        'duration_nights'=> 'integer',
        'group_min'      => 'integer',
        'group_max'      => 'integer',
        'price'          => 'integer',
        'sale_price'     => 'integer',
        'rating_avg'     => 'decimal:2',
        'rating_count'   => 'integer',
        'published_at'   => 'datetime',
    ];

    /* ========= RELATIONS ========= */
    public function highlights()
    {
        return $this->hasMany(TourHighlight::class)->orderBy('sort');
    }

    public function itineraryDays()
    {
        return $this->hasMany(TourItineraryDay::class)->orderBy('day_number');
    }

    public function topics()
    {
        return $this->belongsToMany(TourTopic::class, 'tour_topic_pivot');
    }

    /* ========= SCOPES ========= */
    public function scopePublished($q)
    {
        return $q->where('status', 'published')->whereNotNull('published_at');
    }

    public function scopeBadge($q, string $type)
    {
        return $q->where('badge_type', $type);
    }

    /* ========= I18N HELPERS ========= */
    public function trans(string $base, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $key = "{$base}_{$locale}";
        return $this->getAttribute($key) ?? $this->getAttribute("{$base}_en");
    }

    public function getTitleAttribute(): ?string
    {
        return $this->trans('title');
    }

    public function getTaglineAttribute(): ?string
    {
        return $this->trans('tagline');
    }

    public function getShortDescAttribute(): ?string
    {
        return $this->trans('short_desc');
    }

    public function getOverviewAttribute(): ?string
    {
        return $this->trans('overview');
    }

    public function getCtaLabelAttribute(): ?string
    {
        return $this->trans('cta_label');
    }
}
