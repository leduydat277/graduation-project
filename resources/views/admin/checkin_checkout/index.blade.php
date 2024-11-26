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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 flex-grow-1">Danh sách đơn đã TT</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="table-gridjs"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>

<!-- Modal checkin -->
<div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="checkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkinModalLabel">Check-in Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkinForm">
                    @csrf
                    <!-- Form fields -->
                    <input type="hidden" id="bookingId" name="bookingId">
                    <div class="mb-3">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="userName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Room Type</label>
                        <input type="text" class="form-control" id="roomType" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Check-in Date</label>
                        <input type="text" class="form-control" id="checkInDate" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">CCCD</label>
                        <input type="number" name="cccd" class="form-control" id="cccd" placeholder="nhập số cccd" required>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Code check-in</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="nhập code của bạn" required>
                    </div>
                    <div id="error-message"></div>
                    <!-- You can add more fields if needed -->
                    <button type="submit" class="btn btn-primary">Submit Check-in</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal checkout-->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkinModalLabel">Check-out Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm">
                    @csrf
                    <!-- Form fields -->
                    <input type="hidden" id="bookingId1" name="bookingId">
                    <input type="hidden" id="tiencu" name="tiencu">
                    <div class="mb-3">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="userName1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkoutDate" class="form-label">Check-out Date</label>
                        <input type="text" class="form-control" id="checkoutDate1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Số tiền nợ</label>
                        <input type="number" class="form-control" id="thanhtoan" readonly>
                    </div>
                    <div id="extraFeesContainer">
                    </div>
                    <button type="button" id="addFeeButton" class="btn btn-primary">+</button>
                    <!-- You can add more fields if needed -->
                    <div class="mt-3">
                        <label for="totalPrice" class="form-label">Tổng tiền cần thanh toán</label>
                        <input type="number" name="totalPrice" class="form-control" id="totalPrice" readonly>
                    </div> <br>
                    <button type="submit" class="btn btn-primary">Submit Check-out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal hủy -->
<div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exitModalLabel">Xác nhận hủy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form action="{{route('checkin-checkout.booking.cancel')}}" method="post">
                @csrf
                <div class="modal-body">
                    <p id="exitModalMessage"></p> <!-- Nội dung thông báo sẽ được thay đổi động -->
                    <input type="hidden" name="id" id="cancelItemId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                </div>
            </form>

            <!-- Modal Footer -->

        </div>
    </div>
</div>

@endsection
@section('js')

<script>
    document.getElementById("addFeeButton").addEventListener("click", function() {
        // Lấy tất cả các trường Phát sinh và Giá phát sinh hiện có
        const ppsInputs = document.querySelectorAll('input[name="pps[]"]');
        const priceInputs = document.querySelectorAll('input[name="price[]"]');

        // Kiểm tra nếu tất cả các trường đã điền
        let allFilled = true;
        ppsInputs.forEach(input => {
            if (input.value.trim() === "") {
                allFilled = false;
            }
        });
        priceInputs.forEach(input => {
            if (input.value.trim() === "") {
                allFilled = false;
            }
        });

        // Nếu tất cả các trường đã được điền thì cho phép thêm trường mới
        if (allFilled) {
            // Tạo một div chứa các trường phát sinh mới
            const newFeeDiv = document.createElement("div");
            newFeeDiv.classList.add("mb-3");

            // Tạo trường Phát sinh
            const newPpsLabel = document.createElement("label");
            newPpsLabel.classList.add("form-label");
            newPpsLabel.textContent = "Phát sinh";
            const newPpsInput = document.createElement("input");
            newPpsInput.type = "text";
            newPpsInput.name = "pps[]";
            newPpsInput.classList.add("form-control");

            // Tạo trường Giá phát sinh
            const newPriceLabel = document.createElement("label");
            newPriceLabel.classList.add("form-label");
            newPriceLabel.textContent = "Giá phát sinh";
            const newPriceInput = document.createElement("input");
            newPriceInput.type = "number";
            newPriceInput.name = "price[]";
            newPriceInput.classList.add("form-control", "price-input");
            newPriceInput.oninput = calculateTotal;
            const hr = document.createElement("hr");
            // Thêm các trường vào div mới
            newFeeDiv.appendChild(newPpsLabel);
            newFeeDiv.appendChild(newPpsInput);
            newFeeDiv.appendChild(newPriceLabel);
            newFeeDiv.appendChild(newPriceInput);
            newFeeDiv.appendChild(hr);
            // Thêm div mới vào container chính
            document.getElementById("extraFeesContainer").appendChild(newFeeDiv);
        } else {
            alert("Vui lòng nhập Phát sinh và Giá phát sinh trước khi thêm mục mới.");
        }
    });

    // Hàm tính tổng giá trị các ô Giá phát sinh
    function calculateTotal() {
        const priceInputs = document.querySelectorAll('.price-input');
        const no = parseFloat(document.getElementById('thanhtoan').value) || 0; // Lấy giá trị từ ô "thanhtoan" và chuyển thành số
        let total = no; // Khởi tạo total với giá trị từ "thanhtoan"

        priceInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value; // Cộng giá trị của mỗi ô "Giá phát sinh" vào tổng
            }
        });

        document.getElementById("totalPrice").value = total; // Gán tổng vào ô "totalPrice"
    }
    //end

    document.addEventListener("DOMContentLoaded", function() {
        const bookingsData = @json($bookings);

        if (document.getElementById("table-gridjs")) {
            new gridjs.Grid({
                columns: [{
                        name: "Mã đơn",
                        width: "70px"
                    },
                    {
                        name: "Người dùng",
                        width: "150px"
                    },
                    {
                        name: "Email",
                        width: "150px"
                    },
                    {
                        name: "SĐT",
                        width: "100px"
                    },
                    {
                        name: "Mã phòng",
                        width: "100px"
                    },
                    {
                        name: "Loại phòng",
                        width: "100px"
                    },
                    {
                        name: "Check-in",
                        width: "150px", // Tăng chiều rộng để hiển thị thêm thông tin
                        formatter: (cell) => {
                            const date = new Date(cell * 1000); // Chuyển đổi từ timestamp sang Date
                            const formattedDate = date.toLocaleDateString("vi-VN"); // Định dạng ngày tháng
                            return `${formattedDate}`;
                        }
                    },
                    {
                        name: "Check-out",
                        width: "100px",
                        formatter: (cell) => {
                            const date = new Date(cell * 1000);
                            return date.toLocaleDateString("vi-VN");
                        }
                    },
                    {
                        name: "Tổng tiền",
                        width: "100px",
                        formatter: (cell, row) => {
                            const totalPrice = row.cells[8].data; // Dữ liệu cột total_price
                            const formattedPrice = new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND',
                            }).format(totalPrice); // Định dạng VND
                            return gridjs.html(`<span>${formattedPrice}</span>`);
                        }
                    },
                    {
                        name: "Trạng thái",
                        width: "120px",
                        formatter: (cell, row) => {
                            const status = row.cells[9].data;
                            let statusText = '';
                            let statusClass = '';

                            // Kiểm tra trạng thái và trả về giá trị tương ứng với màu sắc
                            switch (status) {
                                case 2:
                                    statusText = "Đã thanh toán cọc"; // Trạng thái 2
                                    statusClass = 'bg-warning'; // Màu vàng
                                    break;
                                case 3:
                                    statusText = "Đã thanh toán tổng tiền đơn"; // Trạng thái 3
                                    statusClass = 'bg-primary'; // Màu xanh dương
                                    break;
                                case 4:
                                    statusText = "Đang sử dụng"; // Trạng thái 4
                                    statusClass = 'bg-success'; // Màu xanh lá
                                    break;
                                default:
                                    statusText = "Chưa xác định"; // Trạng thái mặc định
                                    statusClass = 'bg-secondary'; // Màu xám
                                    break;
                            }

                            // Trả về HTML với lớp CSS cho màu sắc
                            return gridjs.html(`<span class="badge ${statusClass}">${statusText}</span>`);
                        }
                    },
                    {
                        name: "Ngày đặt",
                        width: "100px",
                        formatter: (cell) => {
                            const date = new Date(cell * 1000); 
                            const hours = date.getHours(); 
                            const minutes = date.getMinutes(); 
                            const day = date.getDate(); 
                            const month = date.getMonth() + 1; 
                            const year = date.getFullYear();
                            return `${hours}h ${day}/${month}/${year}`;
                        }
                    },
                    {
                        name: "Tùy chọn",
                        width: "120px",
                        formatter: (cell, row) => {
                            const status = row.cells[9].data; // Trạng thái
                            const checkInDateTimestamp = row.cells[6].data; // Lấy check_in_date từ bảng (timestamp)
                            const checkInDate = new Date(checkInDateTimestamp * 1000); // Chuyển đổi sang Date
                            const today = new Date();
                            const currentHour = new Date().getHours();

                            // So sánh ngày hôm nay và ngày check_in_date
                            const isToday =
                                checkInDate.getDate() === today.getDate() &&
                                checkInDate.getMonth() === today.getMonth() &&
                                checkInDate.getFullYear() === today.getFullYear();

                            if (status === 2) {
                                if (isToday && currentHour >= 14) {
                                    return gridjs.html(`
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkinModal" onclick="openCheckinModal(${row.cells[0].data})">Check-in</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exitModal" onclick="openCancelModal(${row.cells[0].data})">Hủy</button>
                `);
                                } else {
                                    return gridjs.html(`
                    <button class="btn btn-success" onclick="alert('Chưa đến thời gian check-in')">Check-in</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exitModal" onclick="openCancelModal(${row.cells[0].data})">Hủy</button>
                `);
                                }
                            } else if (status === 4) {
                                return gridjs.html(`
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="openCheckoutModal(${row.cells[0].data})">Check-out</button>
            `);
                            }

                            return '';
                        }
                    },

                ],
                data: bookingsData.map(booking => [
                    booking.id,
                    booking.user_name,
                    booking.user_email,
                    booking.user_phone,
                    booking.room_id,
                    booking.room_type,
                    booking.check_in_date,
                    booking.check_out_date,
                    booking.total_price,
                    booking.status,
                    booking.created_at
                ]),
                pagination: {
                    limit: 10
                },
                sort: true,
                search: true
            }).render(document.getElementById("table-gridjs"));
        }
    });
    // end table

    // hủy
    function openCancelModal(id) {
        const booking = @json($bookings).find(b => b.id === id);
        const modalMessage = document.getElementById('exitModalMessage');
        const confirmButton = document.getElementById('confirmButton');
        const check_in_date = booking.check_in_date;

        // Chuyển đổi timestamp sang đối tượng Date
        const checkInDate = new Date(check_in_date * 1000); // Chuyển timestamp từ giây sang milliseconds

        // Lấy ngày hiện tại
        const today = new Date();

        // Kiểm tra xem check_in_date có cùng ngày với ngày hiện tại không
        const isSameDay = checkInDate.getDate() === today.getDate() &&
            checkInDate.getMonth() === today.getMonth() &&
            checkInDate.getFullYear() === today.getFullYear();
        if (isSameDay) {
            const now = new Date();
            const currentHour = now.getHours();
            if (currentHour < 12) {
                modalMessage.textContent = "Chưa đến giờ check-in. Vẫn hủy?";
            } else if (currentHour >= 21) {
                modalMessage.textContent = "Đã quá giờ check-in. Hủy đơn?";
            } else {
                modalMessage.textContent = "Đang trong khoảng thời gian check-in. Hủy đơn?";
            }
        } else {
            modalMessage.textContent = "Ngày check-in không phải hôm nay. Vẫn hủy?";
        }
        document.getElementById('cancelItemId').value = id;

    }

    function confirmCancel() {
        const id = document.getElementById('cancelItemId').value;
        const modal = bootstrap.Modal.getInstance(document.getElementById('exitModal'));
        modal.hide();
    }

    // end hủy
    //checkin
    function openCheckinModal(bookingId) {
        // Tìm booking tương ứng
        const booking = @json($bookings).find(b => b.id === bookingId);

        // Điền dữ liệu vào form
        document.getElementById('bookingId').value = booking.id;
        document.getElementById('userName').value = booking.user_name;
        document.getElementById('roomType').value = booking.room_type;
        document.getElementById('checkInDate').value = booking.check_in_date;
        window.booking = booking;
    }
    document.getElementById('checkinForm').addEventListener('submit', function(e) {
        const code = document.getElementById('code').value;
        const bookingCode = window.booking.code_check_in;
        if (code.trim() !== bookingCode.trim()) {
            alert('Mã Check in không đúng');
        } else {
            e.preventDefault();
            const form = this;
            const bookingId = document.getElementById('bookingId').value;
            form.action = '/admin/checkin-checkout/checkin/' + bookingId;
            form.method = 'POST';
            form.submit();
        }
    });
    //endcheckin

    //checkout
    function openCheckoutModal(bookingId) {
        const booking = @json($bookings).find(b => b.id === bookingId);
        document.getElementById('bookingId1').value = booking.id;
        document.getElementById('userName1').value = booking.user_name;
        document.getElementById('checkoutDate1').value = booking.check_out_date;
        document.getElementById('thanhtoan').value = (booking.total_price - booking.tien_coc);
        document.getElementById('tiencu').value = (booking.tien_coc);
    }
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngừng hành động gửi form mặc định

        const form = this;
        const bookingId = document.getElementById('bookingId1').value;
        form.action = '/admin/checkin-checkout/checkout/' + bookingId;
        form.method = 'POST';
        form.submit();
    });
    //endcheckout
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
<!-- <script src="{{ asset('assets/admin/assets/js/pages/gridjs.init.js') }}"></script> -->

<!-- App js -->
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>

@endsection