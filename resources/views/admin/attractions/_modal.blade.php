<div class="modal fade" id="tambahAttraction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modalBox">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-modal">Tambah Attraction Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- DEFAULT action diarahkan ke STORE sebagai fallback --}}
            <form id="attractionForm" method="POST" action="{{ route('admin.attractions.store') }}" novalidate>
                @csrf
                <input type="hidden" id="form_method" name="_method" value="POST">
                <input type="hidden" id="id_attraction" name="id_attraction" value="">
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Identitas --}}
                        <div class="col-md-4">
                            <label class="form-label">Name (ID) *</label>
                            <input type="text" id="name_id" name="name_id" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Name (EN)</label>
                            <input type="text" id="name_en" name="name_en" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Name (ZH)</label>
                            <input type="text" id="name_zh" name="name_zh" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Slug *</label>
                            <input type="text" id="slug" name="slug" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" id="display_order" name="display_order" class="form-control" min="0" value="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Destination</label>
                            <select id="destination_id" name="destination_id" class="form-select select2" style="width:100%;">
                                <option value="">— Pilih —</option>
                                @foreach ($destinations as $d)
                                    <option value="{{ $d->id }}">{{ $d->name_id }} @if ($d->name_en)
                                            — {{ $d->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Kota / Label / Badge --}}
                        <div class="col-md-4">
                            <label class="form-label">City (ID)</label>
                            <input type="text" id="city_id" name="city_id" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">City (EN)</label>
                            <input type="text" id="city_en" name="city_en" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">City (ZH)</label>
                            <input type="text" id="city_zh" name="city_zh" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Subtitle (ID)</label>
                            <input type="text" id="subtitle_id" name="subtitle_id" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Location Label (ID)</label>
                            <input type="text" id="location_label_id" name="location_label_id" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Badge Label (ID)</label>
                            <input type="text" id="badge_label_id" name="badge_label_id" class="form-control" placeholder="Popular Choice / Best Value / ...">
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-md-6">
                            <label class="form-label">Description (ID)</label>
                            <textarea id="description_id" name="description_id" rows="4" class="form-control preserveLines"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description (EN)</label>
                            <textarea id="description_en" name="description_en" rows="4" class="form-control preserveLines"></textarea>
                        </div>

                        {{-- Statistik --}}
                        <div class="col-md-2">
                            <label class="form-label">Rating</label>
                            <input type="number" step="0.1" min="0" max="5" id="rating" name="rating" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Reviews</label>
                            <input type="number" min="0" id="rating_count" name="rating_count" class="form-control" value="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Packages</label>
                            <input type="number" min="0" id="packages_count" name="packages_count" class="form-control" value="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tours</label>
                            <input type="number" min="0" id="tours_count" name="tours_count" class="form-control" value="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Expeditions</label>
                            <input type="number" min="0" id="expeditions_count" name="expeditions_count" class="form-control" value="0">
                        </div>

                        {{-- Pricing / Geo --}}
                        <div class="col-md-4">
                            <label class="form-label">Starting Price (IDR)</label>
                            <input type="number" min="0" id="starting_price" name="starting_price" class="form-control" placeholder="e.g. 250000">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Currency</label>
                            <input type="text" id="currency_code" name="currency_code" class="form-control" value="IDR">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Latitude</label>
                            <input type="number" step="0.0000001" id="lat" name="lat" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Longitude</label>
                            <input type="number" step="0.0000001" id="lng" name="lng" class="form-control">
                        </div>

                        {{-- Flags --}}
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="is_popular_choice" name="is_popular_choice" value="1">
                                <label class="form-check-label" for="is_popular_choice">Popular Choice</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="is_best_value" name="is_best_value" value="1">
                                <label class="form-check-label" for="is_best_value">Best Value</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" id="is_limited_spots" name="is_limited_spots" value="1">
                                <label class="form-check-label" for="is_limited_spots">Limited Spots</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <hr class="mt-3">

                        {{-- Media --}}
                        <div class="col-md-4">
                            <label class="form-label">Image Main</label><br>
                            <button type="button" id="btn-upload-main" class="btn btn-outline-secondary btn-sm">Upload</button>
                            <div class="show-main-box mt-2" style="display:none;">
                                <img id="preview-main" src="" class="img-thumb" alt="main">
                                <button type="button" id="retry-main-btn" class="btn btn-sm btn-outline-warning ms-2">Ganti</button>
                                <input type="hidden" id="image_main" name="image_main">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Image Thumb</label><br>
                            <button type="button" id="btn-upload-thumb" class="btn btn-outline-secondary btn-sm">Upload</button>
                            <div class="show-thumb-box mt-2" style="display:none;">
                                <img id="preview-thumb" src="" class="img-thumb" alt="thumb">
                                <button type="button" id="retry-thumb-btn" class="btn btn-sm btn-outline-warning ms-2">Ganti</button>
                                <input type="hidden" id="image_thumb" name="image_thumb">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Gallery</label><br>
                            <button type="button" id="btn-upload-gallery" class="btn btn-outline-secondary btn-sm">Upload Multiple</button>
                            <div class="show-gallery-box mt-2" style="display:none;">
                                <ul id="gallery-list" class="list-group"></ul>
                            </div>
                        </div>

                    </div> {{-- /row --}}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="submitAttractionBtn" class="btn btn-primary">Simpan</button>

                </div>
            </form>
        </div>
    </div>
</div>
