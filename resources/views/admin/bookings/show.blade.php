@extends('admin.layouts.admin')
@section('title')
    Chi tiết hóa đơn khách hàng
@endsection
@section('css')
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Title Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 text-primary">Chi tiết đặt phòng</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}"
                                    class="text-decoration-none">Danh sách đặt phòng</a></li>
                            <li class="breadcrumb-item active text-muted">Chi tiết đặt phòng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary ">
                        <h5 class="mb-0 text-white">Thông tin đặt phòng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Booking Info -->
                            <div class="col-md-6">
                                <h6 class="text-muted">Thông tin đơn hàng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Mã Đơn:</strong> <span class="text-primary">{{ $booking->id }}</span></p>
                                    <p><strong>Mã Check-in:</strong> {{ $booking->code_check_in }}</p>
                                    <p><strong>Loại phòng:</strong> {{ $booking->room->roomType->type ?? 'Không rõ' }}</p>
                                    <p><strong>Tên Phòng:</strong> {{ $booking->room->title }}</p>
                                    <p><strong>Tổng tiền:</strong>
                                        <span
                                            class="badge bg-success fs-6">{{ number_format($booking->total_price, 0, ',', '.') }}đ</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="col-md-6">
                                <h6 class="text-muted">Thông tin khách hàng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Tên khách hàng:</strong> {{ $booking->first_name }}
                                        {{ $booking->last_name }}</p>
                                    <p><strong>Email:</strong> {{ $booking->email }}</p>
                                    <p><strong>Số điện thoại:</strong> {{ $booking->phone }}</p>
                                    <p><strong>Địa chỉ:</strong> {{ $booking->address }}</p>
                                    <p><strong>CCCD:</strong> {{ $booking->CCCD_booking ?? 'Không rõ' }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                            $checkInDate = date('d-m-Y H:i', $booking->check_in_date);
                            $checkOutDate = date('d-m-Y H:i', $booking->check_out_date);
                            $numberOfNights = ($booking->check_out_date - $booking->check_in_date) / (60 * 60 * 24);
                        @endphp

                        <!-- Booking Summary -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Chi tiết đặt phòng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Ngày Check-in:</strong> {{ $checkInDate }}</p>
                                    <p><strong>Ngày Check-out:</strong> {{ $checkOutDate }}</p>
                                    <p><strong>Số đêm ở:</strong> {{ $numberOfNights }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Trạng thái đơn hàng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Tiền cọc:</strong>
                                        <span
                                            class="badge bg-warning fs-6">{{ number_format($booking->tien_coc, 0, ',', '.') }}đ</span>
                                    </p>
                                    <p><strong>Trạng thái:</strong>
                                        @switch($booking->status)
                                            @case(0)
                                                <span class="badge bg-info">chưa thanh toán</span>
                                            @break
                                            @case(1)
                                                <span class="badge bg-info">Đang thanh toán</span>
                                            @break

                                            @case(2)
                                                <span class="badge bg-warning">Đã thanh toán tiền cọc</span>
                                            @break

                                            @case(3)
                                                <span class="badge bg-success">Đã thanh toán tổng tiền đơn</span>
                                            @break

                                            @case(4)
                                                <span class="badge bg-danger">Đang sử dụng</span>
                                            @break

                                            @case(5)
                                                <span class="badge bg-danger">Đã hủy</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">Không rõ</span>
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary me-2">
                                <i class="ri-arrow-go-back-line align-bottom"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
