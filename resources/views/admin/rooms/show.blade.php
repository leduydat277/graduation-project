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
        .card-body .row {
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }
        .card-body .row:last-child {
            border-bottom: none;
        }
        .card-title {
            font-weight: bold;
            color: #333;
        }
        .btn-primary, .btn-secondary {
            min-width: 120px;
        }
        .image-container img {
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center bg-primary">
                <h4 class="card-title mb-0 text-white">Chi Tiết Phòng: {{ $room->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>ID:</strong></div>
                    <div class="col-md-8">{{ $room->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Tên Phòng:</strong></div>
                    <div class="col-md-8">{{ $room->title }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Loại Phòng:</strong></div>
                    <div class="col-md-8">{{ $room->roomType->type ?? 'Không xác định' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Giá:</strong></div>
                    <div class="col-md-8">{{ number_format($room->price, 0, ',', '.') }} VND</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Diện Tích:</strong></div>
                    <div class="col-md-8">{{ $room->room_area }} m²</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Số Người Tối Đa:</strong></div>
                    <div class="col-md-8">{{ $room->max_people }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Trạng Thái:</strong></div>
                    <div class="col-md-8">
                        @switch($room->status)
                            @case(0)
                                Sẵn sàng
                                @break
                            @case(1)
                                Đã cọc
                                @break
                            @case(2)
                                Đang sử dụng
                                @break
                            @case(3)
                                Hỏng
                                @break
                            @default
                                Không xác định
                        @endswitch
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Mô tả:</strong></div>
                    <div class="col-md-8">{{ $room->description }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Hình Ảnh:</strong></div>
                    <div class="col-md-8 image-container">
                        @if (!empty($room->image_room))
                            @foreach (json_decode($room->image_room, true) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Room Image" width="100" height="100" class="me-2 mb-2">
                            @endforeach
                        @else
                            Không có ảnh
                        @endif
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Quay lại</a>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">Chỉnh Sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
