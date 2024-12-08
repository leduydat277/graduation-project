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
    <div class="page-content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danh Sách Hóa Đơn</h5>
                        </div>
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <form method="GET" action="{{ route('payments.index') }}"
                                    class="d-flex align-items-center mb-3">
                                    <div class="row g-3 align-items-center">
                                        <div class="input-group">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control" placeholder="Nhập mã đơn hoặc tên khách hàng..."
                                                aria-label="Tìm kiếm">
                                            <button class="btn btn-primary" type="submit" aria-label="Tìm kiếm">
                                                <i class="ri-search-line"></i> Tìm kiếm
                                            </button>
                                        </div>
                                    </div>
                                </form>


                                <form method="GET" action="{{ route('payments.index') }}">
                                    <div class="row g-3 align-items-center justify-content-end mb-3">
                                        <!-- Input khoảng ngày -->
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text" name="date_range" id="date-range-input"
                                                    class="form-control border-0 dash-filter-picker shadow"
                                                    placeholder="Chọn khoảng thời gian"
                                                    value="{{ request('date_range') }}">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Chọn trạng thái thanh toán -->
                                        <div class="col-sm-auto">
                                            <select name="payment_status" class="form-select">
                                                <option value="">Tất cả trạng thái</option>
                                                <option value="0"
                                                    {{ request('payment_status') == '0' ? 'selected' : '' }}>Chưa thanh
                                                    toán cọc</option>
                                                <option value="1"
                                                    {{ request('payment_status') == '1' ? 'selected' : '' }}>Đang thanh
                                                    toán</option>
                                                <option value="2"
                                                    {{ request('payment_status') == '2' ? 'selected' : '' }}>Đã thanh toán
                                                    cọc</option>
                                                <option value="3"
                                                    {{ request('payment_status') == '3' ? 'selected' : '' }}>Đã thanh toán
                                                    tổng tiền đơn</option>
                                            </select>
                                        </div>

                                        <!-- Nút lọc -->
                                        <div class="col-sm-auto">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <!-- Bảng danh sách thanh toán -->
                            <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Mã thanh toán</th>
                                        <th>Người dùng</th>
                                        <th>Tổng tiền</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Ngày thanh toán</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="payment-tbody">
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->payments_id_number }}</td>
                                            <td>{{ $payment->booking->first_name . ' ' . $payment->booking->last_name ?? 'N/A' }}
                                            </td>
                                            <td>{{ number_format($payment->total_price) }} vnđ</td>
                                            <td>{{ $payment->payment_method == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                                            <td>
                                                @switch($payment->payment_status)
                                                    @case(0)
                                                        <span class="badge bg-secondary">chưa thanh toán</span>
                                                    @break

                                                    @case(1)
                                                        <span class="badge bg-info">đang thanh toán</span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge bg-primary">đã thanh toán cọc</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge bg-success">đã thanh toán tổng tiền</span>
                                                    @break

                                                    @case(4)
                                                        <span class="badge bg-success">đang sử dụng</span>
                                                    @break

                                                    @case(5)
                                                        <span class="badge bg-danger">hủy đơn</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-dark">trạng thái không xác định</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('payments.show', $payment->id) }}"
                                                    title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-danger"
                                                    href="{{ route('payments.export_pdf', $payment->id) }}" title="In PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $payments->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo flatpickr với chế độ chọn khoảng thời gian
            flatpickr('#date-range-input', {
                mode: 'range',
                dateFormat: 'Y-m-d',
            });
        });

        // Xuất file Excel
        document.getElementById('export-excel-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var table = document.getElementById('model-datatables');
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "Payments"
            });
            XLSX.writeFile(wb, 'DanhSachThanhToan.xlsx');
        });
    </script>
@endsection
