@extends('layouts.admin')
@section('title')
    Chi tiết hóa đơn của khách hàng
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
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
@section('content')
    @php
        $totalAmount = 0;
    @endphp
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thông tin đặt phòng chi tiết</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Danh sách đặt phòng</a>
                        </li>
                        <li class="breadcrumb-item active">Thông tin đặt phòng chi tiết</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Mã đơn hàng</p>
                                    <h5 class="fs-14 mb-0">{{ $booking->id }}</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Ngày đặt phòng</p>
                                    <h5 class="fs-14 mb-0">
                                        <span
                                            id="invoice-date">{{ date('H:i d-m-Y', strtotime($booking->create_at)) }}</span>
                                    </h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Trạng thái của đơn hàng</p>
                                    <span class="badge fs-11" id="payment-status"
                                        style="background-color: {{ $booking->status->color }}; color: #fff;">
                                        {{ $booking->status->name }}
                                    </span>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Tổng số tiền</p>
                                    <h5 class="fs-14 mb-0">
                                        <span
                                            id="total-amount">{{ number_format($booking->total_price, 0, ',', '.') }}đ</span>
                                    </h5>
                                </div>
                                <div class="col-lg-3 col-6">
                                    @if ($booking->status->id == 3)
                                        <!-- Nút Check-in cho phòng trống -->
                                        <a href="#" class="btn btn-sm"
                                            style="background-color: green; color: #fff;">
                                            Check-in
                                        </a>
                                    @elseif ($booking->status->id == 5)
                                        <!-- Nút Check-out cho phòng đang sử dụng -->
                                        <a href="#" class="btn btn-sm"
                                            style="background-color: orange; color: #fff;">
                                            Check-out
                                        </a>
                                    @endif
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        @php
                            // Lấy ngày check-in và check-out từ booking
                            $checkInDate = strtotime($booking->check_in_date); // Chuyển đổi thành timestamp
                            $checkOutDate = strtotime($booking->check_out_date);
                            $numberOfNights = ($checkOutDate - $checkInDate) / (60 * 60 * 24); // Tính số ngày
                        @endphp
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Thông tin khách hàng</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{ $booking->user->name }}</p>
                                    <p class="text-muted mb-1" id="billing-address-line-1">{{ $booking->user->address }}
                                    </p>
                                    <p class="text-muted mb-1">{{ $booking->user->phone }}</p>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Thông tin đặt phòng</h6>
                                    <p class="fw-medium mb-2" id="shipping-name">Ngày đến:
                                        {{ date('d-m-Y', strtotime($booking->check_in_date)) }}</p>
                                    <p class="fw-medium mb-2" id="shipping-name">Ngày đi:
                                        {{ date('d-m-Y', strtotime($booking->check_out_date)) }}</p>
                                    <p class="fw-medium mb-2" id="shipping-name">Tình trạng cọc:
                                        @php
                                            $depositStatusMessage = '';
                                            switch ($booking->deposit_status) {
                                                case 'pending':
                                                    $depositStatusMessage = 'Đang chờ khách cọc';
                                                    break;
                                                case 'paid':
                                                    $depositStatusMessage = 'Đã cọc';
                                                    break;
                                                case 'refunded':
                                                    $depositStatusMessage = 'Đã hoàn trả lại cọc';
                                                    break;
                                                default:
                                                    $depositStatusMessage = 'Không xác định';
                                            }
                                        @endphp

                                    <p class="fw-medium mb-2" id="shipping-name">Tình trạng cọc:
                                        {{ $depositStatusMessage }}</p>
                                    </p>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">Số phòng</th>
                                            <th scope="col">Tên loại phòng</th>
                                            <th scope="col">Số đêm ở</th>
                                            <th scope="col">Số lượng người</th>
                                            <th scope="col">Giá tiền 1 đêm</th>
                                            <th scope="col" class="text-end">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($detail as $item)
                                            <tr>
                                                <th scope="row">{{ $item->room->number }}</th>
                                                <td class="text-start">
                                                    <span class="fw-medium">{{ $item->roomType->type }}</span>
                                                </td>
                                                <td>{{ $numberOfNights }}</td>
                                                <td>{{ $item->roomType->defaul_people }}</td>
                                                <td>{{ number_format($item->roomType->price_per_night, 0, ',', '.') }}đ
                                                </td>
                                                <td class="text-end">
                                                    @php
                                                        $roomTotal = $item->roomType->price_per_night * $numberOfNights;
                                                        $totalAmount += $roomTotal;
                                                    @endphp
                                                    {{ number_format($roomTotal, 0, ',', '.') }}đ
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                    style="width:250px">
                                    <tbody>
                                        <tr>
                                            <td>Tổng thành tiền</td>
                                            <td class="text-end">
                                                {{ number_format($totalAmount, 0, ',', '.') }}đ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>VAT</td>
                                            <td class="text-end">{{ number_format($booking->VAT, 0, ',', '.') }}đ</td>
                                        </tr>
                                        <tr>
                                            <td>Tổng tiền đã cọc</td>
                                            <td class="text-end">
                                                {{ number_format($booking->deposit_amount, 0, ',', '.') }}đ</td>
                                        </tr>
                                        <tr class="border-top border-top-dashed fs-15">
                                            <th scope="row">Tổng tiền</th>
                                            <th class="text-end">
                                                {{ number_format($totalAmount + $booking->VAT - $booking->deposit_amount, 0, ',', '.') }}đ
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i
                                        class="ri-printer-line align-bottom me-1"></i> Print</a>
                                <a href="javascript:void(0);" class="btn btn-primary"><i
                                        class="ri-download-2-line align-bottom me-1"></i> Download</a>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
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

    <!-- App js -->
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
