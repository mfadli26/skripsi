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
                <div class="col d-flex flex-column p-0">
                    @include('admin.layout.navbar')
                    @include('admin.layout.breadcrumb')
                    <div class="wrapper p-4 h-100">
                        <div class="container bg-white mt-2 pb-5">
                            <h3 class="pt-5">Tambah Artikel Baru</h3>
                            <div class="row">
                                <div class="mt-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penulis</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="mt-4 col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Gambar</label>
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 1</label>
                                        <textarea name="p1" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 2</label>
                                        <textarea name="p2" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 3</label>
                                        <textarea name="p3" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 4</label>
                                        <textarea name="p4" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 5</label>
                                        <textarea name="p5" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 6</label>
                                        <textarea name="p6" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Paragraph 7</label>
                                        <textarea name="p7" type="text" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>