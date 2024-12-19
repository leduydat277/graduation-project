@extends('admin.layouts.admin')
@section('title')
    Danh sách tài khoản
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách tài khoản</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered" id="userTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $dataRole = [1 => 'Admin', 0 => 'Khách hàng'];
                                    $dataStatus = [1 => 'Hoạt động', 0 => 'Ngưng hoạt động'];
                                @endphp
                                @foreach ($data as $user)
                                    <tr>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ $dataRole[$user['role']] }}</td>
                                        <td>{{ $dataStatus[$user['status']] }}</td>
                                        <td>
                                            <img src="{{ $user['image'] }}" style="width: 100px"
                                                alt="{{ $user['name'] }}">
                                        </td>
                                        <td>
                                            <form
                                                action="{{ $user['status'] === 0 ? route('user.unlock', $user['id']) : route('user.lock', $user['id']) }}"
                                                method="POST" class="lock-unlock-form"
                                                data-room-name="{{ $user['name'] }}" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="button"
                                                    class="btn {{ $user['status'] === 0 ? 'btn-success' : 'btn-danger' }} lock-unlock-btn"
                                                    title="{{ $user['status'] === 0 ? 'Mở hoạt động' : 'Dừng hoạt động' }}">
                                                    <i
                                                        class="{{ $user['status'] === 0 ? 'fas fa-unlock' : 'fas fa-lock' }}"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
        $(document).ready(function() {
            $('#userTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    paginate: {
                        next: 'Tiếp',
                        previous: 'Trước'
                    },
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ mục",
                    info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    infoEmpty: "Không có dữ liệu để hiển thị",
                    zeroRecords: "Không tìm thấy kết quả",
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.lock-unlock-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.lock-unlock-form');
                const roomName = form.dataset.roomName;
                const isUnlocking = this.classList.contains('btn-success');

                Swal.fire({
                    title: `Bạn có chắc chắn muốn ${isUnlocking ? 'mở khóa' : 'khóa'} tài khoản "${roomName}" không?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: isUnlocking ? '#28a745' : '#ffc107',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Có, ${isUnlocking ? 'mở khóa' : 'khóa'}!`,
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
