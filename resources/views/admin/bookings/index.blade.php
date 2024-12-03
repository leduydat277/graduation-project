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
        </div>

        <!-- Booking Table -->
        <div class="card">
            <div class="card-body">
                <!-- Hiển thị thông báo -->
                @if (session('success') || session('error'))
                    <div class="col">
                        <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show mb-0"
                            role="alert">
                            {{ session('success') ?? session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
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
                                    <td class="d-flex justify-content-evenly align-content-center">

                                        <img src="{{ asset('storage/' . $booking->room->thumbnail_image) }}"
                                            alt="Room Image" class="img-fluid mb-2 mt-2" style="width: 80px; height: 80px">

                                    </td>
                                    <td>{{ $booking->last_name . ' ' . $booking->first_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $booking->room->title }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ number_format($booking->tien_coc, 0, ',', '.') }}
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

                                            @case(4)
                                                <span class="badge bg-info">Đang sử dụng</span>
                                            @break

                                            @default
                                                <span class="badge bg-danger">Đã hủy</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if ($booking['status'] != 5)
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info"
                                                title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($booking['status'] != 3)
                                                <button type="button" class="btn btn-danger" title="Hủy đặt phòng"
                                                    onclick="confirmCancel({{ $booking->id }})">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            @endif
                                        @endif
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCancel(bookingId) {
            Swal.fire({
                title: 'Bạn có chắc muốn hủy đơn đặt phòng này không?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hủy đặt phòng',
                cancelButtonText: 'Không, giữ lại'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tạo form động để gửi yêu cầu
                    const form = document.createElement('form');
                    form.action = `/admin/bookings/cancel/${bookingId}`; // Cập nhật route với prefix 'admin'
                    form.method = 'POST';

                    // Thêm CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Thêm method PUT
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
