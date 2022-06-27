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
                            <p><strong>1. BADAN PERPUSTAKAAN DAN KEARSIPAN KABUPATEN SAROLANGUN</strong></p>
                            <p class="mt-3">Badan Perpustakaan dan Kearsipan Kabupaten Sarolangun adalah sebuah lembaga baru yang dibentuk sebagai dampak pemberlakuan Peraturan Pemerintah No. 41 tahun 2007 tentang Organisasi Perangkat Daerah. Lembaga yang merupakan hasil penggabungan dari dua lembaga, yaitu Badan Perpustakaan Kabupaten Sarolangun dan Badan Arsip Kabupaten Sarolangun ini dibentuk berdasarkan Peraturan Daerah Kabupaten Sarolangun No. 10 tahun 2008 tanggal 20 Agustus 2008 tentang Organisasi dan Tata Kerja Inspektorat, Badan Perencanaan Pembangunan Daerah dan Lembaga Teknis Daerah Kabupaten Sarolangun.</p>
                            <p class="mt-3">Sebagai lembaga baru, Badan Perpustakaan dan Kearsipan masih  perlu mengkonsolidasikan segala program kegiatannya agar bisa berjalan seiring sejalan. Perpustakaan dan arsip merupakan rumpun yang sama, tetapi dalam tugas dan kegiatan memiliki karakteristik yang berbeda. Untuk mencapai keseimbangan yang lebih baik,  perlu suatu proses. Dan proses inilah yang saat ini sedang dijalani. Pebedaan ini tidak perlu diperdebatkan, tetapi perlu disikapi sebagai kelebihan.</p>
                            <p class="mt-3">Kepala Badan Perpustakaan dan Kearsipan selaku pimpinan lembaga dengan tingkat eselonering II A,  memang harus bekerja ekstra di tengah perbedaan ini. Dalam melaksanakan tugasnya, Kepala dibantu oleh para Kepala : Bidang Layanan dan Informasi; Bidang Pembinaan dan SDM Pepustakaan; Bidang Deposit, Pengembangan  dan Pengolahan Perpustakaan; Bidang Publikasi, Promosi Perpustakaan dan Kearsipan; Bidang Pembinaan dan Pemasyarakatan Kearsipan, Bidang Pengelolaan Arsip In Aktif; Bidang Penyelamatan Arsip Statis serta seorang Sekretaris.</p>
                            <p class="mt-3 fw-bold">2. BADAN ARSIP</p>
                            <p class="mt-3">Sejarah keberadaan lembaga kearsipan di Kabupaten Sarolangun pada dasarnya tidak terlepas dari lembaga kearsipan tingkat pusat, yaitu Arsip Nasional Republik Indonesia Wilayah Kabupaten Sarolangun yang secara struktural mengacu pada Arsip Nasional RI, Jakarta dan Kantor Arsip Daerah Kabupaten Sarolangun yang secara struktural mengacu pada pemerintah Kabupaten Sarolangun.Kantor Arsip Daerah (KAD) Kabupaten Sarolangun, didirikan sebagai implementasi dari amanat Undang-undang No. 7 Tahun 1971 pasal 8 tentang pembentukan unit kearsipan di setiap unit pemerintahan daerah. Meskipun demikian, tidak serta merta KAD dibentuk di Kabupaten Sarolangun. Untuk itu dibentuklah Sub Bagian Arsip Statis, Bagian Umum di Biro Umum, Sekretariat Wilayah Daerah Kabupaten Sarolangun.</p>
                            <p class="mt-3">Pada perkembangannya, dibentuklah lembaga kearsipan tingkat provinsi yaitu Kantor Arsip Daerah (KAD) yang didirikan berdasarkan Peraturan Daerah No. 10 tahun 1992. Secara de facto, KAD  baru memulai operasionalnya tahun 1995,   walaupun Kepala Kantornya sudah diangkat tahun 1994. Saat itu KAD menempati kantor di Jalan Jagir Wonokromo No. 350 Surabaya. Orang pertama yang dipercaya menjadi Kepala KAD Kabupaten Sarolangun adalah Drs. Soepriyanto HS. Beliau menjadi Kepala KAD selama 5 tahun (1994 – 1999). Sebagai pengganti ditunjuk Dra. Joehartati. Beliau menjadi Kepala KAD sejak tahun 1999 – 2001. Mereka berdua memiliki prestasi yang berbeda tetapi sama pentingnya hingga mampu menanamkan prinsip-prinsip dasar kearsipan di Kabupaten Sarolangun.</p>
                            <p class="mt-3">Berlakunya Undang-undang No. 32 tahun 1999 tentang Pemerintahan Daerah dan Undang-undang No. 25 tahun 1999 tentang Perimbangan Keuangan Antara Pusat dan Daerah, membawa konsekuensi terhadap penataan sejumlah  lembaga pemerintah  di daerah termasuk di antaranya lembaga kearsipan. Hal ini direspon positif oleh Pemerintah Provinsi dan DPRD Kabupaten Sarolangun guna membangun dan menyelamatkan warisan berharga berupa arsip di Kabupaten Sarolangun.</p>
                            <p class="mt-3">Berpijak pada pemikiran tersebut, maka dibentuklah Badan  Arsip Kabupaten Sarolangun. Badan Arsip Kabupaten Sarolangun dibentuk  sebagai upaya penyelamatan fungsi dan lembaga yang sebelumnya sudah ada, yaitu Kantor Arsip Daerah Kabupaten Sarolangun dan Arsip Nasional RI Wilayah Kabupaten Sarolangun.</p>
                            <p class="mt-3">Badan Arsip Kabupaten Sarolangun dibentuk berdasarkan Peraturan Pemerintah Daerah No. 41 Tahun 2000 tanggal 18 Desember 2000 dan diundangkan dalam Lembaran Daerah Kabupaten Sarolangun No. 15 tahun 2001 Seri D. Badan Arsip Kabupaten Sarolangun dipimpin oleh seorang Kepala dengan tingkat eselonering II A. Dalam menjalankan tugasnya, Kepala Badan bertanggung jawab pada Gubernur Jambi.</p>
                            <p class="mt-3">Orang pertama yang ditunjuk sebagai Kepala Badan Arsip Kabupaten Sarolangun adalah Drs. H. Boimin, MM. Sebagai Kepala pertama, beliau harus bekerja keras menyelaraskan visi misi pengembangan kearsipan di Kabupaten Sarolangun. Sayang, beliau tidak lama memimpin Badan Arsip Kabupaten Sarolangun (2001 – 2002). Meskipun begitu, beliau cukup mampu memberi pondasi kuat pada pengembangan  kearsipan di Kabupaten Sarolangun.</p>
                            <p class="mt-3">Muhammad Hakim, SH. MM., ditunjuk oleh Gubernur Jambi sebagai pengganti Drs. H. Boimin, MM. Beliau menjadi Kepala Badan Arsip Kabupaten Sarolangun sejak 2002 – 2008. Selama masa tersebut, banyak sekali hal-hal yang sudah dilakukan untuk membangun kearsipan di Kabupaten Sarolangun, sehingga lembaga kearsipan dikenal oleh masyarakat luas. Pada akhirnya Badan Arsip Kabupaten Sarolangun digabung dengan Badan Perpustakaan, sehingga menjadi Badan Perpustakaan dan Kearsipan Kabupaten Sarolangun.</p>
                            <p class="mt-3 fw-bold">3. BADAN PERPUSTAKAAN</p>
                            <p class="mt-3">Dengan berlakunya Undang-undang nomor 22 tahun 1999 tentang Pemerintah Daerah telah membawa perubahan yang mendasar bagi kelembagaan Pemerintahan di Kabupaten Sarolangun. Salah satu Lembaga Pemerintah yang mengalami perubahan dimaksud adalah Lembaga Perpustakaan.</p>
                            <p>Perpustakaan Nasional Kabupaten Sarolangun yang semula merupakan instansi vertikal Perpustakaan Nasional RI, berubah status menjadi Badan Perpustakaan Propinsi Kabupaten Sarolangun yang berada dalam lingkungan organisasi perangkat Daerah Propinsi Kabupaten Sarolangun.</p>
                            <p class="mt-3">Perjalanan sejarah Badan Perpustakaan Propinsi Kabupaten Sarolangun dimulai dari:</p>
                            <p class="mt-3 fw-bold fst-italic">a. Perpustakaan Negara</p>
                            <p class="mt-3">Pada tahun 1959 dengan Keputusan Menteri Pendidikan dan Kebudayaan Nomor 13477/S tanggal 27 Desember 1959, di Surabaya didirikan Perpustakaan Negara Departemen Pendidikan dan Kebudayaan yang untuk sementara  menempati salah satu ruangan di komplek Jl. Gentengkali Nomor 33 Surabaya. Pada waktu itu bahan pustaka yang ada masih sangat terbatas. Tenaga yang ada hanya satu orang. Terbatasnya kegiatan, anggaran, pengadaan tenaga, bahan pustaka dan sarana perpustakaan berjalan sangat lamban.</p>
                            <p class="mt-3">Secara struktural, Perpustakaan Negara berada di bawah dan bertanggung jawab langsung kepada Kepala Lembaga Perpustakaan di Jakarta. Hubungan kerja dengan Kepala Kantor Perwakilan Departemen P dan K Kabupaten Sarolangun bersifat konsultatif.</p>
                            <p class="mt-3 fw-bold fst-italic">b. Taman Pustaka Masyarakat</p>
                            <p class="mt-3">Sementara itu, sejak tahun 1953 dl Surabaya sudah berdiri dan berfungsi dengan baik Taman Pustaka Masyarakat/C (tingkat Propinsi) yang pengelolaanya menjadi tanggung jawab Jawatan Pendidikan Masyarakat Perwakilan P dan K Kabupaten Sarolangun. Taman Pustaka Masyarakat/C (TPM/C) yang beralamat di Jl. Walikota Mustajab Nomor 68 Surabaya ini adalah bekas Centraal Bibliotheek Indonesia milik Belanda yang diserahkan kepada Perwakilan P dan K Kabupaten Sarolangun bersamaan dengan penyerahan kedaulatan dari Pemerintah Pendudukan Belanda kepada Pernerintah Republik Indonesia. Koleksinya hampir 90% terdiri dari buku-buku berbahasa Belanda, Inggris, Jerman, Perancis. Pada tahun 1975 terbit Keputusan Menteri pendidikan dan Kebudayaan Nomor 079/0/1975 tentang restrukturing di lingkungan Departemen Pendidikan dan Kebudayaan Propinsi Kabupaten Sarolangun.</p>
                            <p class="mt-3">Dalam Keputusan tersebut, Bidang Pendidikan Masyarakat tidak lagi dibebani Pengolahan Taman Pendidikan Masyarakat. Dengan demikian Taman Pendidikan Masyarakat tidak dapat berkembang karena tidak mempunyai Lembaga Induk dan tidak mempunyai anggaran belanja. Sehubungan dengan hal tersebut Keputusan Kepala Kantor Wilayah Departemen Pendidikan dan Kebudayaan Nomor: 2/SA tanggal 23  Pebuari 1977 Taman Pustaka Masyarakat/C diintegrasikan ke dalam Perpustakaan Negara dan menempati gedung di Jl. Walikota Mustajab 68 Surabaya.</p>
                            <p class="mt-3 fw-bold fst-italic">c. Perpustakaan Wilayah</p>
                            <p class="mt-3">Pada tahun 1978, terjadi perubahan nama perpustakaan, yaitu Lembaga perpustakaan berubah menjadi Pusat Pembinaan Perpustakaan dan Perpustakaan Negara berubah menjadi Perpustakaan Wilayah. Sejak saat itu Perpustakaan Wilayah memperoleh dua macam anggaran yaitu: Anggaran Pembangunan dari Direktur Jenderal Kebudayaan dan Anggaran Rutin dari Pusat Pembinaan Perpustakaan.</p>
                            <p class="">Untuk menampung perkembangan, Perpustakaan Wilayah dipindahkan ke Gedung baru yang beralamat Jalan Menu¬r Pumpungan No.32 Surabaya. Gedung baru dimaksud dibangun pada pertengahan Juni 1990 dalam tiga tahun (tahab) dengan biaya pembangunan dan anggaran proyek.</p>
                            <p class="mt-3 fw-bold fst-italic">d. Perpustakaan Daerah</p>
                            <p class="mt-3">Sesuai dengan keputusan Presiden Republik Indonesia Nomor 1 April tahun 1989 tentang Perpustakaan Nasional, mulai 1 April 1991 Pusat Pembinaan perpustakaan dimasukan kedalam struktur Organisasi Perpustakaan Nasional Republik Indonesia. Perpustakaan Wilayah diubah namanya menjadi Perpustakaan Daerah sesuai pula dengan keputusan Kepala Perpustakaan Nasional RI Nomor 001/Org/9/1990, Dalam melaksanakan tugas Kepala Perpustakaan Daerah ber-tanggung jawab kepada Kepala Perpustakaan Nasional. Sejak tanggal 1 April 1991 baik Perpustakaan Nasional maupun Perpustakaan Daerah secara organisasi terlepas dan Departemen pendidikan dan Kebudayaan dan diserahkan kepada Sekretaris Negara (Non Departemen).</p>
                            <p class="mt-3"></p>
                            <p class="mt-3"></p>
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