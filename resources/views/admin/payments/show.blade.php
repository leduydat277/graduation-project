@extends('admin.layouts.admin')

@section('title')
    Chi tiết Thanh Toán #{{ $payment->id }}
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
@endsection

@section('content')
    <div class="card shadow-lg">
        <div class="card-header bg-primary d-flex justify-content-center align-items-center">
            <h4 class="card-title mb-0 text-white">Chi Tiết Hóa Đơn</h4>
        </div>
        <div class="card-body bg-light">

            <!-- Thông tin chi tiết -->
            <div class="d-flex flex-column align-items-center py-4 px-4 bg-white rounded shadow-sm">
                <!-- Thông tin thanh toán -->
                <div class="info-box mb-3 p-3 border rounded w-100">
                    <h6 class="text-primary">Thông Tin Thanh Toán</h6>
                    <p><strong>Ngày Thanh Toán:</strong>
                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</p>
                    <p><strong>Tổng Số Tiền:</strong> <span
                            class="text-danger fw-bold">{{ number_format($payment->total_price) }} VNĐ</span></p>
                    <p><strong>Phương Thức Thanh Toán:</strong> <span
                            class="fw-bold">{{ $payment->payment_method == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</span></p>
                    <p><strong>Trạng Thái Thanh Toán:</strong>
                        <span
                            class="badge @if ($payment->payment_status == 3 || $payment->payment_status == 2) bg-success
                            @else
                            bg-warning @endif">
                            @if ($payment->payment_status == 3)
                                Đã thanh toán tổng tiền
                            @endif
                            @if ($payment->payment_status == 2)
                                Đã thanh toán cọc
                            @endif
                        </span>
                    </p>
                </div>

                <!-- Thông tin đặt phòng -->
                <div class="info-box mb-3 p-3 border rounded w-100">
                    <h6 class="text-primary">Thông Tin Đặt Phòng</h6>
                    <p><strong>Người Đặt Phòng:</strong> {{ $payment->booking->user->name ?? 'N/A' }}</p>
                    <p><strong>Ngày đến:</strong>
                        {{ \Carbon\Carbon::parse($payment->booking->check_in_date)->format('d-m-Y') }}</p>
                    <p><strong>Ngày Check-out:</strong>
                        {{ \Carbon\Carbon::parse($payment->booking->check_out_date)->format('d-m-Y') }}</p>
                    <p><strong>Tổng Số Tiền Đặt Phòng:</strong> <span
                            class="text-danger fw-bold">{{ number_format($payment->booking->total_price) }} VNĐ</span></p>
                    <p><strong>Số Tiền Cọc:</strong> {{ number_format($payment->booking->tien_coc) }} VNĐ</p>
                    <p><strong>Trạng Thái Đặt Phòng:</strong>
                        <span
                            class="badge @if ($payment->booking->status == 3 || $payment->payment_status == 2) bg-success
                            @elseif ($payment->booking->status == 4)
                            bg-primary
                            @else
                            bg-warning @endif">
                            @if ($payment->booking->status == 3)
                                Đã thanh toán tổng tiền
                            @endif
                            @if ($payment->booking->status == 2)
                                Đã thanh toán cọc
                            @endif
                            @if ($payment->booking->status == 4)
                            Đang sử dụng
                        @endif
                        </span>
                    </p>
                </div>

                <!-- Thông tin phòng -->
                <div class="info-box mb-3 p-3 border rounded w-100">
                    <h6 class="text-primary">Thông Tin Phòng</h6>
                    <p><strong>Tên Phòng:</strong> {{ $payment->booking->room->title ?? 'N/A' }}</p>
                    <p><strong>Loại Phòng:</strong> {{ $payment->booking->room->roomType->type ?? 'N/A' }}</p>
                    <p><strong>Giá Mỗi Đêm:</strong> <span
                            class="text-danger fw-bold">{{ number_format($payment->booking->room->price ?? 0) }} VNĐ</span>
                    </p>
                    <p><strong>Sức Chứa:</strong> {{ $payment->booking->room->max_people ?? 'N/A' }} người</p>
                </div>
            </div>

            <!-- Nút Quay Về -->
            <div class="mt-4 text-center">
                <a href="{{route('payments.index')}}" class="btn btn-secondary">Quay về</a>
            </div>
        </div>
    </div>


    <style>
        .card-header {
            border-bottom: 3px solid #6c757d;
        }

        .info-box {
            min-width: 250px;
            background-color: #f8f9fa;
        }

        .badge {
            padding: 0.3em 0.6em;
            font-size: 0.9rem;
            color: #fff;
        }

        .text-danger {
            color: #d9534f !important;
        }

        .text-primary {
            color: #007bff !important;
            font-weight: bold;
        }
    </style>
@endsection
