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
                                            <tr class="text-center">
                                                <td scope="col"></td>
                                                <td scope="col">Kode Pemesanan</td>
                                                <td scope="col">Batas Tanggal Pengambilan</td>
                                                <td scope="col">Denda</td>
                                                <td scope="col">Tanggal Mulai</td>
                                                <td scope="col">Tanggal Berakhir</td>
                                                <td scope="col">Status</td>
                                                <td scope="col">Komentar</td>
                                                <td scope="col">Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data->data_buku as $data_buku)
                                            <tr class="text-center">
                                                <td scope="col">
                                                    <a href="/buku/detail_buku/{{$data_buku->id_buku}}">
                                                        <span class="bi bi-search" data-bs-toggle="tooltip1" data-bs-placement="top" title="Klik Untuk Melihat Detail Buku!"></span>
                                                    </a>
                                                </td>
                                                <td scope="col">{{$data_buku->kode_booking}}</td>
                                                @if($data_buku->batas_pengambilan == null)
                                                <td scope="col">-</td>
                                                @else
                                                <td scope="col">{{$data_buku->batas_pengambilan}}</td>
                                                @endif
                                                @if($data_buku->denda == null)
                                                <td>-</td>
                                                @else
                                                <td scope="col">{{$data_buku->denda}}</td>
                                                @endif
                                                @if($data_buku->start_at == null)
                                                <td>-</td>
                                                <td>-</td>
                                                @else
                                                <td scope="col"><span class="bi bi-info-circle" data-bs-toggle="tooltip1" data-bs-placement="top" title="Tanggal Mulai Peminjaman Dimulai Setelah Mendapatkan Konfirmasi Dari Admin"></span>{{$data_buku->start_at}}</td>
                                                <td scope="col">{{$data_buku->expired_at}}</td>
                                                @endif
                                                <td scope="col">{{$data_buku->status}}</td>
                                                @if ($data_buku->komentar == null)
                                                <td>-</td>
                                                @else
                                                <td scope="col">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#komen_{{$loop->index}}">
                                                        <span class="bi bi-chat-square" data-bs-toggle="tooltip1" data-bs-placement="top" title="Klik Untuk Melihat Komentar Admin"></span>
                                                    </a>
                                                </td>
                                                @endif
                                                <td>
                                                    @if($data_buku->status == 'Dibatalkan Oleh Pengguna' || $data_buku->status == 'Dibatalkan Oleh Admin')
                                                    -
                                                    @elseif($data_buku->status == 'Menunggu Konfirmasi Admin')
                                                    <a href="/buku/batal_pinjam/{{$data_buku->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    @else
                                                    <a href="/buku/batal_pinjam/{{$data_buku->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <div class="modal" id="komen_{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Komentar</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{$data_buku->komentar}}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
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