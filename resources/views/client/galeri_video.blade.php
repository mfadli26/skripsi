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
                        <div class="col-8">
                            <div class="row">
                                @if(ceil($data->jumlah) != 1)
                                <div class="mb-5">
                                    <a href="/galeri_video/{{$data->page + 1}}" class="{{$data->page == ceil($data->jumlah) ? 'disabled' :''}} btn btn-outline-primary text-blue px-4 py-2 rounded-pill float-end">
                                        Next
                                    </a>
                                    <a href="/galeri_video/{{$data->page - 1}}" class="{{$data->page == 1 ? 'disabled' :''}} btn btn-outline-primary text-blue me-3 px-4 py-2 rounded-pill float-end">
                                        Prev
                                    </a>
                                </div>
                                @endif
                                @foreach($data->video AS $video)
                                <div class="col-6 mb-5">
                                    <iframe width="420" height="315" src="{{$video->link}}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @include('client.layout.sidemenu')
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