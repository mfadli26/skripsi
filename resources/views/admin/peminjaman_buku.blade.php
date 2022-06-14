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
                            <nav class="mb-4">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-kategori" aria-selected="false">Cari Berdasarkan Kode</button>
                                    <button class="nav-link" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Menunggu Konfirmasi</button>
                                    <button class="nav-link" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Peminjaman Berlangsung</button>
                                    <button class="nav-link" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Pengambilan</button>
                                    <button class="nav-link" id="nav-5-tab" data-bs-toggle="tab" data-bs-target="#nav-5" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Selesai</button>
                                    <button class="nav-link" id="nav-6-tab" data-bs-toggle="tab" data-bs-target="#nav-6" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Dibatalkan</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- Content 1 -->
                                @if($data->event_cari == '1')
                                <div class="tab-pane fade active show" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                                    <div class="container-fluid mb-5">
                                        <div class="card w-50 m-auto">
                                            <div class="card-header text-center">
                                                <span class="fs-1">Pencarian</span>
                                            </div>
                                            <div class="card-body">
                                                <form action="/admin/menu/buku/peminjaman/cari" method="post">
                                                    {{ csrf_field() }}
                                                    <p class="fs-3 mt-5 text-center">Masukkan Kode Pemesanan</p>
                                                    <div class="row d-flex justify-content-end">
                                                        <div class="col-auto">
                                                            <label for="kode" class="col-form-label fs-2">#</label>
                                                        </div>
                                                        <div class="col-8">
                                                            <input type="text" id="kode" name="search" class="form-control fs-2 w-50">
                                                        </div>
                                                    </div>
                                                    <div class="text-center my-5">
                                                        <button type="submit" class="btn btn-primary fs-5 text-white"><i class="bi bi-search"></i> Cari</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade active show" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Hasil Pencarian
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Denda</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Detail Tanggal</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data->event_cari as $peminjaman)
                                                <tr>
                                                    <td><a data-bs-toggle="modal" href="" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td><a data-bs-toggle="modal" data-bs-target="#modal_buku{{$loop->index}}" href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    @if($peminjaman->denda == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->denda}}</td>
                                                    @endif
                                                    <td>{{$peminjaman->status}}</td>
                                                    <td scope="col" >
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_detail{{$loop->index}}">
                                                            <span class="bi bi-search" data-bs-toggle="tooltip1" data-bs-placement="top" title="Klik Untuk Melihat Detail Buku!"></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' || $peminjaman->status == 'Selesai')
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status == 'Menunggu Konfirmasi Admin')
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status == 'Peminjaman Berlangsung')
                                                        <a class="btn btn-primary text-white" href="">Konfirmasi Pengembalian</a>
                                                        @elseif($peminjaman->status == 'Pengambilan Buku')
                                                        <a class="btn btn-primary text-white" href="">Konfirmasi Pengambilan</a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal Detail Tanggal -->
                                                    <div class="modal fade" id="modal_detail{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Pengguna</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tanggal Pengajuan</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->created_at_peminjaman}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tanggal Batas Pengambilan</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        @if($peminjaman->batas_pengambilan == null)
                                                                        <span class="form-label m-0 col-md-8">-</span>
                                                                        @else
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->batas_pengambilan}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tanggal Mulai</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        @if($peminjaman->start_at == null)
                                                                        <span class="form-label m-0 col-md-8">-</span>
                                                                        @else
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->start_at}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tanggal Berakhir</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        @if($peminjaman->expired_at == null)
                                                                        <span class="form-label m-0 col-md-8">-</span>
                                                                        @else
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->expired_at}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tanggal Pengembalian</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        @if($peminjaman->return_at == null)
                                                                        <span class="form-label m-0 col-md-8">-</span>
                                                                        @else
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->return_at}}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal user detail -->
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
                                                    <!-- Modal Detail Peminjaman Buku -->
                                                    <div class="modal fade" id="modal_buku{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Buku</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Kode Pemesana</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->kode_booking}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Judul</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->judul}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penulis</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penulis}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penerbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penerbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tahun Terbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->tahun_terbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Perpanjang Peminjaman</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->extended_count}} (Kali)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <!-- Modal Konfirmasi -->
                                                <form action="/admin/menu/buku/konfirmasi_peminjaman_buku" method="post">
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
                                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
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
                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/menu/peminjaman_buku/1/zero" tabindex="-1" aria-disabled="true">Back</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                @endif
                                <!-- Content 2 -->
                                <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Peminjaman Buku
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Tanggal Pengajuan</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->jumlah_konfirmasi == 0)
                                                <tr>
                                                    <td colspan="7">- Data Peminjaman Buku Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_konfirmasi as $peminjaman)
                                                <tr>
                                                    <td><a data-bs-toggle="modal" href="" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td><a data-bs-toggle="modal" data-bs-target="#modal_buku{{$loop->index}}" href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td>{{$peminjaman->created_at_peminjaman}}</td>
                                                    <td>
                                                        @if($peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin')
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @else
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a href="/admin/buku/peminjaman_buku_batal_admin/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal user detail -->
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
                                                    <!-- Modal Detail Peminjaman Buku -->
                                                    <div class="modal fade" id="modal_buku{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Buku</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Kode Pemesana</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->kode_booking}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Judul</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->judul}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penulis</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penulis}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penerbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penerbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tahun Terbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->tahun_terbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Perpanjang Peminjaman</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->extended_count}} (Kali)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <!-- Modal Konfirmasi -->
                                                <form action="/admin/menu/buku/konfirmasi_peminjaman_buku" method="post">
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
                                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
                                                                    <button class="btn btn-primary text-white">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                                @endif
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
                                    </div>
                                </div>
                                <!-- Content 3 -->
                                <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Peminjaman Buku
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Tanggal Peminjaman Dimulai Setelah Dikonfirmasi Admin">
                                                            <span class="bi bi-info-circle"></span>
                                                        </a> Tanggal Mulai
                                                    </th>
                                                    <th scope="col">Tanggal Berakhir</th>
                                                    <th scope="col">Denda</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->jumlah_berlangsung == 0)
                                                <tr>
                                                    <td colspan="7">- Data Peminjaman Buku Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_berlangsung as $peminjaman)
                                                <tr>
                                                    <td><a data-bs-toggle="modal" href="" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td><a data-bs-toggle="modal" data-bs-target="#modal_buku{{$loop->index}}" href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    @if($peminjaman->start_at == null)
                                                    <td>-</th>
                                                        @else
                                                    <td>{{$peminjaman->start_at}}</td>
                                                    @endif
                                                    @if($peminjaman->expired_at == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->expired_at}}</td>
                                                    @endif
                                                    @if($peminjaman->denda == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->denda}}</td>
                                                    @endif
                                                    <td>{{$peminjaman->status}}</td>
                                                    <td>
                                                        @if($peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin')
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @else
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a href="/admin/buku/peminjaman_buku_batal_admin/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal user detail -->
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
                                                    <!-- Modal Detail Peminjaman Buku -->
                                                    <div class="modal fade" id="modal_buku{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Buku</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Kode Pemesana</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->kode_booking}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Judul</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->judul}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penulis</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penulis}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penerbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penerbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tahun Terbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->tahun_terbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Perpanjang Peminjaman</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->extended_count}} (Kali)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <!-- Modal Konfirmasi -->
                                                <form action="/admin/menu/buku/konfirmasi_peminjaman_buku" method="post">
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
                                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
                                                                    <button class="btn btn-primary text-white">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                                @endif
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
                                    </div>
                                </div>
                                <!-- Content 4 -->
                                <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Peminjaman Buku
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Tanggal Batas Pengambilan</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->jumlah_pengambilan == 0)
                                                <tr>
                                                    <td colspan="7">- Data Peminjaman Buku Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_pengambilan as $peminjaman)
                                                <tr>
                                                    <td><a data-bs-toggle="modal" href="" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td><a data-bs-toggle="modal" data-bs-target="#modal_buku{{$loop->index}}" href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td>{{$peminjaman->batas_pengambilan}}</td>
                                                    <td>
                                                        @if($peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin')
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @else
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a href="/admin/buku/peminjaman_buku_batal_admin/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal user detail -->
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
                                                    <!-- Modal Detail Peminjaman Buku -->
                                                    <div class="modal fade" id="modal_buku{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Buku</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Kode Pemesana</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->kode_booking}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Judul</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->judul}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penulis</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penulis}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penerbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penerbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tahun Terbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->tahun_terbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Perpanjang Peminjaman</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->extended_count}} (Kali)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <!-- Modal Konfirmasi -->
                                                <form action="/admin/menu/buku/konfirmasi_peminjaman_buku" method="post">
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
                                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
                                                                    <button class="btn btn-primary text-white">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                                @endif
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
                                    </div>
                                </div>
                                <!-- Content 5 -->
                                <div class="tab-pane fade" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Peminjaman Buku
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Tanggal Mulai</th>
                                                    <th scope="col">Tanggal Berakhir</th>
                                                    <th scope="col">Tanggal Pengembalian</th>
                                                    <th scope="col">Denda</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->jumlah_selesai == 0)
                                                <tr>
                                                    <td colspan="7">- Data Peminjaman Buku Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_selesai as $peminjaman)
                                                <tr>
                                                    <td><a data-bs-toggle="modal" href="" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td><a data-bs-toggle="modal" data-bs-target="#modal_buku{{$loop->index}}" href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    @if($peminjaman->start_at == null)
                                                    <td>-</th>
                                                        @else
                                                    <td>{{$peminjaman->start_at}}</td>
                                                    @endif
                                                    @if($peminjaman->expired_at == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->expired_at}}</td>
                                                    @endif
                                                    @if($peminjaman->return_at == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->return_at}}</td>
                                                    @endif
                                                    @if($peminjaman->denda == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->denda}}</td>
                                                    @endif
                                                    <td>{{$peminjaman->status}}</td>
                                                    <td>
                                                        @if($peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin')
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @else
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a href="/admin/buku/peminjaman_buku_batal_admin/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal user detail -->
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
                                                    <!-- Modal Detail Peminjaman Buku -->
                                                    <div class="modal fade" id="modal_buku{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Buku</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Kode Pemesana</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->kode_booking}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Judul</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->judul}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penulis</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penulis}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penerbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penerbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tahun Terbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->tahun_terbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Perpanjang Peminjaman</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->extended_count}} (Kali)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <!-- Modal Konfirmasi -->
                                                <form action="/admin/menu/buku/konfirmasi_peminjaman_buku" method="post">
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
                                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
                                                                    <button class="btn btn-primary text-white">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                                @endif
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
                                    </div>
                                </div>
                                <!-- Content 6 -->
                                <div class="tab-pane fade" id="nav-6" role="tabpanel" aria-labelledby="nav-6-tab">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5">
                                                Peminjaman Buku
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Tanggal Peminjaman Dimulai Setelah Dikonfirmasi Admin">
                                                            <span class="bi bi-info-circle"></span>
                                                        </a> Tanggal Mulai
                                                    </th>
                                                    <th scope="col">Tanggal Berakhir</th>
                                                    <th scope="col">Denda</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->jumlah_dibatalkan == 0)
                                                <tr>
                                                    <td colspan="7">- Data Peminjaman Buku Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_dibatalkan as $peminjaman)
                                                <tr>
                                                    <td><a data-bs-toggle="modal" href="" data-bs-target="#modal_users{{$loop->index}}" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    <td><a data-bs-toggle="modal" data-bs-target="#modal_buku{{$loop->index}}" href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></td>
                                                    @if($peminjaman->start_at == null)
                                                    <td>-</th>
                                                        @else
                                                    <td>{{$peminjaman->start_at}}</td>
                                                    @endif
                                                    @if($peminjaman->expired_at == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->expired_at}}</td>
                                                    @endif
                                                    @if($peminjaman->denda == null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$peminjaman->denda}}</td>
                                                    @endif
                                                    <td>{{$peminjaman->status}}</td>
                                                    <td>
                                                        @if($peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin')
                                                        <a href="/admin/buku/hapus_peminjaman/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @else
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$loop->index}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        <a href="/admin/buku/peminjaman_buku_batal_admin/{{$peminjaman->id_peminjaman}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                        @endif
                                                    </td>
                                                    <!-- Modal user detail -->
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
                                                    <!-- Modal Detail Peminjaman Buku -->
                                                    <div class="modal fade" id="modal_buku{{$loop->index}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Informasi Detail Buku</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Kode Pemesana</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->kode_booking}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Judul</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->judul}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penulis</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penulis}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Penerbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->penerbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Tahun Terbit</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->tahun_terbit}}</span>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-3 d-flex align-items-center">
                                                                            <span class="form-label m-0">Perpanjang Peminjaman</span>
                                                                        </div>
                                                                        <span class="form-label m-0 col-md-1">:</span>
                                                                        <span class="form-label m-0 col-md-8">{{$peminjaman->extended_count}} (Kali)</span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                <!-- Modal Konfirmasi -->
                                                <form action="/admin/menu/buku/konfirmasi_peminjaman_buku" method="post">
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
                                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
                                                                    <button class="btn btn-primary text-white">Save</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endforeach
                                                @endif
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
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah Anda Yakin Menghapus Data Peminjaman?',
                text: 'Data Peminjaman Akan Dihapus Secara Permanent!',
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
                title: 'Apakah Anda Yakin Mengubah Status Peminjaman Buku Menjadi Selesai?',
                text: 'Pastikan Pengguna Telah Mengembalikan Buku Dan Membayar Denda Jika Ada',
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