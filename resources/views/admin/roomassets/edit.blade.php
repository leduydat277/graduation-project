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
                <form action="{{ route('room-assets.update', $roomasset->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Sử dụng PUT cho form chỉnh sửa -->

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="room_id" class="form-label">Tên Phòng</label>
                        <select class="form-control" id="room_id" name="room_id">
                            <option value="">Chọn phòng</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}"
                                    {{ $roomasset->room_id == $room->id ? 'selected' : '' }}>
                                    {{ $room->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="asset_type_id" class="form-label">Loại Tiện Nghi</label>
                        <select class="form-control" id="" name="assets_type_id">
                            <option value="">Chọn loại tiện nghi</option>
                            @foreach ($assetTypes as $assetType)
                                <option value="{{ $assetType->id }}"
                                    {{ $roomasset->assets_type_id == $assetType->id ? 'selected' : '' }}>
                                    {{ $assetType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assets_type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="" name="status">
                            <option value="0" {{ $roomasset->status == 0 ? 'selected' : '' }}>Đang sử dụng</option>
                            <option value="1" {{ $roomasset->status == 1 ? 'selected' : '' }}>Tạm dừng sử dụng
                            </option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Cập Nhật Tiện Nghi</button>
                        <a href="{{ route('room-assets.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection