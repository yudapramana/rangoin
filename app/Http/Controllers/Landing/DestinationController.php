<?php 
// app/Http/Controllers/Landing/DestinationController.php
namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $destinations = Destination::query()
            ->where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('name_id')
            ->get();

        // Kumpulkan filter unik dari kolom `filter` (contoh: tropical, mountain, urban, dst.)
        $filters = $destinations->pluck('filter')->filter()->unique()->values();

        return view('landing.destinations.index', [
            'title'        => 'Destinations',
            'subtitle'     => 'Uncover Captivating Travel Experiences',
            'lead'         => "From the bustling energy of cosmopolitan cities to the serene embrace of untouched wilderness.",
            'destinations' => $destinations,
            'filters'      => $filters,
        ]);
    }

    public function show($slug)
    {
        $d = \App\Models\Destination::with(['attractions'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // (opsional) statistik ringkas untuk header
        $stats = [
            'count'   => $d->attractions->count(),
            'avgRate' => (float) round($d->attractions->whereNotNull('rating')->avg('rating'), 1),
            'minFrom' => $d->attractions->whereNotNull('starting_price')->min('starting_price'),
        ];

        return view('landing.destinations.show', compact('d','stats'));
    }
}
