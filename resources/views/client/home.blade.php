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

</head>

<body class="antialiased">
    <div class="">
        @include('client.layout.header_arsip')
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow">
            <div class="grid grid-cols-1">
                <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
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
            <div class="container-fluid grid grid-cols-1 position-relative">
                <div class="wrapper position-relative">
                    <div class="ms-5 py-3 pt-5">
                        <h2 class="h2"><strong>Rekomendasi Buku</strong></h2>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                        <div class="button-event p-3 text-end pe-5">
                            <button class="px-4 py-2 rounded-pill" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                Prev
                            </button>
                            <button class="px-4 py-2 rounded-pill" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                Next
                            </button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row row-cols-1 row-cols-md-4 g-4 px-5">
                                    @foreach($data->buku1 as $buku)
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
                    <div class="">
                        <span class="fs-2"><strong>Video</strong></span>
                        <a href="" class="float-end me-5 mt-3">Lihat Selangkapnya <i class="bi bi-chevron-double-right"></i></a>
                        <div class="row mt-4">
                            <div class="col-4 px-1">
                                <iframe width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                                </iframe>
                            </div>
                            <div class="col-4 px-1">
                                <iframe width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                                </iframe>
                            </div>
                            <div class="col-4 px-1">
                                <iframe width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <span class="fs-2"><strong>Foto</strong></span>
                        <a href="" class="float-end me-5 mt-3">Lihat Selangkapnya <i class="bi bi-chevron-double-right"></i></a>
                        <div class="row">
                            <div class="col-3 px-1">
                                <img class="w-100" src="{{url('/storage/gambar_artikel/1656337231_117 JCH Sarolangun Berangkat Ke Tanah Suci, PJ Bupati Henrizal Bilang Begini.jpg')}}">
                            </div>
                            <div class="col-3 px-1">
                                <img class="w-100" src="{{url('/storage/gambar_artikel/1656337231_117 JCH Sarolangun Berangkat Ke Tanah Suci, PJ Bupati Henrizal Bilang Begini.jpg')}}">
                            </div>
                            <div class="col-3 px-1">
                                <img class="w-100" src="{{url('/storage/gambar_artikel/1656337231_117 JCH Sarolangun Berangkat Ke Tanah Suci, PJ Bupati Henrizal Bilang Begini.jpg')}}">
                            </div>
                            <div class="col-3 px-1">
                                <img class="w-100" src="{{url('/storage/gambar_artikel/1656337231_117 JCH Sarolangun Berangkat Ke Tanah Suci, PJ Bupati Henrizal Bilang Begini.jpg')}}">
                            </div>
                        </div>
                    </div>
                    <div class="ms-5 py-3 pt-5">
                        <h2 class="h2"><strong>Berita</strong></h2>
                    </div>
                    @include('client.layout.footer_home')
                </div>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>