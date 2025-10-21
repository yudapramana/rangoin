<div class="modal fade" id="tambahWSR" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modalBox">
            <div class="modal-header">
                <h5 class="modal-title" id="judul-modal">Tambah Region</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="wsrForm" action="{{ route('admin.wsr.save') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama (ID) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name_id" name="name_id" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nama (EN)</label>
                            <input type="text" class="form-control" id="name_en" name="name_en">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nama (ZH)</label>
                            <input type="text" class="form-control" id="name_zh" name="name_zh">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="contoh: agam" required>
                            <div class="form-text">huruf/angka/strip/underscore (unique)</div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="type" name="type" required>
                                <option value="kabupaten">Kabupaten</option>
                                <option value="kota">Kota</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Order</label>
                            <input type="number" class="form-control" id="display_order" name="display_order" value="0" min="0">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select select2" id="is_active" name="is_active">
                                <option value="yes" selected>Aktif</option>
                                <option value="no">Nonaktif</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label d-block">Cover</label>

                            <input type="hidden" id="image_url" name="image_url">

                            <button type="button" class="btn btn-outline-secondary" id="cover_image_url_btn">
                                Upload Cover
                            </button>

                            <div class="show-cover-box mt-2" style="display:none;">
                                <img id="preview-cover" src="" alt="cover" class="wsr-img">
                                <button type="button" class="btn btn-sm btn-outline-danger ms-2" id="retry-cover-btn">
                                    Ganti
                                </button>
                            </div>
                            <div class="form-text">Disarankan rasio landscape (contoh 3:2)</div>
                        </div>

                        {{-- lat/lng disembunyikan sesuai permintaan --}}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="submitWSRBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
