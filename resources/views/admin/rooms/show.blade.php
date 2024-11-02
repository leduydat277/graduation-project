@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <div class="listjs-table" id="roomList">
                        <div class="row g-4 mb-3">
                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="roomTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="key">Thông tin</th>
                                            <th class="sort" data-sort="value">Giá trị</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option">
                                                </div>
                                            </td>
                                            <td>ID Phòng</td>
                                            <td>{{ $room->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option">
                                                </div>
                                            </td>
                                            <td>Số Phòng</td>
                                            <td>{{ $room->number }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option">
                                                </div>
                                            </td>
                                            <td>Loại Phòng</td>
                                            <td>{{ $room->roomType->title ?? 'Không xác định' }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option">
                                                </div>
                                            </td>
                                            <td>Giá Mỗi Đêm</td>
                                            <td>{{ number_format($room->roomType->price_per_night ?? 0, 0, ',', '.') }} VND</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option">
                                                </div>
                                            </td>
                                            <td>Mô tả</td>
                                            <td>{{ $room->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="option">
                                                </div>
                                            </td>
                                            <td>Tiện nghi</td>
                                            <td>
                                                @if ($room->amenities->isNotEmpty())
                                                    <ul>
                                                        @foreach ($room->amenities as $amenity)
                                                            <li>{{ $amenity->name }} - {{ $amenity->description }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    Chưa có tiện nghi
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Xin lỗi! Không tìm thấy kết quả</h5>
                                        <p class="text-muted mb-0">Chúng tôi không tìm thấy phòng nào phù hợp với tìm kiếm của bạn.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev disabled" href="javascript:void(0);">Previous</a>
                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                    <a class="page-item pagination-next" href="javascript:void(0);">Next</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <a href="{{ route('admin.room.index') }}" class="btn btn-danger">Quay về danh sách phòng</a>
        </div><!-- end col -->
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
