<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pusat Peminjaman Arsip</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/css/app.css" rel="stylesheet">
    <!-- Styles -->

    <style>
        .btn-hover:hover {
            color: red !important;
        }

        .btn-hover {
            transition: color 0.2s linear;
        }

        .link-active {
            color: red !important;
        }
        .artikel-t:hover {
            background-color: rgba(108, 117, 125, 0.2) !important;
            box-shadow: 1px 1px rgb(108, 117, 125) !important;
        }
    </style>

</head>

<body class="antialiased d-flex flex-column h-100">
    <main class="flex-shrink-0">
        @include('sweetalert::alert')
        @include('client.layout.header_arsip')
        @include('client.layout.breadcrumb_arsip')
        <div class="container-fluid">
            <div class="wrapper py-3 pt-5" style="padding-bottom: 100px !important;">
                <div class="container">
                    <div class="row">
                        <div class="col-7 me-5">
                            <h4><strong>VISI</strong></h4>
                            <p class="fs-5">Visi Rencana Pembangunan Jangka Menengah Kabupaten Sarolangun Periode 2011 – 2016, adalah suatu kondisi yang akan dicapai Kabupaten Sarolangun lima tahun ke depan. Memperhatikan potensi, kondisi, permasalahan, tantangan dan peluang serta mempertimbangkan berbagai isu yang ada, maka visi Kabupaten Sarolangun yang akan diwujudkan pada tahapan kedua RPJP Daerah Kabupaten Sarolangun (Tahun 2011 – 2016) adalah :</p>
                            <h4 class="my-5"><strong><em>"SAROLANGUN LEBIH MAJU DAN SEJAHTERA"</em></strong></h4>
                            <h4><strong>LEBIH MAJU</strong></h4>
                            <p class="fs-5">Meningkatnya kemajuan pembangunan daerah dibidang sosial, ekonomi, politik dan hukum menuju kemandirian daerah.</p>
                            <h4 class="mt-5"><strong>LEBIH SEJAHTERA</strong></h4>
                            <p class="fs-5">Terciptanya kondisi yang lebih kondusif bagi tumbuh kembangnya partisipasi ekonomi, sosial, budaya masyarakat dalam mendukung pembangunan berkelanjutan</p>
                            <h4 class="mt-5 mb-3"><strong>MISI</strong></h4>
                            <P class="fs-5">Agar Visi RPJMD Kabupaten Sarolangun Tahun 2011 – 2016 tersebut dapat diwujudkan, maka ditetapkan 5 (lima) misi sebagai berikut:</P>
                            <P class="fs-5">1. Meningkatkan Infrastruktur Pelayanan Umum</P>
                            <P class="fs-5">2. Meningkatkan Perekonomian Masyarakat Dan Daerah</P>
                            <P class="fs-5">3. Meningkatkan Kualitas Sumber Daya Manusia</P>
                            <P class="fs-5">4. Meningkatkan Tata Kelola Pemerintahan Yang Baik</P>
                            <P class="fs-5">5. Meningkatkan Tata Kehidupan Masyarakat Yang Agamis, Berbudaya dan Harmonis</P>
                        </div>
                        <div class="col-4 ms-5 ps-5" style="border-left : solid 1px black;">
                            <h4><strong>ARTIKEL TERBARU</strong></h4>
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    @foreach ($data->artikel_terbaru AS $terbaru)
                                    <a href="/berita/detail/{{$terbaru->id}}" class="text-decoration-none list-group-item artikel-t">
                                        <div class="row">
                                            <div class="col-5">
                                                <img src="{{url('/storage/gambar_artikel/'.$terbaru->gambar)}}" class="w-100">
                                            </div>
                                            <div class="col-7">
                                                {{$terbaru->judul}}
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('client.layout.footer_arsip')
    <script src="/js/app.js"></script>
</body>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip1"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

</html>