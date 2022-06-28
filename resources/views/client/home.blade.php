<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pusat Peminjaman Arsip</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/home.css" rel="stylesheet">
    <!-- {{ Html::style('css/home.css') }} -->

    <style>
        .test:hover {
            background-color: rgba(108, 117, 125, 0.15) !important;
            color: black;
        }
    </style>
</head>

<body>
    @include('client.layout.header_arsip')
    <div class="bg-white">
        <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($data->content AS $content)
                @if($content->id == 1)
                <div class="carousel-item active">
                    <img src="{{url('/storage/admin_conten/'.$content->path)}}" class="d-block w-100" style="height : 800px !important;" alt="banner-1">
                </div>
                @else
                <div class="carousel-item">
                    <img src="{{url('/storage/admin_conten/'.$content->path)}}" class="d-block w-100" style="height : 800px !important;" alt="banner-1">
                </div>
                @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="justify-content-center" style="margin-top: 100px !important;">
            <div class="mb-4">
                <span class="fs-2 mt-5"><strong>Rekomendasi Buku</strong></span>
                <div class="float-end">
                    <button class="px-4 py-2 rounded-pill" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        Prev
                    </button>
                    <button class="px-4 py-2 rounded-pill" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        Next
                    </button>
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            @foreach($data->buku1 as $buku)
                            <div class="col-md">
                                <div class="card">
                                    <img src="{{url('/storage/cover_buku/'.$buku->cover)}}" class="w-100" style="height : 400px;">
                                    <div class="card-body px-3">
                                        <p class="card-text fs-3 fw-bold">{{ucwords($buku->judul)}}</p>
                                        <p>{{$buku->tahun_terbit}}</p>
                                        <a href="/buku/detail_buku/{{$buku->id}}" class="btn btn-primary text-light float-end"><i class="bi bi-search"></i> Lihat Buku</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row row-cols-1 row-cols-md-4 g-4 px-5">
                            @foreach($data->buku2 as $buku)
                            <div class="col-md">
                                <div class="card px-2 rounded-0">
                                    <img src="{{url('/storage/cover_buku/'.$buku->cover)}}" class="w-100" style="height : 420px;">
                                    <div class="card-body px-0">
                                        <p class="card-text fs-3 fw-bold">{{ucwords($buku->judul)}}</p>
                                        <p>{{$buku->tahun_terbit}}</p>
                                        <a href="/buku/detail_buku/{{$buku->id}}" class="btn btn-primary text-light float-end"><i class="bi bi-search"></i> Lihat Buku</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-center" style="margin-top: 100px !important;">
            <span class="fs-2"><strong>Video</strong></span>
            <a href="/galeri_video/1" class="float-end">Lihat Selangkapnya <i class="bi bi-chevron-double-right"></i></a>
            <div class="row mt-4">
                @foreach($data->video AS $video)
                <div class="col-4 mx-auto">
                    <iframe width="420" height="315" src="{{$video->link}}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                </div>
                @endforeach
            </div>
        </div>
        <div class="justify-content-center" style="margin-top: 100px !important;">
            <div class="mb-4">
                <span class="fs-2"><strong>Foto</strong></span>
                <a href="/galeri_foto/1" class="float-end">Lihat Selangkapnya <i class="bi bi-chevron-double-right"></i></a>
            </div>
            <div class="row">
                @foreach($data->foto AS $foto)
                <div class="col-3 mx-auto">
                    <div class="card">
                        <img height="200px" src="{{url('/storage/foto_video/foto/'.$foto->path)}}" class="card-img-top" alt="...">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="justify-content-center" style="margin-top: 100px !important;">
            <div class="mb-4">
                <h2 class="h2"><strong>Berita</strong></h2>
            </div>
            <div class="row">
                @foreach ($data->artikel AS $artikel)
                <a href="/berita/detail/{{$artikel->id}}" class="text-decoration-none test card col-3 mx-auto px-0" style="width: 20rem;">
                    <img src="{{url('/storage/gambar_artikel/'.$artikel->gambar)}}" class="card-img-top w-100" style="height : 170px !important" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$artikel->judul}}</h5>
                    </div>
                    <p class="mt-2 ms-3">
                        <span class="badge bg-primary">
                            <i class="bi bi-calendar"></i> {{$artikel->tanggal}}
                        </span>
                        <span class="badge bg-secondary">
                            <i class="bi bi-person-fill"></i> {{$artikel->penulis}}
                        </span>
                    </p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js"></script>
</body>

</html>