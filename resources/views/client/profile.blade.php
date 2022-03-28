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
                        <div class="card-body py-5">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">

                                </div>
                                <div class="col-md-7">
                                    <div class="container d-flex h-100">
                                        <div class="row justify-content-center align-self-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="col-md-7 mx-auto">
                                        <img src="{{url('/img/profile-2.png')}}" class="w-100">
                                    </div>
                                    <div class="col-md-9 mx-auto py-4">
                                        <h3 class="h3 text-center">
                                            <b>{{$data->user->name}}</b>
                                        </h3>
                                        <h5 class="h5 text-center">
                                            {{$data->user->ktp_number}}
                                        </h5>
                                        <h5 class="h5 text-center">
                                            {{$data->user->birth_city}}, {{$data->user->birth_date}}
                                        </h5>
                                        <h5 class="h5 mt-4 text-center">
                                            Pengguna sejak {{$data->user->join_at}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <nav class="mb-4">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link col-md-6 active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                                            <button class="nav-link col-md-6" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="true">Password</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                                                    <span>Pembaruan data profil berhasil</span>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- {{$data->user}} -->
                                            <form action="/profile" method="post">
                                                {{ csrf_field() }}
                                                <div class="row mb-3">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <span class="form-label m-0">Nomor Telepon :</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control " placeholder="nomor telepon" name="phone_number" value="{{$data->user->phone_number}}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <span class="form-label m-0">Alamat Lengkap :</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" placeholder="alamat lengkap rumah" name="address">{{$data->user->address}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <span class="form-label m-0">Alamat Email :</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" placeholder="alamat email" name="email" value="{{$data->user->email}}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary text-white col-md-3 float-end">Ubah Profil</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                                            <form action="/update_password" method="post">
                                                {{ csrf_field() }}
                                                <div class="row mb-3">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <span class="form-label m-0">Kata Sandi Lama :</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="kata sandi lama" name="password_old" value="{{ old('password_old') }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <span class="form-label m-0">Kata Sandi Baru :</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="kata sandi baru" name="password_new" value="{{ old('password') }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <span class="form-label m-0">Konfirmasi Kata Sandi Baru :</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" placeholder="konfirmasi kata sandi baru" name="password_new_confirmation">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary text-white col-md-3 float-end">Ubah Kata Sandi</button>
                                            </form>
                                        </div>
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