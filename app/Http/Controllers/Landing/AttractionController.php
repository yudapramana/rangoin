<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    /**
     * GET /attractions
     * Simple listing with a few optional filters.
     */
    public function index(Request $request)
    {
        $attractions = Attraction::query()
            ->with(['destination:id,name_id,slug'])
            ->where('is_active', true)
            ->orderBy('display_order')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('landing.attractions.index', compact('attractions'));
    }


    /**
     * GET /attractions/{slug}
     * Show a single attraction detail.
     */
    public function show(string $slug)
    {
        $attraction = Attraction::query()
            ->with(['destination:id,name_id,slug'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('landing.attractions.show', compact('attraction'));
    }
}
