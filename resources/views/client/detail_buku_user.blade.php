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
        <div class="container-fluid w-75">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    @foreach($data->buku as $buku)
                    <div class="bg-white box-shadow px-5 py-5">
                        <div class="text-dark mb-2">
                            <h1 class="fs-1 mb-3 text-capitalize">{{$buku->judul}}</h1>
                            <span class="text-secondary fs-5">Oleh :</span>
                            <p class="fs-3 text-capitalize">{{$buku->penulis}}</p>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <img src="{{url('/storage/cover_buku/'.$buku->cover)}}" class="w-100">
                            </div>
                            <div class="col-4">
                                <h2><span class="badge bg-primary"><i class="bi bi-journals"></i> Informasi Umum</span></h2>
                                <div class="mt-5">
                                    <h2 class="">Penerbit</h2>
                                    <p class="fs-5 text-secondary text-capitalize">{{$buku->penerbit}}</p>
                                    <h2>Tahun Terbit</h2>
                                    <p class="fs-5 text-secondary">{{$buku->tahun_terbit}}</p>
                                    <h2>Kategori</h2>
                                    <p class="fs-5 text-secondary text-capitalize">{{$buku->kategory}}</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <h2><span class="badge bg-warning"><i class="bi bi-info-square"></i> Informasi Lainnya</span></h2>
                                <div class="mt-5">
                                    <h2 class="">Stok Buku</h2>
                                    <p class="fs-5 text-secondary">{{$buku->stock_buku}}</p>
                                    <h2>Tag</h2>
                                    @if($data->tag_buku_jumlah == 0)
                                    <span class="text-center">- Buku Belum Memiliki Tag -</span>
                                    @else
                                    @foreach($data->tag_buku as $tag_buku)
                                    <span class="badge bg-success fs-6 me-1 mt-2 text-capitalize">{{$tag_buku->tag}}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <form action="/buku/pinjam_buku" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_buku" value="{{$buku->id_buku}}">
                                    <input type="hidden" name="id_users" value="{{$data->user->id}}">
                                    @if ($buku->stock_buku == 0)
                                    <span class="d-inline-block float-end" tabindex="0" data-bs-toggle="tooltip1" title="Stock Buku Tidak Tersedia Untuk Dipinjam Saat Ini">
                                        <button class="btn btn-primary text-white fs-5" type="button" disabled>Pinjam</button>
                                    </span>
                                    @else
                                    <button class="btn btn-primary text-white float-end fs-5">Pinjam</button>
                                    @endif
                                </form>
                            </div>

                        </div>
                        <div>

                        </div>
                    </div>
                    @endforeach
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