<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourBrowseController extends Controller
{
    public function index(Request $request)
    {
        // Sinkronkan locale: URL boleh pakai ?lang=cn tapi kolom kita *_zh
        $locale = $request->get('lang', session('app_locale', config('app.locale')));
        if (! in_array($locale, ['id','en','cn','zh'])) {
            $locale = config('app.locale');
        }
        app()->setLocale($locale === 'cn' ? 'zh' : $locale);
        session(['app_locale' => app()->getLocale()]);

        // ====== Featured (slider): 6 terbaik published ======
        $featured = Tour::published()
            ->with(['highlights' => fn($q) => $q->orderBy('sort')])
            ->orderByDesc('rating_avg')
            ->orderBy('duration_days')
            ->limit(6)
            ->get();

        // ====== All tours (grid) dengan pagination & filter sederhana ======
        $q        = trim($request->get('q', ''));
        $duration = $request->get('duration'); // 1-3, 4-7, 8-14, 15+
        $price    = $request->get('price');    // 0-500, 500-1000, 1000-2000, 2000+

        $toursQ = Tour::published()->with(['highlights' => fn($q) => $q->orderBy('sort')]);

        if ($q !== '') {
            $toursQ->where(function($w) use ($q) {
                $w->where('title_id','like',"%$q%")
                  ->orWhere('title_en','like',"%$q%")
                  ->orWhere('title_zh','like',"%$q%")
                  ->orWhere('short_desc_id','like',"%$q%")
                  ->orWhere('short_desc_en','like',"%$q%")
                  ->orWhere('short_desc_zh','like',"%$q%")
                  ->orWhere('code','like',"%$q%")
                  ->orWhere('slug','like',"%$q%");
            });
        }

        if ($duration) {
            if ($duration === '15+') {
                $toursQ->where('duration_days', '>=', 15);
            } else {
                [$min, $max] = array_pad(explode('-', $duration), 2, null);
                if ($min) $toursQ->where('duration_days','>=',(int)$min);
                if ($max) $toursQ->where('duration_days','<=',(int)$max);
            }
        }

        if ($price) {
            // Catatan: field price/sale_price dianggap “satuan penuh” (IDR/USD), bukan cents.
            [$lo, $hi] = match($price) {
                '0-500'      => [0, 500],
                '500-1000'   => [500, 1000],
                '1000-2000'  => [1000, 2000],
                '2000+'      => [2000, null],
                default      => [null, null],
            };
            if ($lo !== null) {
                $toursQ->where(function($w) use ($lo) {
                    $w->whereNotNull('sale_price')->where('sale_price','>=',$lo)
                      ->orWhere(function($ww) use ($lo) {
                          $ww->whereNull('sale_price')->where('price','>=',$lo);
                      });
                });
            }
            if ($hi !== null) {
                $toursQ->where(function($w) use ($hi) {
                    $w->whereNotNull('sale_price')->where('sale_price','<=',$hi)
                      ->orWhere(function($ww) use ($hi) {
                          $ww->whereNull('sale_price')->where('price','<=',$hi);
                      });
                });
            }
        }

        $toursQ->orderByDesc('published_at')
               ->orderByDesc('rating_avg')
               ->orderBy('duration_days');

        $tours = $toursQ->paginate(12)->appends($request->query());

        // Helpers presentasi
        $fmtPrice = function (?int $amount, ?string $ccy) {
            if (!$amount) return null;
            $ccy = strtoupper($ccy ?? 'IDR');
            // Jika IDR: tampil “IDR 2.150K” (anggap nilai = rupiah)
            if ($ccy === 'IDR') {
                $k = $amount / 1000;
                return sprintf('IDR %sK', number_format($k, 0, ',', '.'));
            }
            // Selain IDR: tampilkan angka utuh
            return sprintf('%s %s', $ccy, number_format($amount, 0, ',', '.'));
        };

        // Map featured untuk slider
        $featuredCards = $featured->map(function (Tour $t) use ($fmtPrice) {
            $badge = match ($t->badge_type) {
                'top_rated'   => __('landing.badges.top_rated'),
                'newly_added' => __('landing.badges.newly_added'),
                'limited'     => $t->trans('badge_label') ?? __('landing.badges.limited'),
                default       => null,
            };

            return [
                'title'    => $t->title,
                'summary'  => $t->short_desc ?? $t->short_desc_en ?? null,
                'duration' => "{$t->duration_days} " . __('landing.tours.days'),
                'price'    => $fmtPrice($t->sale_price ?: $t->price, $t->currency),
                'image'    => $t->hero_image_url ?: asset('tour/img/travel/placeholder-tour.webp'),
                'badge'    => $badge,
                'url'      => route('tours.show', $t->slug),
            ];
        });

        // Map grid “All Tours”
        $grid = $tours->getCollection()->map(function (Tour $t) use ($fmtPrice) {
            return [
                'title'        => $t->title,
                'summary'      => $t->short_desc ?? $t->short_desc_en ?? null,
                'duration_days'=> $t->duration_days,
                'duration'     => "{$t->duration_days} " . __('landing.tours.days'),
                'rating'       => $t->rating_avg ? number_format($t->rating_avg, 1) : null,
                'rating_count' => $t->rating_count,
                'price'        => $fmtPrice($t->sale_price ?: $t->price, $t->currency),
                'image'        => $t->hero_image_url ?: asset('tour/img/travel/placeholder-tour.webp'),
                'url'          => route('tours.show', $t->slug),
            ];
        });
        $tours->setCollection($grid);

        return view('landing.tours.index', [
            'featured' => $featuredCards,
            'tours'    => $tours,
            'filters'  => [
                'q'        => $q,
                'duration' => $duration,
                'price'    => $price,
            ],
        ]);
    }

    // public function show(string $slug)
    // {
    //     $tour = Tour::published()
    //         ->with(['highlights','itineraryDays','topics'])
    //         ->where('slug',$slug)
    //         ->firstOrFail();

    //     return view('landing.tours.show', compact('tour')); // siapkan view ini sesuai kebutuhan Anda
    // }


    public function show(string $slug)
    {
        $tour = Tour::published()
            ->with([
                'highlights' => fn($q) => $q->orderBy('sort'),
                'itineraryDays' => fn($q) => $q->orderBy('day_number'),
                'topics'
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('landing.tours.show', compact('tour'));
    }

}
