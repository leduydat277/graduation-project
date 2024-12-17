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
                    <h4 class="card-title mb-4">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="listjs-table" id="roomAssetList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <a href="{{ route('room-assets.create') }}" class="btn btn-success">
                                                <i class="ri-add-line align-bottom me-1"></i> Thêm tiện nghi cho phòng
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row g-4 mb-3">
                                        <div class="col-md-6">
                                            <label for="search" class="form-label">Tìm kiếm</label>
                                            <input type="text" id="search" name="search" class="form-control"
                                                placeholder="Tìm theo tên phòng, mã phòng..."
                                                value="{{ request('search') }}" onchange="applyFilters()">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sort" class="form-label">Sắp xếp</label>
                                            <select id="sort" name="sort" class="form-select"
                                                onchange="applyFilters()">
                                                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sắp
                                                    xếp theo...</option>
                                                <option value="room_name_asc"
                                                    {{ request('sort') == 'room_name_asc' ? 'selected' : '' }}>Tên Phòng:
                                                    A-Z</option>
                                                <option value="room_name_desc"
                                                    {{ request('sort') == 'room_name_desc' ? 'selected' : '' }}>Tên Phòng:
                                                    Z-A</option>
                                                <option value="asset_count_asc"
                                                    {{ request('sort') == 'asset_count_asc' ? 'selected' : '' }}>Số tiện
                                                    nghi: Tăng dần</option>
                                                <option value="asset_count_desc"
                                                    {{ request('sort') == 'asset_count_desc' ? 'selected' : '' }}>Số tiện
                                                    nghi: Giảm dần</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="roomAssetTable">
                                <thead>
                                    <tr>
                                        <th>Mã phòng</th>
                                        <th>Tên Phòng</th>
                                        <th>Số lượng tiện nghi</th>
                                        <th>Xem chi tiết phòng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomassets as $roomasset)
                                        <tr>
                                            <td>{{ $roomasset->room->roomId_number ?? 'Không xác định' }}</td>
                                            <td>{{ $roomasset['room']['title'] ?? 'Không xác định' }}</td>
                                            <td><a href="{{ route('room-assets.show', $roomasset['room']['id']) }}">{{ $roomasset['asset_count'] ?? 0 }}
                                                    tiện nghi</a></td>
                                            <td class="text-center">
                                                <a class="btn btn-info"
                                                    href="{{ route('rooms.show', $roomasset['room']['id']) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($roomassets->isEmpty())
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Xin lỗi! Không có kết quả</h5>
                                        <p class="text-muted mb-0">Không tìm thấy tiện nghi phòng nào phù hợp với tìm kiếm
                                            của bạn.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $roomassets->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function handleSortChange() {
            const sort = document.getElementById('sort').value;
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('sort', sort);
            window.location.href = `${window.location.pathname}?${urlParams.toString()}`;
        }
    </script>
    <script>
        function applyFilters() {
            const search = document.getElementById('search').value; // Lấy giá trị tìm kiếm
            const sort = document.getElementById('sort') ? document.getElementById('sort').value :
            ''; // Lấy giá trị sắp xếp (nếu có)

            // Cập nhật URL với tham số mới
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('search', search);
            if (sort) {
                urlParams.set('sort', sort);
            }

            // Điều hướng đến URL mới
            window.location.href = `${window.location.pathname}?${urlParams.toString()}`;
        }
    </script>
@endsection
