@extends('layouts.admin')
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
        <div class="col-10">
            <h2 class="text-center">{{ $title }}</h2>
            <div class="row">
                <form action="{{ route('admin.room.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="roomStatus" class="form-label">Trạng thái Phòng</label>
                        <select class="form-select" name="room_status_id" id="roomStatus">
                            <option selected disabled>Chọn trạng thái phòng</option>
                            @foreach ($roomStatuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('room_status_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="roomNumber" class="form-label">Số Phòng</label>
                        <input type="text" class="form-control" id="roomNumber" name="number"
                            placeholder="Nhập số phòng">
                    </div>
                    @error('number')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <div class="mb-3">
                        <label for="roomType" class="form-label">Loại Phòng</label>
                        <select class="form-select" name="room_type_id" id="roomType">
                            <option selected disabled>Chọn loại phòng</option>
                            @foreach ($roomTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('room_type_id')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <div class="mb-3">
                        <label for="roomDescription" class="form-label">Mô tả Phòng</label>
                        <textarea class="form-control" id="roomDescription" name="description" rows="4" placeholder="Nhập mô tả phòng"></textarea>
                    </div>
                    @error('description')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <div class="mb-3">
                        <label for="roomAmenities" class="form-label">Tiện Nghi</label>
                        <select multiple class="form-select" name="amenities[]" id="roomAmenities">
                            @foreach ($amenities as $amenity)
                                <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Giữ Ctrl để chọn nhiều tiện nghi.</small>
                    </div>
                    @error('amenities')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

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
    <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
