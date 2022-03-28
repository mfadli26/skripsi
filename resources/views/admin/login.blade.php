<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Admin</title>

    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet"> <!-- {{ Html::style('css/admin.css') }} -->

</head>

<body>
    <main>
        <div class="container">
            <div class="row d-flex flex-column min-vh-100 justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            @if (\Session::has('fail'))
                            <div class="alert alert-danger">
                                <div class="m-0">
                                    <span>Gagal masuk, silahkan cek kembali username dan kata sandi anda</span>
                                </div>
                            </div>
                            @endif
                            <form action="/masuk_admin" method="post">
                                {{ csrf_field() }}
                                <div class="mb-3 row">
                                    <label for="email" class="col-md-4 col-form-label text-end">Email</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-md-4 col-form-label text-end">Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary float-end text-light   ">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>