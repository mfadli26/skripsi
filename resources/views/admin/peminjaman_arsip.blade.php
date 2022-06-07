<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet">

    {{ Html::style('css/app.css') }}
    {{ Html::style('css/admin.css') }}

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
                        <div class="card box-shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-5">
                                        Peminjaman Arsip
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pengguna</th>
                                            <th scope="col">Nomor Arsip</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Surat Pengantar</th>
                                            <th scope="col">Admin Pengurus</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->peminjaman as $peminjaman)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none" href="">
                                                    {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$loop->index}}" class="text-decoration-none" href="">
                                                    {{$peminjaman->nomor_arsip}} <i class="bi bi-caret-down-fill"></i>
                                                </a>
                                            </td>
                                            </td>
                                            <td>
                                                {{$peminjaman->created_at}}
                                            </td>
                                            </td>
                                            @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                            <td>
                                                Belum Unggah Surat Pengantar
                                                @elseif($peminjaman->type == 1 && $peminjaman->file_izin != NULL)
                                            <td>
                                                <form action="/admin/menu/archive/bacaSurat" method="get">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="file" value="{{$peminjaman->file_izin}}">
                                                    <button class="btn btn-outline-dark" type="submit">
                                                        <a type="submit">Klik Untuk Mendapatkan File</a>
                                                    </button>
                                                </form>
                                            </td>
                                            @else
                                            <td>
                                                Tanpa Surat Pengantar
                                            </td>
                                            @endif
                                            @if($peminjaman->id_admin == NULL)
                                            <td>-</td>
                                            @else
                                            <td>
                                                {{$peminjaman->name_admin}}
                                            </td>
                                            @endif
                                            <td>
                                                <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                    @if($peminjaman->status == 'Pengambilan Arsip')
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Arsip Dapat Didownload Pada Info Detail Arsip">
                                                        @endif
                                                        {{$peminjaman->status}}
                                                </span>
                                            </td>
                                            <td>
                                                @if($peminjaman->status == 'Pengambilan Arsip')
                                                <a class="selesai-confirm" href="/admin/konfirmasi_selesai/{{$peminjaman->id_peminjaman}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                @elseif($peminjaman->status != 'Dibatalkan Oleh Pengguna' && $peminjaman->status != 'Dibatalkan Oleh Admin' && $peminjaman->status != 'Selesai')
                                                <a data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>

                                                @endif
                                                <a href="" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                            </td>
                                        </tr>

                                        <!-- Modal Users Detail -->
                                        <div class="modal fade" id="modal_users{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Pengguna</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nama Lengkap</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->name}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Email</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->email}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor KTP</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->ktp_number}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Tempat, Tanggal Lahir</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->birth_city}}, {{\Carbon\Carbon::parse($peminjaman->birth_date)->translatedFormat('d F Y')}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Alamat</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->address}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Archive Detail -->
                                        <div class="modal fade" id="modal_archive{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Archive</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->nomor_arsip}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">nNomor Surat</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->nomor_surat}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nama Pencipta</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->nama_pencipta}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Petugas Registrasi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->petugas_registrasi}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Kode Klasifikasi</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->kode_klasifikasi}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Jumlah Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->jumlah_arsip}} (Lembar)</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Deskripsi Arsip</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$peminjaman->keterangan}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Link Download</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            @if ($peminjaman->status == 'Pengambilan Arsip')
                                                            <span class="form-label m-0 col-md-8"><a class="badge bg-primary text-decoration-none fs-6 text-white" href=""><i class="bi bi-download"></i> Link Download</a></span>
                                                            @else
                                                            <span class="form-label m-0 col-md-3 badge bg-danger fs-6 text-white">Link Tidak Tersedia</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Konfirmasi -->
                                        <form action="/admin/menu/archive/konfirmasi_peminjaman_arsip" method="post">
                                            {{ csrf_field() }}
                                            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_konfirm_{{$loop->index}}" tabindex="-1" aria-labelledby="label_konfrim_{{$loop->index}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center">Tentukan Aksi Yang Ingin Anda Pilih</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="form-check mt-1">
                                                                <input name="konfirm" value="1" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Konfirmasi Peminjaman
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input name="konfirm" value="2" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tolak Peminjaman
                                                                </label>
                                                                <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan Peminjaman Pada Kolom Komentar">
                                                                    <span class="bi bi-info-circle"></span>
                                                                </a>
                                                            </div>
                                                            <div class="form-check">
                                                                <input name="konfirm" value="3" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Tolak File Izin Peminjaman
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan File Izin Pada Kolom Komentar">
                                                                        <span class="bi bi-info-circle"></span>
                                                                    </a>
                                                                </label>
                                                            </div>
                                                            <div class="mb-3 mt-4">
                                                                <label for="exampleFormControlTextarea1" class="form-label">
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Kolom Komentar Boleh Kosong">
                                                                        <span class="bi bi-info-circle"></span>
                                                                    </a> Tambah Komentar :</label>
                                                                <textarea name="komentar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_admin" value="{{Auth::user()->id}}">
                                                            <input type="hidden" name="id" value="{{$peminjaman->id_peminjaman}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal_{{$loop->index}}">Back</i></a>
                                                            <button class="btn btn-primary text-white">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
    <script src="/js/app.js">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah Anda Yakin Menghapus Data Peminjaman?',
                text: 'Data dan detailnya akan dihapus secara permanent!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        $('.selesai-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah Anda Yakin Mengubah Status Arsip Menjadi Selesai?',
                text: 'Pastikan Pengguna Telah Mendapatkan Hardcopy Arsip!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>