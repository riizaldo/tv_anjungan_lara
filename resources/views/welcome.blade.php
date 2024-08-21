<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="tittle_up">TV | Anjungan Rektorat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .video-container {
            position: relative;
            padding-bottom: 50.2%;
            height: 0;
            overflow: hidden;

            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .scroll-container {
            height: 350px;
            overflow: hidden;
            position: relative;
            font-size: 35px;
        }

        .scroll-content {
            position: absolute;
            width: 100%;
            animation: scrollUp 10s linear infinite;
        }

        .scroll-content li {
            font-size: 39px;
            background-color: #134f5c;
            color: white;
            list-style-type: none;
            margin: 0;
            padding: 2px 0;
            text-align: center;
        }

        .scroll-container-footer {
            height: 100px;
            overflow: hidden;
            position: relative;
            font-size: 45px;
        }

        .scroll-content-footer {
            position: absolute;
            width: 100%;
            animation: scrollLeft 13s linear infinite;
        }

        .scroll-content-footer li {
            font-size: 39px;
            color: white;
            list-style-type: none;
            margin: 0;
            padding: 10px 0;
            text-align: center;
        }

        @keyframes scrollUp {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        @keyframes scrollLeft {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>


<body
    style="background-image: url({{ asset($bg->path) }}); height: 100%;background-repeat: no-repeat;background-size: cover;background-position: center;"
    id="bg_image">


    <div class="container-fluid">
        <div class="row py-2">
            <div class="col-md-12">
                <div style="background: rgba(0, 0, 0, 0.5); color: white;" id="judul_atas">
                    <h1 class="text text-center py-4"><b style="font-size: 44px;"> {!! $judul !!}</b></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-sm-5 col-lg-5">
                <div class="card" id="link_youtube">
                    <div class="card-body video-container" style="background: rgba(0, 0, 0, 0.5); color: white;">
                        {!! $link_youtube !!}
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-lg-7">
                <div class="card" style="background: rgba(0, 0, 0, 0.5); color: white;">
                    <div class="card-header">
                        <div style="background: rgba(0, 0, 0, 0.5); color: white;">
                            <h1 class="text text-center py-4"><b style="font-size: 32px;"> {!! $frame1 !!}</b>
                            </h1>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="scroll-container" style="height:390px">
                            <ul class="scroll-content" id="categoryTable1" style="height:350px;font-size: 45px;">
                                @foreach ($kegiatan_univ as $index => $ku)
                                    @php
                                        $colors = ['#134f5c', '#38761d'];
                                        $backgroundColor = $colors[$index % count($colors)];
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-center mb-3"
                                        style="font-size: 39px; background-color: {{ $backgroundColor }};">
                                        {{ $ku->kegiatan }} | {{ date('d/m/Y H:i', strtotime($ku->start_date)) }} -
                                        {{ date('d/m/Y H:i', strtotime($ku->end_date)) }} |
                                        {!! $ku->keterangan !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-md-5 col-sm-5 col-lg-5">
                <style>
                    .carousel-inner {
                        overflow: hidden;
                    }

                    .carousel-item {
                        transition: transform 0.5s ease-in-out;

                    }
                </style>
                <div class="card" style="background: rgba(0, 0, 0, 0.5); color: white;">

                    <div class="card-body">
                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="5000">
                            <div class="carousel-inner" id="carouselSlider">
                                @foreach ($slider as $index => $sd)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($sd->path) }}" class="d-block w-100"
                                            alt="{{ $sd->name }}" style="max-height:450px">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-lg-7">
                <div class="card" style="background: rgba(0, 0, 0, 0.5); color: white;">
                    <div class="card-header">
                        <div style="background: rgba(0, 0, 0, 0.5); color: white;">
                            <h1 class="text text-center py-4"><b style="font-size: 32px;"> {!! $frame2 !!}</b>
                            </h1>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="scroll-container">
                            <ul class="scroll-content" id="categoryTable2" style="height:350px;font-size: 45px;">

                                @foreach ($kegiatan_fak as $index => $kf)
                                    @php

                                        $colors = ['#134f5c', '#38761d'];
                                        $backgroundColor = $colors[$index % count($colors)];
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-center mb-3"
                                        style="font-size: 39px; background-color: {{ $backgroundColor }};">
                                        {{ $kf->kegiatan }} | {{ date('d/m/Y H:i', strtotime($kf->start_date)) }} -
                                        {{ date('d/m/Y H:i', strtotime($kf->end_date)) }} |
                                        {!! $kf->keterangan !!}
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="scroll-container-footer">
                        <ul class="scroll-content-footer" id="running_textfooter" style="height:100px">
                            <li class="list-group-item d-flex justify-content-center mb-3" style="font-size: 39px">
                                {!! $footer !!}</li>
                        </ul>
                    </div>
                </div>

                <div class="row d-flex justify-content-center" id="logo">

                    @foreach ($logo as $lg)
                        <div class="col-4 d-flex justify-content-center">
                            <img src="{{ asset($lg->path) }}" style="height:100px ;" alt="{{ $lg->name }}">
                        </div>
                    @endforeach

                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    {{-- Support kami dengan follow sosial media resmi kami, Youtube : <i>UnwahasTV<i> dan Instagram <i>@unwahasaja</i> --}}
    <script>
        let lastSliderData = [];
        const bgImageUrl = "{{ asset($bg->path) }}";
        let lastBgImageUrl = bgImageUrl;


        function fetchfooter() {
            $.ajax({
                url: '/get-footer',
                method: 'GET',
                success: function(data) {
                    $('#running_textfooter').empty();
                    data.forEach(function(ku, index) {
                        $('#running_textfooter').append(
                            '<li class="list-group-item d-flex justify-content-center mb-3" style="font-size: 39px;">' +
                            ku.keterangan +
                            '</li>'
                        );
                    });
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }

        function fetchLogo() {
            $.ajax({
                url: '/get-logo',
                method: 'GET',
                success: function(data) {
                    $('#logo').empty();

                    // Ensure data is an array
                    if (Array.isArray(data)) {
                        data.forEach(function(logo) {
                            // Append the logo image and description
                            $('#logo').append(
                                '<div class="col-4 d-flex justify-content-center">' +
                                '<img src="' + logo.path + '" style="height:100px;" alt="' + logo
                                .name + '">' +
                                '</div>'
                            );
                        });
                    } else {
                        console.error('Unexpected data format:', data);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }

        function arraysEqual(arr1, arr2) {
            if (arr1.length !== arr2.length) return false;

            for (let i = 0; i < arr1.length; i++) {
                if (JSON.stringify(arr1[i]) !== JSON.stringify(arr2[i])) return false;
            }
            return true;
        }

        function fetchBg() {
            $.ajax({
                url: '/get-bg',
                method: 'GET',
                success: function(data) {
                    // Memeriksa format data
                    if (data && typeof data.path === 'string') {
                        const newBgImageUrl = data.path;

                        // Periksa apakah URL baru berbeda dari URL yang lama
                        if (lastBgImageUrl !== newBgImageUrl) {
                            document.getElementById('bg_image').style.backgroundImage = `url(${newBgImageUrl})`;
                            lastBgImageUrl = newBgImageUrl;
                        }
                    } else {
                        console.error('Unexpected data format:', data);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }

        function fetchSlider() {
            $.ajax({
                url: '/get-slider',
                method: 'GET',
                success: function(data) {
                    // Jika data adalah array, lanjutkan
                    if (Array.isArray(data)) {
                        // Cek apakah data slider baru berbeda dari data lama
                        if (!arraysEqual(data, lastSliderData)) {
                            // Perbarui cache dengan data baru
                            lastSliderData = data;

                            // Kosongkan slider dan tambahkan item baru
                            $('#carouselSlider').empty();

                            data.forEach(function(logo, index) {
                                var isActive = index === 0 ? 'active' : '';

                                // Append the logo image and description
                                $('#carouselSlider').append(
                                    '<div class="carousel-item ' + isActive + '">' +
                                    '<img src="' + logo.path + '" class="d-block w-100" alt="' +
                                    logo.name + '" style="max-height:450px">' +
                                    '</div>'
                                );
                            });
                        }
                    } else {
                        console.error('Unexpected data format:', data);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }

        function fetchAndUpdateData() {
            $.ajax({
                url: '/get-kegiatan-univ',
                method: 'GET',
                success: function(data) {
                    $('#categoryTable1').empty();

                    data.forEach(function(ku, index) {
                        var colors = ['#134f5c', '#38761d'];
                        var backgroundColor = colors[index % colors.length];

                        $('#categoryTable1').append(
                            '<li class="list-group-item d-flex justify-content-center mb-3" style="font-size: 39px; background-color: ' +
                            backgroundColor + ';">' +
                            ku.kegiatan + ' | ' +
                            new Date(ku.start_date).toLocaleString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            }) + ' - ' +
                            new Date(ku.end_date).toLocaleString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            }) + ' | ' +
                            ku.keterangan +
                            '</li>'
                        );
                    });
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }

        function fetchAndUpdateData2() {
            $.ajax({
                url: '/get-kegiatan-fak',
                method: 'GET',
                success: function(data) {
                    $('#categoryTable2').empty();

                    data.forEach(function(ku, index) {
                        var colors = ['#134f5c', '#38761d'];
                        var backgroundColor = colors[index % colors.length];

                        $('#categoryTable2').append(
                            '<li class="list-group-item d-flex justify-content-center mb-3" style="font-size: 39px; background-color: ' +
                            backgroundColor + ';">' +
                            ku.kegiatan + ' | ' +
                            new Date(ku.start_date).toLocaleString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            }) + ' - ' +
                            new Date(ku.end_date).toLocaleString('en-GB', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            }) + ' | ' +
                            ku.keterangan +
                            '</li>'
                        );
                    });
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }
        // const scrollContent = document.querySelector('.scroll-content');
        const logo = document.querySelector('#logo');
        const scrollContent1 = document.querySelector('#categoryTable1');
        const scrollContent2 = document.querySelector('#categoryTable2');
        const running_textfooter = document.querySelector('#running_textfooter');
        const scrollContainer = document.querySelector('.scroll-container');
        const carouselInterval = {{ $frame3_time }};
        const frame1 = {{ $frame1_time }};
        const frame2 = {{ $frame2_time }};
        const footer = {{ $footer_time }};

        // scrollContent.style.animationDuration = '15s';
        scrollContent1.style.animationDuration = frame1 + 's';
        scrollContent2.style.animationDuration = frame2 + 's';
        running_textfooter.style.animationDuration = footer + 's';

        document.addEventListener('DOMContentLoaded', function() {
            var carouselElement = document.querySelector('#carouselExample');
            var carousel = new bootstrap.Carousel(carouselElement, {
                interval: carouselInterval, // Set interval to 5 seconds
                ride: 'carousel'
            });
        });

        function updateAllData() {
            fetchAndUpdateData();
            fetchAndUpdateData2();
            fetchLogo();
            fetchfooter();
            fetchBg();
            fetchSlider();
        }

        updateAllData();
        setInterval(updateAllData, 2000);
    </script>
</body>

</html>
