@extends('admin.layouts.admin')
@section('title')
    Danh sách đặt phòng
@endsection

@section('css')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

    <!-- Bootstrap, DataTables, Daterangepicker -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />

    <!-- Custom Styles -->
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
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
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Danh sách đặt phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Danh sách đặt phòng</li>
            </ol>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-header bg-light d-flex justify-content-between">
                <h5 class="mb-0">Tìm kiếm và bộ lọc</h5>
                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#filterSection">
                    <i class="ri-filter-3-line"></i> Bộ lọc nâng cao
                </button>
            </div>
            <div class="card-body collapse" id="filterSection">
                <form method="GET" action="{{ route('bookings.index') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="">Tất cả</option>
                                <option value="1">Đang thanh toán</option>
                                <option value="2">Đã thanh toán tiền cọc</option>
                                <option value="3">Đã thanh toán tổng tiền đơn</option>
                                <option value="4">Hủy</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date_range" class="form-label">Ngày đặt</label>
                            <input type="text" id="date_range" class="form-control" name="date_range"
                                placeholder="Chọn khoảng ngày">
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Lọc</button>
                        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Xóa bộ lọc</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bookingTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Ngày đến</th>
                                <th>Ngày đi</th>
                                <th>Phòng</th>
                                <th>Tiền cọc</th>
                                <th>CCCD</th>
                                <th>Trạng thái đơn</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->code_check_in }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $booking->room->title }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ number_format($booking->tien_coc, 0, ',', '.') }}
                                            đ</span>
                                    </td>
                                    <td>{{ $booking->cccd_booking ?? 'Chưa rõ' }}</td>
                                    <td>
                                        @switch($booking['status'])
                                            @case(0)
                                                Đã cọc
                                            @break

                                            @case(1)
                                                Sẵn sàng
                                            @break

                                            @case(2)
                                                Đang sử dụng
                                            @break

                                            @default
                                                Không xác định
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info">Xem chi
                                            tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- jQuery, DataTables, Daterangepicker -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#bookingTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
                }
            });

            // Initialize Daterangepicker
            $('#date_range').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Xóa',
                    applyLabel: 'Áp dụng'
                },
                autoUpdateInput: false
            }).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            }).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
