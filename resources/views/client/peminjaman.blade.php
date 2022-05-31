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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"> -->
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
        @if (session('alert'))
        <div class="alert alert-success">
            {{ session('alert') }}
        </div>
        @endif
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
                                                <th scope="col">Nomor Arsip</th>
                                                <th scope="col">Nomor Surat</th>
                                                <th scope="col"><span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Tanggal Mulai Pengambilan Dimulai Setelah Mendapatkan Konfirmasi Dari Admin"></span> Tanggal Mulai Pengambilan</th>
                                                <th scope="col">Tanggal Berakhir Pengambilan</th>
                                                <th scope="col"><span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Total Biaya Berdasarkan Jumlah Lembar Arsip"></span> Biaya</th>
                                                <th scope="col">Status Peminjaman</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data->data_arsip as $archive)
                                            <tr class="text-center" data-bs-toggle="collapse" data-bs-target="#r1_{{$archive->id}}">
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$archive->nomor_arsip}}</td>
                                                <td>{{$archive->nomor_surat}}</td>
                                                @if($archive->start_at == null)
                                                <td>-</td>
                                                @else
                                                <td>{{$star_at}}</td>
                                                @endif

                                                @if($archive->expired_at == null)
                                                <td>-</td>
                                                @else
                                                <td>{{$expired_a}}</td>
                                                @endif
                                                @if($archive->status == 'Pengambilan Arsip' or $archive->status == 'Selesai')
                                                <td>Rp.@convert($archive->biaya)</td>
                                                @else
                                                <td>Rp.@convert($archive->biaya),-</td>
                                                @endif
                                                @if($archive->status == 'Unggah Izin')
                                                <td><span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Anda Harus Menggungah File Izin Dari Pihak Dinas Terkait Sebelum Dapat Dikonfirmasi Oleh Admin!"></span> {{$archive->status}}</td>
                                                @else
                                                <td>{{$archive->status}}</td>
                                                @endif
                                                <td><i class="fa-solid fa-chevron-down"></i></td>
                                            </tr>
                                            <tr class="collapse accordion-collapse" style="background-color : #00000013;" id="r1_{{$archive->id}}" data-bs-parent=".table">
                                                <td colspan="7" class="px-4">
                                                    <h6>Detail Peminjaman</h6>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="form-label m-0">Nama Pencipta</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span class="form-label">{{$archive->nama_pencipta}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="form-label m-0">Petugas Registrasi</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span class="form-label">{{$archive->petugas_registrasi}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="form-label m-0">Kode Klasifikasi</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span class="form-label">{{$archive->kode_klasifikasi}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="form-label m-0">Jumlah Arsip</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span class="form-label">{{$archive->jumlah_arsip}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="form-label m-0">Keterangan</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <span class="form-label">{{$archive->keterangan}}</span>
                                                            </div>
                                                        </div>
                                                        @if($archive->type == 1)
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <span class="form-label m-0">File Izin Peminjaman Dari Dinas Terkait</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span class="form-label">:</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="file" class="form-control-sm" name="file_izin">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="text-right">
                                                            <button class="btn btn-primary float-end" type="submit">Upload</button>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>


</html>