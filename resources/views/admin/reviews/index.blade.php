@extends('admin.layouts.admin')
@section('title', 'Danh sách đánh giá và bình luận')

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
                    <h4 class="card-title mb-0">Danh sách đánh giá và bình luận</h4>
                </div>
                <div class="card-body">
                    <div class="listjs-table" id="reviewList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <form method="GET" action="{{ route('reviews.index') }}" class="d-flex">
                                    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control"
                                        placeholder="Tìm kiếm bình luận...">

                                    <select name="sort_by" class="form-select ms-2">
                                        <option value="rating" {{ $sortBy == 'rating' ? 'selected' : '' }}>Sắp xếp theo sao
                                        </option>
                                        <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Sắp xếp
                                            theo ngày tạo</option>
                                    </select>

                                    <select name="sort_order" class="form-select ms-2">
                                        <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Tăng dần
                                        </option>
                                        <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Giảm dần
                                        </option>
                                    </select>

                                    <button class="btn btn-primary ms-2" type="submit">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                        <!-- Hiển thị thông báo thành công -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Hiển thị thông báo lỗi -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="reviewTable">
                                <thead >
                                    <tr>
                                        <th>ID</th>
                                        <th>Người dùng</th>
                                        <th>Phòng</th>
                                        <th>Đánh giá (sao)</th>
                                        <th>Nội dung</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->user->name ?? 'Không xác định' }}</td>
                                            <td>{{ $review->room->title ?? 'Không xác định' }}</td>
                                            <td>{{ $review->rating }}</td>
                                            <td>{{ $review->comment }}</td>
                                            <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('rooms.show', $review->room_id) }}" class="btn btn-info" title="Chi tiết phòng">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="delete-form"
                                                    data-review-id="{{ $review->id }}" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-btn" title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($reviews->isEmpty())
                                <div class="noresult">
                                    <div class="text-center">
                                        <h5 class="mt-2">Không có kết quả</h5>
                                        <p class="text-muted mb-0">Không tìm thấy bình luận nào phù hợp với tìm kiếm của
                                            bạn.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $reviews->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('.delete-form');
                var reviewId = form.getAttribute('data-review-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại đánh giá có ID " + reviewId + "!",
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
