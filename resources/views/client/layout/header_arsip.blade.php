@include('sweetalert::alert')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<style>
    .btn-hover:hover {
        color: rgb(40, 142, 146) !important;
    }

    .btn-hover {
        transition: color 0.2s linear;
    }

    .link-active {
        color: rgb(103, 195, 199) !important;
        border-bottom: 3px solid rgb(103, 195, 199) !important;
    }
</style>

<div class="header bg-white">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between border-bottom row">
        <nav class="navbar navbar-expand-lg" style="background-color: white">
            <div class="col-md-2 offset-md-1">
                <a href="/home" class="nav-link text-secondary">
                    <img class="mw-100" src="{{url('/img/logo.jpg')}}" alt="Image" />
                </a>
            </div>
            <div class="col-md-8">
                <ul class="nav col-lg-auto my-2 justify-content-end my-md-0 text-small h-100 align-items-center">
                    <li class="text-center px-4 border-end">
                        <a href="/home" class="nav-link text-dark fs-6 btn-hover">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown text-center px-4 border-end">
                        <a class="nav-link dropdown-toggle text-dark btn-hover {{$data->menu == 'layanan' ? 'link-active' : ''}}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Layanan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item {{$data->submenu == 'pencarian buku' ? 'link-active' : ''}}" href="/layanan/pencarian buku">E-Book</a></li>
                            <li><a class="dropdown-item {{$data->submenu == 'pencarian arsip' ? 'link-active' : ''}}" href="/layanan/pencarian arsip">E-Archive</a></li>
                            <li><a class="dropdown-item" href="#">Layanan Umum Perpustakaan</a></li>
                            <li><a class="dropdown-item" href="#">Layanan Umum Kearsipan</a></li>
                            <li><a class="dropdown-item {{$data->submenu == 'peminjaman buku' ? 'link-active' : ''}}" href="/buku_pinjam">Peminjaman E-Book</a></li>
                            <li><a class="dropdown-item {{$data->submenu == 'peminjaman arsip' ? 'link-active' : ''}}" href="/archive_pinjam">Peminjaman E-Archive</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown text-center px-4 border-end">
                        <a class="nav-link dropdown-toggle text-dark btn-hover {{$data->menu == 'infoterkini' ? 'link-active' : ''}}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Info Terkini
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item {{$data->submenu == 'berita' ? 'link-active' : ''}}" href="/berita">Berita</a></li>
                            <li><a class="dropdown-item" href="#">Galeri Foto</a></li>
                            <li><a class="dropdown-item" href="#">Galeri Video</a></li>
                            <li><a class="dropdown-item" href="#">Info Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown text-center px-4 border-end">
                        <a class="nav-link dropdown-toggle text-dark btn-hover {{$data->menu == 'profile' ? 'link-active' :''}}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Gambaran Umum</a></li>
                            <li><a class="dropdown-item" href="#">Sejarah</a></li>
                            <li><a class="dropdown-item" href="#">Susunan Organisasi</a></li>
                            <li><a class="dropdown-item {{$data->submenu == 'visimisi' ? 'link-active' :''}}" href="/visimisi">Visi dan Misi</a></li>
                            <li><a class="dropdown-item" href="#">Tugas Dan Fungsi</a></li>
                            <li><a class="dropdown-item" href="#">Sarana Dan Prasarana</a></li>
                            <li><a class="dropdown-item" href="#">Dasar Hukum</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown text-center px-4 border-end ">
                        <a class="nav-link text-dark fs-6 btn-hover {{$data->submenu == 'contact_us' ? 'link-active' : ''}}" href="/contact_us">
                            Contact Us
                        </a>
                    </li>
                    @guest
                    <li class="nav-item text-center px-4 border-end">
                        <a class="nav-link text-dark btn-hover {{$data->submenu == 'masuk' ? 'link-active' : ''}}" aria-current="page" href="/masuk">Masuk</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown text-center px-4 border-end">
                        <a class="nav-link dropdown-toggle text-dark btn-hover {{$data->menu == 'user' ? 'link-active' : ''}}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hi, {{$data->user->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item {{$data->submenu == 'settings' ? 'link-active' : ''}}" href="/profile">Setting</a></li>
                            <li><a class="dropdown-item" href="/keluar">Logout</a></li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
</div>