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
                                    <button class="nav-link col-md-6 {{$data->tab == 'kategori' ? 'active' : ''}}" id="nav-kategori-tab" data-bs-toggle="tab" data-bs-target="#nav-kategori" type="button" role="tab" aria-controls="nav-kategori" aria-selected="false">Daftar Kategori</button>
                                    <button class="nav-link col-md-6 {{$data->tab == 'tag' ? 'active' : ''}}" id="nav-tag-tab" data-bs-toggle="tab" data-bs-target="#nav-tag" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Daftar Tag</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- Tab Content 1 -->
                                <div class="tab-pane fade {{$data->tab == 'kategori' ? 'active show' : ''}}" id="nav-kategori" role="tabpanel" aria-labelledby="nav-kategori-tab">
                                    <div class="card-header bg-white">
                                        <div class="row">
                                            <div class="col-md-5">

                                            </div>
                                            <div class="col-md-5">
                                                <form action="/admin/" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0" name="search" placeholder="Novel,Biography,Teknologi.." value="{{$data->search}}">
                                                        <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-2">
                                                <a class="btn btn-primary text-white" data-bs-toggle="modal" href="#Modal2" role="button">Tambah Kategori</a>
                                            </div>
                                            <!-- Modal Tambah Kategori -->
                                            <form action="/admin/buku/tambah_kategori" method="get">
                                                {{ csrf_field() }}
                                                <div class="modal" id="Modal2" aria-hidden="true" aria-labelledby="Modal2Label" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Penambahan Data Kategori</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="my-3 ms-2 row">
                                                                    <label for="inputkategori" class="col-sm-3 col-form-label">Kategori</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="kategori" class="form-control" id="inputkategori" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary text-white" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                                                <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col" class="w-15">No</th>
                                                    <th scope="col" class="w-75">Kategori</th>
                                                    <th scope="col" class="w-15">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data->kategori as $kategori)
                                                <tr>
                                                    <td scope="col">{{ $loop->index + 1 }}</td>
                                                    <td scope="col">{{$kategori->kategory}}</td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#Modal_edit_kategori{{$loop->index}}" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a class="delete-confirm" href="/admin/buku/kategori/{{$kategori->id}}/{{$data->page}}"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit Kategori -->
                                                <form action="/admin/buku/edit_kategori" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal" id="Modal_edit_kategori{{$loop->index}}" aria-hidden="true" aria-labelledby="Modal2Label" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data Kategori</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="my-3 ms-2 row">
                                                                        <label for="inputkategori" class="col-sm-3 col-form-label">Kategori</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" name="kategori" class="form-control" id="inputkategori" value="{{$kategori->kategory}}" required>
                                                                            <input type="hidden" name="id" value="{{$kategori->id}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary text-white" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                                                    <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        @if($data->jumlah != 0)
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                @if(ceil($data->jumlah_page) == 1)
                                                <li class="page-item disabled">Jumlah Data : {{$data->jumlah}}</li>
                                                @else
                                                <li class="page-item {{$data->page_kat == 1 ? 'disabled' : ''}}">
                                                    <a class="page-link" href="/admin/menu/kategori_tag_all/{{$data->page_kat - 1}}/kategori" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                @for($j = 0; $j < ceil($data->jumlah_page); $j++)
                                                    <li class="page-item {{$data->page_kat == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/kategori_tag_all/{{$j+1}}/kategori">{{$j+1}}</a></li>
                                                    @endfor
                                                    <li class="page-item {{$data->page_kat == ceil($data->jumlah_page) ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/kategori_tag_all/{{$data->page_kat + 1}}/kategori">Next</a>
                                                    </li>
                                                    @endif
                                            </ul>
                                        </nav>
                                        @endif
                                    </div>
                                </div>
                                <!-- Tab Content 2 -->
                                <div class="tab-pane fade {{$data->tab == 'tag' ? 'active show' : ''}}" id="nav-tag" role="tabpanel" aria-labelledby="nav-tag-tab">
                                    <div class="card-header bg-white">
                                        <div class="row">
                                            <div class="col-md-5">

                                            </div>
                                            <div class="col-md-5">
                                                <form action="/admin/" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0" name="search" placeholder="Aksi,Fantasi,Horror.." value="{{$data->search}}">
                                                        <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-2">
                                                <a class="btn btn-primary text-white" data-bs-toggle="modal" href="#Modal3" role="button">Tambah Tag</a>
                                            </div>
                                            <!-- Modal Tambah tag -->
                                            <form action="/admin/buku/tambah_tag" method="get">
                                                {{ csrf_field() }}
                                                <div class="modal" id="Modal3" aria-hidden="true" aria-labelledby="Modal2Label" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Penambahan Data Tag</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="my-3 ms-2 row">
                                                                    <label for="inputtag" class="col-sm-2 col-form-label">Tag</label>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="tag" class="form-control" id="inputtag" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="page" value="{{$data->page}}">
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary text-white" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                                                <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col" class="w-15">No</th>
                                                    <th scope="col" class="w-75">Tag</th>
                                                    <th scope="col" class="w-15">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->jumlah_tag == 0)
                                                <tr>
                                                    <td colspan="3" class="text-center"> - Data Tag Kosong - </td>
                                                </tr>
                                                @else
                                                @foreach($data->tag as $tag)
                                                <tr>
                                                    <td scope="col">{{ $loop->index + 1}}</td>
                                                    <td scope="col">{{ $tag->tag}}</td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#Modal_edit_tag{{$loop->index}}" href="#"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a class="delete-confirm" href="/admin/buku/tag/{{$tag->id}}/{{$data->page}}"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit Kategori -->
                                                <form action="/admin/buku/edit_tag" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal" id="Modal_edit_tag{{$loop->index}}" aria-hidden="true" aria-labelledby="Modal2Label" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Data Tag</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="my-3 ms-2 row">
                                                                        <label for="inputkategori" class="col-sm-3 col-form-label">Kategori</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" name="tag" class="form-control" id="inputkategori" value="{{$tag->tag}}" required>
                                                                            <input type="hidden" name="id" value="{{$tag->id}}">
                                                                            <input type="hidden" name="page" value="{{$data->page}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary text-white" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                                                    <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        @if($data->jumlah_tag != 0)
                                        <nav aria-label="...">
                                            <ul class="pagination">
                                                @if(ceil($data->jumlah_page_tag) == 1)
                                                <li class="page-item disabled">Jumlah Data : {{$data->jumlah_tag}}</li>
                                                @else
                                                <li class="page-item {{$data->page_tag == 1 ? 'disabled' : ''}}">
                                                    <a class="page-link" href="/admin/menu/kategori_tag_all/{{$data->page_tag - 1}}/tag" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                @for($j = 0; $j < ceil($data->jumlah_page_tag); $j++)
                                                    <li class="page-item {{$data->page_tag == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/kategori_tag_all/{{$j+1}}/tag">{{$j+1}}</a></li>
                                                    @endfor
                                                    <li class="page-item {{$data->page_tag == ceil($data->jumlah_page_tag) ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/kategori_tag_all/{{$data->page_tag + 1}}/tag">Next</a>
                                                    </li>
                                                    @endif
                                            </ul>
                                        </nav>
                                        @endif
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

    {{ Html::script('js/app.js') }}
</body>
<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Menghapus Data?',
            text: 'Data akan terhapus secara permanent!',
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