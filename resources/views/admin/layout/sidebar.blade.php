<style>
    .btn-hover-1 {
        color: #fff;
        background-color: #0495c9;
        border-color: #357ebd;
        /*set the color you want here*/
    }

    .btn-hover-1:hover,
    .btn-hover-1:focus,
    .btn-hover-1:active,
    .open>.dropdown-toggle.btn-hover-1 {
        color: #fff;
        background-color: #3490DC;
        border-color: #285e8e;
        /*set the color you want here*/
    }
</style>
@include('sweetalert::alert')
<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none text-center mx-auto pb-md-0">
            <span class="fs-4">D<span class="d-none d-sm-inline">ispusip Admin</span></span>
        </a>
        <hr class="custom-w-100">
        <ul class="nav navbar nav-pills flex-sm-column flex-row flex-nowrap w-100 flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
            <li class="nav-item custom-w-100 border-bottom">
                <a href="/admin/menu" class="btn-hover-1 nav-link px-2 text-white {{$data->sidebar == 'home' ? 'active' : ''}}">
                    <i class="bi bi-house-fill"></i>
                    <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            <li class="nav-item custom-w-100 border-bottom">
                <a href="/admin/menu/all_user/1/" class="btn-hover-1 nav-link px-2 text-white {{$data->sidebar == 'user' ? 'active' : ''}}">
                    <i class="bi bi-people-fill"></i>
                    <span class="ms-1 d-none d-sm-inline">User</span>
                </a>
            </li>
            <!-- <li class="nav-item custom-w-100 border-bottom">
                <a href="/admin/menu/archive_all/1/" class="btn-hover-1 nav-link px-2 text-white {{$data->sidebar == 'archive' ? 'active' : ''}}">
                    <i class="fas fa-book me-2"></i>
                    <span class="ms-1 d-none d-sm-inline">Archive</span>
                </a>
            </li> -->
            <li class="nav-item custom-w-100 border-bottom">
                <a href="#sub-pelayanan" data-bs-toggle="collapse" class="btn-hover-1 nav-link px-2 text-white {{$data->sidebar == 'pelayanan' ? 'active' : ''}}">
                    <i class="bi bi-flag-fill"></i>
                    <span class="ms-1 d-none d-sm-inline">Pelayanan</span>
                </a>
                <ul class="collapse nav flex-column {{$data->sidebar == 'pelayanan' ? 'show' : ''}}" id="sub-pelayanan">
                    <li class="w-100">
                        <a href="/admin/menu/archive_all/1/" class="btn-hover-1 nav-link text-white px-0 {{$data->breadcrumbsub == 'Data Arsip' ? 'active' : ''}}"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Data Arsip</a>
                    </li>
                    <li>
                        <a href="/admin/menu/buku_all/1" class="btn-hover-1 nav-link text-white px-0 {{$data->breadcrumbsub == 'Data Buku' ? 'active' : ''}}"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Data E-Book</a>
                    </li>
                    <li>
                        <a href="/admin/menu/kategori_tag_all/1/2" class="btn-hover-1 nav-link text-white px-0 {{$data->breadcrumbsub == 'Kategori & Tag E-Book' ? 'active' : ''}}"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Kategori & Tag E-Book</a>
                    </li>
                    <li>
                        <a href="/admin/menu/peminjaman_arsip/1/1/default" class="btn-hover-1 nav-link text-white px-0 {{$data->breadcrumbsub == 'Peminjaman Arsip' ? 'active' : ''}}"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Peminjaman Arsip</a>
                    </li>
                    <li>
                        <a href="/admin/menu/peminjaman_buku/1/default" class="btn-hover-1 nav-link text-white px-0 {{$data->breadcrumbsub == 'Peminjaman Buku' ? 'active' : ''}}"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Peminjaman E-Book</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item custom-w-100 border-bottom">
                <a href="#sub-infoterkini" data-bs-toggle="collapse" class="btn-hover-1 nav-link px-2 text-white {{$data->sidebar == 'infoterkini' ? 'active' : ''}}">
                    <i class="bi bi-newspaper"></i>
                    <span class="ms-1 d-none d-sm-inline">Info Terkini</span>
                </a>
                <ul class="collapse nav flex-column ms-1 {{$data->sidebar == 'infoterkini' ? 'show' : ''}}" id="sub-infoterkini">
                    <li class="w-100">
                        <a href="/admin/artikel" class="btn-hover-1 nav-link text-white px-0 {{$data->breadcrumbsub == 'Berita' ? 'active' : ''}}"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Berita</a>
                    </li>
                    <li>
                        <a href="#" class="btn-hover-1 nav-link text-white px-0"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Info Kegiatan</a>
                    </li>
                    <li>
                        <a href="#" class="btn-hover-1 nav-link text-white px-0"> <span class="d-none d-sm-inline"><i class="bi bi-caret-right-fill"></i> Foto dan Video</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item custom-w-100 border-bottom">
                <a href="/admin/contact_us" class="btn-hover-1 nav-link px-2 text-white {{$data->sidebar == 'contact_us' ? 'active' : ''}}">
                    <i class="bi bi-chat-right-dots-fill"></i>
                    <span class="ms-1 d-none d-sm-inline">Contact Us</span>
                </a>
            </li>
        </ul>
        <hr class="custom-w-100">
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>