@extends('layouts.admin.master')
@section('title', 'Service List')

@section('_styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <style>
        .preserveLines {
            white-space: pre-wrap;
        }

        .wsr-img {
            width: 90px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
        }
    </style>
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ $br1 }}</a></li>
                    <li class="breadcrumb-item active">{{ $br2 }}</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar destinasi</h5>

                            <table class='table table-bordered display' id="example" style="width:100%; font-size:11pt!important;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama (Multi-bahasa) & Slug</th>
                                        <th>Tipe</th>
                                        <th>Cover</th>
                                        <th>Status & Order</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('admin.destinations._modal')
    </main>
@endsection

@section('_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // === Cloudinary Upload Widget (cover) ===
        var coverWidget = cloudinary.createUploadWidget({
            cloudName: 'dezj1x6xp',
            uploadPreset: 'pandanviewmandeh',
            theme: 'minimal',
            multiple: false,
            max_file_size: 10048576,
            background: "white",
            quality: 20
        }, (error, result) => {
            if (!error && result && result.event === "success") {
                var link = result.info.secure_url;
                $('#image_url').val(link);
                $('#cover_image_url_btn').hide();
                $('.show-cover-box').show();
                $('#preview-cover').attr("src", link);
            }
        });

        document.addEventListener("click", function(e) {
            if (e.target && e.target.id === "cover_image_url_btn") {
                coverWidget.open();
            }
        }, false);

        // === Select2 in modal ===
        $('.select2').select2({
            theme: 'bootstrap-5',
            dropdownParent: $("#tambahWSR")
        });

        // === DataTable ===
        var table = $('#example').DataTable({
            orderable: false,
            sort: false,
            order: false,
            lengthChange: false,
            responsive: false,
            scrollX: true,
            autoWidth: false,
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            iDisplayLength: 50,
            buttons: [
                'pageLength',
                {
                    text: '<i class="fa fa-plus-circle"></i> Tambah',
                    attr: {
                        'title': 'Tambah Data',
                        'data-bs-target': '#tambahWSR',
                        'data-bs-toggle': 'modal',
                        'data-bs-backdrop': 'static',
                        'data-bs-keyboard': 'false',
                        'data-bs-title': 'Tambah Destinasi',
                        'type': 'button',
                        'id': 'addBtn',
                        'class': 'btn btn-primary'
                    }
                },
                {
                    text: '<i class="fa fa-refresh"></i> Reload',
                    attr: {
                        'title': 'Refresh Table',
                        'class': 'btn btn-warning'
                    },
                    action: function(e, dt) {
                        dt.ajax.reload(null, false);
                    }
                }
            ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center'
                },
                {
                    data: 'name_block',
                    name: 'name_block'
                },
                {
                    data: 'type',
                    name: 'type',
                    className: 'text-center align-middle'
                },
                {
                    data: 'image',
                    name: 'image',
                    className: 'text-center align-middle'
                },
                {
                    data: 'status_order',
                    name: 'status_order',
                    className: 'text-center align-middle'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center align-middle'
                },
            ],
            createdRow: function(row, data) {
                // simpan raw untuk edit
                $(row).data('raw', data.raw);
            }
        });

        $(document).ready(function() {
            table.ajax.url('{{ route('admin.wsr.datatable') }}').load();

            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

            $('.toggle-sidebar-btn').on('click', function() {
                setTimeout(function() {
                    table.columns.adjust();
                }, 500);
            });

            // Add
            $(document).on('click', '#addBtn', function() {
                $("#judul-modal").html('Tambah Destinasi');
                $("#id").val('');
                $('#slug').val('');
                $('#type').val('kabupaten').trigger('change');
                $('#display_order').val('0');
                $('#is_active').val('yes').trigger('change');
                $('#name_id').val('');
                $('#name_en').val('');
                $('#name_zh').val('');
                $('#image_url').val('');

                $('#cover_image_url_btn').show();
                $('.show-cover-box').hide();
                $('#preview-cover').attr('src', '');
            });

            // Edit
            $(document).on('click', '#editBtn', function() {
                const data = table.row($(this).parents('tr')).data();
                const raw = data.raw;

                $("#judul-modal").html('Edit Destinasi');
                $("#id").val(raw.id);
                $('#slug').val(raw.slug);
                $('#type').val(raw.type).trigger('change');
                $('#display_order').val(raw.display_order);
                $('#is_active').val(raw.is_active ? 'yes' : 'no').trigger('change');
                $('#name_id').val(raw.name_id);
                $('#name_en').val(raw.name_en ?? '');
                $('#name_zh').val(raw.name_zh ?? '');
                $('#image_url').val(raw.image_url ?? '');

                if (raw.image_url) {
                    $('#cover_image_url_btn').hide();
                    $('.show-cover-box').show();
                    $('#preview-cover').attr("src", raw.image_url);
                } else {
                    $('#cover_image_url_btn').show();
                    $('.show-cover-box').hide();
                    $('#preview-cover').attr("src", '');
                }

                $('#tambahWSR').modal('show');
            });

            // Delete
            $(document).on('click', '#delBtn', function() {
                const row = table.row($(this).parents('tr')).data();
                const raw = row.raw;
                Swal.fire({
                    title: 'Hapus data?',
                    text: `${raw.name_id} (${raw.slug}) akan dihapus.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ url('admin/destinations') }}/' + raw.id,
                            success: function() {
                                table.ajax.reload(null, false);
                                Swal.fire('Terhapus', 'Data berhasil dihapus', 'success');
                            },
                            error: function(err) {
                                Swal.fire('Error', err.responseJSON?.message || 'Gagal menghapus', 'error');
                            }
                        })
                    }
                })
            });
        });

        // Submit
        $("#submitWSRBtn").on("click", function(event) {
            event.preventDefault();
            $('#submitWSRBtn').prop("disabled", true);

            const formdata = $("#wsrForm").serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.wsr.save') }}',
                data: formdata,
                dataType: 'json',
                success: function(res) {
                    $('#submitWSRBtn').prop("disabled", false);
                    if (res.success === 'yeah') {
                        $('#tambahWSR').modal('hide');
                        $('#example').DataTable().ajax.reload(null, false);
                        Swal.fire('Great!', 'Data sukses disimpan!', 'success');
                    }
                },
                error: function(err) {
                    $('#submitWSRBtn').prop("disabled", false);
                    if (err.status === 422) {
                        $('.ajax-invalid').remove();
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="ajax-invalid" style="color:red;">' + error[0] + '</span>'));
                        });
                    } else if (err.status === 403) {
                        Swal.fire('Unauthorized!', 'Anda tidak berwenang', 'warning');
                    } else {
                        Swal.fire('Error', err.responseJSON?.message || 'Terjadi kesalahan', 'error');
                    }
                }
            });
        });

        // Retry/replace image
        $(document).on('click', '#retry-cover-btn', function() {
            $('#cover_image_url_btn').show();
            $('.show-cover-box').hide();
            $('#image_url').val('');
        });
    </script>
@endsection
