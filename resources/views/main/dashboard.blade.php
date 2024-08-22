@extends('layouts.template')

@section('css')
    <link rel="stylesheet" href="{{ url('/template') }}/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
                                <li class="breadcrumb-item active" aria-current="page">Pintasan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="fa-solid fa-scale-balanced"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                            <h6 class="text-muted font-semibold">Kegiatan Univ</h6>
                                            <h6 class="font-extrabold mb-0">{{ $report_kegiatan_univ }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="fa-solid fa-calculator"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                            <h6 class="text-muted font-semibold">Kegiatan Fakultas</h6>
                                            <h6 class="font-extrabold mb-0">{{ $report_kegiatan_fak }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="fa-solid fa-cash-register"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                            <h6 class="text-muted font-semibold">Total Gambar Slider</h6>
                                            <h6 class="font-extrabold mb-0">{{ $report_gambar_slider }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kegiatan</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-profile-visit"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kegiatan besok</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-lg" id="kegiatan_besok">
                                            <thead>
                                                <tr>
                                                    <th>Kegiatan</th>
                                                    <th>Waktu</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kegiatan hari ini</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-lg" id="kegiatan_sekarang">
                                            <thead>
                                                <tr>
                                                    <th>Nama Kegiatan</th>
                                                    <th>Waktu</th>
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
                </div>

                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{ url('/template') }}/assets/compiled/jpg/1.jpg" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                    <h6 class="text-muted mb-0">{{ Auth::user()->email }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Report</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visitors-profile"></div>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ url('/template') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script>
        $(function() {
            // tabel related
            const setTableColor = () => {
                document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
                    dt.classList.add('pagination-primary')
                })
            }
            setTableColor()

            function formatDate(dateString) {
                const options = {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                };
                return new Intl.DateTimeFormat('en-GB', options).format(new Date(dateString));
            }

            function formatDateRange(startDate, endDate) {
                const formattedStartDate = formatDate(startDate);
                const formattedEndDate = formatDate(endDate);
                return `${formattedStartDate} - ${formattedEndDate}`;
            }
            let optionsVisitorsProfile = {
                series: [{{ $report_kegiatan_fak }}, {{ $report_kegiatan_univ }}],
                labels: ["Kegiatan Fakultas", "Kegiatan Universitas"],
                colors: ["#435ebe", "#55c6e8"],
                chart: {
                    type: "donut",
                    width: "100%",
                    height: "350px",
                },
                legend: {
                    position: "bottom",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "30%",
                        },
                    },
                },
            }
            var chartVisitorsProfile = new ApexCharts(
                document.getElementById("chart-visitors-profile"),
                optionsVisitorsProfile
            )

            function fetchAndUpdateChart() {
                $.ajax({
                    url: '/get-monthly-activities',
                    method: 'GET',
                    success: function(data) {

                        const categories = data.categories;
                        const seriesData = data.data;


                        var optionsProfileVisit = {
                            annotations: {
                                position: "back",
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            chart: {
                                type: "bar",
                                height: 300,
                            },
                            fill: {
                                opacity: 1,
                            },
                            plotOptions: {},
                            series: [{
                                name: "Kegiatan",
                                data: seriesData,
                            }],
                            colors: "#435ebe",
                            xaxis: {
                                categories: categories,
                            },
                        };

                        var chart = new ApexCharts(document.querySelector("#chart-profile-visit"),
                            optionsProfileVisit);
                        chart.render();
                    },
                    error: function(xhr) {
                        console.error('Error fetching data:', xhr);
                    }
                });
            }
            fetchAndUpdateChart();
            chartVisitorsProfile.render()



            let table = $('#kegiatan_besok').DataTable({
                serverSide: true,
                ajax: {
                    url: `{{ url('/') }}/get-kegiatan-tomorow/data`,
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}'
                    }
                },
                autoWidth: false,
                columns: [{
                        data: 'kegiatan',
                        name: 'kegiatan',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            return formatDateRange(row.start_date, row.end_date)
                        },
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    },
                ]
            });
            table.on('draw', setTableColor)

            let table2 = $('#kegiatan_sekarang').DataTable({
                serverSide: true,
                ajax: {
                    url: `{{ url('/') }}/get-kegiatan-now/data`,
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}'
                    }
                },
                autoWidth: false,
                columns: [{
                        data: 'kegiatan',
                        name: 'kegiatan',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        render: function(data, type, row) {
                            return formatDateRange(row.start_date, row.end_date)
                        },
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    },
                ]
            });
            table.on('draw', setTableColor)
        })
    </script>
@endsection
