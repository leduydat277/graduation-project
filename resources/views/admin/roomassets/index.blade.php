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
                    <h4 class="card-title mb-0">Danh sách tiện nghi phòng</h4>
                </div>
                <div class="card-body">
                    <div class="listjs-table" id="roomAssetList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <!-- Dropdown Sort -->
                                    <div class="">
                                        <select id="sort" name="sort" class="form-select w-auto"
                                            onchange="handleSortChange()">
                                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sắp xếp
                                                theo...
                                            </option>
                                            <option value="room_name_asc"
                                                {{ request('sort') == 'room_name_asc' ? 'selected' : '' }}>Tên Phòng: A-Z
                                            </option>
                                            <option value="room_name_desc"
                                                {{ request('sort') == 'room_name_desc' ? 'selected' : '' }}>Tên Phòng: Z-A
                                            </option>
                                            <option value="asset_type_asc"
                                                {{ request('sort') == 'asset_type_asc' ? 'selected' : '' }}>Loại Tiện Nghi:
                                                A-Z</option>
                                            <option value="asset_type_desc"
                                                {{ request('sort') == 'asset_type_desc' ? 'selected' : '' }}>Loại Tiện
                                                Nghi: Z-A</option>
                                            <option value="status_asc"
                                                {{ request('sort') == 'status_asc' ? 'selected' : '' }}>Trạng Thái: A-Z
                                            </option>
                                            <option value="status_desc"
                                                {{ request('sort') == 'status_desc' ? 'selected' : '' }}>Trạng Thái: Z-A
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="roomAssetTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã phòng</th>
                                        <th>Tên Phòng</th>
                                        <th>Số lượng tiện nghi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomassets as $roomasset)
                                        <tr>
                                            <td>{{ $roomasset['room']['roomId_number'] ?? 'Không xác định' }}</td>
                                            <td>{{ $roomasset['room']['title'] ?? 'Không xác định' }}</td>
                                            <td><a href="{{ route('room-assets.show', $roomasset['room']['id']) }}">{{ $roomasset['asset_count'] ?? 0 }}
                                                    tiện nghi</a></td>
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
@endsection
