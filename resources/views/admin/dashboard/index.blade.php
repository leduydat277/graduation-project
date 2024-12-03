@extends('admin.layouts.admin')

@section('title')
    Dashboard
@endsection

@section('css')
    <!-- App favicon và các css cần thiết -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>
    <style>
        .dataTables_paginate {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .dataTables_paginate .paginate_button {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            color: #333;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: white;
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
            font-weight: bold;
        }
    </style>
    <style>
        .table-container {
            overflow-x: auto;
            margin: 20px auto;
            max-width: 100%;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: left;
            table-layout: auto;
        }

        table th,
        table td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
            white-space: nowrap;
        }

        table thead th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
        }

        table tbody tr {
            line-height: 1.6;
        }

        .table-container::-webkit-scrollbar {
            height: 8px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background-color: #999;
        }
    </style>
    <style>
        .table {
            max-width: 100%;
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Doanh thu trong tuần
                                        </p>
                                    </div>
                                    @if ($earningsComparison === 'Tăng' && $earningsPercentage > 0)
                                        <div class="flex-shrink-0">
                                            <h5 class="text-success fs-14 mb-0">
                                                <i
                                                    class="ri-arrow-right-up-line fs-13 align-middle"></i>+{{ $earningsPercentage }}%
                                            </h5>
                                        </div>
                                    @elseif ($earningsComparison === 'Giảm' && $earningsPercentage > 0)
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i
                                                class="ri-arrow-right-down-line fs-13 align-middle"></i>-{{ $earningsPercentage }}%
                                        </h5>
                                    @endif
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ number_format($weeklyEarnings, 0, ',', '.') }}">{{ number_format($weeklyEarnings, 0, ',', '.') }}
                                                đ</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Lượt đặt hàng thành công của
                                            tuần</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        @if ($ordersComparison === 'Tăng' && $ordersPercentage > 0)
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i
                                                        class="ri-arrow-right-up-line fs-13 align-middle"></i>+{{ $ordersPercentage }}%
                                                </h5>
                                            </div>
                                        @elseif ($ordersComparison === 'Giảm' && $ordersPercentage > 0)
                                            <h5 class="text-danger fs-14 mb-0">
                                                <i
                                                    class="ri-arrow-right-down-line fs-13 align-middle"></i>-{{ $ordersPercentage }}%
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="36894">{{ $weeklyOrders }}</span></h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Số lượng hủy đơn trong tuần</p>
                                    </div>
                                    @if ($canceledComparison === 'Tăng' && $canceledPercentage > 0)
                                        <div class="flex-shrink-0">
                                            <h5 class="text-danger fs-14 mb-0">
                                                <i
                                                    class="ri-arrow-right-up-line fs-13 align-middle"></i>+{{ $canceledPercentage }}%
                                            </h5>
                                        </div>
                                    @elseif ($canceledComparison === 'Giảm' && $canceledPercentage > 0)
                                        <h5 class="text-success fs-14 mb-0">
                                            <i
                                                class="ri-arrow-right-down-line fs-13 align-middle"></i>-{{ $canceledPercentage }}%
                                        </h5>
                                    @endif
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="36894">{{ $weeklyCanceled }}</span></h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bxs-x-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted mb-0">Người dùng mới</p>
                                    </div>
                                    @if ($uComparison === 'Tăng' && $uPercentage > 0)
                                        <div class="flex-shrink-0">
                                            <h5 class="text-success fs-14 mb-0">
                                                <i
                                                    class="ri-arrow-right-up-line fs-13 align-middle"></i>+{{ $uPercentage }}%
                                            </h5>
                                        </div>
                                    @elseif ($uComparison === 'Giảm' && $uPercentage > 0)
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i
                                                class="ri-arrow-right-down-line fs-13 align-middle"></i>-{{ $uPercentage }}%
                                        </h5>
                                    @endif
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="183.35">{{ $newUsersThisWeek }}</span> </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Thống kê theo tháng</h4>
                                <button type="button" id="changeChartBtn" class="btn btn-soft-secondary btn-sm">
                                    Thống kê số lượng đặt và hủy theo tháng
                                </button>
                            </div>
                            <canvas id="revenueChart" width="400" height="300"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Các đơn đặt hôm nay</h4>
                            </div>
                            <div class="table">
                                <table id="bookingsTodayTable"
                                    class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tên phòng</th>
                                            <th>Ngày đến</th>
                                            <th>Ngày đi</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Phòng được đặt nhiều nhất</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table id="countRoomOrders"
                            class="table table-hover table-centered align-middle table-nowrap mb-0">

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Các tiện nghi đang hỏng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table id="assetsDie"
                            class="table table-hover table-centered align-middle table-nowrap mb-0">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Chi tiết đơn đặt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="module" src="{{ asset('assets/admin/assets/js/pages/dashboard.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#ordersToday tbody').on('click', 'tr', function() {
                var orderId = $(this).data('id');
                console.log(orderId);
                var url = '/admin/bookings/' + orderId;
                window.location.href = url;
            });
        });
    </script>
@endsection
