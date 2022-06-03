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
        @include('client.layout.header_arsip')
        @include('client.layout.breadcrumb_arsip')
        <div class="container-fluid">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    <div class="card box-shadow">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="col-md-9 mx-auto">
                                        <img src="{{url('/img/login.png')}}" class="w-100">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        <div class="m-0">
                                            <span>Login berhasil</span>
                                        </div>
                                    </div>
                                    @endif
                                    @if (\Session::has('fail'))
                                    <div class="alert alert-danger">
                                        <div class="m-0">
                                            <span>Gagal masuk, silahkan cek kembali username dan kata sandi anda</span>
                                        </div>
                                    </div>
                                    @endif
                                    <form action="/masuk" method="post">
                                        {{ csrf_field() }}
                                        <div class="row mb-3 mt-4 d-flex justify-content-center align-items-center">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Alamat Email :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" placeholder="example@email.com" name="email">
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-center align-items-center">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Kata Sandi :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" placeholder="kata sandi" name="password">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary text-white col-md-3 mt-5">Masuk</button>
                                    </form>
                                    <div class="mt-4">
                                        <span>Belum memiliki akun? <a href="/daftar">Daftar</a></span>
                                    </div>
                                </div>
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

</html>