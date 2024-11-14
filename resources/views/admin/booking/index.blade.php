@extends('layouts.admin')
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách đặt phòng</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="userList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.booking.addUI') }}" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Đặt phòng
                                    </a>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()">
                                        <i class="ri-delete-bin-2-line"></i>
                                    </button>
                                </div>                                                                                          
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="GET" action="{{ route('admin.user.index') }}">
                                        <div class="input-group search-box ms-2">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Tìm kiếm đặt phòng...">
                                            <!-- Giữ nguyên giá trị sắp xếp khi tìm kiếm -->
                                            <input type="hidden" name="sort_by">
                                            <input type="hidden" name="sort_order">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="ri-search-line search-icon"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="userTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="id">Mã đơn</th>
                                        <th class="sort" data-sort="name">Phòng</th>
                                        <th class="sort" data-sort="name">Khách hàng</th>
                                        <th class="sort" data-sort="email">Ngày đến</th>
                                        <th class="sort" data-sort="role">Ngày đi</th>
                                        <th class="sort" data-sort="role">Tổng giá</th>
                                        <th class="sort" data-sort="role">Số tiền cọc</th>
                                        <th class="sort" data-sort="role">Trạng thái
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @foreach ($bookings as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $item['id'] }}">
                                                </div>
                                            </td>
                                            <td>{{ $item['id'] }}</td>
                                            <td class="text-wrap" style="max-width: 200px;">{{ $item['room_id'] }}</td>
                                            <td>{{ $item['user_name'] }}</td>
                                            <td>{{ $item['check_in_date'] }}</td>
                                            <td>{{ $item['check_out_date'] }}</td>
                                            <td>{{ $item['total_price'] }}</td>
                                            <td>{{ $item['tien_coc'] }}</td>
                                            <td>{{ $item['status'] }}</td>
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
                                        <p class="text-muted mb-0">Không tìm thấy đặt phòng nào phù hợp với tìm kiếm của
                                            bạn.</p>
                                    </div>
                                </div>
                            @endif
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
