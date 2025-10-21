<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttractionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('attraction')?->id ?? null;

        return [
            'slug' => ['required','string','max:255','unique:attractions,slug'.($id?','.$id:'')],
            'display_order' => ['nullable','integer','min:0'],

            'name_id' => ['required','string','max:255'],
            'name_en' => ['nullable','string','max:255'],
            'name_zh' => ['nullable','string','max:255'],

            'city_id' => ['nullable','string','max:255'],
            'city_en' => ['nullable','string','max:255'],
            'city_zh' => ['nullable','string','max:255'],

            'subtitle_id' => ['nullable','string','max:255'],
            'subtitle_en' => ['nullable','string','max:255'],
            'subtitle_zh' => ['nullable','string','max:255'],

            'description_id' => ['nullable','string'],
            'description_en' => ['nullable','string'],
            'description_zh' => ['nullable','string'],

            'culture_id' => ['nullable','string'],
            'culture_en' => ['nullable','string'],
            'culture_zh' => ['nullable','string'],

            'location_label_id' => ['nullable','string','max:255'],
            'location_label_en' => ['nullable','string','max:255'],
            'location_label_zh' => ['nullable','string','max:255'],

            'badge_label_id' => ['nullable','string','max:255'],
            'badge_label_en' => ['nullable','string','max:255'],
            'badge_label_zh' => ['nullable','string','max:255'],

            'meta_title_id' => ['nullable','string','max:255'],
            'meta_title_en' => ['nullable','string','max:255'],
            'meta_title_zh' => ['nullable','string','max:255'],
            'meta_description_id' => ['nullable','string'],
            'meta_description_en' => ['nullable','string'],
            'meta_description_zh' => ['nullable','string'],

            'rating' => ['nullable','numeric','between:0,5'],
            'rating_count' => ['nullable','integer','min:0'],
            'packages_count' => ['nullable','integer','min:0'],
            'tours_count' => ['nullable','integer','min:0'],
            'expeditions_count' => ['nullable','integer','min:0'],

            'starting_price' => ['nullable','integer','min:0'],
            'currency_code' => ['required','string','size:3'],

            'image_main' => ['nullable','string','max:2048'],
            'image_thumb' => ['nullable','string','max:2048'],
            'gallery' => ['nullable','array'],
            'gallery.*' => ['string','max:2048'],

            'lat' => ['nullable','numeric','between:-90,90'],
            'lng' => ['nullable','numeric','between:-180,180'],

            'is_popular_choice' => ['nullable','boolean'],
            'is_best_value' => ['nullable','boolean'],
            'is_limited_spots' => ['nullable','boolean'],
            'is_active' => ['nullable','boolean'],

            'destination_id' => ['nullable','exists:destinations,id'],
        ];
    }
}
