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

        .btn-primary,
        .btn-secondary {
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
        @if (session('success') || session('error'))
            <div class="col">
                <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show mb-0"
                    role="alert">
                    {{ session('success') ?? session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
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
                                <span class="badge bg-success">Sẵn sàng</span>
                            @break

                            @case(1)
                                <span class="badge bg-warning">Đã cọc</span>
                            @break

                            @case(2)
                                <span class="badge bg-info">Đang sử dụng</span>
                            @break

                            @case(3)
                                <span class="badge bg-danger">Hỏng</span>
                            @break

                            @case(4)
                                <span class="badge bg-dark">Bị khóa</span>
                            @break

                            @default
                                <span class="badge bg-secondary">Không xác định</span>
                        @endswitch
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Mô tả:</strong></div>
                    <div class="col-md-8">{{ $room->description }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Hình Ảnh Phòng:</strong></div>
                    <div class="col-md-8 image-container">
                        @if (!empty($room->image_room))
                            @foreach (json_decode($room->image_room, true) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Room Image" width="100" height="100"
                                    class="me-2 mb-2">
                            @endforeach
                        @else
                            Không có ảnh phòng
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 d-flex align-items-center">
                        <strong>Tiện nghi</strong>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            @foreach ($roomAssets as $item)
                                <li class="list-group-item">{{ $item->assetType->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-secondary">
                        <h5 class="card-title text-white mb-0">Bình luận và Đánh giá</h5>
                    </div>
                    <div class="card-body">
                        <!-- Hiển thị danh sách bình luận -->
                        @if ($reviews->count() > 0)
                            <ul class="list-group">
                                @foreach ($reviews as $review)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong>{{ $review->user->name ?? 'Người dùng ẩn danh' }}</strong>
                                            <small class="text-muted">{{ date('d/m/Y H:i', $review->created_at) }}</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-warning text-dark">Đánh giá: {{ $review->rating }} ⭐</span>
                                        </div>
                                        <p class="mt-2 mb-0">{{ $review->comment }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Chưa có bình luận hoặc đánh giá nào.</p>
                        @endif
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
