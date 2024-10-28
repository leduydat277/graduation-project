@extends('layouts.admin')
@section('title')
    {{ $title }}
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách Chi Tiết Đặt Phòng</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="detailBookingList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                {{-- Nút thêm hoặc chức năng khác --}}
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="GET" action="{{ route('admin.checkin-checkout.index') }}">
                                        <div class="input-group search-box ms-2">
                                            <input type="text" name="search" value="{{ $search }}"
                                                class="form-control" placeholder="Tìm kiếm khách hàng...">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="ri-search-line search-icon"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="detailBookingTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">
                                            <a
                                                href="{{ route('admin.checkin-checkout.index', ['search' => $search, 'sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                ID
                                                @if ($sortBy == 'id')
                                                    @if ($sortOrder == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="sort" data-sort="user">
                                            Tên Khách Hàng
                                        </th>
                                        <th class="sort" data-sort="room">
                                            Phòng
                                        </th>
                                        <th class="sort" data-sort="room_type">
                                            Loại Phòng
                                        </th>
                                        <th class="sort" data-sort="check_in_date">
                                            <a
                                                href="{{ route('admin.checkin-checkout.index', ['search' => $search, 'sort_by' => 'check_in_date', 'sort_order' => $sortBy == 'check_in_date' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                Ngày Check-in
                                                @if ($sortBy == 'check_in_date')
                                                    @if ($sortOrder == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="sort" data-sort="check_out_date">
                                            <a
                                                href="{{ route('admin.checkin-checkout.index', ['search' => $search, 'sort_by' => 'check_out_date', 'sort_order' => $sortBy == 'check_out_date' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                Ngày Check-out
                                                @if ($sortBy == 'check_out_date')
                                                    @if ($sortOrder == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="sort" data-sort="status">
                                            Trạng thái
                                        </th>
                                        <th class="sort" data-sort="total_price">
                                            <a
                                                href="{{ route('admin.checkin-checkout.index', ['search' => $search, 'sort_by' => 'total_price', 'sort_order' => $sortBy == 'total_price' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                Tổng Giá
                                                @if ($sortBy == 'total_price')
                                                    @if ($sortOrder == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="sort" data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $booking->id }}">
                                                </div>
                                            </td>
                                            <td>{{ $booking->id }}</td>
                                            <td class="text-wrap" style="max-width: 200px;">
                                                {{ $booking->user->name ?? 'Không rõ' }}
                                            </td>
                                            <td>
                                                {{ $booking->detailBooking->first()->room->number ?? 'Không rõ' }}
                                            </td>
                                            <td>
                                                {{ $booking->detailBooking->first()->roomType->type ?? 'Không rõ' }}
                                            </td>
                                            <td>{{ $booking->check_in_date->format('d-m-Y') }}</td>
                                            <td>{{ $booking->check_out_date->format('d-m-Y') }}</td>
                                            <td>{{ $booking->status->name ?? 'Không rõ' }}</td>
                                            <td>{{ number_format($booking->total_price, 2) }} VND</td>
                                            <td>
                                                @if ($booking->status_id == 1)
                                                    <a href="{{ route('admin.checkin-checkout.checkin', $booking->id) }}"
                                                        class="btn btn-success">Check in</a>
                                                @elseif ($booking->status_id == 2)
                                                    <a href="{{ route('admin.checkin-checkout.checkOut', $booking->id) }}"
                                                        class="btn btn-warning">Check out</a>
                                                @else
                                                    <button class="btn btn-secondary" disabled>Đã hoàn tất</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($bookings->isEmpty())
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Xin lỗi! Không có kết quả</h5>
                                        <p class="text-muted mb-0">Không tìm thấy chi tiết đặt phòng nào phù hợp với tìm
                                            kiếm của bạn.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $bookings->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
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
                var studentName = form.getAttribute('data-student-name');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu của sinh viên " + studentName +
                        "!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Gửi form nếu người dùng xác nhận xóa
                    }
                });
            });
        });
    </script>
@endsection
