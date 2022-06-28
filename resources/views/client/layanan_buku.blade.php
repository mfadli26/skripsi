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
        <div class="container fs-5">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <p>Badan Perpustakaan dan Kearsipan Kabupaten Sarolangun menyelenggarakan berbagai jenis layanan perpustakaan kepada seluruh anggota masyarakat berpusat di Komplek Perkantoran Gunung Kembang, Kabupaten Sarolangun, Jambi Layanan tersebut adalah sebagai berikut :</p>
                <p class="fw-bold mt-5">1. Layanan sirkulasi</p>
                <p class="my-4">Layanan sirkulasi adalah kegiatan melayani pengguna perpustakaan dalam peminjaman dan pengembalian bahan pustaka beserta penyelesaian administrasinya baik secara manual maupun elektronik.</p>
                <p>Jam Layanan :</p>
                <table class="table text-center my-5">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Istirahat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Senin s/d Kamis</td>
                            <td>07.30-14.30 WIB</td>
                            <td>12.00-13.00 WIB</td>
                        </tr>
                        <tr>
                            <td>Jumat</td>
                            <td>09.00-14.00 WIB</td>
                            <td>11.00-13.00 WIB</td>
                        </tr>
                    </tbody>
                </table>
                <p class="fw-bold">2. Layanan perpustakaan keliling</p>
                <p class="my-3">Layanan perpustakaan keliling adalah kegiatan layanan perpustakaan yang bergerak dari satu tempat ke tempat lain dengan menggunakan Mobil Perpustakaan Keliling (MPK). Layanan ini diselenggarakan dalam bentuk layanan paket dan layanan langsung.</p>
                <p class="fw-bold mt-5">3. Layanan rujukan</p>
                <p class="my-3">Layanan rujukan adalah layanan memberikan informasi kepada pengguna perpustakaan berdasarkan koleksi sumber rujukan yang dimiliki.</p>
                <p class="fw-bold mt-5">4. Layanan rujukan cepat</p>
                <p class="my-3">Layanan rujukan cepat adalah memberi jawaban langsung atas permintaan informasi dari pengguna perpustakaan melalui pemanfaatan sumber rujukan seperti kamus, ensiklopedia, direktori dan lain-lain.</p>
                <p class="fw-bold mt-5">5. Bimbingan pemakaian sumber rujukan</p>
                <p class="my-3">Bimbingan pemakaian sumber rujukan adalah bantuan yang diberikan kepada pengguna jasa perpustakaan untuk memanfaatkan sumber-sumber rujukan yang dimiliki antara lain berkaitan dengan isi, susunan, dan cara mencari informasi termasuk sumber rujukan elektronik. Bidang Layanan Perpustakaan dan Informasi menyediakan komputer dan fasilitas wi-fi untuk akses internet serta koleksi e-book secara gratis.</p>
                <p class="fw-bold mt-5">6. Layanan penelusuran literatur</p>
                <p class="my-3">Layanan penelusuran literatur adalah kegiatan mencari atau menemukan kembali informasi kepustakaan mengenai suatu bidang tertentu yang ada di perpustakaan maupun di luar perpustakaan dengan menggunakan bantuan OPAC (Online Public Access Catalogue), literatur sekunder dan sarana penelusuran lainnya. Kegiatan penelusuran literatur ini umumnya digunakan untuk mendukung penelitian dan atau penulisan ilmiah, serta bahan bacaan sesuai kebutuhan pengguna perpustakaan.</p>
                <p class="fw-bold mt-5">7. Layanan audio visual</p>
                <p class="my-3">Layanan audio visual atau pandang dengar adalah kegiatan mengoperasikan peralatan pandang dengar termasuk komputer dan membimbing penggunaannya.</p>
                <p class="fw-bold mt-5">8. Layanan penyediaan bahan pustaka</p>
                <p class="my-3">Layanan penyediaan bahan pustaka adalah kegiatan mencari dan menyediakan bahan pustaka sesuai dengan kebutuhan pengguna melalui koleksi setempat atau melalui silang layan perpustakaan.</p>
                <p class="fw-bold mt-5">9. Bimbingan membaca</p>
                <p class="my-3">Layanan bimbingan membaca adalah kegiatan memberi bimbingan, petunjuk atau panduan kepada pengguna jasa perpustakaan tentang cara-cara membaca yang baik, secara cepat dan benar dengan menggunakan koleksi dan peralatan perpustakaan.</p>
                <p class="fw-bold mt-5">10. Bimbingan pemakai perpustakaan</p>
                <p class="my-3">Layanan bimbingan pemakai perpustakaan adalah kegiatan memberikan penjelasan tentang berbagai informasi perpustakaan dan penggunaan perpustakaan secara optimal kepada kelompok-kelompok pengguna baru.</p>
                <p class="fw-bold mt-5">11. Layanan mendongeng kepada anak</p>
                <p class="my-3">Layanan mendongeng kepada anak-anak adalah bercerita kepada anak-anak mengenai isi suatu buku atau beberapa buku dengan berbagai teknik untuk menumbuhkan minat baca dan menambah pengetahuan anak.</p>
                <p class="fw-bold mt-5">12. Layanan foto copy</p>
                <p class="my-3">Layanan Foto Copy diperuntukkan bagi pemustaka yang menginginkan foto copy koleksi secara terbatas untuk kepentingan pendidikan dan penelitian.</p>


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