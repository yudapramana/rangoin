@extends('layouts.admin.master')
@section('title', 'Attractions')

@section('_styles')
    {{-- DataTables + Buttons + Select --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.bootstrap5.min.css">

    {{-- Select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <style>
        .preserveLines {
            white-space: pre-wrap;
        }

        .img-thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $title ?? 'Attractions' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ $br1 ?? 'Content' }}</a></li>
                    <li class="breadcrumb-item active">{{ $br2 ?? 'Attractions' }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Attractions</h5>

                            <table class="table table-bordered display" id="example" style="width:100%; font-size:11pt!important;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama / Info</th>
                                        <th>Lokasi</th>
                                        <th>Media</th>
                                        <th width="12%">Aksi</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Modal form Create/Edit --}}
        @include('admin.attractions._modal', ['destinations' => $destinations ?? []])

        {{-- Modal Show (read-only) --}}
        <div class="modal fade" id="showAttraction" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content modalShow">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Attraction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Name (ID)</dt>
                            <dd class="col-sm-9" id="show-name_id">—</dd>

                            <dt class="col-sm-3">Slug</dt>
                            <dd class="col-sm-9" id="show-slug">—</dd>

                            <dt class="col-sm-3">City</dt>
                            <dd class="col-sm-9"><span id="show-city_id">—</span></dd>

                            <dt class="col-sm-3">Destination</dt>
                            <dd class="col-sm-9" id="show-destination">—</dd>

                            <dt class="col-sm-3">Rating</dt>
                            <dd class="col-sm-9"><span id="show-rating">—</span> (<span id="show-rating_count">0</span> reviews)</dd>

                            <dt class="col-sm-3">Counts</dt>
                            <dd class="col-sm-9">Pkg/Tour/Exp: <span id="show-counts">0/0/0</span></dd>

                            <dt class="col-sm-3">Media</dt>
                            <dd class="col-sm-9">
                                <img id="show-thumb" class="img-thumb me-2" src="" alt="" style="display:none;">
                                <img id="show-main" class="img-thumb" src="" alt="" style="display:none;">
                            </dd>

                            <dt class="col-sm-3">Description</dt>
                            <dd class="col-sm-9 preserveLines" id="show-description_id">—</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('_scripts')
    {{-- Bootstrap 5 Bundle (WAJIB agar modal jalan). Jika layout sudah include, hapus baris di bawah. --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- DataTables + Buttons + Select --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    {{-- SweetAlert2 + Cloudinary --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function slugify(str) {
            return (str || '').toString().normalize('NFKD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-zA-Z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-').replace(/-+/g, '-').toLowerCase();
        }

        // === Cloudinary widgets (dipakai oleh modal form) ===
        let mainWidget, thumbWidget, galleryWidget;

        function initCloudinaryWidgets() {
            mainWidget = cloudinary.createUploadWidget({
                cloudName: 'dezj1x6xp',
                uploadPreset: 'pandanviewmandeh',
                theme: 'minimal',
                multiple: false,
                max_file_size: 10048576,
                background: "white",
                quality: 80
            }, (error, result) => {
                if (!error && result && result.event === "success") {
                    $('#image_main').val(result.info.secure_url);
                    $('#btn-upload-main').hide();
                    $('.show-main-box').show();
                    $('#preview-main').attr('src', result.info.secure_url);
                }
            });

            thumbWidget = cloudinary.createUploadWidget({
                cloudName: 'dezj1x6xp',
                uploadPreset: 'pandanviewmandeh',
                theme: 'minimal',
                multiple: false,
                max_file_size: 10048576,
                background: "white",
                quality: 60
            }, (error, result) => {
                if (!error && result && result.event === "success") {
                    $('#image_thumb').val(result.info.secure_url);
                    $('#btn-upload-thumb').hide();
                    $('.show-thumb-box').show();
                    $('#preview-thumb').attr('src', result.info.secure_url);
                }
            });

            galleryWidget = cloudinary.createUploadWidget({
                cloudName: 'dezj1x6xp',
                uploadPreset: 'pandanviewmandeh',
                theme: 'minimal',
                multiple: true,
                max_file_size: 10048576,
                background: "white",
                quality: 70
            }, (error, result) => {
                if (!error && result && result.event === "success") {
                    let url = result.info.secure_url;
                    $('#gallery-list').append(
                        `<li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="text-truncate" style="max-width:70%;">${url}</span>
            <div>
              <img src="${url}" class="img-thumb me-2"/>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="$(this).closest('li').remove()">Hapus</button>
              <input type="hidden" name="gallery[]" value="${url}">
            </div>
          </li>`
                    );
                    $('.show-gallery-box').show();
                }
            });

            document.getElementById("btn-upload-main").addEventListener("click", () => mainWidget.open(), false);
            document.getElementById("btn-upload-thumb").addEventListener("click", () => thumbWidget.open(), false);
            document.getElementById("btn-upload-gallery").addEventListener("click", () => galleryWidget.open(), false);
        }

        // === Select2 untuk dropdown di modal ===
        function initSelect2() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#tambahAttraction")
            });
        }

        // === DataTable ===
        const table = $('#example').DataTable({
            ajax: '/information/attractions',
            select: {
                style: 'single',
                info: false
            },
            columns: [{
                    data: 'DT_RowIndex',
                    className: 'text-center',
                    render: (d, t, r, meta) => meta.row + 1
                },
                {
                    data: 'name-description'
                },
                {
                    data: 'location',
                    className: 'text-center align-middle'
                },
                {
                    data: 'media',
                    className: 'text-center align-middle'
                },
                {
                    data: 'action',
                    className: 'text-center align-middle'
                },
            ],
            orderable: false,
            sort: false,
            order: [],
            lengthChange: false,
            responsive: false,
            scrollX: true,
            autoWidth: false,
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            iDisplayLength: 50,
            dom: 'Bfrtip',
            buttons: [{
                    text: '<i class="fa fa-eye"></i> Show',
                    className: 'btn btn-info',
                    attr: {
                        id: 'btnShow'
                    },
                    enabled: false,
                    action: function() {
                        const row = table.row({
                            selected: true
                        }).data();
                        if (!row || !row.raw) return;
                        const a = row.raw;

                        $('#show-name_id').text(a.name_id || '—');
                        $('#show-slug').text(a.slug || '—');
                        $('#show-city_id').text(a.city_id || '—');
                        $('#show-destination').text($(row.location).text() || (a.destination?.name_id ?? '—'));
                        $('#show-rating').text(a.rating ?? '—');
                        $('#show-rating_count').text(a.rating_count ?? 0);
                        $('#show-counts').text(`${a.packages_count}/${a.tours_count}/${a.expeditions_count}`);
                        $('#show-description_id').text(a.description_id || '—');

                        if (a.image_thumb) {
                            $('#show-thumb').attr('src', a.image_thumb).show();
                        } else {
                            $('#show-thumb').hide();
                        }
                        if (a.image_main) {
                            $('#show-main').attr('src', a.image_main).show();
                        } else {
                            $('#show-main').hide();
                        }

                        const modal = new bootstrap.Modal(document.getElementById('showAttraction'));
                        modal.show();
                    }
                },
                // Tambah
                {
                    text: '<i class="fa fa-plus-circle"></i> Tambah',
                    className: 'btn btn-primary',
                    action: function() {
                        $('#judul-modal').text('Tambah Attraction Baru');
                        const f = $('#attractionForm')[0];
                        f && f.reset();
                        $('.ajax-invalid').remove();

                        // route fallback benar untuk CREATE
                        $('#attractionForm').attr('action', '{{ route('admin.attractions.store') }}');
                        $('#form_method').val('POST'); // spoof POST
                        $('#id_attraction').val('');
                        $('#currency_code').val('IDR');

                        // reset preview media...
                        $('#btn-upload-main').show();
                        $('.show-main-box').hide();
                        $('#preview-main').attr('src', '');
                        $('#btn-upload-thumb').show();
                        $('.show-thumb-box').hide();
                        $('#preview-thumb').attr('src', '');
                        $('.show-gallery-box').hide();
                        $('#gallery-list').html('');

                        new bootstrap.Modal(document.getElementById('tambahAttraction')).show();
                    }
                },
                {
                    text: '<i class="fa fa-refresh"></i> Reload',
                    className: 'btn btn-warning',
                    action: function(e, dt) {
                        dt.ajax.reload(null, false);
                    }
                }
            ]
        });

        // enable/disable tombol Show saat select/deselect
        table.on('select deselect', function() {
            const has = table.rows({
                selected: true
            }).indexes().length === 1;
            table.button('#btnShow').enable(has);
        });




        // Edit
        $(document).on("click", "#editBtn", function() {
            $("#judul-modal").html('Edit Attraction');
            $('.ajax-invalid').remove();

            const row = table.row($(this).parents('tr')).data();
            const a = row.raw;

            // Prefill seperti sebelumnya ...
            // isi form
            $('#id_attraction').val(a.id);
            $('#slug').val(a.slug);
            $('#display_order').val(a.display_order);

            $('#name_id').val(a.name_id);
            $('#name_en').val(a.name_en);
            $('#name_zh').val(a.name_zh);
            $('#city_id').val(a.city_id);
            $('#city_en').val(a.city_en);
            $('#city_zh').val(a.city_zh);
            $('#subtitle_id').val(a.subtitle_id);
            $('#subtitle_en').val(a.subtitle_en);
            $('#subtitle_zh').val(a.subtitle_zh);

            $('#description_id').val(a.description_id);
            $('#description_en').val(a.description_en);
            $('#description_zh').val(a.description_zh);

            $('#location_label_id').val(a.location_label_id);
            $('#badge_label_id').val(a.badge_label_id);

            $('#rating').val(a.rating);
            $('#rating_count').val(a.rating_count);
            $('#packages_count').val(a.packages_count);
            $('#tours_count').val(a.tours_count);
            $('#expeditions_count').val(a.expeditions_count);

            $('#starting_price').val(a.starting_price);
            $('#currency_code').val(a.currency_code || 'IDR');

            $('#lat').val(a.lat);
            $('#lng').val(a.lng);

            $('#destination_id').val(a.destination_id).trigger('change');

            $('#is_popular_choice').prop('checked', !!a.is_popular_choice);
            $('#is_best_value').prop('checked', !!a.is_best_value);
            $('#is_limited_spots').prop('checked', !!a.is_limited_spots);
            $('#is_active').prop('checked', !!a.is_active);

            // media
            $('#image_main').val(a.image_main || '');
            if (a.image_main) {
                $('#btn-upload-main').hide();
                $('.show-main-box').show();
                $('#preview-main').attr('src', a.image_main);
            } else {
                $('#btn-upload-main').show();
                $('.show-main-box').hide();
                $('#preview-main').attr('src', '');
            }

            $('#image_thumb').val(a.image_thumb || '');
            if (a.image_thumb) {
                $('#btn-upload-thumb').hide();
                $('.show-thumb-box').show();
                $('#preview-thumb').attr('src', a.image_thumb);
            } else {
                $('#btn-upload-thumb').show();
                $('.show-thumb-box').hide();
                $('#preview-thumb').attr('src', '');
            }

            $('#gallery-list').html('');
            if (Array.isArray(a.gallery) && a.gallery.length) {
                a.gallery.forEach(url => {
                    $('#gallery-list').append(
                        `<li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="text-truncate" style="max-width:70%;">${url}</span>
            <div>
              <img src="${url}" class="img-thumb me-2"/>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="$(this).closest('li').remove()">Hapus</button>
              <input type="hidden" name="gallery[]" value="${url}">
            </div>
          </li>`
                    );
                });
                $('.show-gallery-box').show();
            } else {
                $('.show-gallery-box').hide();
            }

            // === SET action & _method utk UPDATE (fallback aman)
            $('#attractionForm').attr('action', `/admin/attractions/${a.id}`);
            $('#form_method').val('PUT'); // spoof PUT

            const modal = new bootstrap.Modal(document.getElementById('tambahAttraction'));
            modal.show();
        });









        // retry upload buttons
        $(document).on('click', '#retry-main-btn', function() {
            $('#btn-upload-main').show();
            $('.show-main-box').hide();
        });
        $(document).on('click', '#retry-thumb-btn', function() {
            $('#btn-upload-thumb').show();
            $('.show-thumb-box').hide();
        });

        // auto-slug saat create
        $(document).on('input', '#name_id', function() {
            if (!$('#id_attraction').val()) {
                $('#slug').val(slugify(this.value));
            }
        });

        // inisialisasi Select2 + Cloudinary saat dokumen siap
        $(document).ready(function() {
            initSelect2();
            initCloudinaryWidgets();
        });
    </script>


    <script>
        // util: pastikan ajax header X-Requested-With untuk Laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        // Satu fungsi submit handler
        function handleAttractionSubmit(e) {
            // HARD STOP semua submit default
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }

            const $form = $('#attractionForm');
            if (!$form.length) return false;

            // jaga-jaga: kalau dipanggil bukan dari event submit, jangan double-run
            if ($form.data('submitting') === true) return false;
            $form.data('submitting', true);

            // action & spoof method sudah di-set saat ADD/EDIT dibuka
            const url = $form.attr('action') || '{{ route('admin.attractions.store') }}';
            const data = $form.serialize();

            $('#submitAttractionBtn').prop('disabled', true);

            $.ajax({
                type: 'POST', // selalu POST; PUT di-spoof via _method
                url: url,
                data: data,
                dataType: 'json'
            }).done(function(res) {
                const modalEl = document.getElementById('tambahAttraction');
                (bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl)).hide();

                $('#example').DataTable().ajax.reload(null, false);
                Swal.fire('Great!', 'Data sukses disimpan!', 'success');
            }).fail(function(err) {
                if (err.status === 422 && err.responseJSON?.errors) {
                    $('.ajax-invalid').remove();
                    $.each(err.responseJSON.errors, function(name, msgs) {
                        const el = $(document).find('[name="' + name + '"]');
                        el.after('<span class="ajax-invalid" style="color:red;">' + msgs[0] + '</span>');
                    });
                } else if (err.status === 403) {
                    Swal.fire('Unauthorized', 'Anda tidak berwenang', 'warning');
                } else {
                    Swal.fire('Error', (err.responseJSON?.message || err.statusText || 'Unexpected error'), 'error');
                }
            }).always(function() {
                $('#submitAttractionBtn').prop('disabled', false);
                $form.data('submitting', false);
            });

            // jaga-jaga untuk browser lama
            return false;
        }

        // === BINDING GANDA ===
        // 1) Vanilla (kalau jQuery gagal/terlambat)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('attractionForm');
            if (form) {
                form.addEventListener('submit', handleAttractionSubmit, {
                    capture: true
                });
            }
        });

        // 2) jQuery delegated (kalau form di-replace dinamis)
        $(document).on('submit', '#attractionForm', handleAttractionSubmit);
    </script>

@endsection
