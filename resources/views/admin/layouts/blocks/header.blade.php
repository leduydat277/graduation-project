<div class="layout-width">
    <div class="navbar-header d-flex justify-content-end">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box horizontal-logo">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/../assets/admin/assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/../assets/admin/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/../assets/admin/assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
            </div>
            <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-bell fs-22'></i>
                    <span
                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><span
                            class="visually-hidden"></span></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">

                    <div class="dropdown-head bg-primary bg-pattern rounded-top">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold text-white">Thông báo</h6>
                                </div>
                                <div class="col-auto dropdown-tabs">
                                    <span class="badge bg-light-subtle text-body fs-13"> 0 thông báo mới</span>
                                </div>
                            </div>
                            <div id="deleteNotificationButtonContainer" style="display: none;" class="text-end mt-2">
                                <button id="deleteNotificationButton" class="btn btn-danger">Xóa thông báo</button>
                                <button id="readNotificationButton" class="btn btn-primary">Đọc các thông báo được
                                    chọn</button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content position-relative" id="notificationItemsTabContent">
                        {{-- <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                            <div data-simplebar style="max-height: 300px;" class="pe-2">
                                <div class="text-reset notification-item d-block dropdown-item position-relative">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                <i class="bx bx-badge-check"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                    Optimization <span class="text-secondary">reward</span> is
                                                    ready!
                                                </h6>
                                            </a>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-15">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="all-notification-check01">
                                                <label class="form-check-label" for="all-notification-check01"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div id="notification-container"></div>
            <div class="dropdown ms-sm-3 header-item topbar-user">
                <button type="button" class="btn d-flex align-items-center" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- Avatar -->
                    <img class="rounded-circle header-profile-user"
                        src="{{ Auth::user()->image ?? asset('assets/images/users/default-avatar.jpg') }}"
                        alt="User Avatar" style="width: 36px; height: 36px; object-fit: cover;">
                    <!-- User Info -->
                    <span class="text-start ms-2">
                        <span class="d-block fw-medium user-name-text"
                            style="color: #212529;">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <span class="d-block fs-12 user-name-sub-text text-muted">
                            {{ Auth::user()->role === 1 ? 'Admin' : 'User' }}
                        </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                        <span class="align-middle" data-key="t-logout">Đăng xuất</span>
                    </a>
                </div>
            </div>
            <style>
                .header-profile-user {
                    width: 36px;
                    height: 36px;
                    object-fit: cover;
                    /* Đảm bảo hình ảnh không bị méo */
                }

                .user-name-text {
                    font-weight: 600;
                    color: #212529;
                    /* Màu chữ đậm */
                }

                .user-name-sub-text {
                    font-size: 12px;
                    color: #6c757d;
                    /* Màu chữ nhạt hơn */
                }

                .header-item .dropdown-menu {
                    min-width: 150px;
                    /* Đảm bảo menu không bị hẹp */
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                }

                .btn:focus {
                    outline: none;
                    /* Bỏ border outline khi chọn button */
                    box-shadow: none;
                    /* Bỏ shadow của button */
                }
            </style>

        </div>
    </div>
</div>
