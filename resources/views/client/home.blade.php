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
    <div class="container-fluid bg-image" style="background-image: url('img/bg.jpg');">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" style="background: transparent;">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow">
                    @include('client.layout.header_home')
                    <div class="grid grid-cols-1">
                        <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{url('/img/banner-1.jpg')}}" class="d-block w-100" alt="banner-1">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{url('/img/banner-2.jpg')}}" class="d-block w-100" alt="banner-2">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{url('/img/banner-3.jpg')}}" class="d-block w-100" alt="banner-3">
                                </div>
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
                    <div class="grid grid-cols-1 position-relative">
                        <img class="position-absolute" src="https://dispusip.jakarta.go.id/dispusip/wp-content/uploads/2019/05/BACKGROUND-02.jpg" style="width: 1920px; height: 1080px;">
                        <div class="wrapper position-relative">
                            <div class="text-center py-3 pt-5">
                                <h2 class="h2">Latest Archive</h2>
                            </div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
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
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-3.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-3.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-3.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-3.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row row-cols-1 row-cols-md-4 g-4 px-5">
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-2.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-2.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-2.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-2.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row row-cols-1 row-cols-md-4 g-4 px-5">
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-1.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-1.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-1.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card px-2 rounded-0">
                                                    <img src="{{url('/img/banner-1.jpg')}}" class="card-img-top rounded-0 pt-2" alt="event-1">
                                                    <div class="card-body px-0">
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-success text-light float-end">Go somewhere</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('client.layout.footer_home')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>