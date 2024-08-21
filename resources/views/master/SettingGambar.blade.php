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
                                                                <option value="logo">Logo Footer</option>
                                                                <option value="frame_3">Gambar Slider</option>
                                                                <option value="bg">Background</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh : Rapat Umum Ketua Yayasan">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="keterangan">Gambar</label>
                                                            <input type="file" name="path" class="form-control" id="image">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="mb-3 mt-4 text-center">
                                                                <img id="image-preview" src="https://cdn.dribbble.com/users/4438388/screenshots/15854247/media/0cd6be830e32f80192d496e50cfa9dbc.jpg?resize=1000x750&vertical=center"
                                                                    alt="preview image" style="max-height: 250px;">
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th style="width:0px">No</th>
                                            <th class="text-center text-nowrap">Tipe</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Path</th>
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
        $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        const modalTambah = new bootstrap.Modal('#modal-tambah', {
            backdrop: 'static'
        });
        $('#btn-tambah').click(function() {
            modalTambah.show();
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
                url: `{{ url('/') }}/master-gambar/data`,
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

                        if (data === 'logo') {
                            return `Logo Bawah`
                        } else {
                            return `Gambar Slider`
                        }

                    },
                    class: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name',
                    class: 'text-center'
                },
                {
                    data: 'path',
                    name: 'path',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        return `<div class="text-nowrap"><button class="btn icon btn-sm me-1 btn-danger btn-delete" data-id="${row.id}"><i class="bi bi-trash-fill"></i></button></div>`
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
                        url: `{{ url('/') }}/master-gambar/${id}`,
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
                url: `{{ url('/') }}/master-gambar`,
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
    })
</script>
@endsection