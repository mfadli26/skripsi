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
                <p>Pelayanan arsip maupun koleksi referensi di Badan Arsip Kabupaten Sarolangun yang dapat dipergunakan untuk kepentingan Pemerintah Kabupaten Sarolangun, lembaga pencipta arsip, peneliti maupun masyarakat baik dari dalam/ luar negeri.</p>
                <p class="fw-bold">Unit Pelayanan Arsip</p>
                <p>Layanan Informasi dan jasa bahan kearsipan dilakukan oleh Bidang Layanan Jasa Kearsipan</p>
                <p class="fw-bold">Waktu Pelayanan Arsip</p>
                <p>Pelayanan Informasi, Perpustakaan dan Pemesanan Khasanah Arsip (tidak melayani permintaan arsip)</p>
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
                <p>Tata Tertib Bagi Pengguna Arsip (di Ruang Layanan Arsip/ Ruang Baca) :</p>
                <ul>
                    <li>Ruang Baca, khusus untuk membaca arsip atau referensi lainnya.</li>
                    <li>Pengguna dilarang membawa arsip/ referensi lainnya keluar Ruang Baca</li>
                    <li>Untuk menjaga kelestarian arsip, pengguna arsip wajib memperlakukan arsip dengan hati-hati</li>
                    <li>Pengguna bertanggungjawab sepenuhnya atas bahan arsip yang sedang dipergunakan</li>
                    <li>Pengguna dilarang melakukan hal-hal yang dapat mengakibatkan kerusakan arsip/ referensi secara fisik maupun informasinya, seperti :</li>
                    <ol class="mb-4">
                        <li>Memberi catatan, tanda/ coretan dengan cara apapun pada lembar arsip</li>
                        <li>Mengubah susunan/ penataan sesuai aturan aslinya</li>
                        <li>Menggunakan arsip sebagai alas/ landasan untuk menulis</li>
                    </ol>
                    <li>Bahan referensi yang terdapat di Ruang Baca dapat dipergunakan dengan terlebih dahulu memberitahukan kepada petugas layanan.</li>
                    <li>Pengguna hanya diperkenankan membawa alat tulis di Ruang Baca. Barang-barang milik pengguna seperti tas, map, jaket dan lain sebagainya harus disimpan pada tempat yang ditentukan (locker).</li>
                    <li>Pengguna tidak diperkenankan makan, minum dan merokok di Ruang Baca.</li>
                    <li>Pengguna tidak diperkenankan melakukan hal-hal yang dapat mengganggu ketenangan di Ruang Baca, seperti membuat gaduh, berisik, membawa anak kecil di bawah usia 12 tahun.</li>
                    <li>Ruang Baca dan Perpustakaan dibuka pada jam yang telah ditentukan.</li>
                </ul>
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