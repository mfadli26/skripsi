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
        @include('sweetalert::alert')
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                @include('admin.layout.sidebar')
                <div class="col d-flex flex-column h-sm-100 p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="card box-shadow">
                            <div class="tab-pane fade show active" id="nav-buku" role="tabpanel" aria-labelledby="nav-buku-tab">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h5>Daftar Buku</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <form action="/admin/menu/buku/cari" method="post">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <input type="text" class="form-control rounded-0" name="search" placeholder="Judul, Penerbit, Tahun Terbit, Penulis" value="{{$data->search}}">
                                                    <button class="btn btn-success text-white rounded-0" type="submit">Cari</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary text-white" data-bs-toggle="modal" href="#Modal2" role="button">Tambah Data Buku</a>
                                        </div>
                                    </div>
                                    <!-- Modal Tambah Buku -->
                                    <form action="/admin/buku/tambah_buku" method="post">
                                        {{ csrf_field() }}
                                        <div class="modal fade" id="Modal2" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="Modal2Label" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-scrollable ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Penambahan Data Buku</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-mb-6">
                                                                <label for="judul" class="col-form-label">Judul:</label>
                                                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                                                            </div>
                                                            <div class="form-group col-mb-6">
                                                                <label for="penerbit" class="col-form-label">Penerbit:</label>
                                                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="penulis" class="col-form-label">Penulis:</label>
                                                            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ old('penulis') }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tahun" class="col-form-label">Tahun:</label>
                                                            <input type="text" class="form-control" id="tahun" name="tahun" value="{{ old('tahun') }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kategori" class="col-form-label">Kategori:</label>
                                                            @if($data->kategori_count == 0)
                                                            <select class="form-select" name="id_kategori" disabled>
                                                                <option selected>- Data Kategori Buku Tidak Tersedia -</option>
                                                            </select>
                                                            @else
                                                            <select class="form-select" name="id_kategori">
                                                                @foreach ($data->kategori as $kategori)
                                                                <option value="{{$kategori->id}}">{{$kategori->kategory}}</option>
                                                                @endforeach
                                                            </select>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cover" class="col-form-label">Foto Cover Buku:</label>
                                                            <input type="file" class="form-control" id="cover" name="cover" value="{{ old('cover') }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary text-white" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                                                        <button type="submit" class="btn btn-primary text-white">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Judul</th>
                                                <th scope="col">Penulis</th>
                                                <th scope="col">Penerbit</th>
                                                <th scope="col">Tahun Terbit</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data->buku as $buku)
                                            <tr>
                                                <td>{{ $loop->index +1 }}</td>
                                                <td>{{ $buku->judul }}</td>
                                                <td>{{ $buku->penulis }}</td>
                                                <td>{{ $buku->penerbit }}</td>
                                                <td>{{ $buku->tahun_terbit }}</td>
                                                @if($buku->kategory == null)
                                                <td> - </td>
                                                @else
                                                <td>{{ $buku->kategory }}</td>
                                                @endif
                                                <td>
                                                    <a href="/admin/buku/detail/{{$buku->id}}"><i class="fas fa-edit text-success me-2 fs-5"></i></a>
                                                    <a class="delete-confirm" href="/admin/buku/hapus_buku/{{$buku->id}}/"><i class="fas fa-trash-alt text-danger me-2 fs-5"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit -->

                                            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_edit_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="label_{{$loop->index}}">Pembaruan Buku</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <nav class="mb-4">
                                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <button class="nav-link col-md-6 active" id="nav-kategori-tab" data-bs-toggle="tab" data-bs-target="#nav-kategori" type="button" role="tab" aria-controls="nav-kategori" aria-selected="false">Buku</button>
                                                                <button class="nav-link col-md-6" id="nav-tag-tab" data-bs-toggle="tab" data-bs-target="#nav-tag" type="button" role="tab" aria-controls="nav-tag" aria-selected="true">Tag Buku</button>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    @if($data->check_count != 0)
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            @if(ceil($data->jumlah_page) == 1)
                                            <li class="page-item disabled">Jumlah Data : {{$data->check_count}}</li>
                                            @elseif(ceil($data->jumlah_page) > 5)
                                            <li class="page-item {{$data->page == 1 ? 'disabled' : ''}}">
                                                <a class="page-link" href="{{$data->target}}{{$data->page - 1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            @if($data->page == 1)
                                            @for($j = 0; $j < 3; $j++) <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{$j+1}}">{{$j+1}}</a></li>
                                                @endfor
                                                <li class="page-item"><a class="page-link disabled">...</a></li>
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{ceil($data->jumlah_page)}}">{{ceil($data->jumlah_page)}}</a></li>
                                                @elseif($data->page == ceil($data->jumlah_page))
                                                <li class="page-item {{$data->page == 1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}1">1</a></li>
                                                <li class="page-item"><a class="page-link disabled">...</a></li>
                                                @for($j = 3; $j != 0; $j--)
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) - $j+1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{ceil($data->jumlah_page) - $j+1}}">{{ceil($data->jumlah_page) - $j+1}}</a></li>
                                                @endfor
                                                @else
                                                @if($data->page-1 == 1)
                                                <li class="page-item {{$data->page == 1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}1">1</a></li>
                                                @for($j = $data->page-1; $j != $data->page + 2; $j++)
                                                <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{$j+1}}">{{$j+1}}</a></li>
                                                @endfor
                                                <li class="page-item"><a class="page-link disabled">...</a></li>
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{ceil($data->jumlah_page)}}">{{ceil($data->jumlah_page)}}</a></li>
                                                @elseif($data->page+1 == ceil($data->jumlah_page))
                                                <li class="page-item {{$data->page == 1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}1">1</a></li>
                                                <li class="page-item"><a class="page-link disabled">...</a></li>
                                                @for($j = 4; $j != 0; $j--)
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) - $j+1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{ceil($data->jumlah_page) - $j+1}}">{{ceil($data->jumlah_page) - $j+1}}</a></li>
                                                @endfor
                                                @else
                                                <li class="page-item {{$data->page == 1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}1">1</a></li>
                                                <li class="page-item"><a class="page-link disabled">...</a></li>
                                                @for($j = $data->page-2; $j != $data->page + 1; $j++)
                                                <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{$j+1}}">{{$j+1}}</a></li>
                                                @endfor
                                                <li class="page-item"><a class="page-link disabled">...</a></li>
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{ceil($data->jumlah_page)}}">{{ceil($data->jumlah_page)}}</a></li>
                                                @endif
                                                @endif
                                                <li class="page-item {{$data->page == ceil($data->jumlah_page) ? 'disabled' : ''}}">
                                                    <a class="page-link" href="{{$data->target}}{{$data->page + 1}}">Next</a>
                                                </li>
                                                @else
                                                <li class="page-item {{$data->page == 1 ? 'disabled' : ''}}">
                                                    <a class="page-link" href="{{$data->target}}{{$data->page - 1}}" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>

                                                @for($j = 0; $j < ceil($data->jumlah_page); $j++)
                                                    <li class="page-item {{$data->page == $j+1 ? 'active' : ''}}"><a class="page-link" href="{{$data->target}}{{$j+1}}">{{$j+1}}</a></li>
                                                    @endfor
                                                    <li class="page-item {{$data->page == ceil($data->jumlah_page) ? 'disabled' : ''}}">
                                                        <a class="page-link" href="{{$data->target}}{{$data->page + 1}}">Next</a>
                                                    </li>
                                                    @endif
                                        </ul>
                                    </nav>
                                    @endif
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
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Menghapus Data Buku?',
            text: 'Data buku akan terhapus secara permanent!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>


</html>