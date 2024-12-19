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
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách tài khoản</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="userList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('user.addUI') }}" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Thêm tài khoản
                                    </a>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()">
                                        <i class="ri-delete-bin-2-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-end">
                                    <form method="GET" action="{{ route('user.index') }}" class="w-100" style="max-width: 400px;">
                                        <div class="input-group">
                                            <!-- Ô tìm kiếm -->
                                            <input 
                                                type="text" 
                                                name="search" 
                                                class="form-control rounded-start" 
                                                placeholder="Tìm kiếm tài khoản..." 
                                                value="{{ request('search') }}"
                                            >
                                            <!-- Nút tìm kiếm -->
                                            <button class="btn btn-primary rounded-end" type="submit">
                                                <i class="ri-search-line"></i>
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
                                        <th data-sort="id">
                                            ID
                                        </th>
                                        <th data-sort="name">
                                            Tên
                                        </th>
                                        <th data-sort="email">
                                            Email
                                        </th>
                                        <th data-sort="role">
                                            Vai trò
                                        </th>
                                        <th data-sort="role">
                                            Trạng thái
                                        </th>
                                        <th data-sort="role">
                                            Ảnh
                                        </th>
                                        <th data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @if (session('success'))
                                        <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show mb-0"
                                            role="alert">
                                            {{ session('success') ?? session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @php
                                        $dataRole = [
                                            1 => 'Admin',
                                            0 => 'Khách hàng',
                                        ];
                                        $dataStatus = [
                                            1 => 'Hoạt động',
                                            0 => 'Ngưng hoạt động',
                                        ];
                                    @endphp
                                    {{-- @dd($data) --}}
                                    @foreach ($data as $user)
                                        @php
                                            $role = $user['role'];
                                            $distable = $userDefaults->role == 1 && $role == 1;
                                        @endphp
                                        <tr>
                                            <td>{{ $user['id'] }}</td>
                                            <td class="text-wrap" style="max-width: 200px;">{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $dataRole[$role] }}</td>
                                            <td>{{ $dataStatus[$user['status']] }}</td>
                                            <td>
                                                <img src="{{ Storage::url($user['image']) }}" style="width: 100px"
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
                            @if ($data->isEmpty())
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Xin lỗi! Không có kết quả</h5>
                                        <p class="text-muted mb-0">Không tìm thấy tài khoản nào phù hợp với tìm kiếm của
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
