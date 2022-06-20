<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pusat Peminjaman Arsip</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet">
    <!-- Styles -->

    <style>
        .btn-hover:hover {
            color: red !important;
        }

        .btn-hover {
            transition: color 0.2s linear;
        }

        .link-active {
            color: red !important;
        }
    </style>

</head>

<body class="antialiased d-flex flex-column h-100">
    <main class="flex-shrink-0">
        @include('sweetalert::alert')
        @include('client.layout.header_arsip')
        <div class="container-fluid">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    <div class="text-center text-dark" style="margin-bottom: 100px">
                        @if($data->submenu == 'pencarian arsip')
                        <h1 class="h1">SELAMAT DATANG DI SISTEM LAYANAN KEARSIPAN ONLINE</h1>
                        @elseif($data->submenu == 'pencarian buku')
                        <h1 class="h1">SELAMAT DATANG DI SISTEM LAYANAN BUKU ONLINE</h1>
                        @endif
                    </div>
                    <div class="col-md-8 mx-auto pt-5" style="margin-bottom: 100px">
                        @if($data->submenu == 'pencarian arsip')
                        <form action="/archive/main" method="post">
                            {{ csrf_field() }}
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="search" placeholder="Masukkan Nama atau Nomor Arsip">
                                <button class="btn btn-primary text-white" type="submit">Cari Arsip</button>
                            </div>
                        </form>
                        @elseif($data->submenu == 'pencarian buku')
                        <form action="/buku/main" method="post">
                            {{ csrf_field() }}
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="search" placeholder="Masukkan Judul/Penulis/Penerbit/Tahun Terbit Buku Yang Ingin Anda Cari...">
                                <button class="btn btn-primary text-white" type="submit">Cari Buku</button>
                            </div>
                        </form>
                        @endif
                    </div>
                    <div>
                        <div class="col-md-7 mx-auto">
                            @if($data->submenu == 'pencarian arsip')
                            <img id="giftest" src="" class="w-100 border border-secondary" style="border-width: 10px">
                            @elseif($data->submenu == 'pencarian buku')
                            <img id="giftest" src="" class="w-100 border border-secondary" style="border-width: 10px">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js"></script>
</body>
<script>
    var paths = [window.location.origin + "/img/Banner_Layanan_Arsip_Online.gif",
        window.location.origin + "/img/Banner_Layanan_Arsip_Online.jpg"
    ];

    var img = document.getElementById("giftest");
    var i = 0;
    var timer = setInterval(function() {
        // If we've reached the end of the array...
        if (i >= paths.length) {
            clearInterval(timer); // Stop the timer
            return; // Exit the function
        }
        img.src = paths[i++]; // Sete the path to the current counter and then increase the counter
    }, 1000);
</script>

</html>