<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pusat Peminjaman Arsip</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
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
        @include('client.layout.breadcrumb_arsip')
        <div class="container-fluid">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    <div class="card box-shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Data</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container shadow">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Buku</th>
                                                <th scope="col">Kode Pemesanan</th>
                                                <th scope="col">Judul</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="text-center">Detail</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($data->check_count == 0)
                                            <tr>
                                                <th colspan="7" class="text-center">- Data Peminjaman Masih Kosong, Silahkan Lakukan Peminjaman Terlebih Dahulu -</th>
                                            </tr>
                                            @else
                                            @foreach($data->data_buku as $data_buku)
                                            <tr>
                                                <th scope="row">
                                                    <a href="/buku/detail_buku/{{$data_buku->id_buku}}">
                                                        <span class="bi bi-search" data-bs-toggle="tooltip1" data-bs-placement="top" title="Klik Untuk Melihat Detail Buku!"></span>
                                                    </a>
                                                </th>
                                                <td scope="col">{{$data_buku->kode_booking}}</td>
                                                <td scope="col">{{$data_buku->judul}}</td>
                                                <td scope="col">{{$data_buku->status}}</td>
                                                <td scope="col" class="text-center">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#detail_{{$loop->index}}">
                                                        <span class="bi bi-ticket-detailed" data-bs-toggle="tooltip1" data-bs-placement="top" title="Klik Untuk Melihat Komentar Admin"></span>
                                                    </a>
                                                </td>
                                                <th scope="row" class="text-center">
                                                    @if($data_buku->status == 'Dibatalkan Oleh Pengguna' || $data_buku->status == 'Dibatalkan Oleh Admin' || $data_buku->status == 'Selesai')
                                                        -
                                                    @elseif($data_buku->status == 'Menunggu Konfirmasi Admin')
                                                        <a href="/buku/batal_pinjam/{{$data_buku->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    @elseif($data_buku->status == 'Peminjaman Berlangsung')
                                                        @if($data_buku->extended_count == 0)
                                                            <a href="/buku/perpanjang_masa/{{$data_buku->id_peminjaman}}" class="perpanjang-confirm btn btn-primary text-white">Perpanjang Masa</a>
                                                        @else
                                                            -
                                                        @endif
                                                    @elseif($data_buku->status == 'Pengambilan Buku')
                                                        <a href="/buku/perpanjang_masa/{{$data_buku->id_peminjaman}}" class="btn btn-primary text-white">Panduan Pengambilan</a>
                                                    @endif
                                                </th>
                                            </tr>
                                            <!-- Modal Detail Peminjaman -->
                                            <div class="modal" id="detail_{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Tanggal Pengajuan
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->created_at_peminjaman == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->created_at_peminjaman}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Tanggal Batas Pengambilan
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->batas_pengambilan == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->batas_pengambilan}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Tanggal Mulai
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->start_at == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->start_at}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Tanggal Berakhir
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->expired_at == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->expired_at}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Denda
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->denda == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->denda}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Komentar
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->komentar == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->komentar}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Perpanjang Masa Peminjaman (Max 1 Kali)
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->extended_count == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->extended_count}} (Kali)
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    Tanggal Pengembalian
                                                                </div>
                                                                <div class="col-1">
                                                                    :
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($data_buku->return_at == null)
                                                                    -
                                                                    @else
                                                                    {{$data_buku->return_at}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js">
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        $('.perpanjang-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Maksimal Perpanjang Masa Peminjaman Hanya 1 kali',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah Anda Yakin Membatalkan Peminjaman Buku?',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>
</body>


</html>