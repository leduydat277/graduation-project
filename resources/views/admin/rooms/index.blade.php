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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách phòng</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="roomList">
                        <div class="row g-4 mb-3 align-items-center">
                            <!-- Nút thêm phòng -->
                            <div class="col-sm-auto">
                                <a href="{{ route('rooms.create') }}" class="btn btn-success">
                                    <i class="ri-add-line align-bottom me-1"></i> Thêm phòng
                                </a>
                            </div>

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

                            <!-- Form tìm kiếm và dropdown -->
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end align-items-center gap-3">
                                    <!-- Form tìm kiếm -->
                                    <!-- Dropdown sắp xếp -->
                                    <div>
                                        <select id="sort" name="sort" class="form-select w-auto"
                                            onchange="this.form.submit()">
                                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sắp xếp
                                                theo...</option>
                                            <option value="title_asc"
                                                {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Tên phòng: A-Z
                                            </option>
                                            <option value="title_desc"
                                                {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Tên phòng: Z-A
                                            </option>
                                            <option value="price_asc"
                                                {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao
                                            </option>
                                            <option value="price_desc"
                                                {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp
                                            </option>
                                            <option value="room_area_asc"
                                                {{ request('sort') == 'room_area_asc' ? 'selected' : '' }}>Diện tích: Tăng
                                                dần</option>
                                            <option value="room_area_desc"
                                                {{ request('sort') == 'room_area_desc' ? 'selected' : '' }}>Diện tích: Giảm
                                                dần</option>
                                            <option value="capacity_asc"
                                                {{ request('sort') == 'capacity_asc' ? 'selected' : '' }}>Số người: Ít đến
                                                Nhiều</option>
                                            <option value="capacity_desc"
                                                {{ request('sort') == 'capacity_desc' ? 'selected' : '' }}>Số người: Nhiều
                                                đến Ít</option>
                                            <option value="status_asc"
                                                {{ request('sort') == 'status_asc' ? 'selected' : '' }}>Trạng thái: A-Z
                                            </option>
                                            <option value="status_desc"
                                                {{ request('sort') == 'status_desc' ? 'selected' : '' }}>Trạng thái: Z-A
                                            </option>
                                        </select>
                                    </div>

                                    <form method="GET" action="{{ route('rooms.index') }}"
                                        class="d-flex align-items-center">
                                        <div class="input-group">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control" placeholder="Nhập từ khóa tìm kiếm..."
                                                aria-label="Tìm kiếm loại phòng">
                                            <button class="btn btn-primary" type="submit" aria-label="Tìm kiếm">
                                                <i class="ri-search-line"></i> Tìm kiếm
                                            </button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>


                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="roomTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã phòng</th>
                                        <th>Tên Phòng</th>
                                        <th>Hình Ảnh</th>
                                        <th>Loại Phòng</th>
                                        <th>Giá</th>
                                        <th>Sức chứa</th>
                                        <th>Trạng Thái</th>

                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>{{ $room->roomId_number }}</td>
                                            <td>{{ $room->title }}</td>
                                            <td>
                                                @if ($room->thumbnail_image)
                                                    <img src="{{ asset('storage/' . $room->thumbnail_image) }}"
                                                        alt="Room Image" width="50">
                                                @else
                                                    Không có ảnh
                                                @endif
                                            </td>
                                            <td>{{ $room->roomType->type ?? 'Không xác định' }}</td>
                                            <td>{{ number_format($room->price, 0, ',', '.') }} VND</td>
                                            <td>{{ $room->max_people }} Người</td>
                                            <td>
                                                @switch($room->status)
                                                    @case(0)
                                                        <span class="badge bg-success">Sẵn sàng</span>
                                                    @break

                                                    @case(1)
                                                        <span class="badge bg-warning">Đã cọc</span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge bg-info">Đang sử dụng</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge bg-danger">Hỏng</span>
                                                    @break

                                                    @case(4)
                                                        <span class="badge bg-dark">Ngừng kinh doanh</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-secondary">Không xác định</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <div
                                                    style="display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
                                                    @if ($room->status !== 4)
                                                        <a href="{{ route('rooms.edit', $room->id) }}"
                                                            class="btn btn-warning" title="Sửa">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info"
                                                            title="Xem">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    <form
                                                        action="{{ $room->status === 4 ? route('rooms.unlock', $room->id) : route('rooms.lock', $room->id) }}"
                                                        method="POST" class="lock-unlock-form"
                                                        data-room-name="{{ $room->title }}" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="button"
                                                            class="btn {{ $room->status === 4 ? 'btn-success' : 'btn-danger' }} lock-unlock-btn"
                                                            title="{{ $room->status === 4 ? 'Mở hoạt động' : 'Dừng hoạt động' }}">
                                                            <i
                                                                class="{{ $room->status === 4 ? 'fas fa-unlock' : 'fas fa-lock' }}"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($rooms->isEmpty())
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Xin lỗi! Không có kết quả</h5>
                                        <p class="text-muted mb-0">Không tìm thấy phòng nào phù hợp với tìm kiếm của bạn.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $rooms->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.lock-unlock-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const roomName = form.dataset.roomName;
                const isUnlocking = this.classList.contains('btn-success');

                Swal.fire({
                    title: `Bạn có chắc chắn muốn ${isUnlocking ? 'mở khóa' : 'khóa'} phòng "${roomName}" không?`,
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

    <script>
        $(document).ready(function() {
            $('#sort').change(function() {
                const sortValue = $(this).val(); // Lấy giá trị sort được chọn
                const urlParams = new URLSearchParams(window.location.search);

                // Cập nhật giá trị sort trong URL
                if (sortValue) {
                    urlParams.set('sort', sortValue);
                } else {
                    urlParams.delete('sort');
                }

                // Thay đổi URL và tải lại trang
                window.location.search = urlParams.toString();
            });
        });
    </script>
@endsection
