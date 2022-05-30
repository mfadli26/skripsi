<div class="header bg-white">
    <header class="d-flex flex-wrap border-bottom row">
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
                @auth
                <li class="text-center px-4 border-end">
                    <div class="dropdown">
                        <a class="nav-link text-dark fs-6 btn-hover dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
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
                <li class="text-center px-4 border-end">
                    <a href="/archive" class="nav-link text-dark fs-6 btn-hover">
                        Kearsipan
                    </a>
                </li>
                @endguest
                @auth
                <li class="text-center px-4 border-end">
                    <a href="/profile" class="nav-link text-dark fs-6 btn-hover {{$data->menu == 'profile' ? 'link-active' : ''}}">
                        Profil
                    </a>
                </li>
                <li class="text-center px-4">
                    <a href="/keluar" class="nav-link text-dark fs-6 btn-hover">
                        Logout
                    </a>
                </li>
                @endauth
                @guest
                <li class="text-center px-4 border-end">
                    <a href="/daftar" class="nav-link text-dark fs-6 btn-hover {{$data->menu == 'register' ? 'link-active' : ''}}">
                        Daftar
                    </a>
                </li>
                <li class="text-center px-4">
                    <a href="/masuk" class="nav-link text-dark fs-6 btn-hover {{$data->menu == 'login' ? 'link-active' : ''}}">
                        Masuk
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </header>
</div>