<div class="header">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between border-bottom row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="col-md-2">
                    <a href="#" class="nav-link text-secondary">
                        <img class="mw-100" src="{{url('/img/logo.jpg')}}" alt="Image" />
                    </a>
                </div>
                <div class="collapse justify-content-end navbar-collapse col-md-9 " id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item text-center px-6 border-end">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item dropdown text-center px-6 border-end">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Layanan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">E-Book</a></li> 
                                <li><a class="dropdown-item" href="#">Layanan Umum Perpustakaan</a></li>
                                <li><a class="dropdown-item" href="#">Layanan Umum Kearsipan</a></li>
                                <li><a class="dropdown-item" href="#">Pencarian Arsip</a></li>
                                <li><a class="dropdown-item" href="#">Peminjaman Arsip</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown text-center px-6 border-end">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Info Terkini
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Berita</a></li>
                                <li><a class="dropdown-item" href="#">Galeri Foto</a></li>
                                <li><a class="dropdown-item" href="#">Galeri Video</a></li>
                                <li><a class="dropdown-item" href="#">Info Kegiatan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown text-center px-6 border-end">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Forum/Saran
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Tanya/Jawab</a></li>
                                <li><a class="dropdown-item" href="#">Kritik dan Saran</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown text-center px-6 border-end">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    </ul>
                </div>
            </div>
        </nav>
        <!-- <div class="col-md-3">
            <a href="#" class="nav-link text-secondary">
                <img class="mw-100" src="{{url('/img/logo.jpg')}}" alt="Image" />
            </a>
        </div>
        <div class="col-md-9">
            <ul class="nav justify-content-end my-md-0 text-small align-items-center">
                <li class="text-center px-6 border-end">
                    <a href="#" class="nav-link text-dark fs-4 btn-hover link-active">
                        Beranda
                    </a>
                </li>
                <li class="text-center px-6 border-end">
                    <a href="#" class="nav-link text-dark fs-4 btn-hover">
                        Profile
                    </a>
                </li>
                <li class="text-center px-6 border-end">
                    <a href="#" class="nav-link text-dark fs-4 btn-hover">
                        Layanan
                    </a>
                </li>
                <li class="text-center px-6 border-end">
                    <a href="#" class="nav-link text-dark fs-4 btn-hover">
                        Info Terkini
                    </a>
                </li>
                <li class="text-center px-6 border-end">
                    <a href="#" class="nav-link text-dark fs-4 btn-hover">
                        Forum Dan Saran
                    </a>
                </li>
                @auth
                <li class="text-center px-6 border-end">
                    <div class="dropdown">
                        <a class="nav-link text-dark fs-4 btn-hover dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Kearsipan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/archive">Pencarian Arsip</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/archive_pinjam">Peminjaman Arsip</a></li>
                        </ul>
                    </div>
                </li>
                @endauth
                @guest
                <li class="text-center px-6 border-end">
                    <a href="/archive" class="nav-link text-dark fs-4 btn-hover">
                        Kearsipan
                    </a>
                </li>
                @endguest
                @auth
                <li class="text-center px-6 border-end">
                    <a href="/profile" class="nav-link text-dark fs-4 btn-hover">
                        Profil
                    </a>
                </li>
                <li class="text-center px-6 border-end">
                    <a href="/keluar" class="nav-link text-dark fs-4 btn-hover">
                        Keluar
                    </a>
                </li>
                @endauth
                @guest
                <li class="text-center px-6 border-end">
                    <a href="/daftar" class="nav-link text-dark fs-4 btn-hover">
                        Daftar
                    </a>
                </li>
                <li class="text-center px-6">
                    <a href="/masuk" class="nav-link text-dark fs-4 btn-hover">
                        Masuk
                    </a>
                </li>
                @endguest
            </ul>
        </div> -->
    </header>
</div>