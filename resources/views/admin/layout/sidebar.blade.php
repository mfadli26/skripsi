<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none text-center mx-auto pb-md-0">
            <span class="fs-4">D<span class="d-none d-sm-inline">ispusip Admin</span></span>
        </a>
        <hr class="custom-w-100">
        <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap w-100 flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
            <li class="nav-item active custom-w-100">
                <a href="/admin/menu" class="nav-link px-2 text-white {{$data->sidebar == 'home' ? 'active' : ''}}">
                    <i class="fas fa-home me-2"></i>
                    <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            <li class="nav-item custom-w-100">
                <a href="/admin/menu/all_user/1/" class="nav-link px-2 text-white {{$data->sidebar == 'user' ? 'active' : ''}}">
                    <i class="fas fa-user me-2"></i>
                    <span class="ms-1 d-none d-sm-inline">User</span>
                </a>
            </li>
            <li class="nav-item custom-w-100">
                <a href="/admin/menu/archive_all/1/" class="nav-link px-2 text-white {{$data->sidebar == 'archive' ? 'active' : ''}}">
                    <i class="fas fa-book me-2"></i>
                    <span class="ms-1 d-none d-sm-inline">Archive</span>
                </a>
            </li>
            <li class="nav-item custom-w-100">
                <a href="/admin/menu/category" class="nav-link px-2 text-white {{$data->sidebar == 'category' ? 'active' : ''}}">
                    <i class="fas fa-archive me-2"></i>
                    <span class="ms-1 d-none d-sm-inline">Category</span>
                </a>
            </li>
        </ul>
        <hr class="custom-w-100">
    </div>
</div>