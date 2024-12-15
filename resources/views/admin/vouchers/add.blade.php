@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
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
<div class="container">
    <h1>Thêm Voucher</h1>

    <form method="POST" action="{{ route('vouchers.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name">Tên Voucher</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="code_voucher">Mã Voucher</label>
            <input type="text" name="code_voucher" id="code_voucher" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="type">Loại</label>
            <select name="type" id="type" class="form-control" required>
                <option value="%">Phần trăm</option>
                <option value="fixed">Cố định</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="discount_value">Giá trị giảm</label>
            <input type="number" name="discount_value" id="discount_value" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="min_booking_amount">Số tiền đặt tối thiểu</label>
            <input type="number" name="min_booking_amount" id="min_booking_amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quantity">Số lượng</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="start_date">Ngày bắt đầu</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="end_date">Ngày kết thúc</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
        <input type="hidden" name="status" value="1">
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
