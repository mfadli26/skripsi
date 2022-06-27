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
                            <p>Nomenklatur baru Organisasi dan Manajemen Dinas Perpustakaan dan Kearsipan Propinsi Jawa Timur didasarkan pada Peraturan Gubernur Jawa Timur Nomor 64 Tahun 2016 tentang Kedudukan, Susunan Organisasi, Uraian Tugas dan Fungsi Serta Tata Kerja Dinas Perpustakaan dan Kearsipan Provinsi Jawa Timur. L adalah sebagai berikut :</p>
                            <ul>
                                <li>Unsur pimpinan atau top manajemen dalam hal ini adalah Kepala</li>
                                <li>Unsur Pimpinan dalam manajemen menengah (middle management) ada 1 (satu) sekretaris dan 5 (lima) Bidang yang dikembangkan sesuai dengan fungsi organisasi yang terdiri dari :</li>
                                <ul>
                                    <li>Fungsi Kesekretariatan membawahi 3 (tiga) Sub Bagian, yaitu Sub Bagian Tata Usaha, Sub Bagian Penyusunan Program dan Sub Bagian Keuangan</li>
                                    <li>Fungsi Bidang Deposit,Akuisisi,Pelestarian dan Pengolahan Bahan Perpustakaan membawahi 3 (tiga)seksi yaitu , seksi Deposit, Seksi Akuisisi dan Alih Media Arsip, dan Seksi Pengolahan dan Pelestarian Bahan Pustaka</li>
                                    <li>Fungsi Bidang Pelayanan Perpustakaan dan Informasi membawahi 3 (tiga) seksi yaitu : Seksi Pelayanan Perpustakaan, Seksi Pelayanan Ekstensi, Seksi Promosi dan Pengembangan Minat Baca</li>
                                    <li>Fungsi Bidang Pengembangan Sumber Daya, membawahi 3 (tiga) seksi yaitu : Seksi Pengembangan Sumber Daya, Seksi Pengembangan Perpustakaan, Seksi Pengembangan Kearsipan, Seksi Kerjasama Perpustakaan dan Kearsipan</li>
                                    <li>Fungsi Bidang Penyelamatan dan Pendayagunaan Kearsipan, membawahi 3 (tiga) seksi, yaitu : Seksi Akuisisi dan Pengolahan Arsip, Seksi Pemeliharaan dan Pelestarian Arsip, Seksi Layanan Kearsipan</li>
                                    <li>Fungsi Bidang Pembinaan dan Pengawasan Kearsipan membawahi 3 (tiga) seksi, yaitu : Seksi Pembinaan Kearsipan, Seksi Pemasyarakatan Kearsipan, Seksi Pengawasan Kearsipan</li>
                                </ul>
                                <li>Unsur Kelompok Jabatan Fungsional Pustakawan dan Arsiparis sebagai cerminan dari kelompok keahlian profesional dalam bidang perpustakaan dan kearsipan</li>
                            </ul>
                            <p class="text-center fs-5 mt-5 fw-bold">Struktur organisasi Dinas Perpustakaan dan Kearsipan Kabupaten Sarolangun</p>
                            <div class="d-flex justify-content-center">
                                <img src="{{url('/storage/gambar_artikel/1656337231_117 JCH Sarolangun Berangkat Ke Tanah Suci, PJ Bupati Henrizal Bilang Begini.jpg')}}">
                            </div>
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