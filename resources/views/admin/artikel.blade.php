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
                @include('admin.layout.sidebar')
                <div class="col d-flex flex-column h-sm-100 p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="card box-shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        User List
                                    </div>
                                    <div class="col-md-6">
                                        <form action="" method="post">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control rounded-0" name="search" placeholder="Judul,Penulis,Tanggal Terbit" value="">
                                                <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
                                                <a href="/admin/artikel/tambah" class="btn btn-primary text-white rounded-0 ms-1">Tambah Artikel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">judul</th>
                                            <th scope="col">Penulis</th>
                                            <th scope="col">Tanggal Terbit</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->artikel as $artikel)
                                        <tr>
                                            <th scope="row">{{$loop->index + 1}}</th>
                                            <th>{{$artikel->judul}}</th>
                                            <th>{{$artikel->penulis}}</th>
                                            <th>{{$artikel->tanggal}}</th>
                                            <td>
                                                <a href="/admin/artikel/update_artikel/{{$artikel->id}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                <a href=""><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @include('admin.layout.footer')
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>