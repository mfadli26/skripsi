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
                                    Pencarian
                                </div>
                                <div class="col-md-6">
                                    <form action="/archive/main" method="post">
                                        {{ csrf_field() }}
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded-0" name="search" value="{{$data->search}}" placeholder="Masukkan Nama atau Nomor Arsip">
                                            <button class="btn btn-success text-white rounded-0" type="submit">Cari Arsip</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->archive as $archive)
                                    <tr>
                                        <th scope="row">{{$archive->nomor_surat}}</th>
                                        <td>{{$archive->petugas_registrasi}}</td>
                                        <td class="text-center"><button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modal_{{$loop->index}}" type="button">Pilih</button></td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Arsip</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Nomor Arsip</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->nomor_arsip}}</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Nomor Surat</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->nomor_surat}}</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Nama Pencipta</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->nama_pencipta}}</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Petugas Registrasi</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->petugas_registrasi}}</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Kode Klasifikasi</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->kode_klasifikasi}}</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Jumlah Arsip</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->jumlah_arsip}}</span>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Jenis Arsip</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        @if($archive->type == 1)
                                                            <span class="form-label m-0 col-md-8">Harus Dengan Surat Pengantar</span>
                                                            
                                                        @else
                                                            <span class="form-label m-0 col-md-8">Tidak Memerlukan Surat Pengantar</span>
                                                        
                                                        @endif
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Deskripsi Arsip</span>
                                                        </div>
                                                        <span class="form-label m-0 col-md-1">:</span>
                                                        <span class="form-label m-0 col-md-8">{{$archive->keterangan}}</span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    <form action="/archive/pinjam" method="post">
                                                    {{ csrf_field() }}           
                                                        <button class="btn btn-primary" type="submit">Pinjam</button>
                                                        <input type="hidden" value="{{$archive->id}}" name="id_archive">
                                                        <input type="hidden" value="{{$archive->type}}" name="type">
                                                        <input type="hidden" value="{{$data->user->id}}" name="id_users">
                                                        <input type="hidden" value="{{$archive->jumlah_arsip}}" name="jumlah">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <span>Total Data {{$data->jumlah}}</span>
                            <nav class="float-end">
                                <ul class="pagination justify-content-end my-2">
                                    <li class="page-item {{($data->page == 1) ? 'disabled' : ''}}">
                                        @if($data->search == "")
                                        <a class="page-link" href="/all_archive/{{$data->page-1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                        @else
                                        <a class="page-link" href="/archive/{{$data->search}}/{{$data->page-1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                        @endif
                                    </li>
                                    <li class="page-item {{($data->page == 1) ? 'd-none' : ''}}">
                                        @if($data->search == "")
                                        <a class="page-link" href="/all_archive/{{$data->page-1}}">{{$data->page-1}}</a>
                                        @else
                                        <a class="page-link" href="/archive/{{$data->search}}/{{$data->page-1}}">{{$data->page-1}}</a>
                                        @endif
                                    </li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">{{$data->page}}</a>
                                    </li>
                                    <li class="page-item">
                                        @if($data->search == "")
                                        <a class="page-link" href="/all_archive/{{$data->page+1}}">{{$data->page+1}}</a>
                                        @else
                                        <a class="page-link" href="/archive/{{$data->search}}/{{$data->page+1}}">{{$data->page+1}}</a>
                                        @endif
                                    </li>
                                    <li class="page-item">
                                        @if($data->search == "")
                                        <a class="page-link" href="/all_archive/{{$data->page+1}}" tabindex="-1" aria-disabled="true">Next</a>
                                        @else
                                        <a class="page-link" href="/archive/{{$data->search}}/{{$data->page+1}}">Next</a>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js"></script>
</body>

</html>