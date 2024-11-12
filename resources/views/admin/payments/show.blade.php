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
<div class="card">
    <div class="card-header bg-primary ">
        <h4 class="card-title mb-0 text-white">Chi Tiết Thanh Toán</h4>
    </div>
    <div class="card-body bg-light">
        <!-- Thông tin thanh toán -->
        <div class="mt-3">
            <h5 class="section-title bg-secondary text-white p-2 rounded">Thông Tin Thanh Toán</h5>
            <div class="row py-2 px-3 bg-white rounded shadow-sm">
                <div class="col-md-6">
                    <p><strong>ID Thanh Toán:</strong> {{ $payment->id }}</p>
                    <p><strong>ID Đặt Phòng:</strong> {{ $payment->booking_id }}</p>
                    <p><strong>Ngày Thanh Toán:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tổng Số Tiền:</strong> <span class="text-danger">{{ number_format($payment->total_price) }} VNĐ</span></p>
                    <p><strong>Phương Thức Thanh Toán:</strong> {{ $payment->payment_method == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</p>
                    <p><strong>Trạng Thái Thanh Toán:</strong> <span class="badge {{ $payment->payment_status == 1 ? 'bg-success' : 'bg-warning' }}">{{ $payment->payment_status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</span></p>
                </div>
            </div>
        </div>

        <!-- Thông tin đặt phòng -->
        <div class="mt-3">
            <h5 class="section-title bg-secondary text-white p-2 rounded">Thông Tin Đặt Phòng</h5>
            <div class="row py-2 px-3 bg-white rounded shadow-sm">
                <div class="col-md-6">
                    <p><strong>Người Đặt Phòng:</strong> {{ $payment->booking->user->name ?? 'N/A' }}</p>
                    <p><strong>Ngày Check-in:</strong> {{ \Carbon\Carbon::parse($payment->booking->check_in_date)->format('d-m-Y') }}</p>
                    <p><strong>Ngày Check-out:</strong> {{ \Carbon\Carbon::parse($payment->booking->check_out_date)->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tổng Số Tiền Đặt Phòng:</strong> <span class="text-danger">{{ number_format($payment->booking->total_price) }} VNĐ</span></p>
                    <p><strong>Số Tiền Cọc:</strong> {{ number_format($payment->booking->tien_coc) }} VNĐ</p>
                    <p><strong>Trạng Thái Đặt Phòng:</strong> <span class="badge {{ $payment->booking->status == 1 ? 'bg-info' : 'bg-danger' }}">{{ $payment->booking->status == 1 ? 'Đang sử dụng' : 'Đã hủy' }}</span></p>
                </div>
            </div>
        </div>

        <!-- Thông tin phòng -->
        <div class="mt-3">
            <h5 class="section-title bg-secondary text-white p-2 rounded">Thông Tin Phòng</h5>
            <div class="row py-2 px-3 bg-white rounded shadow-sm">
                <div class="col-md-6">
                    <p><strong>Tên Phòng:</strong> {{ $payment->booking->room->title ?? 'N/A' }}</p>
                    <p><strong>Loại Phòng:</strong> {{ $payment->booking->room->roomType->type ?? 'N/A' }}</p>
                    <p><strong>Diện Tích:</strong> {{ $payment->booking->room->room_area ?? 'N/A' }} m²</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Giá Mỗi Đêm:</strong> <span class="text-danger">{{ number_format($payment->booking->room->price ?? 0) }} VNĐ</span></p>
                    <p><strong>Sức Chứa:</strong> {{ $payment->booking->room->max_people ?? 'N/A' }} người</p>
                    @if ($payment->booking->room->image_room)
                        <p><strong>Hình Ảnh:</strong></p>
                        @foreach (json_decode($payment->booking->room->image_room, true) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Room Image" class="img-thumbnail mb-2" width="100">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
    .section-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .badge {
        padding: 0.4em 0.8em;
        font-size: 0.9rem;
    }

    .card-header {
        background-color: #007bff;
    }

    .bg-primary {
        background-color: #007bff !important;
    }

    .bg-secondary {
        background-color: #6c757d !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }
</style>
@endsection
