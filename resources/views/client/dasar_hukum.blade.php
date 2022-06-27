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
                            <p>Dasar pelaksanaan kegiatan Badan Perpustakaan dan Kearsipan Kabupaten Sarolangun adalah Undang-undang, Peraturan Pemerintah sampai Peraturan Daerah Kabupaten Sarolangun yang telah diperinci dalam landasan Struktural dan landasan operasional, seperti berikut ini :</p>
                            <p class="mt-5 fw-bold fs-5">Landasan Struktural</p>
                            <p class="mt-3">Landasan Struktural merupakan dasar hukum formal yang menandai keberadaan Badan Perpustakaan dan Kearsipan, sebagai berikut :</p>
                            <ol>
                                <li>Peraturan Daerah Kabupaten Sarolangun Nomor 10 Tahun 2008 tentang Organisasi dan Tata Kerja Inspektorat, Badan Perencanaan Pembangunan Daerah dan Lembaga Teknis Daerah Kabupaten Sarolangun</li>
                                <li>Peraturan Gubernur jambi Nomor 64 Tahun 2016 tentang Uraian Tugas Sekretariat, Bidang, Sub Bagian dan Sub Bidang Dinas Perpustakaan dan Kearsipan Kabupaten Sarolangun.</li>
                            </ol>
                            <p class="mt-5 fw-bold fs-5">Landasan Operasional</p>
                            <p class="mt-2">Landasan Operasional adalah dasar hukum material yang memberikan arah dan pedoman pada Badan Perpustakaan dan Kearsipan dalam menjalankan aktifitasnya, sebagai berikut :</p>
                            <ol>
                                <li>Undang-undang Nomor 7 Tahun 1971 tentang Ketentuan-ketentuan Pokok Kearsipan.</li>
                                <li>Undang-undang Nomor 4  Tahun 1990 tentang Serah Simpan Karya Cetak dan Karya Rekam<./li>
                                <li>Undang-undang Nomor 8 Tahun 1997 tentang Dokumen Perusahaan.</li>
                                <li>Undang-undang Nomor 43 Tahun 2007 tentang Perpustakaan.</li>
                                <li>Peraturan Pemerintah Nomor 34 Tahun 1979 tentang Penyusutan Arsip.</li>
                                <li>Peraturan Pemerintah Nomor 70 Tahun 1991 tentang Pelaksanaan Undang-undang Nomor 4  Tahun 1990 tentang Serah Simpan Karya Cetak dan Karya Rekam.</li>
                                <li>Peraturan Pemerintah Nomor 87 Tahun 1999 tentang Tata Cara Penyerahan dan Pemusnahan Dokumen Perusahaan.</li>
                                <li>Peraturan Pemerintah Nomor 88 Tahun 1999 tentang Tata Cara Pengalihan Dokumen Perusahaan ke Dalam Micro film atau Media lainnya dan legalisasi.</li>
                                <li>Peraturan Pemerintah Nomor 38 Tahun 2007 tentang Pembagian untuk Usulan Pemerintahan antara Pemerintah, Pemerintahan Daerah Provinsi dan Pemerintahan Daerah Kabupaten/Kota.</li>
                                <li>Keputusan Presiden Republik Indonesia Nomor 105 Tahun 2004 tentang Pengelolaan Arsip.</li>
                            </ol>
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