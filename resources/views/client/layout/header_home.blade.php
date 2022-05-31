<div class="header">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between border-bottom row">
        <div class="col-md-3">
            <a href="#" class="nav-link text-secondary">
                <img class="mw-100" src="{{url('/img/logo.jpg')}}" alt="Image" />
            </a>
        </div>
        <div class="col-md-9">
            <ul class="nav col-lg-auto my-2 justify-content-end my-md-0 text-small h-100 align-items-center">
                <li class="text-center px-6 border-end">
                    <a href="#" class="nav-link text-dark fs-4 btn-hover link-active">
                        Beranda
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
        </div>
    </header>
</div>