@extends('layouts.template')
@section('css')
<!-- css page -->
<link rel="stylesheet"
    href="{{ url('/') }}/template/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="{{ url('/') }}/template/assets/compiled/css/table-datatable-jquery.css" />
@endsection
@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-start">Kelola Data {{ $title }}</h4>
                            <button class="btn btn-icon icon btn-primary float-end" id="btn-tambah">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </button>

                            <div class="modal modal-lg fade text-left modal-borderless" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Kegiatan</h5>
                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form form-vertical" id="form-tambah" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="tipe">Tipe Kegiatan</label>
                                                            <select name="tipe" id="tipe" class="form-control">
                                                                <option value="">pilih tipe kegiatan</option>
                                                                <option value="frame_1">Kegiatan Universitas</option>
                                                                <option value="frame_2">Kegiatan Bagian / Unit / Fakultas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nama">Nama Kegiatan</label>
                                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh : Rapat Umum Ketua Yayasan">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan Lokasi</label>
                                                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Contoh : Lantai 7 Gedung Dekanat">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="start">Waktu Mulai</label>
                                                                    <input type="datetime-local" name="start_date" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="end">Waktu Selesai</label>
                                                                    <input type="datetime-local" name="end_date" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary ml-1" id="btn-submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal modal-lg fade text-left modal-borderless" id="modal-edit" tabindex="-1" role="dialog"
                                aria-labelledby="modal-edit" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $title }}</h5>
                                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form form-vertical" id="form-edit" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-body">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="tipe">Tipe Kegiatan</label>
                                                            <select name="tipe" class="form-control">
                                                                <option value="">pilih tipe kegiatan</option>
                                                                <option value="frame_1">Kegiatan Universitas</option>
                                                                <option value="frame_2">Kegiatan Bagian / Unit / Fakultas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nama">Nama Kegiatan</label>
                                                            <input type="text" name="nama" class="form-control" placeholder="Contoh : Rapat Umum Ketua Yayasan">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan Lokasi</label>
                                                            <input type="text" name="keterangan" class="form-control" placeholder="Contoh : Lantai 7 Gedung Dekanat">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="start">Waktu Mulai</label>
                                                                    <input type="datetime-local" name="start_date" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="end">Waktu Selesai</label>
                                                                    <input type="datetime-local" name="end_date" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary ml-1"
                                                id="btn-update">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th style="width:0px">No</th>
                                            <th class="text-center text-nowrap">Tipe</th>
                                            <th class="text-center">Kegiatan</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Waktu</th>
                                            <th class="text-center" style="width:0px">Status</th>
                                            <th style="width:0px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
@section('js')
<!-- js page -->
@livewireScripts
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script>
    $(function() {
        // form related

        const modalTambah = new bootstrap.Modal('#modal-tambah', {
            backdrop: 'static'
        });
        $('#btn-tambah').click(function() {
            modalTambah.show();
        })
        const modalEdit = new bootstrap.Modal('#modal-edit', {
            backdrop: 'static'
        });

        $(document.body).on('click', '.btn-edit', function() {
            $('#form-edit input[name=keterangan]').val($(this).attr('data-keterangan'));
            $('#form-edit input[name=nama]').val($(this).attr('data-kegiatan'));
            $('#form-edit input[name=start_date]').val($(this).attr('data-mulai'));
            $('#form-edit input[name=end_date]').val($(this).attr('data-akhir'));
            $('#form-edit select[name=tipe]').val($(this).attr('data-tipe'));
            $('#btn-update').attr('data-id', $(this).attr('data-id'));
            modalEdit.show();
        })


        // tabel related
        const setTableColor = () => {
            document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
                dt.classList.add('pagination-primary')
            })
        }
        setTableColor()

        let table = $('#table').DataTable({
            serverSide: true,
            ajax: {
                url: `{{ url('/') }}/master-kegiatan/data`,
                type: 'POST',
                data: function(d) {
                    d._token = '{{ csrf_token() }}'
                }
            },
            autoWidth: false,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'tipe',
                    name: 'tipe',
                    render: function(data, type, row) {

                        if (data === 'frame_1') {
                            return `Kegiatan Universitas`
                        } else {
                            return `Kegiatan Unit / Fakultas / Bagian`
                        }

                    },
                    class: 'text-center'
                },
                {
                    data: 'kegiatan',
                    name: 'kegiatan',
                    class: 'text-center'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    class: 'text-center'
                },
                {
                    data: 'waktu',
                    name: 'waktu',
                    render: function(data, type, row) {
                        // Helper function to format date as d-m-Y H:i
                        function formatDate(dateString) {
                            var optionsDate = {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            };
                            var optionsTime = {
                                hour: '2-digit',
                                minute: '2-digit'
                            };
                            var date = new Date(dateString);
                            return date.toLocaleDateString('en-GB', optionsDate) + ' ' + date.toLocaleTimeString('en-GB', optionsTime);
                        }

                        var startDateFormatted = formatDate(row.start_date);
                        var endDateFormatted = formatDate(row.end_date);
                        return startDateFormatted + ' - ' + endDateFormatted;
                    },
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    render: function(data, type, row) {
                        if (data === 1) {
                            return `<span class="badge bg-primary">Aktif</span>`
                        } else {
                            return `<span class="badge bg-secondary">Non-Aktif</span>`
                        }
                    },
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        return `<div class="text-nowrap"><button class="btn icon btn-sm me-1 btn-warning btn-edit" date-tipe="${row.tipe}" data-id="${row.id}" data-kegiatan="${row.kegiatan}" data-keterangan="${row.keterangan}" data-mulai="${row.start_date}" data-akhir="${row.end_date}"><i class="bi bi-pencil-fill"></i><button class="btn icon btn-sm me-1 btn-danger btn-delete" data-id="${row.id}"><i class="bi bi-trash-fill"></i></button></div>`
                    },
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                },
            ]
        });
        table.on('draw', setTableColor)

        $(document.body).on('click', '.btn-delete', function() {
            let id = $(this).attr('data-id');
            Swal.fire({
                title: 'Yakin?',
                text: "Data akan dihapus dari sistem",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/') }}/master-kegiatan/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(data) {
                            if (data == "sukses") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses',
                                    text: 'Berhasil menghapus data!',
                                    timer: 2000
                                })
                                setTimeout(function() {
                                    // Livewire.emit('kegiatanUpdated');
                                    $('#table').DataTable().ajax.reload()
                                }, 2000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: JSON.stringify(data)
                                })
                            }
                        },
                    });
                }
            })
        })
        $('#btn-submit').click(function() {
            $('#form-tambah :input').each(function() {
                this.classList.remove('is-invalid')
            })
            $('.invalid-feedback').each(function() {
                $(this).remove();
            })
            $.ajax({
                url: `{{ url('/') }}/master-kegiatan`,
                data: new FormData(document.querySelector('#form-tambah')),
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    if (response == "sukses") {
                        modalTambah.hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil tambah data!',
                            timer: 2000
                        })
                        setTimeout(function() {
                            // Livewire.emit('kegiatanUpdated');
                            $('#table').DataTable().ajax.reload()
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: JSON.stringify(response)
                        })
                    }
                },
                error: function(response) {
                    let obj = JSON.parse(response.responseText);
                    $.each(obj.errors, function(index, value) {
                        $(`#form-tambah [name='${index}']`).addClass('is-invalid');
                        $(`#form-tambah [name='${index}']`).after(
                            `<div class="invalid-feedback"><i class="bx bx-radio-circle"></i>${value[0]}</div>`
                        )
                    })
                }
            });
        })


        $('#btn-update').click(function() {
            $('#form-edit :input').each(function() {
                this.classList.remove('is-invalid')
            })
            $('.invalid-feedback').each(function() {
                $(this).remove();
            })
            let data = new FormData(document.querySelector('#form-edit'));
            let id = $(this).attr('data-id');
            $.ajax({
                url: `{{ url('/') }}/master-kegiatan/${id}`,
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    if (response == "sukses") {
                        modalEdit.hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil update data!',
                            timer: 2000
                        })
                        setTimeout(function() {
                            Livewire.emit('kegiatanUpdated');
                            $('#table').DataTable().ajax.reload()
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: JSON.stringify(response)
                        })
                    }
                },
                error: function(response) {
                    let obj = JSON.parse(response.responseText);
                    $.each(obj.errors, function(index, value) {
                        $(`#form-edit [name='${index}']`).addClass('is-invalid');
                        $(`#form-edit [name='${index}']`).after(
                            `<div class="invalid-feedback"><i class="bx bx-radio-circle"></i>${value[0]}</div>`
                        )
                    })
                }
            });
        })


    })
</script>
@endsection