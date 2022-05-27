<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin</title>

    {{ Html::style('css/app.css') }}
    {{ Html::style('css/admin.css') }}

</head>

<body>
    <main>
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                @include('admin.layout.sidebar')
                <div class="col d-flex flex-column h-sm-100 p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="card box-shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-5">
                                        Archive List
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <form action="/admin/menu/archive/cari" method="post">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control rounded-0" name="search" placeholder="Nomor Arsip, Nomor Surat, Kode Klasifikasi" value="{{$data->search}}">
                                                <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-2">
                                        <a class="btn btn-primary float-end" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Tambah Data Arsip</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Tambah Archive -->
                            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalToggleLabel">Tambah Data Arsip</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <button class="btn btn-primary" data-bs-target="#Modal2" data-bs-toggle="modal" data-bs-dismiss="modal">Manual</button>
                                            <hr>
                                            <button class="btn btn-primary" data-bs-target="#Modal3" data-bs-toggle="modal" data-bs-dismiss="modal">+ File</button>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="/admin/menu/archive/tambah_archive" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="modal fade" id="Modal2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="Modal2Label" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-scrollable ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Penambahan Data Arsip Manual</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-group col-mb-6">
                                                        <label for="nomor-arsip" class="col-form-label">Nomor Arsip:</label>
                                                        <input type="text" class="form-control" id="nomor-arsip" name="nomor_arsip" value="{{ old('nomor_arsip') }}">
                                                    </div>
                                                    <div class="form-group col-mb-6">
                                                        <label for="nomor-surat" class="col-form-label">Nomor Surat:</label>
                                                        <input type="text" class="form-control" id="nomor-surat" name="nomor_surat" value="{{ old('nomor_surat') }}">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama-pencipta" class="col-form-label">Nama Pencipta:</label>
                                                    <input type="text" class="form-control" id="nama-pencipta" name="nama_pencipta" value="{{ old('nama_pencipta') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="petugas-registrasi" class="col-form-label">Petugas Registrasi:</label>
                                                    <input type="text" class="form-control" id="petugas-registrasi" name="petugas_registrasi" value="{{ old('petugas_registrasi') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kode-klasifikasi" class="col-form-label">Kode Klasifikasi:</label>
                                                    <input type="text" class="form-control" id="kode-klasifikasi" name="kode_klasifikasi" value="{{ old('kode_klasifikasi') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah arsip" class="col-form-label">Jumlah Arsip (Lembar):</label>
                                                    <input type="number" class="form-control" id="jumlah-arsip" name="jumlah_arsip" value="{{ old('jumlah_arsip') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tipe_arsip" class="col-form-label">Tipe Arsip:</label>
                                                    <select class="form-select" aria-label="Default select example" name="type" value="{{ old('type') }}">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">Harus Dengan Surat Pengantar</option>
                                                        <option value="2">Tidak Memerlukan Surat Pengantar</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi-arsip" class="col-form-label">Deskripsi Arsip:</label>
                                                    <textarea type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"></textarea>
                                                </div>
                                                <div>
                                                    <label for="deskripsi-arsip" class="col-form-label">Upload File:</label>
                                                    <input class="form-control" type="file" id="formFile" name="file">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </from>
                            <div class="modal fade" id="Modal3" aria-hidden="true" aria-labelledby="Modal3Label" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload File Arsip</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <input type="file">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nomor Arsip</th>
                                            <th scope="col">Nomor Surat</th>
                                            <th scope="col">Nama Pencipta Arsip</th>
                                            <th scope="col">Petugas Registrasi</th>
                                            <th scope="col">Kode Klasifikasi</th>
                                            <th scope="col">Jumlah (Lembar)</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data->archive as $archive)
                                        <tr>
                                            <td>{{$archive->nomor_arsip}}</td>
                                            <td>{{$archive->nomor_surat}}</td>
                                            <td>{{$archive->nama_pencipta}}</td>
                                            <td>{{$archive->petugas_registrasi}}</td>
                                            <td>{{$archive->kode_klasifikasi}}</td>
                                            <td>{{$archive->jumlah_arsip}}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#modal_{{$loop->index}}" href="#"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                <a data-bs-toggle="modal" data-bs-target="#modal_delete_{{$loop->index}}"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                            </td>
                                        </tr>
                                    <!-- Modal Info -->
                                        <div class="modal fade" id="modal_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Arsip</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->nomor_arsip}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor Surat</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->nomor_surat}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nama Pencipta Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->nama_pencipta}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Petugas Registrasi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->petugas_registrasi}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Kode Klasifikasi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->kode_klasifikasi}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Jumlah (Lembar)</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->jumlah_arsip}} Lembar</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Deskripsi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->keterangan}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Tipe Arsip </span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->type}}</span>
                                                        </div>
                                                        <div>
                                                            
                                                            <!-- <form action="/admin/menu/archive/getDownload" method="post"> -->
                                                                <a href="/admin/menu/archive/getDownload?file={{$archive->file}}" class="btn-download"><i class="fa fa-download"></i> Download</a>
                                                            <!-- </from>               -->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <a class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_edit_{{$loop->index}}">Edit</i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- Modal Edit -->
                                         <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_edit_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="label_{{$loop->index}}">Pembaruan Detail Arsip</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <input type="text" class="col-md-3" id="nomor-surat" name="nomor_surat" value="{{ old('nomor_surat') }}">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor Surat</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->nomor_surat}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nama Pencipta Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->nama_pencipta}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Petugas Registrasi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->petugas_registrasi}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Kode Klasifikasi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->kode_klasifikasi}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Jumlah (Lembar)</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->jumlah_arsip}} Lembar</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Deskripsi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->keterangan}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Tipe Arsip </span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$archive->type}}</span>
                                                        </div>
                                                        <div>
                                                            
                                                            <!-- <form action="/admin/menu/archive/getDownload" method="post"> -->
                                                                <a href="/admin/menu/archive/getDownload?file={{$archive->file}}" class="btn-download"><i class="fa fa-download"></i> Download</a>
                                                            <!-- </from>               -->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_delete_{{$loop->index}}" tabindex="-1" aria-labelledby="label_delete_{{$loop->index}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center">Apakah Anda Yakin Menghapus Data Arsip?</h5>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="col-md-6">
                                                            
                                                            <a href="/admin/menu/archive/delete_arsip?id={{$archive->id}}" class="btn btn-secondary float-end">Hapus</a>
                                                
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button> 
                                                        </div> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
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
                                <div class="card-footer">
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

</html>