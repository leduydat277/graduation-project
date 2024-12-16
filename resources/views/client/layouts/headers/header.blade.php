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
                            <li class="nav-item px-3">
                                <a class="nav-link p-0" href="{{ route('client.contact') }}">Liên hệ</a>
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
                @if (Auth::user())
                    <div class="search d-lg-block d-none">
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <button style="border: none" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path fill-rule="evenodd"
                                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li class="dropdown-item">
                                            <a href="{{ route('account') }}"
                                                class="d-flex align-items-center text-decoration-none text-dark">
                                                <span class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" fill="currentColor"
                                                        class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                                    </svg>
                                                </span>
                                                <span>Quản lý tài khoản</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('paymentHistory') }}"
                                                class="d-flex align-items-center text-decoration-none text-dark">
                                                <span class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-clipboard-data"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                                                        <path
                                                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                                        <path
                                                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                                    </svg>
                                                </span>
                                                <span>Lịch sử thanh toán</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="#"
                                                class="d-flex align-items-center text-decoration-none text-dark">
                                                <span class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" fill="currentColor"
                                                        class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                        <path fill-rule="evenodd"
                                                            d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                                    </svg>
                                                </span>
                                                <span>Đăng xuất</span>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
