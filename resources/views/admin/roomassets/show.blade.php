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
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center bg-primary">
                <h4 class="card-title mb-0 text-white">Chi Tiết Tiện Nghi Phòng: {{ $roomasset->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>ID:</strong></div>
                    <div class="col-md-8">{{ $roomasset->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Tên Phòng:</strong></div>
                    <div class="col-md-8">{{ $roomasset->room->title ?? 'Không xác định' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Loại Tiện Nghi:</strong></div>
                    <div class="col-md-8">{{ $roomasset->assetType->name ?? 'Không xác định' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Trạng Thái:</strong></div>
                    <div class="col-md-8">
                        @switch($roomasset->status)
                            @case(0)
                                Đang sử dụng
                                @break
                            @case(1)
                                Tạm dừng sử dụng
                                @break
                            @default
                                Không xác định
                        @endswitch
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('roomassets.index') }}" class="btn btn-secondary">Quay lại</a>
                    <a href="{{ route('roomassets.edit', $roomasset->id) }}" class="btn btn-primary">Chỉnh Sửa</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
