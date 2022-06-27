<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico" />
    <link rel="canonical" href="https://quilljs.com/standalone/full/">
    <link type="application/atom+xml" rel="alternate" href="https://quilljs.com/feed.xml" title="Quill - Your powerful rich text editor" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" />

    <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css" />



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
                            <h3 class="pt-5">Edit Artikel</h3>
                            <div class="row">
                                @foreach ($data->artikel AS $konten)
                                <form action="/admin/artikel/update" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$konten->id}}">
                                    <div class="mt-4 col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" name="judul" class="form-control" value="{{$konten->judul}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Penulis</label>
                                            <input type="text" name="penulis" class="form-control" value="{{$konten->penulis}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" value="{{$konten->tanggal}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar</label>
                                            <img src="{{url('/storage/gambar_artikel/'.$konten->gambar)}}" class="w-100">
                                            <input type="hidden" name="old_pict" value="{{$konten->gambar}}">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mt-4 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Konten</label>
                                            <textarea id="content-textarea" class="form-control" style="display : none" name="konten">{{$konten->content}}</textarea>
                                        </div>
                                        <div id="standalone-container">
                                            <div id="toolbar-container">
                                                <span class="ql-formats">
                                                    <select class="ql-font"></select>
                                                    <select class="ql-size"></select>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-strike"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <select class="ql-color"></select>
                                                    <select class="ql-background"></select>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-script" value="sub"></button>
                                                    <button class="ql-script" value="super"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-header" value="1"></button>
                                                    <button class="ql-header" value="2"></button>
                                                    <button class="ql-blockquote"></button>
                                                    <button class="ql-code-block"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-list" value="ordered"></button>
                                                    <button class="ql-list" value="bullet"></button>
                                                    <button class="ql-indent" value="-1"></button>
                                                    <button class="ql-indent" value="+1"></button>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-direction" value="rtl"></button>
                                                    <select class="ql-align"></select>
                                                </span>
                                                <span class="ql-formats">
                                                    <button class="ql-clean"></button>
                                                </span>
                                            </div>
                                            <div id="editor-container">{!! $konten->content !!}</div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary text-white float-end" type="submit">Submit</button>
                                </form>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/js/app.js"></script>
</body>

<script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>


<script>
    $(document).ready(function() {
        var quill = new Quill('#editor-container', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container'
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            $('#content-textarea').text($(".ql-editor").html());
        })
    });
</script>

</html>