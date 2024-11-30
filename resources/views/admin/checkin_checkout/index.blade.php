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
                <h5 class="modal-title" id="checkinModalLabel">Khách Hàng Nhận phòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkinForm">
                    @csrf
                    <!-- Form fields -->
                    <input type="hidden" id="bookingId" name="bookingId">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Người dùng</label>
                        <input type="text" class="form-control" id="userName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Loại phòng</label>
                        <input type="text" class="form-control" id="roomType" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Thời gian đến</label>
                        <input type="text" class="form-control" id="checkInDate" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">CCCD</label>
                        <input type="number" name="cccd" class="form-control" id="cccd" placeholder="nhập số cccd" required>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Mã nhận phòng</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="nhập code của bạn" required>
                    </div>
                    <div id="error-message"></div>
                    <!-- You can add more fields if needed -->
                    <button type="submit" class="btn btn-primary">Xác nhận nhận phòng</button>
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
                <h5 class="modal-title" id="checkinModalLabel">Khách Hàng Trả Phòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="checkoutForm">
                    @csrf
                    <!-- Form fields -->
                    <input type="hidden" id="bookingId1" name="bookingId">
                    <input type="hidden" id="tiencu" name="tiencu">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Người dùng</label>
                        <input type="text" class="form-control" id="userName1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkoutDate" class="form-label">Ngày đi</label>
                        <input type="text" class="form-control" id="checkoutDate1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Phí phát sinh của bạn</label>
                        <div id="phiphatsinh-container"></div>
                    </div>
                    <div class="mb-3">
                        <label for="checkInDate" class="form-label">Số tiền nợ (tiền còn lại sau cọc và phí phát sinh)</label>
                        <input type="text" name="tienno" class="form-control" id="thanhtoan" readonly>
                    </div>
                    <div id="extraFeesContainer">
                    </div>
                    <button type="button" id="addFeeButton" class="btn btn-primary">+</button>
                    <!-- You can add more fields if needed -->
                    <div class="mt-3">
                        <label for="totalPrice" class="form-label">Tổng tiền cần thanh toán</label>
                        <input type="text" name="totalPrice" class="form-control" id="totalPrice" readonly>
                    </div> <br>
                    <button type="submit" class="btn btn-primary">Xác nhận trả phòng</button>
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
<!-- //bot thanh scroll ngang -->
<style>
    .gridjs-wrapper {
        overflow-x: auto;
        /* Cho phép cuộn ngang */
    }

    .gridjs-wrapper::-webkit-scrollbar {
        display: none;
        /* Ẩn thanh cuộn ngang trên Chrome, Edge, Safari */
    }
</style>
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
        newPpsInput.type = "text";  // Sử dụng "text" để dễ dàng định dạng tiền tệ
        newPpsInput.name = "pps[]";
        newPpsInput.classList.add("form-control");

        // Tạo trường Giá phát sinh
        const newPriceLabel = document.createElement("label");
        newPriceLabel.classList.add("form-label");
        newPriceLabel.textContent = "Giá phát sinh";
        const newPriceInput = document.createElement("input");
        newPriceInput.type = "text";  // Sử dụng "text" thay vì "number" để định dạng tiền tệ
        newPriceInput.name = "price[]";
        newPriceInput.classList.add("form-control", "price-input");
        
        // Định dạng giá trị ban đầu nếu cần
        newPriceInput.value = formatCurrency(0); // Mặc định giá là 0 VNĐ

        // Định dạng tiền tệ khi người dùng nhập
        newPriceInput.oninput = function(e) {
            let value = e.target.value.replace(/[^\d]/g, ""); // Loại bỏ các ký tự không phải số
            e.target.value = formatCurrency(value); // Định dạng lại giá trị nhập
            calculateTotal(); // Cập nhật tổng khi nhập liệu
        };

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

    function formatCurrency(value) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        }).format(value);
    }
    // Hàm tính tổng giá trị các ô Giá phát sinh
    function calculateTotal() {
        const paymentInput = document.getElementById('thanhtoan');
        const rawValue = paymentInput.value.replace(/[^0-9]/g, '');
        const priceInputs = document.querySelectorAll('.price-input');
        const no = parseFloat(rawValue) || rawValue;
        let total = no;
        document.getElementById("totalPrice").value = total; // Gán tổng vào ô "totalPrice"
        priceInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
        // document.getElementById("totalPrice").value = total; 
        document.getElementById("totalPrice").value = formatCurrency(total);
    }
    //end

    document.addEventListener("DOMContentLoaded", function() {
        calculateTotal();
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
                        name: "Ngày đến",
                        width: "150px", // Tăng chiều rộng để hiển thị thêm thông tin
                        formatter: (cell) => {
                            const date = new Date(cell * 1000); // Chuyển đổi từ timestamp sang Date
                            const formattedDate = date.toLocaleDateString("vi-VN"); // Định dạng ngày tháng
                            return `${formattedDate}`;
                        }
                    },
                    {
                        name: "Ngày đi",
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
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkinModal" onclick="openCheckinModal(${row.cells[0].data})">Check in</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exitModal" onclick="openCancelModal(${row.cells[0].data})">Hủy</button>
                `);
                                                } else {
                                                    return gridjs.html(`
                                    <button class="btn btn-success" onclick="alert('Chưa đến thời gian nhận phòng')">Check in</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exitModal" onclick="openCancelModal(${row.cells[0].data})">Hủy</button>
                                `);
                                                }
                            } else if (status === 4) {
                                return gridjs.html(`
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="openCheckoutModal(${row.cells[0].data})">Check out</button>
            `);
                            }

                            return '';
                        }
                    },

                ],
                data: bookingsData.map(booking => [
                    booking.booking_number_id,
                    booking.last_name+' '+booking.first_name,
                    booking.email,
                    booking.phone,
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
                modalMessage.textContent = "Chưa đến giờ nhận phòng. Vẫn hủy?";
            } else if (currentHour >= 21) {
                modalMessage.textContent = "Đã quá giờ nhận phòng. Hủy đơn?";
            } else {
                modalMessage.textContent = "Đang trong khoảng thời gian nhận phòng. Hủy đơn?";
            }
        } else {
            modalMessage.textContent = "Ngày nhận phòng không phải hôm nay. Vẫn hủy?";
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
        const now = new Date(); // Lấy thời gian hiện tại

        // Định dạng giờ:phút ngày/tháng/năm
        const hours = now.getHours().toString().padStart(2, '0'); // Giờ có 2 chữ số
        const minutes = now.getMinutes().toString().padStart(2, '0'); // Phút có 2 chữ số
        const day = now.getDate().toString().padStart(2, '0'); // Ngày có 2 chữ số
        const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Tháng có 2 chữ số (tháng bắt đầu từ 0)
        const year = now.getFullYear(); // Năm
        const formattedDate = `${hours}:${minutes} ${day}/${month}/${year}`;
        // Điền dữ liệu vào form
        document.getElementById('bookingId').value = booking.id;
        document.getElementById('userName').value = booking.user_name;
        document.getElementById('roomType').value = booking.room_type;
        document.getElementById('checkInDate').value = formattedDate;
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
        const phiphatsinhs = @json($phiphatsinhs).filter(p => p.booking_id === bookingId);
        document.getElementById('bookingId1').value = booking.id;
        document.getElementById('userName1').value = booking.user_name;
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}`;
        const phiphatsinhSum = phiphatsinhs.reduce((sum, item) => {
            return sum + (parseFloat(item.price) || 0);
        }, 0);
        const totalPayment = booking.total_price - booking.tien_coc + phiphatsinhSum;
        // Định dạng và hiển thị số tiền thanh toán trong input
        const paymentInput = document.getElementById('thanhtoan');
        paymentInput.value = formatCurrency(totalPayment);
        document.getElementById('checkoutDate1').value = formattedDate;
        document.getElementById('tiencu').value = (booking.tien_coc);

        calculateTotal();
        //thêm phí phát inh cứng
        const container = document.getElementById('phiphatsinh-container');

        // Tạo các input cho mỗi phí phát sinh
        phiphatsinhs.forEach((item, index) => {
            // Tạo div cho mỗi phí phát sinh
            const div = document.createElement('div');
            div.classList.add('mb-3');


            // Tạo input cho name
            const inputName = document.createElement('input');
            inputName.setAttribute('type', 'text');
            inputName.setAttribute('id', `phiphatsinh_name_${index}`);
            inputName.setAttribute('name', `phiphatsinhs[${index}][name]`);
            inputName.setAttribute('value', formatCurrency(item.price));
            inputName.classList.add('form-control');
            inputName.setAttribute('readonly', true); // Nếu bạn muốn input readonly

            // Tạo input cho price
            const inputPrice = document.createElement('input');
            inputPrice.setAttribute('type', 'number');
            inputPrice.setAttribute('id', `phiphatsinh_price_${index}`);
            inputPrice.setAttribute('name', `phiphatsinhs[${index}][price]`);
            inputPrice.setAttribute('value', item.price);
            inputPrice.classList.add('form-control');
            inputPrice.setAttribute('readonly', true); // Nếu bạn muốn input readonly

            // Thêm label và input vào div
            div.appendChild(inputName);
            div.appendChild(inputPrice);

            // Thêm div vào container
            container.appendChild(div);
        });
        //end thêm phí phát inh cứng
    }
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngừng hành động gửi form mặc định

        const form = this;
        const bookingId = document.getElementById('bookingId1').value;
        const paymentInput = document.getElementById('thanhtoan');
        const rawValue = paymentInput.value.replace(/[^0-9]/g, '');
        const priceInputs = document.querySelectorAll('.price-input');
        let total = 0;
        priceInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
        paymentInput.value = rawValue;
        const totalPrice = document.getElementById('totalPrice');
        totalPrice.value = Number(rawValue) + Number(total);
        const price = document.querySelectorAll('input[name="price[]"]');

// Lặp qua tất cả các input price[] và xử lý giá trị của từng input
price.forEach(function(input) {
    const formatPrice = input.value.replace(/[^0-9]/g, ''); // Loại bỏ ký tự không phải số
    input.value = formatPrice; // Cập nhật giá trị đã được làm sạch
});

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