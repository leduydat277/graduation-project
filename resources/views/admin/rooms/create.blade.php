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
                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="room_number" class="form-label">Tên Phòng</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Nhập tên phòng" value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="room_type" class="form-label">Loại Phòng</label>
                        <select class="form-control select2" id="room_type" name="room_type">
                            <option value="">Chọn loại phòng</option>
                            <!-- Loop through room types -->
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" dt-value="{{ $type->roomType_number }}"
                                    {{ old('room_type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->type }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Mã Phòng</label>
                        <input type="text" class="form-control" id="roomId_number" name="roomId_number"
                            placeholder="Mã phòng" readonly value="{{ old('roomId_number') }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả Phòng</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả phòng">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá Mỗi Đêm</label>
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Nhập giá mỗi đêm" value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="max_people" class="form-label">Số lượng người tối đa</label>
                        <input type="number" class="form-control" id="max_people" name="max_people"
                            placeholder="Số lượng người tối đa" value="{{ old('max_people') }}">
                        @error('max_people')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="room_area" class="form-label">Diện Tích (m²)</label>
                        <input type="number" class="form-control" id="room_area" name="room_area"
                            placeholder="Nhập diện tích phòng" value="{{ old('room_area') }}">
                        @error('room_area')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_image" class="form-label">Ảnh Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image">
                        <small class="text-muted">Chọn một ảnh đại diện. (Hỗ trợ JPG, PNG, WEBP)</small>
                        @error('thumbnail_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_room" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image_room" name="image_room[]" multiple>
                        <small class="text-muted">Giữ Ctrl để chọn nhiều ảnh. (Hỗ trợ JPG, PNG, WEBP)</small>
                        @error('image_room')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Thêm Phòng</button>
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
            $('#room_type').select2({
                placeholder: "Chọn loại phòng",
                allowClear: true
            });
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
