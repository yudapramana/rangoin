<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DestinationController extends Controller
{
    public function index()
    {
        $title = 'Destinations';
        $br1   = 'Master Data';
        $br2   = 'Destinations';

        return view('admin.destinations.index', compact('title','br1','br2'));
    }

    public function datatable(Request $request)
    {
        $rows = Destination::query()
            ->orderBy('display_order')
            ->orderBy('name_id')
            ->get();

        $data = [];
        $no = 1;
        foreach ($rows as $r) {
            $badgeType = $r->type === 'kota'
                ? '<span class="badge bg-primary">Kota</span>'
                : '<span class="badge bg-success">Kabupaten</span>';

            $badgeActive = $r->is_active
                ? '<span class="badge bg-success">Aktif</span>'
                : '<span class="badge bg-secondary">Nonaktif</span>';

            $nameBlock = "
                <div class='fw-semibold mb-1'>{$r->name_id}</div>
                <div class='text-muted small'>
                    <span class='me-2'>EN: ".($r->name_en ?? '-')."</span>
                    <span class='me-2'>ZH: ".($r->name_zh ?? '-')."</span>
                </div>
                <div class='small text-muted'>Slug: <code>{$r->slug}</code></div>
            ";

            $image = $r->image_url
                ? "<img src='{$r->image_url}' alt='cover' style='width:90px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #eee;'/>"
                : "<span class='text-muted'>—</span>";

            $statusOrder = "
                <div class='d-flex flex-column align-items-center gap-1'>
                    {$badgeActive}
                    <div class='small text-muted'>Order: {$r->display_order}</div>
                </div>
            ";

            $actions = "
                <button class='btn btn-sm btn-warning me-1' id='editBtn'>Edit</button>
                <button class='btn btn-sm btn-danger' id='delBtn'>Hapus</button>
            ";

            $data[] = [
                'DT_RowIndex' => $no++,
                'name_block'  => $nameBlock,
                'type'        => $badgeType,
                'image'       => $image,
                'status_order'=> $statusOrder,
                'action'      => $actions,
                'raw'         => $r, // untuk akses saat edit
            ];
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function save(Request $request)
    {
        $id = $request->input('id');

        $validated = $request->validate([
            'slug'  => ['required','alpha_dash', Rule::unique('destinations','slug')->ignore($id)],
            'type'  => ['required', Rule::in(['kabupaten','kota'])],
            'display_order' => ['nullable','integer','min:0'],
            'is_active'     => ['required', Rule::in(['yes','no'])],
            'name_id' => ['required','string','max:255'],
            'name_en' => ['nullable','string','max:255'],
            'name_zh' => ['nullable','string','max:255'],
            'image_url' => ['nullable','string','max:1000'],
        ],[
            'slug.alpha_dash' => 'Slug hanya boleh huruf, angka, strip, underscore.'
        ]);

        $payload = [
            'slug'          => $validated['slug'],
            'type'          => $validated['type'],
            'display_order' => (int) ($validated['display_order'] ?? 0),
            'is_active'     => $validated['is_active'] === 'yes',
            'name_id'       => $validated['name_id'],
            'name_en'       => $validated['name_en'] ?? null,
            'name_zh'       => $validated['name_zh'] ?? null,
            'image_url'     => $validated['image_url'] ?? null,
        ];

        if ($id) {
            $row = Destination::findOrFail($id);
            $row->update($payload);
        } else {
            $row = Destination::create($payload);
        }

        return response()->json(['success' => 'yeah', 'data' => $row]);
    }

    public function destroy($id)
    {
        $row = Destination::findOrFail($id);
        $row->delete();

        return response()->json(['success' => true]);
    }
}
