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
                                    <button class="nav-link {{$data->tab_menu == '1' ? 'active' : ''}}" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-kategori" aria-selected="false">Cari Berdasarkan Kode</button>
                                    <button class="nav-link {{$data->tab_menu == 'konfirmasi' ? 'active' : ''}}" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Menunggu Konfirmasi</button>
                                    <button class="nav-link {{$data->tab_menu == 'unggah' ? 'active' : ''}}" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Unggah File</button>
                                    <button class="nav-link {{$data->tab_menu == 'pengambilan' ? 'active' : ''}}" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Pengambilan Arsip</button>
                                    <button class="nav-link {{$data->tab_menu == 'selesai' ? 'active' : ''}}" id="nav-5-tab" data-bs-toggle="tab" data-bs-target="#nav-5" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Selesai</button>
                                    <button class="nav-link {{$data->tab_menu == 'batal' ? 'active' : ''}}" id="nav-6-tab" data-bs-toggle="tab" data-bs-target="#nav-6" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Dibatalkan</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <!-- Content 1-->
                                @if($data->event_cari == '1')
                                <div class="tab-pane fade {{$data->tab_menu == '1' ? 'active show' : ''}}" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                                    <div class="container-fluid mb-5">
                                        <div class="card w-50 m-auto">
                                            <div class="card-header text-center">
                                                <span class="fs-1">Pencarian</span>
                                            </div>
                                            <div class="card-body">
                                                <form action="/admin/menu/arsip/peminjaman/cari" method="post">
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
                                                Peminjaman Arsip
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Surat Pengantar</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data->event_cari as $peminjaman)
                                                <tr>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_users{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{$peminjaman->created_at}}</td>
                                                    @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                                    <td>Belum Unggah Surat Pengantar</td>
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
                                                    <td>Tanpa Surat Pengantar</td>
                                                    @endif
                                                    @if($peminjaman->biaya == NULL)
                                                    <td>-</td>
                                                    @else
                                                    <td>Rp.@convert($peminjaman->biaya),-</td>
                                                    @endif
                                                    <td>
                                                        <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                            @if($peminjaman->status == 'Pengambilan Arsip')
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Kode Pemesanan Untuk Melihat Detail Arsip Dan Mendownload File Arsip">
                                                                @endif
                                                                <i class="bi bi-info-circle"></i> {{$peminjaman->status}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($peminjaman->status == 'Pengambilan Arsip')
                                                        <a class="selesai-confirm" href="/admin/arsip/konfirmasi_selesai/{{$peminjaman->id_peminjaman}}/pencarian"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status == 'Menunggu Konfirmasi')
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$peminjaman->id_peminjaman}}" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status == 'Selesai' || $peminjaman->status == 'Dibatalkan Oleh Admin' || $peminjaman->status == 'Dibatalkan Oleh Pengguna' )
                                                        <form action="/admin/arsip/hapus_peminjaman" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{$peminjaman->id_peminjaman}}">
                                                            <input type="hidden" name="tab" value="1">
                                                            @if($peminjaman->file_izin == null)
                                                            <input type="hidden" name="file" value="0">
                                                            @else
                                                            <input type="hidden" name="file" value="{{$peminjaman->file_izin}}">
                                                            @endif
                                                            <button type="submit" class="delete-confirm btn btn-danger text-white py-auto">Hapus</button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!-- Modal Tab Konfirmasi -->
                                                <form action="/admin/menu/archive/konfirmasi_peminjaman_arsip" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_konfirm_{{$peminjaman->id_peminjaman}}" tabindex="-1" aria-labelledby="label_konfrim_{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center">Tentukan Aksi Yang Ingin Anda Pilih</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="form-check mt-1">
                                                                        <input name="konfirm" value="1" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" required>
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Konfirmasi Peminjaman
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input name="konfirm" value="2" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" required>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Tolak Peminjaman
                                                                        </label>
                                                                        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan Peminjaman Pada Kolom Komentar">
                                                                            <span class="bi bi-info-circle"></span>
                                                                        </a>
                                                                    </div>
                                                                    @if($peminjaman->status == 'Menunggu Konfirmasi' && $peminjaman->type == 1)
                                                                    <div class="form-check">
                                                                        <input name="konfirm" value="3" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Tolak File Izin Peminjaman
                                                                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan File Izin Pada Kolom Komentar">
                                                                                <span class="bi bi-info-circle"></span>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                    @else
                                                                    <div class="form-check">
                                                                        <input name="konfirm" value="3" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Tolak File Izin Peminjaman
                                                                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan File Izin Pada Kolom Komentar">
                                                                                <span class="bi bi-info-circle"></span>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                    @endif
                                                                    <div class="mb-3 mt-4">
                                                                        <label for="exampleFormControlTextarea1" class="form-label">
                                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Kolom Komentar Boleh Kosong">
                                                                                <span class="bi bi-info-circle"></span>
                                                                            </a> Tambah Komentar :</label>
                                                                        <textarea name="komentar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                    </div>
                                                                    <input type="hidden" name="id_admin" value="{{Auth::user()->id}}">
                                                                    <input type="hidden" name="id" value="{{$peminjaman->id_peminjaman}}">
                                                                    <input type="hidden" name="tab" value="pencarian">
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
                                                <li class="page-item">
                                                    <a class="page-link" href="/admin/menu/peminjaman_arsip/1/1/default" tabindex="-1" aria-disabled="true">Back</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                @endif
                                <!-- Content 2-->
                                <div class="tab-pane fade {{$data->tab_menu == 'konfirmasi' ? 'active show' : ''}}" id="nav-2" role="tabpanel" aria-labelledby="nav-1-tab">
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
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Surat Pengantar</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->count_check_konfirmasi == 0)
                                                <tr>
                                                    <td colspan="8">- Data Peminjaman Arsip Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_konfirmasi as $peminjaman)
                                                <tr>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_users{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{$peminjaman->created_at}}</td>
                                                    @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                                    <td>Belum Unggah Surat Pengantar</td>
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
                                                    <td>Tanpa Surat Pengantar</td>
                                                    @endif
                                                    @if($peminjaman->biaya == NULL)
                                                    <td>-</td>
                                                    @else
                                                    <td>Rp.@convert($peminjaman->biaya),-</td>
                                                    @endif
                                                    <td>
                                                        <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                            @if($peminjaman->status == 'Pengambilan Arsip')
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Kode Pemesanan Untuk Melihat Detail Arsip Dan Mendownload File Arsip">
                                                                @endif
                                                                <i class="bi bi-info-circle"></i> {{$peminjaman->status}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($peminjaman->status == 'Pengambilan Arsip')
                                                        <a class="selesai-confirm" href="/admin/konfirmasi_selesai/{{$peminjaman->id_peminjaman}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status != 'Dibatalkan Oleh Pengguna' && $peminjaman->status != 'Dibatalkan Oleh Admin' && $peminjaman->status != 'Selesai')
                                                        <a data-bs-toggle="modal" data-bs-target="#tab_konfirmasi_modal_konfirm_{{$peminjaman->id_peminjaman}}" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>

                                                        @endif
                                                        <a href="/admin/arsip/batal_arsip_by_id/{{$peminjaman->id_peminjaman}}/konfirmasi" class="batal-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Modal Tab Konfirmasi -->
                                                <form action="/admin/menu/archive/konfirmasi_peminjaman_arsip" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="tab_konfirmasi_modal_konfirm_{{$peminjaman->id_peminjaman}}" tabindex="-1" aria-labelledby="label_konfrim_{{$loop->index}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center">Tentukan Aksi Yang Ingin Anda Pilih</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="form-check mt-1">
                                                                        <input name="konfirm" value="1" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" required>
                                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                                            Konfirmasi Peminjaman
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input name="konfirm" value="2" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" required>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Tolak Peminjaman
                                                                        </label>
                                                                        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan Peminjaman Pada Kolom Komentar">
                                                                            <span class="bi bi-info-circle"></span>
                                                                        </a>
                                                                    </div>
                                                                    @if($peminjaman->status == 'Menunggu Konfirmasi' && $peminjaman->type == 1)
                                                                    <div class="form-check">
                                                                        <input name="konfirm" value="3" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Tolak File Izin Peminjaman
                                                                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan File Izin Pada Kolom Komentar">
                                                                                <span class="bi bi-info-circle"></span>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                    @else
                                                                    <div class="form-check">
                                                                        <input name="konfirm" value="3" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                            Tolak File Izin Peminjaman
                                                                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Silahkan Tambahkan Alasan Penolakan File Izin Pada Kolom Komentar">
                                                                                <span class="bi bi-info-circle"></span>
                                                                            </a>
                                                                        </label>
                                                                    </div>
                                                                    @endif
                                                                    <div class="mb-3 mt-4">
                                                                        <label for="exampleFormControlTextarea1" class="form-label">
                                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Kolom Komentar Boleh Kosong">
                                                                                <span class="bi bi-info-circle"></span>
                                                                            </a> Tambah Komentar :</label>
                                                                        <textarea name="komentar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                    </div>
                                                                    <input type="hidden" name="id_admin" value="{{Auth::user()->id}}">
                                                                    <input type="hidden" name="id" value="{{$peminjaman->id_peminjaman}}">
                                                                    <input type="hidden" name="tab" value="konfirmasi">
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
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            @if($data->count_check_konfirmasi != 0)
                                            <nav aria-label="...">
                                                <ul class="pagination">
                                                    @if(ceil($data->page_total_konfirmasi) == 1)
                                                    <li class="page-item disabled">Jumlah Data : {{$data->count_check_konfirmasi}}</li>
                                                    @else
                                                    <li class="page-item {{$data->page_konfirmasi == 1 ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/peminjaman_arsip/konfirmasi/{{$data->page_konfirmasi - 1}}/default" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    @for($j = 0; $j < ceil($data->page_total_konfirmasi); $j++)
                                                        <li class="page-item {{$data->page_konfirmasi == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/peminjaman_arsip/konfirmasi/{{$j+1}}/default">{{$j+1}}</a></li>
                                                        @endfor
                                                        <li class="page-item {{$data->page_konfirmasi == ceil($data->page_total_konfirmasi) ? 'disabled' : ''}}">
                                                            <a class="page-link" href="/admin/menu/peminjaman_arsip/konfirmasi/{{$data->page_konfirmasi + 1}}/default">Next</a>
                                                        </li>
                                                        @endif
                                                </ul>
                                            </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Content 3-->
                                <div class="tab-pane fade {{$data->tab_menu == 'unggah' ? 'active show' : ''}}" id="nav-3" role="tabpanel" aria-labelledby="nav-1-tab">
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
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Surat Pengantar</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->count_check_unggahfile == 0)
                                                <tr>
                                                    <td colspan="8">- Data Peminjaman Arsip Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_unggahfile as $peminjaman)
                                                <tr>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_users{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{$peminjaman->created_at}}</td>
                                                    @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                                    <td>Belum Unggah Surat Pengantar</td>
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
                                                    <td>Tanpa Surat Pengantar</td>
                                                    @endif
                                                    @if($peminjaman->biaya == NULL)
                                                    <td>-</td>
                                                    @else
                                                    <td>Rp.@convert($peminjaman->biaya),-</td>
                                                    @endif
                                                    <td>
                                                        <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                            @if($peminjaman->status == 'Pengambilan Arsip')
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Kode Pemesanan Untuk Melihat Detail Arsip Dan Mendownload File Arsip">
                                                                @endif
                                                                <i class="bi bi-info-circle"></i> {{$peminjaman->status}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="/admin/arsip/batal_arsip_by_id/{{$peminjaman->id_peminjaman}}/unggah" class="batal-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            @if($data->count_check_unggahfile != 0)
                                            <nav aria-label="...">
                                                <ul class="pagination">
                                                    @if(ceil($data->page_total_unggah) == 1)
                                                    <li class="page-item disabled">Jumlah Data : {{$data->count_check_unggahfile}}</li>
                                                    @else
                                                    <li class="page-item {{$data->page_unggah == 1 ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/peminjaman_arsip/unggah/{{$data->page_unggah - 1}}/default" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    @for($j = 0; $j < ceil($data->page_total_konfirmasi); $j++)
                                                        <li class="page-item {{$data->page_unggah == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/peminjaman_arsip/unggah/{{$j+1}}/default">{{$j+1}}</a></li>
                                                        @endfor
                                                        <li class="page-item {{$data->page_unggah == ceil($data->page_total_unggah) ? 'disabled' : ''}}">
                                                            <a class="page-link" href="/admin/menu/peminjaman_arsip/unggah/{{$data->page_unggah + 1}}/default">Next</a>
                                                        </li>
                                                        @endif
                                                </ul>
                                            </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Content 4-->
                                <div class="tab-pane fade {{$data->tab_menu == 'pengambilan' ? 'active show' : ''}}" id="nav-4" role="tabpanel" aria-labelledby="nav-1-tab">
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
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Surat Pengantar</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->count_check_pengambilan == 0)
                                                <tr>
                                                    <td colspan="8">- Data Peminjaman Arsip Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_pengambilan as $peminjaman)
                                                <tr>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_users{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{$peminjaman->created_at}}</td>
                                                    @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                                    <td>Belum Unggah Surat Pengantar</td>
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
                                                    <td>Tanpa Surat Pengantar</td>
                                                    @endif
                                                    @if($peminjaman->biaya == NULL)
                                                    <td>-</td>
                                                    @else
                                                    <td>Rp.@convert($peminjaman->biaya),-</td>
                                                    @endif
                                                    <td>
                                                        <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                            @if($peminjaman->status == 'Pengambilan Arsip')
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Kode Pemesanan Untuk Melihat Detail Arsip Dan Mendownload File Arsip">
                                                                @endif
                                                                <i class="bi bi-info-circle"></i> {{$peminjaman->status}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($peminjaman->status == 'Pengambilan Arsip')
                                                        <a class="selesai-confirm" href="/admin/arsip/konfirmasi_selesai/{{$peminjaman->id_peminjaman}}/pengambilan"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status != 'Dibatalkan Oleh Pengguna' && $peminjaman->status != 'Dibatalkan Oleh Admin' && $peminjaman->status != 'Selesai')
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$peminjaman->id_peminjaman}}" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>

                                                        @endif
                                                        <a href="/admin/arsip/batal_arsip_by_id/{{$peminjaman->id_peminjaman}}/pengambilan" class="batal-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            @if($data->count_check_pengambilan != 0)
                                            <nav aria-label="...">
                                                <ul class="pagination">
                                                    @if(ceil($data->page_total_pengambilan) == 1)
                                                    <li class="page-item disabled">Jumlah Data : {{$data->count_check_pengambilan}}</li>
                                                    @else
                                                    <li class="page-item {{$data->page_pengambilan == 1 ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/peminjaman_arsip/pengambilan/{{$data->page_pengambilan - 1}}/default" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    @for($j = 0; $j < ceil($data->page_total_pengambilan); $j++)
                                                        <li class="page-item {{$data->page_pengambilan == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/peminjaman_arsip/pengambilan/{{$j+1}}/default">{{$j+1}}</a></li>
                                                        @endfor
                                                        <li class="page-item {{$data->page_pengambilan == ceil($data->page_total_pengambilan) ? 'disabled' : ''}}">
                                                            <a class="page-link" href="/admin/menu/peminjaman_arsip/pengambilan/{{$data->page_pengambilan + 1}}/default">Next</a>
                                                        </li>
                                                        @endif
                                                </ul>
                                            </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Content 5-->
                                <div class="tab-pane fade {{$data->tab_menu == 'selesai' ? 'active show' : ''}}" id="nav-5" role="tabpanel" aria-labelledby="nav-1-tab">
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
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Surat Pengantar</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->count_check_selesai == 0)
                                                <tr>
                                                    <td colspan="8">- Data Peminjaman Arsip Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_selesai as $peminjaman)
                                                <tr>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_users{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{$peminjaman->created_at}}</td>
                                                    @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                                    <td>Belum Unggah Surat Pengantar</td>
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
                                                    <td>Tanpa Surat Pengantar</td>
                                                    @endif
                                                    @if($peminjaman->biaya == NULL)
                                                    <td>-</td>
                                                    @else
                                                    <td>Rp.@convert($peminjaman->biaya),-</td>
                                                    @endif
                                                    <td>
                                                        <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                            @if($peminjaman->status == 'Pengambilan Arsip')
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Kode Pemesanan Untuk Melihat Detail Arsip Dan Mendownload File Arsip">
                                                                @endif
                                                                <i class="bi bi-info-circle"></i> {{$peminjaman->status}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($peminjaman->status == 'Pengambilan Arsip')
                                                        <a class="selesai-confirm" href="/admin/konfirmasi_selesai/{{$peminjaman->id_peminjaman}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                        @elseif($peminjaman->status != 'Dibatalkan Oleh Pengguna' && $peminjaman->status != 'Dibatalkan Oleh Admin' && $peminjaman->status != 'Selesai')
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_konfirm_{{$peminjaman->id_peminjaman}}" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>

                                                        @endif
                                                        <form action="/admin/arsip/hapus_peminjaman" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{$peminjaman->id_peminjaman}}">
                                                            <input type="hidden" name="tab" value="selesai">
                                                            @if($peminjaman->file_izin == null)
                                                            <input type="hidden" name="file" value="0">
                                                            @else
                                                            <input type="hidden" name="file" value="{{$peminjaman->file_izin}}">
                                                            @endif
                                                            <button type="submit" class="delete-confirm btn btn-danger text-white py-auto">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            @if($data->count_check_selesai != 0)
                                            <nav aria-label="...">
                                                <ul class="pagination">
                                                    @if(ceil($data->page_total_selesai) == 1)
                                                    <li class="page-item disabled">Jumlah Data : {{$data->count_check_selesai}}</li>
                                                    @else
                                                    <li class="page-item {{$data->page_selesai == 1 ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/peminjaman_arsip/selesai/{{$data->page_selesai - 1}}/default" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    @for($j = 0; $j < ceil($data->page_total_selesai); $j++)
                                                        <li class="page-item {{$data->page_selesai == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/peminjaman_arsip/selesai/{{$j+1}}/default">{{$j+1}}</a></li>
                                                        @endfor
                                                        <li class="page-item {{$data->page_selesai == ceil($data->page_total_selesai) ? 'disabled' : ''}}">
                                                            <a class="page-link" href="/admin/menu/peminjaman_arsip/selesai/{{$data->page_selesai + 1}}/default">Next</a>
                                                        </li>
                                                        @endif
                                                </ul>
                                            </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Content 6-->
                                <div class="tab-pane fade {{$data->tab_menu == 'batal' ? 'active show' : ''}}" id="nav-6" role="tabpanel" aria-labelledby="nav-1-tab">
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
                                                    <th scope="col">Kode Pemesanan</th>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Surat Pengantar</th>
                                                    <th scope="col">Biaya</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($data->count_check_dibatalkan == 0)
                                                <tr>
                                                    <td colspan="8">- Data Peminjaman Arsip Masih Kosong -</td>
                                                </tr>
                                                @else
                                                @foreach($data->peminjaman_dibatalkan as $peminjaman)
                                                <tr>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_archive{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#modal_users{{$peminjaman->id_peminjaman}}" class="text-decoration-none" href="">
                                                            {{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{$peminjaman->created_at}}</td>
                                                    @if($peminjaman->type == 1 && $peminjaman->file_izin == NULL)
                                                    <td>Belum Unggah Surat Pengantar</td>
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
                                                    <td>Tanpa Surat Pengantar</td>
                                                    @endif
                                                    @if($peminjaman->biaya == NULL)
                                                    <td>-</td>
                                                    @else
                                                    <td>Rp.@convert($peminjaman->biaya),-</td>
                                                    @endif
                                                    <td>
                                                        <span class="badge {{$peminjaman->status == 'Dibatalkan Oleh Pengguna' || $peminjaman->status == 'Dibatalkan Oleh Admin' ? 'bg-danger' : 'bg-primary'}} fs-6">
                                                            @if($peminjaman->status == 'Pengambilan Arsip')
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Klik Kode Pemesanan Untuk Melihat Detail Arsip Dan Mendownload File Arsip">
                                                                @endif
                                                                <i class="bi bi-info-circle"></i> {{$peminjaman->status}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <form action="/admin/arsip/hapus_peminjaman" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{$peminjaman->id_peminjaman}}">
                                                            <input type="hidden" name="tab" value="batal">
                                                            @if($peminjaman->file_izin == null)
                                                            <input type="hidden" name="file" value="0">
                                                            @else
                                                            <input type="hidden" name="file" value="{{$peminjaman->file_izin}}">
                                                            @endif
                                                            <button type="submit" class="delete-confirm btn btn-danger text-white py-auto">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            @if($data->count_check_dibatalkan != 0)
                                            <nav aria-label="...">
                                                <ul class="pagination">
                                                    @if(ceil($data->page_total_batal) == 1)
                                                    <li class="page-item disabled">Jumlah Data : {{$data->count_check_dibatalkan}}</li>
                                                    @else
                                                    <li class="page-item {{$data->page_batal == 1 ? 'disabled' : ''}}">
                                                        <a class="page-link" href="/admin/menu/peminjaman_arsip/batal/{{$data->page_batal - 1}}/default" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    @for($j = 0; $j < ceil($data->page_total_batal); $j++)
                                                        <li class="page-item {{$data->page_batal == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/menu/peminjaman_arsip/batal/{{$j+1}}/default">{{$j+1}}</a></li>
                                                        @endfor
                                                        <li class="page-item {{$data->page_batal == ceil($data->page_total_batal) ? 'disabled' : ''}}">
                                                            <a class="page-link" href="/admin/menu/peminjaman_arsip/batal/{{$data->page_batal + 1}}/default">Next</a>
                                                        </li>
                                                        @endif
                                                </ul>
                                            </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($data->peminjaman as $peminjaman)
                            <!-- Modal Users Detail -->
                            <div class="modal fade" id="modal_users{{$peminjaman->id_peminjaman}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
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
                            <div class="modal fade" id="modal_archive{{$peminjaman->id_peminjaman}}" tabindex="-1" aria-labelledby="label_archive{{$loop->index}}" aria-hidden="true">
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
                            @endforeach
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
    <script>
        $('.selesai-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Konfirmasi Pengambilan',
                text: 'Pastikan Pengguna Telah Mendapatkan Dan Membayar Biaya Hardcopy Arsip!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        $('.batal-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Konfirmasi Pembatalan',
                text: 'Status Peminjaman Arsip Akan Dibatalkan Oleh Admin!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: 'Perhatian!',
                text: 'Data Peminjaman Akan Dihapus Secara Permanent Dari Database',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) form.submit();
            });
        });
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>