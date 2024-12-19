@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- CSS cần thiết -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title mb-0 text-white">{{ $title }}</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive mt-3 mb-1">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên phòng</th>
                                    <th>Diện tích</th>
                                    <th>Giá (VNĐ)</th>
                                    <th>Số người tối đa</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roomType->rooms as $room)
                                    <tr>
                                        <td>{{ $room->title }}</td>
                                        <td>{{ $room->room_area }} m²</td>
                                        <td>{{ number_format($room->price) }}</td>
                                        <td>{{ $room->max_people }}</td>
                                        <td>
                                            @switch($room->status)
                                                @case(0)
                                                    <span class="badge bg-success">Sẵn sàng</span>
                                                @break

                                                @case(1)
                                                    <span class="badge bg-warning">Đã cọc</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-danger">Đang sử dụng</span>
                                                @break

                                                @case(3)
                                                    <span class="badge bg-secondary">Hỏng</span>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Không có phòng nào thuộc loại này.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('room-types.index') }}" class="btn btn-danger">Quay lại danh sách loại phòng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    @endsection
