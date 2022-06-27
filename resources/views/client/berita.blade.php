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

        .artikel-t:hover {
            background-color: rgba(108, 117, 125, 0.2) !important;
            box-shadow: 1px 1px rgb(108, 117, 125) !important;
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
                    <div class="row">
                        <div class="col-7 me-5">
                            @foreach($data->artikel AS $artikel)
                            <a href="/berita/detail/{{$artikel->id}}" class="card mt-3 text-decoration-none text-black artikel-t">
                                <div class="card-body row">
                                    <div class="col-md-3">
                                        <img src="{{url('/storage/gambar_artikel/'.$artikel->gambar)}}" class="w-100">
                                    </div>
                                    <div class="col-md-9">
                                        <strong class="fs-5">{{$artikel->judul}}</strong>
                                        <p class="mt-2"><span class="badge bg-primary"><i class="bi bi-calendar"></i> {{$artikel->tanggal}}<span></p>
                                        <span>
                                            {!! substr($artikel->content, 0, 250) !!}..
                                        </span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="col-4 ms-5 ps-5" style="border-left : solid 1px black;">
                            <h4><strong>ARTIKEL TERBARU</strong></h4>
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    @foreach ($data->artikel_terbaru AS $terbaru)
                                    <a href="/berita/detail/{{$terbaru->id}}" class="text-decoration-none list-group-item artikel-t">
                                        <div class="row">
                                            <div class="col-5">
                                                <img src="{{url('/storage/gambar_artikel/'.$terbaru->gambar)}}" class="w-100">
                                            </div>
                                            <div class="col-7">
                                                {{$terbaru->judul}}
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </ul>
                            </div>
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