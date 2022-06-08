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
                            <div class="tab-pane fade show active" id="nav-buku" role="tabpanel" aria-labelledby="nav-buku-tab">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h5>Daftar Buku</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <form action="/admin/menu/buku/cari" method="post">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <input type="text" class="form-control rounded-0" name="search" placeholder="Judul, Penerbit, Tahun Terbit, Penulis" value="{{$data->search}}">
                                                    <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary text-white" data-bs-toggle="modal" href="#Modal2" role="button">Tambah Data Buku</a>
                                        </div>
                                    </div>
                                    <!-- Modal Tambah Buku -->
                                    <form action="/admin/buku/tambah_buku" method="post">
                                        {{ csrf_field() }}
                                        <div class="modal fade" id="Modal2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="Modal2Label" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-scrollable ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Penambahan Data Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-mb-6">
                                                                <label for="judul" class="col-form-label">Judul:</label>
                                                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                                                            </div>
                                                            <div class="form-group col-mb-6">
                                                                <label for="penerbit" class="col-form-label">Penerbit:</label>
                                                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penulis" class="col-form-label">Penulis:</label>
                                                            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ old('penulis') }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tahun" class="col-form-label">Tahun:</label>
                                                            <input type="text" class="form-control" id="tahun" name="tahun" value="{{ old('tahun') }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kategori" class="col-form-label">Kategori:</label>
                                                            <select class="form-select" name="id_kategori">
                                                                @foreach ($data->kategori as $kategori)
                                                                <option value="{{$kategori->id}}">{{$kategori->kategory}}</option>
                                                                @endforeach
                                                            </select>
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
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Judul</th>
                                                <th scope="col">Penulis</th>
                                                <th scope="col">Penerbit</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Tahun Terbit</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data->buku as $buku)
                                            <tr>
                                                <td>{{ $loop->index +1 }}</td>
                                                <td>{{ $buku->judul }}</td>
                                                <td>{{ $buku->penulis }}</td>
                                                <td>{{ $buku->penerbit }}</td>
                                                <td>{{ $buku->kategory }}</td>
                                                <td>{{ $buku->tahun_terbit }}</td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#modal_edit_{{$loop->index}}" href="#"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                    <a class="delete-confirm" href="/admin/buku/hapus_buku/{{$buku->id}}"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit -->
                                            <form action="/admin/buku/update_buku" method="post">
                                                {{ csrf_field() }}
                                                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_edit_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="label_{{$loop->index}}">Pembaruan Buku</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <span class="form-label m-0">Judul</span>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <span class="form-label">:</span>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3 d-flex align-items-center">
                                                                        <span class="form-label m-0">Penulis</span>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <span class="form-label">:</span>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{$buku->penulis}}">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3 d-flex align-items-center">
                                                                        <span class="form-label m-0">Penerbit</span>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <span class="form-label">:</span>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{$buku->penerbit}}">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3 d-flex align-items-center">
                                                                        <span class="form-label m-0">Kategori</span>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <span class="form-label">:</span>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <select class="form-select" name="id_kategori">
                                                                            <option value="{{$kategori->id}}">{{$buku->kategory}}</option>
                                                                            @foreach ($data->kategori as $kategori)
                                                                            @if($kategori->kategory != $buku->kategory)
                                                                            <option type="hidden" value="{{$kategori->id}}">{{$kategori->kategory}}</option>
                                                                            @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3 d-flex align-items-center">
                                                                        <span class="form-label m-0">Tahun</span>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <span class="form-label">:</span>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" id="tahun" name="tahun" value="{{$buku->tahun_terbit}}">
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="id" value="{{$buku->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_{{$loop->index}}">Back</i></a>
                                                                <button type="submit" class="btn btn-primary text-white">Save</button>
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
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item" aria-current="page">
                                                <a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="modal fade" id="Modal3" aria-hidden="true" aria-labelledby="Modal3Label" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload File Arsip</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-mb-6">
                                                    <label for="nomor-arsip" class="col-form-label">Kategori Buku :</label>
                                                    <input type="text" class="form-control" id="nomor-arsip" name="nomor_arsip" value="{{ old('nomor_arsip') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
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

    {{ Html::script('js/app.js') }}
</body>
<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Menghapus Data Buku?',
            text: 'Data buku akan terhapus secara permanent!',
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