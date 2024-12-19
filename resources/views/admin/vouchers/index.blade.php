@extends('admin.layouts.admin')
@section('title')
{{ $title }}
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/assets/libs/gridjs/theme/mermaid.min.css') }}">
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
<link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
<link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container">
    <h1>Danh sách Voucher</h1> <br>
    <a href="{{ route('vouchers.create') }}" class="btn btn-success mb-3">Thêm mới</a>
    <form method="GET" action="{{ route('vouchers.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="code" class="form-control" placeholder="Mã voucher, Tên Voucher" value="{{ request('code') }}">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-control">
                    <option value="">Chọn loại</option>
                    <option value="%" {{ request('type') == '%' ? 'selected' : '' }}>Phần trăm</option>
                    <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Cố định</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="min_discount" class="form-control" placeholder="Giá tối thiểu" value="{{ request('min_discount') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_discount" class="form-control" placeholder="Giá tối đa" value="{{ request('max_discount') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">Chọn trạng thái</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Còn hiệu lực</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Hết hạn</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mã</th>
                <th>Giá trị giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Giá trị tối thiểu đơn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->id }}</td>
                <td>{{ $voucher->name }}</td>
                <td>{{ $voucher->code_voucher }}</td>
                <td>
                    @if ($voucher->type == 'fixed')
                    {{ number_format($voucher->discount_value, 0, ',', '.') }} VND
                    @else
                    {{ $voucher->discount_value }} %
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</td>
                <td>{{ number_format($voucher->min_booking_amount, 0, ',', '.') }} VND</td>
                <td>{{ $voucher->status ? 'Còn hiệu lực' : 'Hết hạn' }}</td>
                <td>
                    <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                    <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $vouchers->withQueryString()->links() }}
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection