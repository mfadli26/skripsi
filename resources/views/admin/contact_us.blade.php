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
                            @foreach($data->contact_data as $contact)
                            <div class="card border-dark mb-3 me-3 col-md-4" style="padding : 0px !important; width : 30%;">
                                <div class="card-header bg-secondary text-white">{{$contact->email}}</div>
                                <div class="card-body text-dark">
                                    <P class="card-text fs-5">{{$contact->nama_depan}} {{$contact->nama_belakang}}</P>
                                    <p class="card-text">{{$contact->msg}}</p>
                                </div>
                                <div class="card-footer">
                                    No Hp: {{$contact->phone}} <span class="float-end">{{\Carbon\Carbon::parse($contact->created_at)->translatedFormat('d F Y')}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($data->total != 0)
                        <nav aria-label="...">
                            <ul class="pagination d-flex justify-content-center">
                                @if(ceil($data->total_page) == 1)
                                @else
                                <li class="page-item {{$data->page == 1 ? 'disabled' : ''}}">
                                    <a class="page-link" href="/admin/contact_us/{{$data->page - 1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                @for($j = 0; $j < ceil($data->total_page); $j++)
                                    <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="/admin/contact_us/{{$j+1}}">{{$j+1}}</a></li>
                                    @endfor
                                    <li class="page-item {{$data->page == ceil($data->total_page) ? 'disabled' : ''}}">
                                        <a class="page-link" href="/admin/contact_us/{{$data->page + 1}}">Next</a>
                                    </li>
                                    @endif
                            </ul>
                        </nav>
                        @endif
                    </div>
                    @include('admin.layout.footer')
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>