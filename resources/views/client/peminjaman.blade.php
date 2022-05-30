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
        @include('client.layout.header_arsip')
        @include('client.layout.breadcrumb_arsip')
        <div class="container-fluid">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    <div class="card box-shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Data
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container shadow">
                                <div class="table-responsive">
                                    <table class="table table-hover accordion">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">No</th>
                                                <th scope="col">Nomor Arsip</th>
                                                <th scope="col">Nomor Surat</th>
                                                <th scope="col">Tanggal Mulai Pengambilan</th>
                                                <th scope="col">Tanggal Berakhir Pengambilan</th>
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
                                                <td>Test</td>
                                                <td><i class="fa-solid fa-chevron-down"></i></td>
                                            </tr>
                                            <tr class="collapse accordion-collapse" id="r1_{{$archive->id}}" data-bs-parent=".table">
                                                <td colspan="7" class="px-3"> test</td>
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
    <script src="/js/app.js"></script>
</body>

</html>