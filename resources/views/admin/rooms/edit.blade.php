@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container--default .select2-selection--single .select2-selection__clear {
            display: none;
        }

        .select2-container--default .select2-selection--single {
            height: 36px !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-top: 4px;
            margin-left: 6px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            margin-top: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="w-100 d-flex justify-content-center align-items-center">
            <div class="col-9">
                <h2 class="text-center">{{ $title }}</h2>
                <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Sử dụng PUT cho form chỉnh sửa -->

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái Phòng</label>
                        <select class="form-control"  name="status" 
                            {{ in_array($room->status, [1, 2]) ? 'disabled' : '' }}>
                            <option value="0" {{ $room->status == 0 ? 'selected' : '' }}>Sẵn sàng</option>
                            <option value="1" {{ $room->status == 1 ? 'selected' : '' }}>Đã cọc</option>
                            <option value="2" {{ $room->status == 2 ? 'selected' : '' }}>Đang sử dụng</option>
                            <option value="3" {{ $room->status == 3 ? 'selected' : '' }}>Hỏng</option>
                        </select>
                        @if (in_array($room->status, [1, 2]))
                            <small class="text-muted">Phòng đang sử dụng hoặc đã được đặt cọc, không thể thay đổi trạng thái.</small>
                        @endif
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Tên Phòng</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Nhập tên phòng" value="{{ old('title', $room->title) }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="room_type" class="form-label">Loại Phòng</label>
                        <select class="form-control" id="room_type" name="room_type">
                            <option value="">Chọn loại phòng</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" dt-value="{{ $type->roomType_number }}"
                                    {{ $room->room_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->type }}</option>
                            @endforeach
                        </select>
                        @error('room_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Mã Phòng</label>
                        <input type="text" class="form-control" id="roomId_number" name="roomId_number"
                            placeholder="Mã phòng" readonly value="{{ $room->roomId_number }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả Phòng</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả phòng">{{ old('description', $room->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá Mỗi Đêm</label>
                        <input type="text" class="form-control" id="price" name="price"
                            placeholder="Nhập giá mỗi đêm" value="{{ $room->price }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="max_people" class="form-label">Số lượng người tối đa</label>
                        <input type="number" class="form-control" id="max_people" name="max_people"
                            placeholder="Số lượng người tối đa" value="{{ old('max_people', $room->max_people) }}">
                        @error('max_people')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="room_area" class="form-label">Diện Tích (m²)</label>
                        <input type="number" class="form-control" id="room_area" name="room_area"
                            placeholder="Nhập diện tích phòng" value="{{ old('room_area', $room->room_area) }}">
                        @error('room_area')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_image" class="form-label">Ảnh Thu Nhỏ</label>
                        <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image">
                        <small class="text-muted">Chọn một ảnh đại diện (Hỗ trợ JPG, PNG, WEBP).</small>
                        @error('thumbnail_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if ($room->thumbnail_image)
                            <div class="mt-3">
                                <p>Ảnh Thu Nhỏ Hiện Tại:</p>
                                <img src="{{ asset('storage/' . $room->thumbnail_image) }}" alt="Thumbnail Image"
                                    class="img-thumbnail" style="max-width: 150px; height: auto;">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="image_room" class="form-label">Hình Ảnh Phòng</label>
                        <input type="file" class="form-control" id="image_room" name="image_room[]" multiple>
                        <small class="text-muted">Giữ Ctrl để chọn nhiều ảnh (Hỗ trợ JPG, PNG, WEBP).</small>
                        @error('image_room')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mt-3">
                            <p>Ảnh Hiện Tại:</p>
                            @if (!empty($room->image_room))
                                <div class="d-flex flex-wrap">
                                    @foreach (json_decode($room->image_room, true) as $key => $image)
                                        <div class="position-relative m-2" id="gallery_existing_{{ $key }}">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Room Image"
                                                class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Không có ảnh nào.</p>
                            @endif
                        </div>
                    </div>


                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Cập Nhật Phòng</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- CSS Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- JS Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#room_type').select2();
        });
    </script>
    <script>
        function removeVietnameseTones(str) {
            return str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Xóa dấu
                .replace(/đ/g, 'd') // Chuyển đ -> d
                .replace(/Đ/g, 'D'); // Chuyển Đ -> D
        }

        $(document).ready(function() {
            $('#room_type').on('select2:select', function(e) {
                const selectedOption = e.params.data.element; // Lấy option được chọn
                const roomName = $(selectedOption).attr('dt-value'); // Lấy giá trị dt-value
                console.log(roomName);

                if (roomName) {
                    const normalizedRoomName = removeVietnameseTones(roomName);

                    const roomCode = normalizedRoomName
                        .toUpperCase()
                        .replace(/\s+/g, '_')
                        .replace(/[^A-Z0-9_]/g, '');

                    $('#roomId_number').val(roomCode + '_{{ $roomId }}');
                } else {
                    $('#roomId_number').val('');
                }
            });
        });
    </script>
@endsection
