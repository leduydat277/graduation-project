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
            <form action="{{ route('room-types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Tên Loại Phòng</label>
                    <input type="text" class="form-control" id="type" name="type"
                        placeholder="Nhập tên loại phòng" value="{{ old('type') }}">
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Mã Loại Phòng</label>
                    <input type="text" class="form-control" id="roomType_number" name="roomType_number"
                    placeholder="Mã phòng" readonly value="{{ old('roomType_number') }}">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Thêm Loại Phòng</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        function removeVietnameseTones(str) {
            return str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/đ/g, 'd')
                .replace(/Đ/g, 'D');
        }

        document.getElementById('type').addEventListener('input', function() {
            const roomName = this.value;

            const normalizedRoomName = removeVietnameseTones(roomName);

            const roomCode = normalizedRoomName
                .toUpperCase()
                .replace(/\s+/g, '_')
                .replace(/[^A-Z0-9_]/g, '');
            document.getElementById('roomType_number').value = roomCode;
        });


    </script>
@endsection
