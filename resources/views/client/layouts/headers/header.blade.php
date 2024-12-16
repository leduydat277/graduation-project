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
                                <a class="nav-link {{ request()->routeIs('client.home') ? 'active' : '' }} p-0"
                                    aria-current="page" href="{{ route('client.home') }}">Trang chủ</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link {{ request()->routeIs('client.about') ? 'active' : '' }} p-0"
                                    href="{{ route('client.about') }}">Về chúng tôi</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link {{ request()->routeIs('client.services') ? 'active' : '' }} p-0"
                                    href="{{ route('client.services') }}">Tiện nghi</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link {{ request()->routeIs('client.blog') ? 'active' : '' }} p-0"
                                    href="{{ route('client.blog') }}">Liên Hệ</a>
                            </li>
                            <li class="nav-item px-3">
                                <a class="nav-link {{ request()->routeIs('client.policy') ? 'active' : '' }} p-0"
                                    href="{{ route('client.policy') }}">Điều khoản</a>
                            </li>
                            <li class="nav-item px-3 dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->is('client/room*') ? 'active' : '' }} p-0"
                                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Phòng</a>
                                <ul class="dropdown-menu dropdown-menu-end animate slide mt-3 border-0 shadow">
                                    <li><a href="{{ route('client.room') }}"
                                            class="dropdown-item {{ request()->routeIs('client.room') ? 'active' : '' }}">Các loại phòng</a></li>
                                    <li><a href="{{ route('client.blog-detail') }}"
                                            class="dropdown-item {{ request()->routeIs('client.blog-detail') ? 'active' : '' }}">Chi tiết bài viết</a></li>
                                    <li><a href="{{ route('client.booking') }}"
                                            class="dropdown-item {{ request()->routeIs('client.booking') ? 'active' : '' }}">Đặt phòng</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="search d-lg-block d-none">
                    <style>
                        .btn {
                            padding: 8px 16px;
                            border-radius: 5px;
                            font-weight: 500;
                        }

                        .register-btn {
                            background: linear-gradient(to right, #FFE5CC, #FFE5CC);
                            color: #fff;
                            border: none;
                        }

                        .register-btn:hover {
                            background: linear-gradient(to right, #FFE5CC, #FFE5CC);
                            color: #fff;
                        }

                        .login-btn {
                            border: 2px solid #FFE5CC;
                            color: #7a2929;
                            background: transparent;
                        }

                        .login-btn:hover {
                            background: #FFE5CC;
                            color: #fff;
                        }

                        .search {
                            margin-top: 10px;
                        }
                    </style>
                    <div class="d-flex justify-content-end align-items-center">
                        @if (Auth::check())
                        <!-- Khi người dùng đã đăng nhập -->
                        <div class="dropdown">
                            <button class="btn d-flex align-items-center" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Hình ảnh tài khoản -->
                                <img src="{{ Auth::user()->image ? Storage::url(Auth::user()->image) : asset('images/default-avatar.png') }}"
                                    alt="avatar" class="rounded-circle me-2"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                                <!-- Tên tài khoản -->
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('client.logout') }}">Đăng
                                        xuất</a>
                                </li>
                            </ul>
                        </div>
                        @else
                        <!-- Khi người dùng chưa đăng nhập -->
                        <a href="{{ route('client.login') }}" class="btn btn-outline-primary me-2 login-btn">Đăng
                            nhập</a>
                        <a href="{{ route('client.register') }}" class="btn btn-primary register-btn">Đăng ký</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </nav>
</header>