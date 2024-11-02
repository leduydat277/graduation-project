@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- App favicon và các css cần thiết -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('admin.room.create') }}" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Thêm phòng
                                    </a>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()">
                                        <i class="ri-delete-bin-2-line"></i> Xóa nhiều
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="GET" action="{{ route('admin.room.index') }}">
                                        <div class="input-group search-box ms-2">
                                            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Tìm kiếm phòng...">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="ri-search-line search-icon"></i>
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
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">
                                            <a href="{{ route('admin.room.index', ['search' => $search, 'sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
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
                                        <th class="sort" data-sort="number">
                                            <a href="{{ route('admin.room.index', ['search' => $search, 'sort_by' => 'number', 'sort_order' => $sortBy == 'number' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                Số Phòng
                                                @if ($sortBy == 'number')
                                                    @if ($sortOrder == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="sort" data-sort="room_type">
                                            Loại Phòng
                                        </th>
                                        <th class="sort" data-sort="price_per_night">
                                            Giá mỗi đêm
                                        </th>
                                        <th class="sort" data-sort="amenities_count">
                                            Tiện nghi
                                        </th>
                                        <th class="sort" data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{ $room->id }}">
                                                </div>
                                            </td>
                                            <td>{{ $room->id }}</td>
                                            <td>{{ $room->number }}</td>
                                            <td>{{ $room->roomType->title ?? 'Không xác định' }}</td>
                                            <td>{{ number_format($room->roomType->price_per_night ?? 0, 0, ',', '.') }} VND</td>
                                            <td>{{ $room->amenities->count() }}</td>
                                            
                                            <td>
                                                <a href="{{ route('admin.room.show', $room->id) }}" class="btn btn-info">Xem</a>
                                                <a href="{{ route('admin.room.edit', $room->id) }}" class="btn btn-warning">Sửa</a>
                                                <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST" class="delete-form" data-room-name="{{ $room->number }}" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-btn">Xóa</button>
                                                </form>
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
                                        <p class="text-muted mb-0">Không tìm thấy phòng nào phù hợp với tìm kiếm của bạn.</p>
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
    <!-- JavaScript và SweetAlert cho thông báo xóa -->
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('.delete-form');
                var roomName = form.getAttribute('data-room-name');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu của phòng " + roomName + "!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
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
