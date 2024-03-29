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
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Pemesanan</th>
                                                <th scope="col">Nomor Arsip</th>
                                                <th scope="col"><span class="bi bi-info-circle" data-bs-toggle="tooltip1" data-bs-placement="top" title="Tanggal Mulai Pengambilan Dimulai Setelah Mendapatkan Konfirmasi Dari Admin"></span> Tanggal Mulai Pengambilan</th>
                                                <th scope="col">Tanggal Berakhir Pengambilan</th>
                                                <th scope="col"><span class="bi bi-info-circle" data-bs-toggle="tooltip1" data-bs-placement="top" title="Total Biaya Berdasarkan Jumlah Lembar Arsip"></span> Biaya</th>
                                                <th scope="col">Status Peminjaman</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($data->check_count == 0)
                                            <tr class="text-center">
                                                <td colspan="7">
                                                    - Anda Belum Meminjam Arsip Apapun, <a href="/layanan/pencarian arsip">Klik</a> Disini Untuk Mencari Arsip -
                                                </td>
                                            </tr>
                                            @else
                                            @foreach($data->data_arsip as $archive)
                                            <tr class="text-center" data-bs-toggle="collapse" data-bs-target="#r1_{{$archive->id}}">
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$archive->kode_booking}}</td>
                                                <td>{{$archive->nomor_arsip}}</td>
                                                @if($archive->start_at == null)
                                                <td>-</td>
                                                @else
                                                <td>{{$archive->start_at}}</td>
                                                @endif

                                                @if($archive->expired_at == null)
                                                <td>-</td>
                                                @else
                                                <td>{{$archive->expired_at}}</td>
                                                @endif
                                                <td>Rp.@convert($archive->biaya),-</td>
                                                @if($archive->status == 'Unggah Izin')
                                                <td><span class="bi bi-info-circle" data-bs-toggle="tooltip1" data-bs-placement="top" title="Anda Harus Menggungah File Izin Dari Pihak Dinas Terkait Sebelum Dapat Dikonfirmasi Oleh Admin!"></span> {{$archive->status}}</td>
                                                @elseif($archive->status == 'File Izin Ditolak')
                                                <td><span class="bi bi-info-circle" data-bs-toggle="tooltip1" data-bs-placement="top" title="Silahkan Lakukan Pengunggahan File Ulang!"></span> {{$archive->status}}</td>
                                                @else
                                                <td>{{$archive->status}}</td>
                                                @endif
                                                <td><i class="fa-solid fa-chevron-down"></i></td>
                                            </tr>
                                            <tr class="collapse accordion-collapse" style="background-color : #00000013; border-top: solid black;" id="r1_{{$archive->id}}" data-bs-parent=".table">
                                                <td colspan="8" class="px-4">
                                                    <h4 class="fw-bold text-center">Detail Peminjaman</h4>
                                                    <div class="container" style="width : 60%;">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <span class="form-label m-0">Nama Pencipta</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="form-label">{{$archive->nama_pencipta}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <span class="form-label m-0">Petugas Registrasi</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="form-label">{{$archive->petugas_registrasi}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <span class="form-label m-0">Kode Klasifikasi</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="form-label">{{$archive->kode_klasifikasi}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <span class="form-label m-0">Jumlah Arsip</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="form-label">{{$archive->jumlah_arsip}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <span class="form-label m-0">Keterangan Arsip</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="form-label">{{$archive->keterangan}}</span>
                                                            </div>
                                                        </div>


                                                        <form action="/unggah_file" method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            @if($archive->status == 'Unggah Izin' || $archive->status == 'File Izin Ditolak')
                                                            @if($archive->type == 1)
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <span class="form-label m-0">File Izin Peminjaman Dari Dinas Terkait</span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span class="form-label">:</span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control-sm" name="file" required>
                                                                    <input type="hidden" name="id" value="{{$archive->id}}">
                                                                    <input type="hidden" name="file_old" value="{{$archive->file_izin}}">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endif
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <span class="form-label m-0">Komentar Admin</span>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span class="form-label">:</span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if($archive->komentar == NULL)
                                                                    <span class="form-label">-</span>
                                                                    @else
                                                                    <span class="form-label">{{$archive->komentar}}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="mt-5">
                                                                <span>Klik <a href="">Link</a> Berikut Untuk Melihat Panduan Pengambilan Arsip</span>
                                                            </div>
                                                            <div class="ms-3 mt-3">

                                                                <div class="float-end">
                                                                    @if($archive->status == 'Menunggu Konfirmasi' || $archive->status == 'Pengambilan Arsip' || $archive->status == 'File Izin Ditolak' || $archive->status == 'Unggah Izin')
                                                                    <a href="/batal_pinjam_user/{{$archive->id}}" class="batal_pinjam btn btn-danger text-white">Batal</a>
                                                                    @endif
                                                                    @if($archive->status == 'Unggah Izin' || $archive->status == 'File Izin Ditolak')
                                                                    <button class="btn btn-primary text-white upload-confirm" type="submit">Unggah</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($data->check_count != 0)
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            @if(ceil($data->jumlah_page) == 1)
                                            <li class="page-item disabled">Jumlah Data : {{$data->check_count}}</li>
                                            @else
                                            <li class="page-item {{$data->page == 1 ? 'disabled' : ''}}">
                                                <a class="page-link" href="/archive_pinjam/{{$data->page - 1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            @for($j = 0; $j < ceil($data->jumlah_page); $j++)
                                                <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="/archive_pinjam/{{$j+1}}">{{$j+1}}</a></li>
                                                @endfor
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) ? 'disabled' : ''}}">
                                                    <a class="page-link" href="/archive_pinjam/{{$data->page + 1}}">Next</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                    @endif
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/js/app.js">
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        $('.batal_pinjam').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah Anda Yakin Membatalkan Peminjaman?',
                text: 'Data dan detailnya akan dihapus secara permanent!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        $('.upload-confirm').on('click', function(event) {
            event.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: 'Konfirmasi Upload File',
                text: 'Pastikan File Izin Telah Benar!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) form.submit();
            });
        });
    </script>
</body>


</html>