@extends('admin.layouts.admin')
@section('title')
    Danh sách đặt phòng
@endsection
@section('css')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-auto">
            <div>
                <a href="{{ route('adminBooking.addUI') }}" class="btn btn-success">
                    <i class="ri-add-line align-bottom me-1"></i> Đặt phòng
                </a>
            </div>                                                                                          
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Hiển thị thông báo -->
                    @if (session('success') || session('error'))
                        <div class="col">
                            <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show mb-0"
                                role="alert">
                                {{ session('success') ?? session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                    <th>Tổng tiền</th>
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
                                                alt="Room Image" class="img-fluid mb-2 mt-2"
                                                style="width: 80px; height: 80px">

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
                                            <span
                                                class="badge bg-info">{{ number_format($booking->total_price, 0, ',', '.') }}
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
                                                    <span class="badge bg-warning">Đã thanh toán cọc</span>
                                                @break

                                                @case(3)
                                                    <span class="badge bg-success">Đã thanh toán tổng tiền đơn</span>
                                                @break

                                                @case(4)
                                                    <span class="badge bg-info">Đang sử dụng</span>
                                                @break

                                                @case(5)
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                @break

                                                @case(6)
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                @break

                                                @default
                                                    <span class="badge bg-success">Không xác định</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @if ($booking->status != 5)
                                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info"
                                                    title="Xem chi tiết">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if ($booking->status != 3 && $booking->status != 6)
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
        </div><!-- end col -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('.delete-form');
                var userName = form.getAttribute('data-user-name'); // Đổi từ 'student' sang 'user'

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn khóa đặt phòng không?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Gửi form nếu đặt phòng xác nhận xóa
                    }
                });
            });
        });
    </script>
@endsection
