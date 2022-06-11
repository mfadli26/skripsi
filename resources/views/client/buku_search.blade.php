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
                                    Pencarian
                                </div>
                                <div class="col-md-6">
                                    <form action="/buku/main" method="post">
                                        {{ csrf_field() }}
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded-0" name="search" value="{{$data->search}}" placeholder="Masukkan Nama atau Nomor Arsip">
                                            <button class="btn btn-primary text-white rounded-0" type="submit">Cari Buku</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Tahun Terbit</th>
                                        <th scope="col">Buku Tersedia</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->buku as $buku)
                                    <tr>
                                        <th scope="row">{{$buku->judul}}</th>
                                        <td scope="row">{{$buku->penulis}}</td>
                                        <td scope="row">{{$buku->tahun_terbit}}</td>
                                        <td scope="row">{{$buku->stock_buku}}</td>
                                        @auth
                                        <td><a href="/buku/detail_buku/{{$buku->id}}" class="btn btn-primary text-white">Pilih</a></td>
                                        @endauth
                                        @guest
                                        <td scope="row"><a href="/masuk" class="text-decoration-none">Masuk</a> Untuk Melakukan Peminjaman</td>
                                        @endguest
                                    </tr>

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
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

</html>