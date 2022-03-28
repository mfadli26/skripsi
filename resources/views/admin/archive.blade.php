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
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                @include('admin.layout.sidebar')
                <div class="col d-flex flex-column h-sm-100 p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="card box-shadow">
                            <div class="card-header">
                                Archive List
                                <a class="btn btn-primary float-end" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Tambah Data Arsip</a>
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
                                                    <input type="text" class="form-control" id="nomor-arsip">
                                                </div>
                                                <div class="form-group col-mb-6">
                                                    <label for="nomor-surat" class="col-form-label">Nomor Surat:</label>
                                                    <input type="text" class="form-control" id="nomor-surat">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama-pencipta" class="col-form-label">Nama Pencipta:</label>
                                                <input type="text" class="form-control" id="nama-pencipta">
                                            </div>
                                            <div class="mb-3">
                                                <label for="petugas-registrasi" class="col-form-label">Petugas Registrasi:</label>
                                                <input type="text" class="form-control" id="petugas-registrasi">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode-klasifikasi" class="col-form-label">Kode Klasifikasi:</label>
                                                <input type="text" class="form-control" id="kode-klasifikasi">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah arsip" class="col-form-label">Jumlah Arsip (Lembar):</label>
                                                <input type="number" class="form-control" id="jumlah-arsip">
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi-arsip" class="col-form-label">Deskripsi Arsip:</label>
                                                <textarea type="text" class="form-control" id="deskripsi-arsip"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                            <button class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
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
                                                <i class="fas fa-trash-alt text-danger fs-5"></i>
                                            </td>
                                        </tr>
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