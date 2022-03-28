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
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="{{url('/img/signup.png')}}" class="w-100">
                                </div>
                                <div class="col-md-7">
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul class="m-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        <div class="m-0">
                                            <span>Akun berhasil dibuat, silahkan login</span>
                                        </div>
                                    </div>
                                    @endif
                                    <form action="/daftar/baru" method="post">
                                        {{ csrf_field() }}
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Nama Lengkap :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control " placeholder="nama lengkap" name="name" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Nomor KTP :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control " placeholder="nomor ktp" name="ktp_number" value="{{ old('ktp_number') }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Nomor Telepon :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control " placeholder="nomor telepon" name="phone_number" value="{{ old('phone_number') }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Jenis Kelamin :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="pria" name="sex" {{ old('sex') == 'pria' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Pria</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="wanita" name="sex" {{ old('sex') == 'wanita' ? 'checked' : '' }}>
                                                    <label class="form-check-label">Wanita</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Tempat dan Tanggal Lahir :</span>
                                            </div>
                                            <div class="col-md-9 row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control col-md-6" placeholder="kota tempat lahir" name="birth_city" value="{{ old('birth_city') }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control col-md-6" name="birth_date" value="{{ old('birth_date') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Alamat Lengkap :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" placeholder="alamat lengkap rumah" name="address">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Alamat Email :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" placeholder="example@email.com" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Kata Sandi :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" placeholder="kata sandi" name="password" value="{{ old('password') }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3 d-flex align-items-center">
                                                <span class="form-label m-0">Konfirmasi Kata Sandi :</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" placeholder="konfirmasi kata sandi" name="password_confirmation" >
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary text-white col-md-3">Daftar</button>
                                    </form>
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