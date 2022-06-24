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
                @include('sweetalert::alert')
                @include('admin.layout.sidebar')
                <div class="col d-flex flex-column h-sm-100 p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="false">
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
                                <div class="carousel-item active ">
                                    <div class="row row-cols-1 row-cols-md-4 g-4 px-5 d-flex justify-content-center">
                                        @foreach ($data->konten AS $konten)
                                        @if($konten->id == '1')
                                        <div class="card my-5 mx-3 col-md-5">
                                            <img src="{{url('/storage/admin_conten/'.$konten->path)}}" class="card-img-top w-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Konten {{$konten->id}}</h5>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                <span class="badge bg-success fs-5">Konten Utama</span>
                                                <button class="float-end btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$konten->id}}">Edit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @foreach ($data->konten AS $konten)
                                        @if($konten->id == '2')
                                        <div class="card my-5 mx-3 col-md-5">
                                            <img src="{{url('/storage/admin_conten/'.$konten->path)}}" class="card-img-top w-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Konten {{$konten->id}}</h5>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                @if($konten->status == 0)
                                                <a href="/admin/konten_status/{{$konten->id}}/{{$konten->status}}" class="confirm-active btn btn-danger text-white">Non-Active</a>
                                                @else
                                                <a href="/admin/konten_status/{{$konten->id}}/{{$konten->status}}" class="confirm-non-active btn btn-success text-white">Active</a>
                                                @endif
                                                <button class="float-end btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$konten->id}}">Edit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row row-cols-1 row-cols-md-4 g-4 px-5 d-flex justify-content-center">
                                        @foreach ($data->konten AS $konten)
                                        @if($konten->id == '3' || $konten->id == '4')
                                        <div class="card my-5 mx-3 col-md-5">
                                            <img src="{{url('/storage/admin_conten/'.$konten->path)}}" class="card-img-top w-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Konten {{$konten->id}}</h5>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                @if($konten->status == 0)
                                                <a href="/admin/konten_status/{{$konten->id}}/{{$konten->status}}" class="confirm-active btn btn-danger text-white">Non-Active</a>
                                                @else
                                                <a href="/admin/konten_status/{{$konten->id}}/{{$konten->status}}" class="confirm-non-active btn btn-success text-white">Active</a>
                                                @endif
                                                <button class="float-end btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$konten->id}}">Edit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row row-cols-1 row-cols-md-4 g-4 px-5 d-flex justify-content-center">
                                        @foreach ($data->konten AS $konten)
                                        @if($konten->id == '5' || $konten->id == '6')
                                        <div class="card my-5 mx-3 col-md-5">
                                            <img src="{{url('/storage/admin_conten/'.$konten->path)}}" class="card-img-top w-100">
                                            <div class="card-body">
                                                <h5 class="card-title">Konten {{$konten->id}}</h5>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                @if($konten->status == 0)
                                                <a href="/admin/konten_status/{{$konten->id}}/{{$konten->status}}" class="confirm-active btn btn-danger text-white">Non-Active</a>
                                                @else
                                                <a href="/admin/konten_status/{{$konten->id}}/{{$konten->status}}" class="confirm-non-active btn btn-success text-white">Active</a>
                                                @endif
                                                <button class="float-end btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$konten->id}}">Edit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit Konten -->
                        @foreach($data->konten AS $konten)
                        <div class="modal fade" id="exampleModal_{{$konten->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="/admin/home_content_edit" method="post" enctype="multipart/form-data">
                                {{ csrf_field()}}
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Konten {{$konten->id}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="formFileSm" class="form-label">Foto Konten</label>
                                                <input class="form-control form-control-sm" id="formFileSm" name="file" type="file">
                                                <input type="hidden" name="old_file" value="{{$konten->path}}">
                                                <input type="hidden" name="id" value="{{$konten->id}}">
                                                <input type="hidden" name="id_admin" value="1">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary text-white">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @include('admin.layout.footer')
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>
<script>
    $('.confirm-active').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Mengaktifkan Konten?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    $('.confirm-non-active').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Menonaktifkan Konten?',
            icon: 'info',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>

</html>