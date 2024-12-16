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
<br>
<form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Tên Voucher</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $voucher->name) }}" required>
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Mã Voucher</label>
        <input type="text" class="form-control" value="{{ old('code_voucher', $voucher->code_voucher) }}" readonly>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $voucher->description) }}</textarea>
        @error('description')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Loại</label>
        <select name="type" id="type" class="form-control" onchange="updateDiscountSuffix()">
            <option value="fixed" {{ old('type', $voucher->type) == 'fixed' ? 'selected' : '' }}>Giảm theo giá trị cố định</option>
            <option value="%" {{ old('type', $voucher->type) == '%' ? 'selected' : '' }}>Giảm theo phần trăm</option>
        </select>
        @error('type')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="discount_value" class="form-label">Giá trị giảm</label>
        <div class="input-group">
            <input type="number" name="discount_value" id="discount_value" class="form-control" value="{{ old('discount_value', $voucher->discount_value) }}" required>
            <span class="input-group-text" id="discount_suffix">{{ old('type', $voucher->type) == '%' ? '%' : 'vnđ' }}</span>
        </div>
        @error('discount_value')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="min_booking_amount" class="form-label">Số tiền tối thiểu đặt phòng</label>
        <div class="input-group">
            <input type="text" name="min_booking_amount" id="min_booking_amount" class="form-control" value="{{ old('min_booking_amount', number_format($voucher->min_booking_amount, 0, ',', '.')) }}" required oninput="formatCurrency(this)">
            <span class="input-group-text">vnđ</span>
        </div>
        @error('min_booking_amount')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Ngày bắt đầu</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $voucher->start_date ? date('Y-m-d', $voucher->start_date) : '') }}" required>
        @error('start_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">Ngày kết thúc</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $voucher->end_date ? date('Y-m-d', $voucher->end_date) : '') }}" required>
        @error('end_date')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label for="quantity" class="form-label">Số lượng voucher</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $voucher->quantity) }}" required>
        @error('quantity')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Trạng thái</label>
        <select name="status" id="statuss" class="form-control">
            <option value="1" {{ old('status', $voucher->status) == 1 ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ old('status', $voucher->status) == 0 ? 'selected' : '' }}>Hết hạn</option>
        </select>
        @error('status')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
</form>

</div> <br>
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