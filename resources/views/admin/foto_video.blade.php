<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Admin</title>

    {{ Html::style('css/app.css') }}
    {{ Html::style('css/admin.css') }}

</head>

<body>
    <main>
        @include('sweetalert::alert')
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                @include('admin.layout.sidebar')
                <div class="col d-flex flex-column h-sm-100 p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="card box-shadow">
                            <nav class="mb-4">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link col-md-6 {{$data->tab == 'foto' ? 'active' : ''}}" id="nav-foto-tab" data-bs-toggle="tab" data-bs-target="#nav-foto" type="button" role="tab" aria-controls="nav-foto" aria-selected="false">Daftar Foto</button>
                                    <button class="nav-link col-md-6 {{$data->tab == 'video' ? 'active' : ''}}" id="nav-video-tab" data-bs-toggle="tab" data-bs-target="#nav-video" type="button" role="tab" aria-controls="nav-video" aria-selected="true">Daftar Video</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- Tab Content 1 -->
                                <div class="tab-pane fade {{$data->tab == 'foto' ? 'active show' : ''}}" id="nav-foto" role="tabpanel" aria-labelledby="nav-foto-tab">
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <span class="fs-4 fw-bold">Koleksi Foto Dinas Perpustakaan Dan Kearsipan Kabupaten Sarolangun</span>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal_tambah_foto" class="me-2 btn btn-primary text-white float-end">Tambah Foto Baru</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($data->foto AS $foto)
                                        <div class="col-3 mb-5 d-flex align-items-stretch">
                                            <div class="card">
                                                <img height="200px" src="{{url('/storage/foto_video/foto/'.$foto->path)}}" class="card-img-top" alt="...">
                                                <div class="card-body d-flex flex-column">
                                                    <p class="card-text mb-4">{{$foto->judul}}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="/admin/foto/hapus/{{$foto->id}}" class="float-end btn btn-danger text-white delete-confirm">Hapus</a>
                                                    <button data-bs-toggle="modal" data-bs-target="#modal_edit_foto_{{$foto->id}}" class="float-end btn btn-secondary text-white me-2">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit Foto -->

                                        <div class="modal" id="modal_edit_foto_{{$foto->id}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="/admin/foto/edit" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Foto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="judul" class="form-label">Judul</label>
                                                                <input type="text" name="judul" class="form-control" id="judul" value="{{$foto->judul}}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="file" class="form-label">Gambar Baru</label>
                                                                <input type="file" name="file" class="form-control">
                                                            </div>
                                                            <input type="hidden" name="id" value="{{$foto->id}}">
                                                            <input type="hidden" name="old_path" value="{{$foto->path}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button data-bs-dismiss="modal" class="btn btn-secondary text-white">Back</button>
                                                            <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                    <!-- Modal Tambah Foto -->
                                    <form action="/admin/foto/tambah" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal" id="modal_tambah_foto">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Foto Baru</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label">Judul</label>
                                                            <input type="text" name="judul" class="form-control" id="judul" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Foto</label>
                                                            <input type="file" name="file" class="form-control" id="foto" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary text-white">Tambah</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <nav aria-label="Page navigation example ">
                                        <ul class="pagination d-flex justify-content-center">
                                            @if(ceil($data->foto_jumlah) == 1)
                                            <li class="page-item disabled"><a class="page-link" href="">1</a></li>
                                            @else
                                            <li class="page-item {{$data->page_foto == 1 ? 'disabled' : ''}}"><a class="page-link" href="/admin/menu/foto_video/{{$data->page-1}}/2">Previous</a></li>
                                            @for($i = 0; $i < ceil($data->foto_jumlah); $i++)
                                                <li class="page-item {{$data->page_foto == $i+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/foto_video/{{$i+1}}/2">{{$i+1}}</a></li>
                                                @endfor
                                                <li class="page-item {{$data->page_foto == ceil($data->foto_jumlah) ? 'disabled' : ''}}"><a class="page-link" href="/admin/menu/foto_video/{{$data->page+1}}/2">Next</a></li>
                                                @endif
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Tab Content 2 -->
                                <div class="tab-pane fade {{$data->tab == 'video' ? 'active show' : ''}}" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                                    <div class="row mb-5">
                                        <div class="col-8">
                                            <span class="fs-4 fw-bold">Koleksi Video Dinas Perpustakaan Dan Kearsipan Kabupaten Sarolangun</span>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal_tambah_video" class="me-2 btn btn-primary text-white float-end">Tambah Video Baru</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($data->video AS $video)
                                        <div class="col-6">
                                            <iframe width="100%" height="315" src="{{$video->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            <a href="/admin/video/hapus/{{$data->page_video}}/{{$video->id}}" class="btn btn-danger text-white float-end delete-video-confirm">Hapus</a>
                                            <button data-bs-toggle="modal" data-bs-target="#modal_edit_video{{$loop->index}}" class="btn btn-secondary text-white float-end me-3">Edit</button>
                                        </div>
                                        <!-- Modal Edit Video -->
                                        <div class="modal" id="modal_edit_video{{$loop->index}}">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="/admin/video/edit" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Link Video</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="#video" class="form-label">Kode Link Baru</label>
                                                                <input type="text" name="link" class="form-control" id="video" required>
                                                                <input type="hidden" name="id" value="{{$video->id}}">
                                                                <input type="hidden" name="page" value="{{$data->page_video}}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Modal Tambah Video -->
                                    <form action="/admin/video/tambah" method="post">
                                        {{ csrf_field() }}
                                        <div class="modal" id="modal_tambah_video">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Video Baru</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="#video" class="form-label">Kode Link</label>
                                                            <input type="text" name="link" class="form-control" id="video" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary text-white">Tambah</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <nav aria-label="Page navigation example ">
                                        <ul class="pagination d-flex justify-content-center mt-5">
                                            @if(ceil($data->video_jumlah) == 1)
                                            <li class="page-item disabled"><a class="page-link" href="">1</a></li>
                                            @else
                                            <li class="page-item {{$data->page_video == 1 ? 'disabled' : ''}}"><a class="page-link" href="/admin/menu/foto_video/{{$data->page-1}}/video">Previous</a></li>
                                            @for($j = 0; $j < ceil($data->video_jumlah); $j++)
                                                <li class="page-item {{$data->page_video == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/foto_video/{{$j+1}}/video">{{$j+1}}</a></li>
                                                @endfor
                                                <li class="page-item {{$data->page_video == ceil($data->video_jumlah) ? 'disabled' : ''}}"><a class="page-link" href="/admin/menu/foto_video/{{$data->page+1}}/video">Next</a></li>
                                                @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('admin.layout.footer')
                </div>
            </div>
        </div>

    </main>

    {{ Html::script('js/app.js') }}
</body>
<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Menghapus Foto?',
            text: 'Foto akan terhapus secara permanent dari database!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    $('.delete-video-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Menghapus Video?',
            text: 'Link Video akan terhapus secara permanent dari database!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>

</html>