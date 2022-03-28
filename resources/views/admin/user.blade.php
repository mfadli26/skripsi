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
                                <div class="row">
                                    <div class="col-md-6">
                                        User List
                                    </div>
                                    <div class="col-md-6">
                                        <form action="/admin/menu/user/main" method="post">
                                            {{ csrf_field() }}
                                            <div class="input-group">
                                                <input type="text" class="form-control rounded-0" name="search" placeholder="Nama Lengkap, Email, ataupun Nama Lengkap" value="{{$data->search}}">
                                                <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
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
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Alamat Email</th>
                                            <th scope="col">Nomor Ktp</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->user as $user)
                                        <tr>
                                            <th scope="row">{{$loop->index + 1}}</th>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->ktp_number}}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#modal_{{$loop->index}}" href="#"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                <i class="fas fa-trash-alt text-danger fs-5"></i>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
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
                                                            <span class="form-label m-0 col-md-8">{{$user->name}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Email</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$user->email}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Nomor KTP</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$user->ktp_number}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Tempat, Tanggal Lahir</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$user->birth_city}}, {{\Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y')}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Alamat</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <span class="form-label m-0 col-md-8">{{$user->address}}</span>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                <span class="form-label m-0">Admin</span>
                                                            </div>
                                                            <span class="form-label m-0 col-md-1">:</span>
                                                            <div class="m-0 col-md-8">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{$user->admin ? 'checked' : ''}}>
                                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Admin</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <span>Total Data {{$data->jumlah}}</span>
                                <nav class="float-end">
                                    <ul class="pagination justify-content-end my-2">
                                        <li class="page-item {{($data->page == 1) ? 'disabled' : ''}}">
                                            @if($data->search == "")
                                            <a class="page-link" href="/admin/menu/all_user/{{$data->page-1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                            @else
                                            <a class="page-link" href="/admin/menu/user/{{$data->search}}/{{$data->page-1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                            @endif
                                        </li>
                                        <li class="page-item {{($data->page == 1) ? 'd-none' : ''}}">
                                            @if($data->search == "")
                                            <a class="page-link" href="/admin/menu/all_user/{{$data->page-1}}">{{$data->page-1}}</a>
                                            @else
                                            <a class="page-link" href="/admin/menu/user/{{$data->search}}/{{$data->page-1}}">{{$data->page-1}}</a>
                                            @endif
                                        </li>
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="#">{{$data->page}}</a>
                                        </li>
                                        <li class="page-item {{(floor($data->jumlah / 20 + 1) == $data->page) ? 'd-none' : ''}}">
                                            @if($data->search == "")
                                            <a class="page-link" href="/admin/menu/all_user/{{$data->page+1}}">{{$data->page+1}}</a>
                                            @else
                                            <a class="page-link" href="/admin/menu/user/{{$data->search}}/{{$data->page+1}}">{{$data->page+1}}</a>
                                            @endif
                                        </li>
                                        <li class="page-item {{(floor($data->jumlah / 20 + 1) == $data->page) ? 'disabled' : ''}}">
                                            @if($data->search == "")
                                            <a class="page-link" href="/admin/menu/all_user/{{$data->page+1}}" tabindex="-1" aria-disabled="true">Next</a>
                                            @else
                                            <a class="page-link" href="/admin/menu/user/{{$data->search}}/{{$data->page+1}}">Next</a>
                                            @endif
                                        </li>
                                    </ul>
                                </nav>
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