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
    <h2>Sửa Voucher</h2>

    <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên Voucher</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $voucher->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $voucher->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Loại</label>
            <select name="type" id="type" class="form-control">
                <option value="%" {{ old('type', $voucher->type) == '%' ? 'selected' : '' }}>Giảm theo phần trăm</option>
                <option value="fixed" {{ old('type', $voucher->type) == 'fixed' ? 'selected' : '' }}>Giảm theo giá trị cố định</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="discount_value" class="form-label">Giá trị giảm</label>
            <input type="number" name="discount_value" id="discount_value" class="form-control" value="{{ old('discount_value', $voucher->discount_value) }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $voucher->start_date ? date('Y-m-d', $voucher->start_date) : '') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Ngày kết thúc</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $voucher->end_date ? date('Y-m-d', $voucher->end_date) : '') }}" required>
        </div>

        <div class="mb-3">
            <label for="min_booking_amount" class="form-label">Số tiền tối thiểu đặt phòng</label>
            <input type="number" name="min_booking_amount" id="min_booking_amount" class="form-control" value="{{ old('min_booking_amount', $voucher->min_booking_amount) }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng voucher</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $voucher->quantity) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="statuss" class="form-control">
                <option value="1" {{ (old('status', $voucher->status) == 1) ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ (old('status', $voucher->status) == 0) ? 'selected' : '' }}>Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection