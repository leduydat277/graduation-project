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
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="col-6">
            <h2 class="text-center">{{ $title }}</h2>
            <form action="{{ route('asset-types.update', $assetType->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Đặt phương thức PUT cho form chỉnh sửa -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Loại Tiện Nghi</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên loại tiện nghi" value="{{ $assetType->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả Loại Tiện Nghi</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả">{{ $assetType->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @if ($assetType->image)
                        <div class="mt-3">
                            <label>Hình Ảnh Hiện Tại:</label>
                            <img src="{{ asset('storage/' . $assetType->image) }}" alt="Hình Ảnh Hiện Tại" class="img-fluid" style="max-width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cập Nhật Loại Tiện Nghi</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
