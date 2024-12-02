<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/admin/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/../assets/admin/assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/admin/" class="logo logo-light">
            <span class="logo-sm">
                <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="/../assets/admin/assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>

            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-house"></i> <!-- Biểu tượng cho trang chủ -->
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-user"></i> <!-- Biểu tượng cho danh sách người dùng -->
                        Tài khoản
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-calendar-check"></i> <!-- Biểu tượng cho trang chủ -->
                        Đơn đặt
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('payments.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-file-invoice-dollar"></i> <!-- Biểu tượng cho trang chủ -->
                        Hóa đơn
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('room-types.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-bed"></i> <!-- Icon for room type list -->
                        Loại phòng
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rooms.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-list"></i> <!-- Icon for room list -->
                        Danh sách phòng
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('asset-types.index')}}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-concierge-bell"></i> <!-- Icon for room type list -->
                        Danh sách tiện nghi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('room-assets.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-tools"></i> <!-- Icon for room type list -->
                        Quản lý tiện nghi phòng
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manage-status-rooms.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-door-closed"></i> <!-- Thay đổi icon cho quản lý trạng thái phòng -->
                        Quản lý trạng thái phòng
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('reviews.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-comments"></i> <!-- Icon for reviews and comments -->
                        Đánh giá và bình luận
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('checkin-checkout.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-sign-in-alt"></i>
                        Check-in & Check-out
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('phiphatsinhs.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Phí phát sinh
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('others.index') }}" class="nav-link" data-key="t-analytics">
                        <i class="fas fa-th-list"></i>
                        Others
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
