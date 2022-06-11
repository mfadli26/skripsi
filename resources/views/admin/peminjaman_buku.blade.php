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
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Denda</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data->jumlah == 0)
                                        <tr>
                                            <th colspan="7">- Data Peminjaman Buku Masih Kosong -</th>
                                        </tr>
                                        @else
                                        <tr>
                                            @foreach($data->peminjaman as $peminjaman)
                                            <th><a href="" class="text-decoration-none">{{$peminjaman->name}} <i class="bi bi-caret-down-fill"></i></a></th>
                                            <th><a href="" class="text-decoration-none">{{$peminjaman->kode_booking}} <i class="bi bi-caret-down-fill"></i></a></th>
                                            <th>{{$peminjaman->tanggal_mulai}}</th>
                                            @if($peminjaman->denda == null)
                                            <th>-</th>
                                            @else
                                            <th>{{$peminjaman->denda}}</th>
                                            @endif
                                            <th>{{$peminjaman->status}}</th>
                                            <th>
                                                <a class="selesai-confirm" href=""><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                <a href="" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                            </th>
                                            @endforeach
                                        </tr>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Apakah Anda Yakin Menghapus Data Peminjaman?',
                text: 'Data Peminjaman dan detailnya akan dihapus secara permanent!',
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