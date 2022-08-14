<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Admin</title>

    <link href="../../css/app.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    <!-- {{ Html::style('css/admin.css') }} -->

</head>

<body>
    <main>
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                <div class="col d-flex flex-column h-sm-100 p-0">
                    <nav class="navbar navbar-dark bg-dark">
                        <div class="container-fluid col-md-3">
                            <a class="navbar-brand" href="#">
                                <img class="mw-100" src="{{url('/img/logo.jpg')}}" alt="Image" />
                            </a>
                        </div>
                    </nav>
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
                                                <form action="/login_admin" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="row mb-3 d-flex justify-content-center align-items-center">
                                                        <div class="col-md-3 d-flex align-items-center">
                                                            <span class="form-label m-0">Alamat Email :</span>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="example@email.com" name="email">
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
                                                    <button type="submit" class="btn btn-primary text-white col-md-3 mt-3">Masuk</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.layout.footer')
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>