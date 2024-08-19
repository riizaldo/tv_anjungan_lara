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
                <div class="col-md-6 col-lg-6 col-sm-12 mr-1">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-start">{{ $title_kiri }}</h4>

                            <div class="modal fade text-left modal-borderless" id="modal-edit" tabindex="-1" role="dialog"
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
                                                            <label for="tipe">Keterangan</label>
                                                            <textarea type="text" name="keterangan" class="form-control" id="keterangan"> </textarea>
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
                                            <th class="text-center text-nowrap" style="width:0px">Tipe</th>
                                            <th class="text-center">Keterangan</th>
                                            <th style="width:0px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 ml-1">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-start">{{ $title_kanan }}</h4>
                            <div class="modal fade text-left modal-borderless" id="modal-edittimer" tabindex="-1" role="dialog"
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
                                            <form class="form form-vertical" id="form-edit_timer" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-body">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="tipe">Waktu</label>
                                                            <textarea type="text" name="timer" class="form-control" id="timer"> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary ml-1"
                                                id="btn-updatetimer">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table_timer">
                                    <thead>
                                        <tr>
                                            <th style="width:0px">No</th>
                                            <th class="text-center text-nowrap" style="width:0px">Tipe</th>
                                            <th class="text-center">Waktu</th>
                                            <th style="width:0px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script>
    $(function() {
        // form related

        const modalEdit = new bootstrap.Modal('#modal-edit', {
            backdrop: 'static'
        });

        const modalEdit_timer = new bootstrap.Modal('#modal-edittimer', {
            backdrop: 'static'
        });

        $(document.body).on('click', '.btn-edit', function() {
            $('#form-edit textarea[name=keterangan]').val($(this).attr('data-keterangan'));
            $('#btn-update').attr('data-id', $(this).attr('data-id'));
            modalEdit.show();
        })

        $(document.body).on('click', '.btn-edittime', function() {
            $('#form-edit_timer textarea[name=timer]').val($(this).attr('data-timer'));
            $('#btn-updatetimer').attr('data-id', $(this).attr('data-id'));
            modalEdit_timer.show();
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
                url: `{{ url('/') }}/master-text/data`,
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
                    class: 'text-center'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        return `<div class="text-nowrap"><button class="btn icon btn-sm me-1 btn-warning btn-edit" data-id="${row.id}" data-keterangan="${row.keterangan}"><i class="bi bi-pencil-fill"></i></div>`
                    },
                    orderable: false,
                    searchable: false,
                    class: 'text-start'
                },
            ]
        });
        table.on('draw', setTableColor)

        let table_timer = $('#table_timer').DataTable({
            serverSide: true,
            ajax: {
                url: `{{ url('/') }}/master-timer/data`,
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
                    class: 'text-center'
                },
                {
                    data: 'timer',
                    name: 'timer',
                    render: function(data, type, row) {
                        if (row.tipe === 'frame3') {
                            data = (data / 1000) + ' detik / putaran';
                        } else {
                            data = data + ' detik / putaran';
                        }

                        return data;
                    },
                    orderable: false,
                    searchable: false,
                    class: 'text-start'
                },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        return `<div class="text-nowrap"><button class="btn icon btn-sm me-1 btn-warning btn-edittime" data-id="${row.id}" data-timer="${row.timer}"><i class="bi bi-pencil-fill"></i></div>`
                    },
                    orderable: false,
                    searchable: false,
                    class: 'text-start'
                },
            ]
        });
        table.on('draw', setTableColor)

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
                url: `{{ url('/') }}/master-text/${id}`,
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
        $('#btn-updatetimer').click(function() {
            $('#form-edit_timer :input').each(function() {
                this.classList.remove('is-invalid')
            })
            $('.invalid-feedback').each(function() {
                $(this).remove();
            })
            let data = new FormData(document.querySelector('#form-edit_timer'));
            let id = $(this).attr('data-id');
            $.ajax({
                url: `{{ url('/') }}/master-timer/${id}`,
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    if (response == "sukses") {
                        modalEdit_timer.hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil update data!',
                            timer: 2000
                        })
                        setTimeout(function() {
                            $('#table_timer').DataTable().ajax.reload()
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
                        $(`#form-edit_timer [name='${index}']`).addClass('is-invalid');
                        $(`#form-edit_timer [name='${index}']`).after(
                            `<div class="invalid-feedback"><i class="bx bx-radio-circle"></i>${value[0]}</div>`
                        )
                    })
                }
            });
        })

    })
</script>
@endsection