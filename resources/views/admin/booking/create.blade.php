@extends('admin.layouts.admin')
@section('title')
    Đặt phòng
@endsection
@section('css')
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
@endsection
@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <h2 class="text-center">Đặt phòng</h2>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <form action="{{ route('adminBooking.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="room_type" class="form-label">Loại phòng</label>
                        <select class="form-select" name="room_type" id="room_type">
                            <option selected disabled value="">Chọn loại phòng</option>
                            @foreach ($dataRoomType as $item)
                                <option value="{{ $item->id }}" {{ old('room_type') == $item->id ? 'selected' : '' }}>
                                    {{ $item->type }}</option>
                            @endforeach
                        </select>
                        <span id="err_room_type" class="text-danger">
                            @error('room_type')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="check_in_date" class="form-label">Ngày đến</label>
                        <input type="date" class="form-control" id="check_in_date" name="check_in_date"
                            value="{{ old('check_in_date') }}" placeholder="Nhập ngày đến">
                        <span id="err_check_in_date" class="text-danger">
                            @error('check_in_date')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="check_out_date" class="form-label">Ngày đi</label>
                        <input type="date" class="form-control" id="check_out_date" name="check_out_date"
                            value="{{ old('check_out_date') }}" placeholder="Nhập ngày đến">
                        <span id="err_check_out_date" class="text-danger">
                            @error('check_out_date')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="max_people" class="form-label">Số lượng người</label>
                        <input type="number" class="form-control" id="max_people" name="max_people"
                            value="{{ old('max_people') }}" placeholder="Số lượng người">
                        <span class="text-danger" id="err_max_people">
                            @error('max_people')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="room_id" class="form-label">Phòng</label>
                        <select class="form-select" name="room_id" id="room_id">
                            <option selected disabled>Chọn phòng</option>
                            <!-- Thêm logic đổ dữ liệu vào đây nếu cần -->
                        </select>
                        @error('room_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total_price" class="form-label">Tổng giá</label>
                        <input type="text" class="form-control" id="total_price" name="total_price" disabled value="{{ old('total_price') }}">
                        @error('total_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="CCCD" class="form-label">CCCD</label>
                        <input type="number" class="form-control" id="CCCD" name="CCCD" placeholder="Nhập CCCD"
                            value="{{ old('CCCD') }}">
                        @error('CCCD')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Nhập email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Các phần tử cần lấy từ DOM
        const roomSelect = document.getElementById("room_id");
        const roomType = document.getElementById("room_type");
        const checkInDate = document.getElementById("check_in_date");
        const checkOutDate = document.getElementById("check_out_date");
        const err_check_out_date = document.getElementById("err_check_out_date");
        const maxPeople = document.getElementById("max_people");

        function fetchRooms() {
            const valueRoomType = roomType.value;
            const valueCheckInDate = checkInDate.value;
            const valueCheckOutDate = checkOutDate.value;
            const valueMaxPeople = maxPeople.value;

            // Kiểm tra ngày
            err_check_out_date.innerHTML = "";
            if (new Date(valueCheckInDate) >= new Date(valueCheckOutDate)) {
                err_check_out_date.innerHTML = "Ngày nhận phòng phải nhỏ hơn ngày trả phòng.";
                return; // Ngừng thực hiện nếu ngày không hợp lệ
            }

            // Tạo URL với các tham số truy vấn
            const url = new URL("/api/rooms/bookings", window.location.origin);
            url.searchParams.append("room_type_id", valueRoomType);
            url.searchParams.append("check_in_date", valueCheckInDate);
            url.searchParams.append("check_out_date", valueCheckOutDate);
            url.searchParams.append("max_people", valueMaxPeople);

            // Gửi yêu cầu fetch tới API
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    // Xóa các tùy chọn hiện có
                    roomSelect.innerHTML = '<option selected disabled>Chọn phòng</option>';
                    // Tính toán tổng giá
                    let totalPrice = 0;
                    data.forEach(room => {
                        const option = document.createElement("option");
                        option.value = room.id;
                        const price = room.price;
                        const priceFormat = price.toLocaleString();
                        option.textContent =
                            `${room.title} - Giá: ${priceFormat} - Tối đa: ${room.max_people} người`;
                        roomSelect.appendChild(option);
                    });

                })
                .catch(err => {
                    console.error("Lỗi khi lấy danh sách phòng:", err);
                });
        }

        // Gọi hàm fetchRooms khi người dùng thay đổi các trường đầu vào
        roomType.addEventListener("change", fetchRooms);
        checkInDate.addEventListener("change", fetchRooms);
        checkOutDate.addEventListener("change", fetchRooms);
        maxPeople.addEventListener("input", fetchRooms);
        roomSelect.addEventListener("change", (e) => {
            const selectedOption = e.target.selectedOptions[0]; // Lấy option đã chọn
            const text = selectedOption.textContent; // Lấy nội dung văn bản của option
            const match = text.match(/Giá:\s?([\d,]+)/);
            const price = parseInt(match[1].replace(/,/g, ''));
            const valueCheckInDate = checkInDate.value;
            const valueCheckOutDate = checkOutDate.value;
            const valueMaxPeople = parseInt(maxPeople.value);
            const matchMaxPeople = text.match(/Tối đa:\s?(\d+)/);
            const maxPeopleDefault = parseInt(matchMaxPeople[1]);

            const err_max_people = document.getElementById('err_max_people');
            err_max_people.innerHTML = "";
            if(valueMaxPeople > maxPeopleDefault){
                err_max_people.innerHTML = "Số lượng người quá lớn";
            }

            // Tính số ngày lưu trú
            const checkIn = new Date(valueCheckInDate);
            const checkOut = new Date(valueCheckOutDate);
            const days = (checkOut - checkIn) / (1000 * 3600 * 24); // Tính số ngày
            const totalPriceForRoom = price * days * valueMaxPeople;
            // Cập nhật giá tổng vào trường total_price
            const totalPriceInput = document.getElementById("total_price");
            totalPriceInput.value = totalPriceForRoom.toLocaleString(); // Hiển thị dưới dạng tiền tệ
        });
    </script>

    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
