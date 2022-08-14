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
        @include('sweetalert::alert')
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
                                    <div class="col-md-10">
                                        List Artikel
                                    </div>
                                    <div class="col-md-2">
                                        <form action="" method="post">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <a href="/admin/artikel_page/tambah" class="btn btn-primary text-white rounded-0 ms-1">Tambaha Artikel</a>
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
                                        @if($data->jumlah == 0 )
                                        <tr class="text-center">
                                            <th colspan="5">- Data Artikel Masih Kosong -</th>
                                        </tr>
                                        @else
                                        @foreach($data->artikel as $artikel)
                                        <tr>
                                            <th scope="row">{{$loop->index + 1}}</th>
                                            <th>{{$artikel->judul}}</th>
                                            <th>{{$artikel->penulis}}</th>
                                            <th>{{$artikel->tanggal}}</th>
                                            <td>
                                                <a href="/admin/artikel/update_artikel/{{$artikel->id}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                <a href="/admin/artikel/hapus/{{$artikel->id}}" class="delete-confirm"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                @if($data->jumlah != 0)
                                <nav aria-label="...">
                                    <ul class="pagination">
                                        @if(ceil($data->jumlah_all) == 1)
                                        <li class="page-item disabled">Jumlah Data : {{$data->jumlah}}</li>
                                        @else
                                        <li class="page-item {{$data->page == 1 ? 'disabled' : ''}}">
                                            <a class="page-link" href="/admin/artikel/{{$data->page - 1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        @for($j = 0; $j < ceil($data->jumlah_all); $j++)
                                            <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/artikel/{{$j+1}}">{{$j+1}}</a></li>
                                            @endfor
                                            <li class="page-item {{$data->page == ceil($data->jumlah_all) ? 'disabled' : ''}}">
                                                <a class="page-link" href="/admin/artikel/{{$data->page + 1}}">Next</a>
                                            </li>
                                            @endif
                                    </ul>
                                </nav>
                                @endif
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
            title: 'Apakah Anda Yakin Menghapus Artikel?',
            icon: 'info',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>

</html>