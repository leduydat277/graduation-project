@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- App favicon và các css cần thiết -->
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $title }}</h4>
                </div>

                <div class="card-body">
                    <!-- Form Tìm kiếm và Lọc -->
                    <form method="GET" action="{{ route('manage-status-rooms.index') }}" class="row mb-4">
                        <!-- Tìm kiếm tên phòng -->
                        <div class="col-md-3">
                            <label for="search" class="form-label">Tìm kiếm tên phòng</label>
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Nhập tên phòng..." value="{{ request('search') }}">
                        </div>
                
                        <!-- Chọn trạng thái phòng -->
                        <div class="col-md-3">
                            <label for="status" class="form-label">Trạng thái phòng</label>
                            <select name="status" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Đã cọc</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Sẵn sàng</option>
                                <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Đang sử dụng</option>
                            </select>
                        </div>
                
                        <!-- Ngày bắt đầu -->
                        <div class="col-md-3">
                            <label for="from_date" class="form-label">Ngày đến (From)</label>
                            <input type="date" name="from_date" id="from_date" class="form-control"
                                value="{{ request('from_date') }}" placeholder="dd-mm-yyyy">
                        </div>
                
                        <!-- Ngày kết thúc -->
                        <div class="col-md-3">
                            <label for="to_date" class="form-label">Ngày đi (To)</label>
                            <input type="date" name="to_date" id="to_date" class="form-control"
                                value="{{ request('to_date') }}" placeholder="dd-mm-yyyy">
                        </div>
                
                        <!-- Nút Lọc -->
                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary w-50">Lọc</button>
                            <a href="{{ route('manage-status-rooms.index')}}" class="btn btn-secondary">Xoá bộ lọc</a>
                        </div>
                    </form>

                    <!-- Bảng danh sách trạng thái phòng -->
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th>Mã phòng</th>
                                    <th>Tên Phòng</th>
                                    <th>Loại Trạng Thái</th>
                                    <th>Khoảng Thời Gian</th>
                                    <th>Chi Tiết đơn hàng(nếu có)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($statusRooms as $statusRoom)
                                    <tr>
                                        <td>{{ $statusRoom['room']['roomId_number'] ?? 'Không xác định' }}</td>
                                        <td>{{ $statusRoom['room']['title'] ?? 'Không xác định' }}</td>
                                        <td>
                                            @switch($statusRoom['status'])
                                                @case(0)
                                                    <span
                                                        style="background-color: #6c757d; color: #fff; padding: 2px 5px; border-radius: 3px;">Đã
                                                        cọc</span>
                                                @break

                                                @case(1)
                                                    <span
                                                        style="background-color: #28a745; color: #fff; padding: 2px 5px; border-radius: 3px;">Sẵn
                                                        sàng</span>
                                                @break

                                                @case(2)
                                                    <span
                                                        style="background-color: #17a2b8; color: #fff; padding: 2px 5px; border-radius: 3px;">Đang
                                                        sử dụng</span>
                                                @break

                                                @default
                                                    <span
                                                        style="background-color: #dc3545; color: #333; padding: 2px 5px; border-radius: 3px;">Không
                                                        xác định
                                                    </span>
                                            @endswitch

                                        </td>
                                        <td>
                                            {{ date('d/m/Y H:i', $statusRoom['from']) }} -

                                            @if (!$statusRoom['to'])
                                                <span
                                                    style="background-color: #ccffcc; color: #333; padding: 2px 5px; border-radius: 3px;">không
                                                    giới hạn</span>
                                            @else
                                                {{ date('d/m/Y H:i', $statusRoom['to']) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($statusRoom['booking']))
                                                <a href="{{ route('bookings.show', $statusRoom['booking']['id']) }}"
                                                    class="btn btn-info" title="Xem Booking">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </a>
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Không có kết quả phù hợp</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Hiển thị phân trang -->
                        <div class="d-flex justify-content-end">
                            {{ $statusRooms->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
    @endsection

