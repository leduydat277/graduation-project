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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 flex-grow-1">Danh sách đặt phòng</h4>
                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#filterSection">
                    <i class="ri-filter-3-line"></i> Bộ lọc nâng cao
                </button>
            </div>
            <div class="card mb-4">
                <div class="card-body collapse" id="filterSection">
                    <form method="GET" action="{{ route('bookings.index') }}">
                        <div class="row g-3 d-flex align-items-center">
                            <!-- Bộ lọc trạng thái -->
                            <div class="col-md-4">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="">Tất cả</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Chưa thanh toán
                                    </option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang thanh toán
                                    </option>
                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đã thanh toán
                                        tiền
                                        cọc</option>
                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Đã thanh toán
                                        tổng
                                        tiền đơn</option>
                                    <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Đang sử dụng
                                    </option>
                                    <option value="5" {{ request('status') == '5' ? 'selected' : '' }}>Đã hủy
                                    </option>
                                </select>
                            </div>
                            <!-- Bộ lọc khoảng thời gian -->
                            <div class="col-md-4">
                                <label for="date_range" class="form-label">Khoảng thời gian đặt</label>
                                <div class="col-sm-auto">
                                    <div class="input-group">
                                        <input type="text" name="date_range" id="date-range-input"
                                            class="form-control border-0 dash-filter-picker shadow"
                                            placeholder="Chọn khoảng thời gian" value="{{ request('date_range') }}">
                                        <div class="input-group-text bg-primary border-primary text-white">
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: -26px !important;">
                                <button type="submit" class="btn btn-primary">Lọc</button>
                                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Xóa bộ lọc</a>
                            </div>
                        </div>
                        <!-- Nút bấm -->
                    
                    </form>
                </div>
            </div>
            <div class="card-body" style="">
                <div class="table-responsive">
                    <table id="bookingTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đặt</th>
                                <th>Ảnh phòng</th>
                                <th>Khách hàng</th>
                                <th>Ngày đến</th>
                                <th>Ngày đi</th>
                                <th>Phòng</th>
                                <th>Tiền cọc</th>
                                <th>Trạng thái đơn</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_number_id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $booking->room->image_room) }}" alt="Room Image"
                                            class="img-fluid" style="max-width: 100px;">
                                    </td>
                                    <td>{{ $booking->last_name . ' ' . $booking->first_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $booking->room->title }}</td>
                                    <td>
                                        <span
                                            class="badge bg-warning">{{ number_format($booking->tien_coc, 0, ',', '.') }}
                                            đ</span>
                                    </td>

                                    <td>
                                        @switch($booking['status'])
                                            @case(0)
                                                Chưa thanh toán cọc
                                            @break

                                            @case(1)
                                                Đang thanh toán
                                            @break

                                            @case(2)
                                                <span class="badge bg-success">Đã thanh toán cọc</span>
                                            @break

                                            @case(3)
                                                <span class="badge bg-success">Đã thanh toán tổng tiền đơn</span>
                                            @break

                                            @case(3)
                                                <span class="badge bg-info">Đang sử dụng</span>
                                            @break

                                            @default
                                                <span class="badge bg-danger">Đã hủy</span>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        $('#bookingTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json'
            }
        });
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
