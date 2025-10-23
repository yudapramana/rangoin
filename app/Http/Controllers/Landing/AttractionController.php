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
        $q = Attraction::query()
            ->with(['destination:id,name_id,slug']) // adjust columns as needed
            ->where('is_active', true);

        // Filters (optional)
        if ($request->filled('city')) {
            $city = $request->string('city')->toString();
            $q->where(function ($qq) use ($city) {
                $qq->where('city_id', 'like', "%{$city}%")
                   ->orWhere('city_en', 'like', "%{$city}%")
                   ->orWhere('city_zh', 'like', "%{$city}%");
            });
        }
        if ($request->filled('destination_id')) {
            $q->where('destination_id', $request->integer('destination_id'));
        }
        if ($request->boolean('popular')) {
            $q->where('is_popular_choice', true);
        }
        if ($request->boolean('best_value')) {
            $q->where('is_best_value', true);
        }

        // Sorting: display_order asc, then latest
        $q->orderBy('display_order')->orderByDesc('id');

        $attractions = $q->paginate(12)->withQueryString();

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
