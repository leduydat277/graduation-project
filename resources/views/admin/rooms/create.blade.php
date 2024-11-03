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
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select name="status" class="form-select" id="">
                            <option value="" selected disabled>Chọn trạng thái</option>
                            <option value="0">Sẵn sàng</option>
                            <option value="1">Đã cọc</option>
                            <option value="2">Đang sử dụng</option>
                            <option value="3">Hỏng</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="room_type" class="form-label">Loại Phòng</label>
                        <select class="form-control" id="room_type" name="room_type">
                            <option value="">Chọn loại phòng</option>
                            <!-- Loop through room types -->
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}" {{ old('room_type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->type }}</option>
                            @endforeach
                        </select>
                        @error('room_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                                <button type="button" class="btn btn-primary" onclick="addImageGallery()">Thêm
                                    ảnh</button>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="live-preview">
                                    <div class="row gy-4" id="gallery_list">
                                        <div class="col-md-4" id="gallery_default_item">
                                            <label for="gallery_default" class="form-label">Image</label>
                                            <div class="d-flex">
                                                <input type="file" class="form-control" name="image_room[]"
                                                    id="gallery_default">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
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
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="image_room[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
