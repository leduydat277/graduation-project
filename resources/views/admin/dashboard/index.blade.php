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
                <div class="container">
                    <!-- Filter form -->
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <label for="startDate" class="form-label">Từ ngày:</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="endDate" class="form-label">Đến ngày:</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button id="filterBtn" class="btn btn-primary w-100">Lọc</button>
                            <button id="resetBtn" class="btn btn-secondary w-100 mt-2">Reset</button>
                        </div>
                    </div>

                    <div class="row" id="statistics">
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <p class="text-uppercase fw-medium text-muted mb-0">Doanh thu</p>
                                    <div class="mt-4">
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span id="allTotalEarnings">0</span> đ
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lượt đặt hàng thành công -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <p class="text-uppercase fw-medium text-muted mb-0">Lượt đặt hàng thành công</p>
                                    <div class="mt-4">
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span style="color: green" id="totalSuccessfulOrders">0</span> đơn
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Số lượng hủy đơn -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <p class="text-uppercase fw-medium text-muted mb-0">Số lượng hủy đơn</p>
                                    <div class="mt-4">
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span style="color: red" id="totalCanceledOrders">0</span> đơn
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Thống kê theo tháng của năm {{ $yearNow }}</h4>
                                <button type="button" id="changeChartBtn" class="btn btn-soft-secondary btn-sm">
                                    Thống kê số lượng đặt và hủy theo tháng
                                </button>
                            </div>
                            <canvas id="revenueChart" width="400" height="300"></canvas>
                            <div>
                                <h4>Tổng số liệu cả năm {{ $yearNow }}</h4>
                                <p>Doanh thu: <span id="totalEarnings">0 VNĐ</span></p>
                                <p>Số lượng đặt thành công: <span id="totalOrders">0 lượt</span></p>
                                <p>Số lượng đặt hủy: <span id="totalCanceled">0 lượt</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Tỷ lệ Đặt phòng thành công và Hủy</h4>
                            </div>
                            <canvas id="bookingStatusChart" width="400" height="300"></canvas>
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
                    <h4 class="card-title mb-0 flex-grow-1">Top 5 phòng được đặt nhiều nhất</h4>
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
