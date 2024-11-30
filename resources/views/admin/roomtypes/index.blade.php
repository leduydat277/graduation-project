@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
@endsection

@section('css')
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách loại phòng</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="roomTypeList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <a href="{{ route('room-types.create') }}" class="btn btn-success">
                                    <i class="ri-add-line align-bottom me-1"></i> Thêm loại phòng
                                </a>
                            </div>

                            <div class="col-sm">
                                <div class="d-flex justify-content-end align-items-center mb-3">
                                    <!-- Form Filter -->
                                    <form method="GET" action="{{ route('room-types.index') }}"
                                        class="d-flex align-items-center me-4">
                                        <div class="input-group" style="width: 300px;">
                                            <select name="sort" class="form-select" onchange="this.form.submit()">
                                                <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>Sắp
                                                    xếp theo</option>
                                                <option value="type_asc"
                                                    {{ request('sort') === 'type_asc' ? 'selected' : '' }}>Tên loại phòng:
                                                    A-Z</option>
                                                <option value="type_desc"
                                                    {{ request('sort') === 'type_desc' ? 'selected' : '' }}>Tên loại phòng:
                                                    Z-A</option>
                                            </select>
                                        </div>
                                    </form>

                                    <!-- Form Tìm Kiếm -->
                                    <form method="GET" action="{{ route('room-types.index') }}"
                                        class="d-flex align-items-center me-3">
                                        <div class="input-group" style="width: 300px;">
                                            <input type="text" name="search"
                                                value="{{ old('search', request('search')) }}" class="form-control"
                                                placeholder="Tìm kiếm theo mã hoặc tên loại phòng..."
                                                aria-label="Tìm kiếm loại phòng">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="ri-search-line"></i> Tìm kiếm
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
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
                        <!-- Bảng danh sách loại phòng -->
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="roomTypeTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã loại phòng</th>
                                        <th>Tên loại phòng</th>
                                        <th>Ảnh</th>
                                        <th>Số lượng phòng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomTypes as $roomType)
                                        <tr>
                                            <td>{{ $roomType->roomType_number }}</td>
                                            <td>{{ $roomType->type }}</td>
                                            <td>
                                                @if ($roomType->image)
                                                    <img src="{{ asset('storage/' . $roomType->image) }}"
                                                        alt="Ảnh loại phòng" class="img-thumbnail"
                                                        style="width: 100px; height: 100px;">
                                                @else
                                                    <span class="text-muted">Chưa có ảnh</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('room-types.rooms', $roomType->id) }}">
                                                    {{ $roomType->rooms_count }} phòng
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('room-types.edit', $roomType->id) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <form action="{{ route('room-types.destroy', $roomType->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger  delete-btn">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($roomTypes->isEmpty())
                            <div class="noresult">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Không có kết quả</h5>
                                    <p class="text-muted mb-0">Không tìm thấy loại phòng nào phù hợp với tìm kiếm.</p>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end">
                            {{ $roomTypes->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace(); // Khởi tạo Feather Icons
    </script>


    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Áp dụng sự kiện click cho tất cả nút có class .delete-btn
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Có, xóa nó!',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Gửi form xóa nếu người dùng xác nhận
                        }
                    });
                });
            });
        });
    </script>
@endsection
