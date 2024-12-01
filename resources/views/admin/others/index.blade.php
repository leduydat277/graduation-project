@extends('admin.layouts.admin')
@section('title')
{{ $title }}
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/assets/libs/gridjs/theme/mermaid.min.css') }}">
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
<link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
<link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 flex-grow-1">Danh sách khác</h4>
            </div><!-- end card header -->
            <button style="width: 120px; margin: 10px;" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#addOtherModal">
                Thêm mới
            </button>

            <div class="card-body">
                <div id="table-gridjs"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#addOtherModal').modal('show');
    });
</script>
@endif
<!-- modal thêm mới -->
<div class="modal fade" id="addOtherModal" tabindex="-1" aria-labelledby="addOtherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOtherModalLabel">Thêm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addOtherForm" action="{{ route('others.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="otherName" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="otherName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="otherType" class="form-label">Loại</label>
                        <input type="text" class="form-control" id="otherType" name="type">
                    </div>
                    <div class="mb-3">
                        <label for="otherDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="otherDescription" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="otherValue" class="form-label">Dữ liệu (nhập 1 trong 2 loại dưới đây)</label>
                        <input type="file" class="form-control" name="value" id="fileInput"> <br>
                        <textarea type="text" class="form-control" id="otherValue" name="valuee" placeholder="nhập dữ liệu"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal sửa -->
<div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="checkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkinModalLabel">Chỉnh sửa thông tin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <form id="editForm" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT') <!-- Phương thức PUT để Laravel nhận diện đây là yêu cầu cập nhật -->
    <div class="mb-3">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name1" name="name" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Loại</label>
        <input type="text" class="form-control" id="type1" name="type" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Mô tả</label>
        <input type="text" class="form-control" id="description1" name="description">
    </div>
    <div class="mb-3">
        <label for="otherValue" class="form-label">Dữ liệu (nhập 1 trong 2 loại dưới đây)</label>
        <input type="file" class="form-control" name="value" id="fileInputU"> <br>
        <textarea type="text" class="form-control" id="otherValueU" name="valuee" placeholder="nhập dữ liệu"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>

            </div>
        </div>
    </div>
</div>




@endsection
@section('js')
<script>
// Đảm bảo sự kiện click được gắn sau khi bảng được render
document.addEventListener("DOMContentLoaded", function() {
    // Tìm tất cả nút có class "edit-btn"
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');  // Lấy ID từ data-id
            var url = '{{ route('others.show', ['other' => ':id']) }}'.replace(':id', id); // Tạo URL với id
            window.location.href = url;  // Chuyển hướng đến URL đã tạo
        });
    });
});



    // check inputfile
    document.getElementById('fileInput').addEventListener('change', function() {
        document.getElementById('otherValue').disabled = this.files.length > 0;
    });

    document.getElementById('otherValue').addEventListener('input', function() {
        document.getElementById('fileInput').disabled = this.value.trim() !== '';
    });


    document.getElementById('fileInputU').addEventListener('change', function() {
        document.getElementById('otherValueU').disabled = this.files.length > 0;
    });

    document.getElementById('otherValueU').addEventListener('input', function() {
        document.getElementById('fileInputU').disabled = this.value.trim() !== '';
    });
    // end check inputfile


    document.addEventListener("DOMContentLoaded", function() {
        const othersData = @json($others);
        if (document.getElementById("table-gridjs")) {
            new gridjs.Grid({
                columns: [{
                        name: "Id",
                        width: "100px"
                    }, {
                        name: "Tên",
                        width: "150px"
                    },
                    {
                        name: "Loại",
                        width: "100px"
                    },
                    {
                        name: "Mô tả",
                        width: "150px"
                    },
                    {
                        name: "Dữ liệu"
                    },
                    {

                        name: "Hành động",
                        width: "100px",
                        formatter: (_, row) => gridjs.html(`
               <button class="btn btn-warning edit-btn" 
                        data-id="${row.cells[0].data}">
                    Sửa
                </button>
    <form id="delete-form-${row.cells[0].data}" action="/admin/others/${row.cells[0].data}" method="POST" style="display: inline-block;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" onclick="return confirm('bạn có muốn xóa?')" class="btn btn-danger">Xóa</button>
    </form>
`)

                    }

                ],
                data: othersData.map(other => [
                    other.id || '',
                    other.name || '',
                    other.type || '',
                    other.description || 'Không có mô tả',
                    other.value || 'Không có giá trị',
                ]),
                pagination: {
                    limit: 10
                },
                sort: true,
                search: true,
            }).render(document.getElementById("table-gridjs"));
        }
    });
</script>


<script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

<!-- prismjs plugin -->
<script src="{{ asset('assets/admin/assets/libs/prismjs/prism.js') }}"></script>

<!-- gridjs js -->
<script src="{{ asset('assets/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script>
<!-- gridjs init -->

<!-- App js -->
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection