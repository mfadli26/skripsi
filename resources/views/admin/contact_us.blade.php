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
                        <div class="row d-flex justify-content-center">
                            @foreach($data->contact_data as $data)
                            <div class="card border-dark mb-3 me-3 col-md-4" style="padding : 0px !important; width : 30%;">
                                <div class="card-header bg-secondary text-white">{{$data->email}}</div>
                                <div class="card-body text-dark">
                                    <P class="card-text fs-5">{{$data->nama_depan}} {{$data->nama_belakang}}</P>
                                    <p class="card-text">{{$data->msg}}</p>
                                </div>
                                <div class="card-footer">
                                    No Hp: {{$data->phone}} <span class="float-end">Tanggal</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination d-flex justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                    @include('admin.layout.footer')
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>