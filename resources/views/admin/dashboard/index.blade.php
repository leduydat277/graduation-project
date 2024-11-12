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
                    <div class="col-xl-8">
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

                    <div class="col-xl-4">
                        <!-- card -->
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Phần trăm đặt phòng của các phòng</h4>
                                {{-- <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        Export Report
                                    </button>
                                </div> --}}
                            </div><!-- end card header -->

                            {{-- <!-- card body -->
                            <div class="card-body">

                                <div id="sales-by-locations" data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                    style="height: 269px" dir="ltr"></div>

                                <div class="px-2 py-2 mt-1">
                                    <p class="mb-1">Canada <span class="float-end">75%</span></p>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div id="canada-progress" class="progress-bar progress-bar-striped bg-primary"
                                            role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                            aria-valuemax="75"></div>
                                        {{-- <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                            style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75">
                                        </div> --}}
                                    </div>

                                    <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                                    </p>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div id="greenland-progress" class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                        style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="47"></div>
                                    </div>

                                    <p class="mt-3 mb-1">Russia <span class="float-end">82%</span></p>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div id="russia-progress" class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                        style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="82"></div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
@endsection
@section('js')
    <script type="module" src="{{ asset('assets/admin/assets/js/pages/dashboard.js') }}"></script>
@endsection
