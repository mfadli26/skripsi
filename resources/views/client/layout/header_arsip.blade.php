@include('sweetalert::alert')
<div class="header bg-white">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between border-bottom roww">
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
                    <a class="nav-link dropdown-toggle text-dark btn-hover" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">E-Book</a></li>
                        <li><a class="dropdown-item" href="#">Layanan Umum Perpustakaan</a></li>
                        <li><a class="dropdown-item" href="#">Layanan Umum Kearsipan</a></li>
                        <li><a class="dropdown-item" href="/archive">Pencarian Arsip</a></li>
                        <li><a class="dropdown-item" href="/archive_pinjam">Peminjaman Arsip</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown text-center px-4 border-end">
                    <a class="nav-link dropdown-toggle text-dark btn-hover" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Info Terkini
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Berita</a></li>
                        <li><a class="dropdown-item" href="#">Galeri Foto</a></li>
                        <li><a class="dropdown-item" href="#">Galeri Video</a></li>
                        <li><a class="dropdown-item" href="#">Info Kegiatan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown text-center px-4 border-end ">
                    <a class="nav-link dropdown-toggle text-dark btn-hover" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Forum/Saran
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Tanya/Jawab</a></li>
                        <li><a class="dropdown-item" href="#">Kritik dan Saran</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown text-center px-4 border-end">
                    <a class="nav-link dropdown-toggle text-dark btn-hover" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Gambaran Umum</a></li>
                        <li><a class="dropdown-item" href="#">Sejarah</a></li>
                        <li><a class="dropdown-item" href="#">Susunan Organisasi</a></li>
                        <li><a class="dropdown-item" href="#">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="#">Tugas Dan Fungsi</a></li>
                        <li><a class="dropdown-item" href="#">Sarana Dan Prasarana</a></li>
                        <li><a class="dropdown-item" href="#">Dasar Hukum</a></li>
                    </ul>
                </li>
                @guest
                <li class="nav-item text-center px-4 border-end">
                    <a class="nav-link text-dark btn-hover" aria-current="page" href="/masuk">Masuk</a>
                </li>
                @endguest
                @auth
                <li class="nav-item dropdown text-center px-4 border-end">
                    <a class="nav-link dropdown-toggle text-dark btn-hover" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, {{$data->user->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/profile">Setting</a></li>
                        <li><a class="dropdown-item" href="/keluar">Logout</a></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
    </header>
</div>