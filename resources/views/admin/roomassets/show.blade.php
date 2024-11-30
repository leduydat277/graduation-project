@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- CSS cần thiết -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-4">{{ $title }}</h4>
                    <div class="col-sm-auto">
                        <a href="{{ route('room-assets.edit', $room->id) }}" class="btn btn-success">
                            <i class="ri-add-line align-bottom me-1"></i> Thêm tiện nghi phòng
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên tiện nghi</th>
                                    <th>Ảnh tiện nghi</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($asset as $room)
                                    <tr>
                                        <td>{{ $room->assetType->name }}</td>
                                        <td>
                                            <img src="{{ Storage::url($room->assetType->image)}}" alt="" width="110px">
                                        </td>
                                        <td>{{ $room->assetType->description }}</td>
                                        <td>
                                            @if ($room->assetType->status == 0)
                                                <p style="color: green">Hoạt động</p>
                                            @else
                                                <p style="color: red">Hỏng</p>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('room-assets.destroy', $room->id) }}"
                                                method="POST" style="display:inline-block;">
                                                <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger delete-btn">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có tiện nghi nào thuộc loại này.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('room-assets.index') }}" class="btn btn-danger">Quay lại danh sách tiện nghi
                            phòng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('form');
                var assetTypeId = form.getAttribute('action').split('/').pop();

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu của tiện nghi phòng này (ID: " +
                        assetTypeId + ")!",
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
