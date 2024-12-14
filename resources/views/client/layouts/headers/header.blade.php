<header id="header">
    <nav id="primary-header" class="navbar navbar-expand-lg py-4">
        <div class="container-fluid padding-side">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand" href="{{ route('client.home') }}">
                    <p class="logo img-fluid">SleepHotel</p>
                </a>
                <button class="navbar-toggler border-0 d-flex d-lg-none order-3 p-2 shadow-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar"
                    aria-expanded="false">
                    <svg class="navbar-icon" width="60" height="60">
                        <use xlink:href="#navbar-icon"></use>
                    </svg>
                </button>
                <div class="header-bottom offcanvas offcanvas-end " id="bdNavbar"
                    aria-labelledby="bdNavbarOffcanvasLabel">
                    <div class="offcanvas-header px-4 pb-0">
                        <button type="button" class="btn-close btn-close-black mt-2" data-bs-dismiss="offcanvas"
                            aria-label="Close" data-bs-target="#bdNavbar"></button>
                    </div>
                    <div class="offcanvas-body align-items-center justify-content-center">
                        <ul class="navbar-nav align-items-center mb-2 mb-lg-0">
                            <li class="nav-item px-3">
                                <a class="nav-link active p-0" aria-current="page"
                                    href="{{ route('client.home') }}">Trang chủ</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link p-0" href="{{ route('client.about') }}">Về chúng tôi</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link p-0" href="{{ route('client.services') }}">Tiện nghi</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link p-0" href="{{ route('client.blog') }}">Bài viết</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link p-0" href="{{ route('client.policy') }}">Điều khoản</a>
                            </li>
                            <li class="nav-item px-3 dropdown">
                                <a class="nav-link p-0 dropdown-toggle text-center " data-bs-toggle="dropdown"
                                    href="#" role="button" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu dropdown-menu-end animate slide mt-3 border-0 shadow">
                                    <li><a href="{{ route('client.room') }}" class="dropdown-item ">Phòng</a></li>
                                    <li><a href="{{ route('client.blog-detail') }}" class="dropdown-item ">Chi tiết bài
                                            viế</a></li>
                                    <li><a href="{{ route('client.booking') }}" class="dropdown-item ">Đặt phòng</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="search d-lg-block d-none">
                    <form class=" position-relative">
                        <input type="text" class="form-control bg-secondary border-0 rounded-5 px-4 py-2"
                            placeholder="Search...">
                        <a href="#" class="position-absolute top-50 end-0 translate-middle-y p-1 me-3">
                            <svg class="" width="20" height="20">
                                <use xlink:href="#search"></use>
                            </svg>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
