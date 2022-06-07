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

                    </div>
                    @include('admin.layout.footer')
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/app.js"></script>
</body>

</html>