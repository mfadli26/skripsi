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
                        <div class="col-7 me-5">
                            <p>Badan Perpustakaan dan Kearsipan Kabupaten Sarolangun merupakan salah satu pelaksana kebijakan daerah yang bersifat spesifik di bidang Perpustakaan dan Kearsipan. Keberadaan perpustakaan mendorong terwujudnya cita-cita yang diamanatkan dalam Undang-undang Dasar tahun 1945 yaitu mencerdaskan kehidupan bangsa. Sehubungan dengan itu, maka tujuan perpustakaan yang tercantum pada pasal 4 Undang-undang Nomor 43 tahun 2007 tentang Perpustakaan adalah memberikan layanan kepada pemustaka, meningkatkan kegemaran membaca, serta memperluas wawasan dan pengetahuan untuk mencerdaskan kehidupan bangsa. Dalam rangka mencerdaskan kehidupan bangsa tersebut perlu ditumbuhkembangkan budaya gemar membaca melalui perpustakaan, perpustakaan juga sebagai wahana belajar sepanjang hayat (long life educations).</p>
                            <p class="mt-5">Tujuan kearsipan sebagaimana tercantum pada pasal 3 Undang-undang Nomor 7 Tahun 1971 tentang Ketentuan-ketentuan pokok Kearsipan adalah menjamin keselamatan bahan pertanggungjawaban nasional tentang perencanaan, pelaksanaan dan penyelenggaraan kehidupan kebangsaan serta menyediakan bahan pertanggungjawaban tersebut bagi kegiatan pemerintah. Selaras dengan tujuan kearsipan sebagaimana tersebut, maka kearsipan dapat disebut sebagai wahana pelestarian kekayaan budaya bangsa yang dapat menjadi sumber informasi yang obyektif menyangkut ideologi, politik, sosial, ekonomi, budaya, agama, ilmu pengetahuan dan teknologi yang sangat bermanfaat bagi masyarakat pengguna.</p>
                            <p class="mt-5">Badan Perpustakaan dan Kearsipan Kabupaten Sarolangun sebagai penanggungjawab dalam mewujudkan pembinaan minat baca di Jawa Timur dan penjamin terselamatkannya dan terlestarinya serta didayagunakannya arsip di Jawa Timur maka perlu diterbitkannya buku pintar tentang profil Badan, issue aktual perpustakaan dan kearsipan serta peta dan foto-foto kegiatan perpustakaan dan kearsipan.</p>
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