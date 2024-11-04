@extends('layouts.admin')
@section('title')
    Danh sách đặt phòng
@endsection
@section('css')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách đặt phòng</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Danh sách đặt phòng</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Danh sách đặt phòng</h5>
                    </div>
                </div>
                <div class="card-body bg-light-subtle border border-dashed border-start-0 border-end-0">
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-12">
                            <div class="search-box">
                                <input type="text" id="customSearch" class="form-control search bg-light border-light"
                                    placeholder="Tìm kiếm tên khách hàng, trạng thái cọc, trạng thái của đơn hàng...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card">
                            <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filterSection">
                                Bộ lọc nâng cao
                            </button>

                            <div class="collapse" id="filterSection">
                                <div class="row g-3">
                                    <div class="create_at">
                                        <label for="create_at" class="form-label">Ngày tạo:</label>
                                        <input type="text" class="form-control" id="create_at"
                                            placeholder="Chọn ngày tạo">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label">Ngày đến:</label>
                                        <input type="text" class="form-control" id="start_date"
                                            placeholder="Chọn ngày đến">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label">Ngày đi:</label>
                                        <input type="text" class="form-control" id="end_date"
                                            placeholder="Chọn ngày đi">
                                    </div>
                                    <div class="product_status"></div>
                                    <div class="booking_status"></div>
                                    <div class="status_book"></div>
                                    <div class="col-12">
                                        <button id="resetFilters" class="btn btn-secondary">Tạo lại</button>
                                    </div>
                                </div>
                            </div>

                            <table class="table align-middle table-nowrap" id="bookingTable">
                                <thead class="text-muted">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort text-uppercase" data-sort="id">Mã đơn</th>
                                        <th class="sort text-uppercase" data-sort="name">Khách hàng</th>
                                        <th class="sort text-uppercase" data-sort="total_price">Tổng giá</th>
                                        <th class="sort text-uppercase" data-sort="check_in_date">Ngày đến</th>
                                        <th class="sort text-uppercase" data-sort="check_out_date">Ngày đi</th>
                                        <th class="sort text-uppercase" data-sort="type">Nơi đặt</th>
                                        <th class="sort text-uppercase" data-sort="deposit_status">Trạng thái cọc</th>
                                        <th class="sort text-uppercase" data-sort="status">Trạng thái của đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="invoice-list-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="module" src="{{ asset('assets/admin/assets/js/pages/booking-list.js') }}"></script>
@endsection
