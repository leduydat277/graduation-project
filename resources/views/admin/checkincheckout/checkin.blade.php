@extends('layouts.admin')
@section('title')
    {{ $title }}
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
            <h2 class="text-center">Check-In Phòng</h2>
            <div class="row">
                <form id="checkInForm" action="{{ route('admin.checkin-checkout.checkInRequest', $booking->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="resultMessage"></div>
                    <!-- Trường tên khách hàng -->
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Tên Khách Hàng</label>
                        <input type="text" class="form-control" id="customerName" name="customer_name"
                            value="{{ old('customer_name', $booking->user->name ?? '') }}" disabled>
                    </div>

                    <!-- Trường số điện thoại -->
                    <div class="mb-3">
                        <label for="customerTel" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="customerTel" name="tel"
                            value="{{ old('tel', $booking->user->phone ?? '') }}" disabled>
                    </div>

                    <!-- Trường CCCD -->
                    <div class="mb-3">
                        <label for="customerCCCD" class="form-label">Số CCCD</label>
                        <input type="text" class="form-control" id="customerCCCD" name="cccd"
                            value="{{ old('cccd', '') }}" placeholder="Nhập số CCCD" required>
                        @error('cccd')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="roomSelect" class="form-label">Chọn Phòng</label>
                        <select class="form-select" name="room_id" id="roomSelect" required>
                            <option selected disabled>Chọn phòng</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    Phòng {{ $room->number }} (Loại: {{ $room->roomType->type ?? 'Không có thông tin' }})
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="actualNumberPeople" class="form-label">Số Người Thực Tế</label>
                        <input type="number" class="form-control" id="actualNumberPeople" name="actual_number_people"
                            value="{{ old('actual_number_people', $booking->detailBooking->first()->actual_number_people ?? 1) }}"
                            required>
                        @error('actual_number_people')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Địa chỉ (Chỉ hiển thị nếu cần thiết) -->
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Địa chỉ</label>
                        <textarea class="form-control" id="customerAddress" name="address" rows="4" disabled>{{ old('address', $booking->user->address ?? '') }}</textarea>
                    </div>

                    <!-- Nút Check-In -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Check In</button>
                        <a href="{{ route('admin.checkin-checkout.index') }}" class="btn btn-danger">Quay lai danh sach</a>
                    </div>
                </form>

                <!-- Nơi để hiển thị thông báo -->


            </div>
        </div>
    </div>
@endsection
@section('js')
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var form = this.closest('.delete-form');
                var studentName = form.getAttribute('data-student-name');

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu của sinh viên " + studentName +
                        "!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Gửi form nếu người dùng xác nhận xóa
                    }
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#checkInForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn form gửi theo cách truyền thống

                // Lấy dữ liệu từ form
                var formData = {
                    _token: '{{ csrf_token() }}', // Token CSRF Laravel yêu cầu
                    cccd: $('#customerCCCD').val(),
                    room_id: $('#roomSelect').val(),
                    actual_number_people: $('#actualNumberPeople').val()
                };
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: $(this).attr('action'), // URL của route từ form
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        $('#resultMessage').html('<div class="alert alert-success">' + response
                            .message + '</div>');
                    },
                    error: function(xhr) {
                        // Hiển thị thông báo lỗi
                        var errorMessage = xhr.responseJSON.message || 'Có lỗi xảy ra!';
                        $('#resultMessage').html('<div class="alert alert-danger">' +
                            errorMessage + '</div>');
                    }
                });
            });
        });
    </script>
@endsection
