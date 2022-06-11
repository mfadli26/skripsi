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
                <div class="col d-flex flex-column p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="container">
                            <div class="bg-white box-shadow px-5 py-5">
                                <div class="mb-3">
                                    <a href="/admin/menu/buku_all/1" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                                    <div class="text-center">
                                        <span class="display-6">Detail Buku</span>
                                    </div>

                                </div>
                                @foreach($data->buku as $buku)
                                <form action="/admin/buku/update_buku" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{url('/storage/cover_buku/'.$buku->cover)}}" class="w-100">
                                        </div>
                                        <div class="col-4 mt-5">

                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Judul :</label>
                                                <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="penerbit" class="form-label">Penerbit :</label>
                                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{$buku->penerbit}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="penulis" class="form-label">Penulis :</label>
                                                <input type="text" class="form-control" id="penulis" name="penulis" value="{{$buku->penulis}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun" class="form-label">Tahun Terbit :</label>
                                                <input type="number" class="form-control" id="tahun" name="tahun" value="{{$buku->tahun_terbit}}">
                                            </div>
                                        </div>
                                        <div class="col-4 mt-5">
                                            <div class="mb-3">
                                                <label for="stock_buku" class="form-label">Stock Buku :</label>
                                                <input type="number" class="form-control" id="stock_buku" name="stock_buku" value="{{$buku->stock_buku}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label">Kategori :</label>
                                                <select class="form-select" name="id_kategori">
                                                    <option value="{{$buku->id_kategori}}">{{$buku->kategory}}</option>
                                                    @foreach ($data->kategori as $kategori)
                                                    @if($kategori->kategory != $buku->kategory)
                                                    <option type="hidden" value="{{$kategori->id}}">{{$kategori->kategory}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <span>Tag : <button data-bs-target="#modal_tambah_tag_{{$loop->index}}" data-bs-toggle="modal" class="btn btn-success text-white rounded-circle"><i class="bi bi-plus-lg"></i></button></span>
                                            </div>
                                            <div class="mb-3 row">
                                                @if($data->tag_buku_jumlah == 0)
                                                <span class="text-center">- Buku Belum Memiliki Tag -</span>
                                                @else
                                                @foreach($data->tag_buku as $tag_buku)
                                                <div class="col-6 pb-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$tag_buku->tag}}" aria-label="Input group example" aria-describedby="btnGroupAddon" disabled>
                                                        <a href="/admin/buku/hapus_detail_buku_tag/{{$tag_buku->id_detail_tag}}" class="delete-confirm input-group-text text-decoration-none w-25 text-center bg-danger text-white" id="btnGroupAddon">X</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                            <input type="hidden" name="id_buku" value="{{$buku->id_buku}}">
                                        </div>
                                        <div class="mt-3">
                                            <div class="float-end">
                                                <a href="" class="delete-confirm btn btn-danger text-white">Hapus</a>
                                                <button type="submit" class="btn btn-primary text-white ms-3">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- Moddal Tambah Tag -->
                                <form action="/admin/buku/tambah_tagtobuku" method="get">
                                    {{ csrf_field() }}
                                    <div class="modal fade" id="modal_tambah_tag_{{$loop->index}}" tabindex="-1" aria-labelledby="label_{{$loop->index}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="label_{{$loop->index}}">Tambah Tag Baru</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <label for="tag" class="col-form-label">Kategori:</label>
                                                    <select class="form-select" name="id_tag">
                                                        @foreach ($data->tag as $tag)

                                                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="id_buku" value="{{$buku->id_buku}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal">Back</i></a>
                                                    <button type="submit" class="btn btn-primary text-white">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
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
            title: 'Apakah Anda Yakin Menghapus Data?',
            text: 'Data akan terhapus secara permanent!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    $('.update-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Apakah Anda Yakin Memperbarui Data?',
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