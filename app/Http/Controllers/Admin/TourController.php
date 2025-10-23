<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index(Request $request)
    {
        // Sinkronkan locale 'cn' -> 'zh' agar accessor i18n di model bekerja
        $locale = $request->get('lang', session('app_locale', config('app.locale')));
        if (! in_array($locale, ['id','en','cn','zh'])) {
            $locale = config('app.locale');
        }
        app()->setLocale($locale === 'cn' ? 'zh' : $locale);
        session(['app_locale' => app()->getLocale()]);

        // === Filters ===
        $q         = trim($request->get('q', ''));
        $badge     = $request->get('badge');               // none|top_rated|newly_added|limited
        $currency  = $request->get('currency');            // IDR|USD|...
        $durRange  = $request->get('duration');            // 1-3 | 4-7 | 8-14 | 15+
        $priceMin  = $request->get('price_min');           // angka
        $priceMax  = $request->get('price_max');           // angka
        $status    = $request->get('status');              // published|draft|archived

        $tours = Tour::query()->with(['highlights' => fn($q) => $q->orderBy('sort')]);

        // Basic search di 3 bahasa title & short desc
        if ($q !== '') {
            $tours->where(function ($w) use ($q) {
                $w->where('title_id', 'like', "%$q%")
                  ->orWhere('title_en', 'like', "%$q%")
                  ->orWhere('title_zh', 'like', "%$q%")
                  ->orWhere('short_desc_id', 'like', "%$q%")
                  ->orWhere('short_desc_en', 'like', "%$q%")
                  ->orWhere('short_desc_zh', 'like', "%$q%")
                  ->orWhere('code', 'like', "%$q%")
                  ->orWhere('slug', 'like', "%$q%");
            });
        }

        if ($status) {
            $tours->where('status', $status);
        }

        if ($badge && in_array($badge, ['none','top_rated','newly_added','limited'])) {
            $tours->where('badge_type', $badge);
        }

        if ($currency) {
            $tours->where('currency', strtoupper($currency));
        }

        if ($durRange) {
            if ($durRange === '15+') {
                $tours->where('duration_days', '>=', 15);
            } else {
                [$min, $max] = array_pad(explode('-', $durRange), 2, null);
                if ($min) $tours->where('duration_days', '>=', (int)$min);
                if ($max) $tours->where('duration_days', '<=', (int)$max);
            }
        }

        if ($priceMin !== null && $priceMin !== '') {
            $tours->where(function ($w) use ($priceMin) {
                $w->where('sale_price', '>=', (int)$priceMin)
                  ->orWhere(function ($ww) use ($priceMin) {
                      $ww->whereNull('sale_price')
                         ->where('price', '>=', (int)$priceMin);
                  });
            });
        }

        if ($priceMax !== null && $priceMax !== '') {
            $tours->where(function ($w) use ($priceMax) {
                $w->where('sale_price', '<=', (int)$priceMax)
                  ->orWhere(function ($ww) use ($priceMax) {
                      $ww->whereNull('sale_price')
                         ->where('price', '<=', (int)$priceMax);
                  });
            });
        }

        // urutan default: prioritas published terbaru & rating
        $tours->orderByRaw("CASE WHEN status='published' THEN 0 ELSE 1 END")
              ->orderByDesc('published_at')
              ->orderByDesc('rating_avg')
              ->orderBy('duration_days');

        $tours = $tours->paginate(12)->appends($request->query());

        // helper harga: IDR -> “K”, selain itu angka biasa
        $fmtPrice = function (?int $amount, string $ccy) {
            if (!$amount) return null;
            $ccy = strtoupper($ccy ?: 'IDR');
            if ($ccy === 'IDR') {
                $k = $amount / 1000;
                return sprintf('IDR %sK', number_format($k, 0, ',', '.'));
            }
            return sprintf('%s %s', $ccy, number_format($amount, 0, ',', '.'));
        };

        // siapkan data presentasi buat kartu
        $list = $tours->getCollection()->map(function (Tour $t) use ($fmtPrice) {
            // badge text
            $badgeText = match ($t->badge_type) {
                'top_rated'   => __('landing.badges.top_rated'),
                'newly_added' => __('landing.badges.newly_added'),
                'limited'     => $t->trans('badge_label') ?? __('landing.badges.limited'),
                default       => null,
            };

            return [
                'id'           => $t->id,
                'slug'         => $t->slug,
                'code'         => $t->code,
                'title'        => $t->title,
                'summary'      => $t->short_desc ?? $t->short_desc_en ?? null,
                'duration'     => "{$t->duration_days}D{$t->duration_nights}N",
                'group_max'    => $t->group_max,
                'price'        => $fmtPrice($t->sale_price ?: $t->price, $t->currency ?? 'IDR'),
                'badge_text'   => $badgeText,
                'rating'       => $t->rating_avg ? number_format($t->rating_avg, 1) : null,
                'rating_count' => $t->rating_count,
                'image'        => $t->hero_image_url ?: asset('tour/img/travel/placeholder-tour.webp'),
                'highlights'   => $t->highlights->take(3)->map(fn($h)=>$h->item())->values()->all(),
                'status'       => $t->status,
                'published_at' => optional($t->published_at)->format('Y-m-d'),
            ];
        });

        // ganti koleksi paginasi dengan array presentasi
        $tours->setCollection(collect($list));

        return view('admin.tours.index', [
            'tours'   => $tours,
            'filters' => [
                'q'        => $q,
                'badge'    => $badge,
                'currency' => $currency,
                'duration' => $durRange,
                'price_min'=> $priceMin,
                'price_max'=> $priceMax,
                'status'   => $status,
            ],
        ]);
    }
}
