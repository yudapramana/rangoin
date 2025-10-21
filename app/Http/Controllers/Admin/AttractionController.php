<?php

// app/Http/Controllers/Admin/AttractionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttractionRequest;
use App\Models\Attraction;
use App\Models\Destination;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    public function index()
    {
        return view('admin.attractions.index', [
            'title' => 'Attractions',
            'br1'   => 'Content',
            'br2'   => 'Attractions',
            'destinations' => Destination::select('id','name_id','name_en')->orderBy('name_id')->get(),
        ]);
    }

    public function datatable(Request $request)
    {
        // Basic server-side format mirip output yang kamu pakai
        $query = Attraction::with('destination')->orderBy('display_order')->latest('id');

        // paging
        $total = $query->count();

        // DataTables expects: draw, recordsTotal, recordsFiltered, data
        $data = $query->get()->map(function($a, $i) {
            $media = '<div class="d-flex flex-column align-items-center">'
                .($a->image_thumb ? "<img src='{$a->image_thumb}' alt='' style='width:70px;height:70px;object-fit:cover;border-radius:6px;border:1px solid #eee'/>" : '<span class="text-muted">—</span>')
                .'</div>';

            $badges = [];
            if($a->is_popular_choice) $badges[] = '<span class="badge bg-success">Popular</span>';
            if($a->is_best_value)    $badges[] = '<span class="badge bg-primary">Best Value</span>';
            if($a->is_limited_spots) $badges[] = '<span class="badge bg-warning text-dark">Limited</span>';
            $flags = implode(' ', $badges);

            $nameDesc =
                "<div class='fw-semibold'>{$a->name_id}"
                .($a->subtitle_id ? " <small class='text-muted'>— {$a->subtitle_id}</small>" : "")
                ."</div>"
                ."<div class='small text-muted'>Slug: {$a->slug}</div>"
                ."<div class='small mt-1'>Rating: ".($a->rating ?? '–')." • Reviews: {$a->rating_count}</div>"
                ."<div class='small'>Pkg/Tour/Exp: {$a->packages_count}/{$a->tours_count}/{$a->expeditions_count}</div>"
                .($flags ? "<div class='mt-1'>{$flags}</div>" : "");

            $loc =
                "<div>".($a->destination?->name_id ?? '–')."</div>"
                ."<small class='text-muted'>City: ".($a->city_id ?? '–')."</small>"
                .($a->location_label_id ? "<div><small class='text-muted'>Label: {$a->location_label_id}</small></div>" : "");

            $action =
            "<div class='btn-group'>
                <button id='editBtn' class='btn btn-sm btn-outline-primary'>Edit</button>
                <button class='btn btn-sm btn-outline-danger' onclick='deleteAttraction({$a->id})'>Hapus</button>
            </div>";

            return [
                'DT_RowIndex'   => '',
                'name-description' => $nameDesc,
                'location'      => $loc,
                'media'         => $media,
                'action'        => $action,
                'raw'           => $a, // untuk keperluan JS (edit)
            ];
        });

        return response()->json([
            'data' => $data,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'draw' => intval($request->get('draw')),
        ]);
    }

    public function store(AttractionRequest $request)
    {
        $payload = $request->validated();
        // pastikan gallery array -> json
        if (isset($payload['gallery']) && is_array($payload['gallery'])) {
            $payload['gallery'] = array_values(array_filter($payload['gallery']));
        }

        $payload['currency_code'] = $payload['currency_code'] ?? 'IDR';

        $a = Attraction::create($payload);

        return response()->json(['success' => 'yeah', 'data' => $a]);
    }

    public function update(AttractionRequest $request, Attraction $attraction)
    {
        $payload = $request->validated();
        if (isset($payload['gallery']) && is_array($payload['gallery'])) {
            $payload['gallery'] = array_values(array_filter($payload['gallery']));
        }

        $attraction->update($payload);

        return response()->json(['success' => 'yeah', 'data' => $attraction]);
    }

    public function destroy(Attraction $attraction)
    {
        $attraction->delete();
        return response()->json(['success' => true]);
    }
}
