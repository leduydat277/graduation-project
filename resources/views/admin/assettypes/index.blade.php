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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách loại tiện nghi</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="assetTypeList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('asset-types.create') }}" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Thêm loại tiện nghi
                                    </a>
                                </div>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <form method="GET" action="{{ route('asset-types.index') }}"
                                        class="d-flex align-items-center">
                                        <div class="input-group">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control" placeholder="Nhập từ khóa tìm kiếm..."
                                                aria-label="Tìm kiếm loại phòng">
                                            <button class="btn btn-primary" type="submit" aria-label="Tìm kiếm">
                                                <i class="ri-search-line"></i> Tìm kiếm
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="assetTypeTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">
                                            <a
                                                href="{{ route('asset-types.index', ['search' => $search, 'sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                Mã tiện nghi
                                                @if ($sortBy == 'id')
                                                    @if ($sortOrder == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                @endif
                                            </a>
                                        </th>
                                        <th class="sort" data-sort="name">Tên loại tiện nghi</th>
                                        <th class="sort" data-sort="image">Hình ảnh</th>
                                        <th class="sort" data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($assetTypes as $assetType)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $assetType->id }}">
                                                </div>
                                            </td>
                                            <td>{{ $assetType->assets_number_id }}</td>
                                            <td>{{ $assetType->name }}</td>
                                            <td>
                                                @if ($assetType->image)
                                                    <img src="{{ asset('storage/' . $assetType->image) }}" alt="Hình ảnh"
                                                        width="100">
                                                @else
                                                    Không có hình ảnh
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('asset-types.edit', $assetType->id) }}"
                                                    class="btn btn-warning">Sửa</a>
                                                <form action="{{ route('asset-types.destroy', $assetType->id) }}"
                                                    method="POST" class="delete-form"
                                                    data-asset-type="{{ $assetType->name }}" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-btn">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($assetTypes->isEmpty())
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Xin lỗi! Không có kết quả</h5>
                                        <p class="text-muted mb-0">Không tìm thấy loại tiện nghi nào phù hợp với tìm kiếm
                                            của
                                            bạn.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $assetTypes->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('.delete-form');
                var assetType = form.getAttribute('data-asset-type');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu của loại tiện nghi " + assetType +
                        "!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
