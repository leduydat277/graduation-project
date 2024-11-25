@extends('admin.layouts.admin')
@section('title')
{{$title}}
@endsection
@section('css')
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

<!-- gridjs css -->
<link rel="stylesheet" href="{{ asset('assets/admin/assets/libs/gridjs/theme/mermaid.min.css') }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

<!-- jsvectormap css -->
<link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
    type="text/css" />

<!--Swiper slider css-->
<link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Layout config Js -->
<script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
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
                <h4 class="card-title mb-0 flex-grow-1">Danh sách Phí phát sinh</h4>
            </div><!-- end card header -->
            <button style="width: 120px; margin: 10px;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOtherModal">
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
                <h5 class="modal-title" id="addOtherModalLabel">Thêm mới Others</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addOtherForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="otherName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="otherName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="otherType" class="form-label">Type</label>
                        <input type="text" class="form-control" id="otherType" name="type">
                    </div>
                    <div class="mb-3">
                        <label for="otherDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="otherDescription" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="otherValue" class="form-label">Value</label>
                        <input type="text" class="form-control" id="otherValue" name="value">
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
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name1" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type1" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description1" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Value</label>
                        <input type="text" class="form-control" id="value1" name="value" required>
                    </div>
                    <!-- Thêm các trường sửa ở đây -->
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection
@section('js')
<script>
    // thêm mới
    document.addEventListener("DOMContentLoaded", function() {
        const addOtherForm = document.getElementById("addOtherForm");

        addOtherForm.addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(addOtherForm);

            fetch("{{ route('phiphatsinhs.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: formData
            })
            window.location.reload();
        });
    });
    // end thêm mới

// // sửa
//     function openCheckinModal(id) {
//         const data = @json($phiphatsinhs).find(others => others.id === id);
//         document.getElementById('name1').value = data.name;
//             document.getElementById('type1').value = data.type;
//             document.getElementById('description1').value = data.description;
//             document.getElementById('value1').value = data.value;
        
//             document.getElementById('editForm').addEventListener('submit', function(e) {
//             e.preventDefault();
//             const form = this;
//             form.action = '{{ route('others.update', ':id') }}'.replace(':id', id);
//             form.submit();
//     });        
//     }
// // endsuaw

    document.addEventListener("DOMContentLoaded", function() {
        const othersData = @json($phiphatsinhs);
        if (document.getElementById("table-gridjs")) {
            new gridjs.Grid({
                columns: [{
                        name: "Mã",
                        width: "100px"
                    },
                    {
                        name: "Tên phí",
                        width: "150px"
                    },
                    {
                        name: "Mã đơn",
                        width: "100px"
                    },
                    {
                        name: "Mô tả",
                        width: "150px"
                    },
                    {
                        name: "Giá",
                        width: "100px",
                        formatter: (cell, row) => {
                            const totalPrice = row.cells[4].data; 
                            const formattedPrice = new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND',
                            }).format(totalPrice); // Định dạng VND
                            return gridjs.html(`<span>${formattedPrice}</span>`);
                        }
                    },
                    {
                        name: "Hình ảnh"
                    },
                    {

                        name: "Action",
                        width: "150px",
                        formatter: (_, row) => gridjs.html(`
<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#checkinModal" onclick="openCheckinModal(${row.cells[0].data})">Sửa</button>
    <form id="delete-form-${row.cells[0].data}" action="/admin/phiphatsinhs/${row.cells[0].data}" method="POST" style="display: inline-block;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" onclick="return confirm('bạn có muốn xóa?')" class="btn btn-danger">Xóa</button>
    </form>
`)

                    }

                ],
                data: othersData.map(phiphatsinhs => [
                    phiphatsinhs.id || '',
                    phiphatsinhs.name || '',
                    phiphatsinhs.booking_id || '',
                    phiphatsinhs.description || 'Không có mô tả',
                    phiphatsinhs.price || '',
                    phiphatsinhs.image || 'Không có hình ảnh',
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