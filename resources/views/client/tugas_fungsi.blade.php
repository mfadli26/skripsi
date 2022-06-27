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

        .artikel-t:hover {
            background-color: rgba(108, 117, 125, 0.2) !important;
            box-shadow: 1px 1px rgb(108, 117, 125) !important;
        }
    </style>

</head>

<body class="antialiased d-flex flex-column h-100">
    <main class="flex-shrink-0">
        @include('sweetalert::alert')
        @include('client.layout.header_arsip')
        @include('client.layout.breadcrumb_arsip')
        <div class="container-fluid">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    <div class="row">
                        <div class="col-8">
                            <p>Tugas pokok dan fungsi Dinas Perpustakaan dan Kearsipan Kabupaten Sarolangun sesuai dengan peraturan Gubernur Jambi Nomor 64 Tahun 2016 tentang Kedudukan, Susunan Organisasi, Uraian Tugas dan Fungsi Serta Tata Kerja Dinas Perpustakaan dan Kearsipan Kabupaten Sarolangun, sebagai berikut :</p>
                            <p class="mt-3 fw-bold">a. Tugas Pokok :</p>
                            <p class="mt-3">Melaksanakan penyusunan dan pelaksanaan kebijakan Daerah yang bersifat spesifik yaitu di bidang perpustakaan dan kearsipan.</p>
                            <p class="mt-3 fw-bold">b. Fungsi :</p>
                            <ul>
                                <li>Perumusan kebijakan teknis dibidang arsip dan perpustakaan</li>
                                <li>Pemberian dukungan atas penyelenggaraan pemerintahan daerah</li>
                                <li>Pembinaan dan pelaksanaan tugas sesuai dengan lingkup tugasnya</li>
                                <li>Pelaksanaan tugas lain yang diberikan Gubernur.</li>
                            </ul>
                        </div>
                        @include('client.layout.sidemenu')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js"></script>
</body>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

</html>