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
                                <option value="{{ $type->id }}"
                                    {{ $room->room_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->type }}</option>
                            @endforeach
                        </select>
                        @error('room_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Nhập giá mỗi đêm" value="{{ old('price', $room->price) }}">
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

                    <!-- Hiển thị ảnh hiện tại và thêm ảnh mới -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between bg-primary">
                                <h4 class="card-title mb-0 text-white">Gallery</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Khối hiển thị ảnh hiện tại -->
                                    <div class="col-md-12 mb-4">
                                        <div class="card border-light shadow-sm p-3">
                                            <h5 class="text-center">Ảnh Hiện Tại</h5>
                                            <div class="d-flex flex-wrap justify-content-center">
                                                @if (!empty($room->image_room))
                                                    @foreach (json_decode($room->image_room, true) as $key => $image)
                                                        <div class="position-relative m-2" id="gallery_existing_{{ $key }}">
                                                            <img src="{{ asset('storage/' . $image) }}" alt="Room Image"
                                                                class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-center">Không có ảnh nào.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                    
                                    <!-- Khối thêm ảnh mới -->
                                    <div class="col-md-12">
                                        <div class="card border-light shadow-sm p-3">
                                            <h5 class="text-center">Thêm Ảnh Mới</h5>
                                            <div id="new-image-uploads">
                                                <div class="d-flex align-items-center mb-3">
                                                    <input type="file" class="form-control" name="image_room[]" multiple>
                                                    <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeImageInput(this)">Xóa</button>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="addNewImageInput()">+ Thêm ảnh</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        function addNewImageInput() {
            let html = `
                <div class="d-flex align-items-center mb-3">
                    <input type="file" class="form-control" name="image_room[]" multiple>
                    <button type="button" class="btn btn-danger btn-sm ms-2" onclick="removeImageInput(this)">Xóa</button>
                </div>
            `;
            document.getElementById('new-image-uploads').insertAdjacentHTML('beforeend', html);
        }
    
        function removeImageGallery(id) {
            if (confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
                document.getElementById(id).remove();
            }
        }
    
        function removeImageInput(element) {
            element.parentNode.remove();
        }
    </script>
@endsection
