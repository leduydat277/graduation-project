@extends('admin.layouts.admin')
@section('title')
{{$title}}
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
                <h5 class="modal-title" id="addOtherModalLabel">Thêm mới Phí phát sinh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addOtherForm" action="{{ route('phiphatsinhs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="otherName" class="form-label">Tên phí</label>
                        <input type="text" class="form-control" id="otherName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="otherType" class="form-label">Mã đơn</label>
                        <select class="form-select searchable-select" name="booking_id" id="booking_id">
                            <?php foreach ($allBooking as $booking) {
                                echo '<option value="' . $booking->id . '">' . "Mã: " . $booking->id . " - " . $booking->first_name . " " . $booking->last_name . " - phòng: " . $booking->room_id . '</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="otherDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="otherDescription" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="otherValue" class="form-label">Giá</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="otherValue" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="otherValue" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
                <form id="editForm" action="{{ route('phiphatsinhs.update', ':id') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Thêm phương thức PUT -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên phí</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="booking_id" class="form-label">Mã đơn</label>
                            <select class="form-select" name="booking_id" id="booking_id">
                                <!-- Các tùy chọn sẽ được render động từ PHP -->
                                <?php foreach ($allBooking as $booking): ?>
                                    <option value="{{ $booking->id }}">
                                        Mã: {{ $booking->id }} - {{ $booking->first_name }} {{ $booking->last_name }} - phòng: {{ $booking->room_id }}
                                    </option>
                                <?php endforeach; ?>
                            </select>


                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3" id="currentImageContainer">
                            <label class="form-label">Hình ảnh hiện tại:</label>
                            <img id="currentImage" src="" alt="Hình ảnh hiện tại" style="width: 100px; height: auto;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection
@section('js')
<script>
// format tiền trong input
function formatCurrency(value) {
        // Loại bỏ các ký tự không phải là số
        value = value.replace(/[^\d]/g, "");

        // Thêm dấu phân cách hàng nghìn
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Lắng nghe sự kiện nhập liệu trong ô input
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value;

        // Format giá trị nhập vào và thêm "VNĐ"
        let formattedValue = formatCurrency(value);

        // Cập nhật giá trị vào ô input
        e.target.value = formattedValue + " VNĐ";
    });
// end format tiền trong input


    // // sửa
    function openCheckinModal(id) {
    // Tìm đối tượng cần chỉnh sửa
    const data = @json($phiphatsinhs).find(phiphatsinhs => phiphatsinhs.id === id);
    // Gán giá trị cho các trường trong modal
    const modal = document.getElementById('checkinModal'); // ID của modal
    modal.querySelector('#name').value = data.name || '';
    modal.querySelector('#description').value = data.description || '';
    modal.querySelector('#price').value = data.price || '';

    // Xử lý select để chọn đúng giá trị
    const bookingSelect = modal.querySelector('#booking_id');
    const valueToSelect = String(data.booking_id); // Chuyển thành chuỗi để so sánh chính xác
    Array.from(bookingSelect.options).forEach(option => {
        option.selected = String(option.value) === valueToSelect;
    });

    // Hiển thị hình ảnh hiện tại nếu có
    const currentImageContainer = modal.querySelector('#currentImageContainer');
    const currentImage = modal.querySelector('#currentImage');
    if (data.image) {
        currentImage.src = `/storage/${data.image}`;
        currentImageContainer.style.display = 'block';
    } else {
        currentImageContainer.style.display = 'none';
    }

    // Cập nhật hành động submit form
    const editForm = modal.querySelector('#editForm');
    editForm.action = '{{ route('phiphatsinhs.update', ':id') }}'.replace(':id', id);
    // Hiển thị modal
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
}


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
                        name: "Hình ảnh",
                        formatter: (cell) => gridjs.html(cell),
                    },
                    {
                        name: "Trạng thái",
                        width: "120px",
                        formatter: (cell, row) => {
                            const status = row.cells[6].data;
                            let statusText = '';
                            let statusClass = '';

                            // Kiểm tra trạng thái và trả về giá trị tương ứng với màu sắc
                            switch (status) {
                                case 0:
                                    statusText = "Chưa thanh toán"; // Trạng thái 2
                                    statusClass = 'bg-danger'; // Màu vàng
                                    break;
                                case 1:
                                    statusText = "Đã thanh toán"; // Trạng thái 3
                                    statusClass = 'bg-success'; // Màu xanh dương
                                    break;
                            }

                            // Trả về HTML với lớp CSS cho màu sắc
                            return gridjs.html(`<span class="badge ${statusClass}">${statusText}</span>`);
                        }
                    },

                ],
                data: othersData.map(phiphatsinhs => [
                    phiphatsinhs.id || '',
                    phiphatsinhs.name || '',
                    phiphatsinhs.booking_id || '',
                    phiphatsinhs.description || 'Không có mô tả',
                    phiphatsinhs.price || '',
                    phiphatsinhs.image ?
                    `<img src="/storage/${phiphatsinhs.image}" alt="Hình ảnh" style="width: 50px; height: 50px; object-fit: cover;">` :
                    'Không có hình ảnh',
                    phiphatsinhs.status,
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