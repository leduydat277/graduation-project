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
<br>
<form method="POST" action="{{ route('vouchers.store') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Tên Voucher</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="code_voucher" class="form-label">Mã Voucher</label>
        <input type="text" name="code_voucher" id="code_voucher" class="form-control" value="{{ old('code_voucher') }}" required oninput="formatVoucherCode(this)">
        @error('code_voucher')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Loại</label>
        <select name="type" id="type" class="form-control" onchange="updateDiscountSuffix()">
            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Cố định</option>
            <option value="%" {{ old('type') == '%' ? 'selected' : '' }}>Phần trăm</option>
        </select>
        @error('type')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="discount_value" class="form-label">Giá trị giảm</label>
        <div class="input-group">
            <input type="number" name="discount_value" id="discount_value" class="form-control" value="{{ old('discount_value') }}" required>
            <span class="input-group-text" id="discount_suffix">{{ old('type') == '%' ? '%' : 'vnđ' }}</span>
        </div>
        @error('discount_value')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="min_booking_amount" class="form-label">Số tiền đặt tối thiểu</label>
        <div class="input-group">
            <input type="text" name="min_booking_amount" id="min_booking_amount" class="form-control" value="{{ old('min_booking_amount') }}" required oninput="formatCurrency(this)">
            <span class="input-group-text">vnđ</span>
        </div>
        @error('min_booking_amount')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Số lượng</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" required>
        @error('quantity')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Ngày bắt đầu</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
        @error('start_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">Ngày kết thúc</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
        @error('end_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <input type="hidden" name="status" value="1">

    <button type="submit" class="btn btn-success">Thêm</button>
</form>
</div>
<br>
<a href="{{route('vouchers.index')}}"><button class="btn btn-primary">Quay lại</button></a>
<br>
@endsection
@section('js')
<script>
    function updateDiscountSuffix() {
        const type = document.getElementById('type').value;
        const discountValue = document.getElementById('discount_value');
        const discountSuffix = document.getElementById('discount_suffix');

        discountSuffix.textContent = type === '%' ? '%' : 'vnđ';


        if (type === '%' && parseFloat(discountValue.value) > 100) {
            discountValue.value = 100;  
            alert("Giá trị giảm không thể lớn hơn 100%");
        }
    }

    function formatCurrency(input) {
        const value = input.value.replace(/[^0-9]/g, '');  
        if (value) {
            input.value = parseInt(value).toLocaleString('vi-VN');  
        }
    }

    function formatVoucherCode(input) {
        const value = input.value.toUpperCase().normalize('NFD').replace(/\p{Diacritic}/gu, '').replace(/\s+/g, '');  
        input.value = value;
    }
    window.onload = function() {
        updateDiscountSuffix();
    }
</script>

<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection