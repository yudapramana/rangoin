<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $featured = Destination::pickFeaturedFour();

        // helper format harga “IDR 2.950K” (sederhana)
        $fmt = function (?int $minor, string $ccy = 'IDR') {
            if (!$minor) return null;
            // asumsikan minor = 1 rupiah; jadikan ribuan “K”
            $k = $minor / 1000;
            // 1.750K, 6.900K dst.
            return sprintf('%s %sK', $ccy, number_format($k, 0, ',', '.'));
        };

        // siapkan struktur presentasi agar Blade rapi
        $presented = collect($featured)->map(function ($d) use ($fmt) {
            // pilih mana yang dihitung “count label”
            $count = $d->tours_count ?: ($d->packages_count ?: $d->expeditions_count);
            $countType = $d->tours_count ? __('landing.common.tours')
                        : ($d->packages_count ? __('landing.common.packages')
                        : ($d->expeditions_count ? __('landing.common.expeditions') : ''));

            return [
                'id'        => $d->id,
                'name'      => $d->t('name') ?? $d->slug,
                'subtitle'  => $d->t('subtitle'),
                'city'      => $d->t('location_label') ?: $d->t('city'),
                'desc'      => $d->t('description'),
                'badge'     => [
                    'popular' => $d->is_popular_choice,
                    'best'    => $d->is_best_value,
                    'limited' => $d->is_limited_spots,
                    'label'   => $d->is_best_value
                                    ? __('landing.badges.best_value')
                                    : ($d->is_limited_spots
                                        ? __('landing.badges.limited')
                                        : ($d->is_popular_choice ? __('landing.destinations.popular') : null)),
                ],
                'rating'    => $d->rating,
                'rating_count' => $d->rating_count,
                'count'     => $count,
                'count_type'=> $countType,
                'price'     => $fmt($d->starting_price, $d->currency_code ?? 'IDR'),
                'image'     => $d->image_main,
                'slug'      => $d->slug,
            ];
        });
        
        $services = \App\Models\Services::where('featured', 'yes')->get();
        $carousels = \App\Models\Carousel::where('active', 'yes')->get();
        $recent_posts = \App\Models\Post::orderBy('created_at', 'DESC')->take(5)->get();
        return view('landing.home', [
            'title' => 'Pandan View Mandeh - Villa Cafe dan Cottage Resort untuk Liburan Keluarga',
            'accountfb' => 'pandanviewmandeh',
            'account' => 'pandanviewmandeh',
            'channel' =>  '@pandanviewmandehofficial4919',
            'services' =>  $services,
            'carousels' =>  $carousels,
            'recent_posts' => $recent_posts,
            'featuredDestinations' => $presented,
        ]);
    }
}
