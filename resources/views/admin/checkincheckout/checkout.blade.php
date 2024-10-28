@extends('layouts.admin')
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
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <h2 class="text-center">Check-Out Phòng</h2>
            <div class="row">
                <form id="checkOutForm" action="{{ route('admin.checkin-checkout.checkOutRequest', $booking->id) }}" method="POST"
                    enctype="multipart/form-data">
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

                    <!-- Chọn Phòng -->
                    <div class="mb-3">
                        <label for="roomSelect" class="form-label">Phòng</label>
                        <select class="form-select" name="room_id" id="roomSelect" disabled>
                            <option selected disabled>Chọn phòng</option>
                            {{-- @foreach ($booking->detailBooking as $detailBooking) --}}
                                
                                <option value="{{ $booking->detailBooking->first()->room->id }}" selected>
                                    Phòng {{ $booking->detailBooking->first()->room->number }} (Loại: {{ $detailBooking->room->roomType->type ?? 'Không có thông tin' }})
                                </option>
                            {{-- @endforeach --}}
                        </select>
                    </div>

                    <!-- Số lượng người thực tế -->
                    <div class="mb-3">
                        <label for="actualNumberPeople" class="form-label">Số Người Thực Tế</label>
                        <input type="number" class="form-control" id="actualNumberPeople" name="actual_number_people"
                            value="{{ old('actual_number_people', $booking->detailBooking->first()->actual_number_people ?? 1) }}"
                            disabled>
                    </div>

                    <!-- Địa chỉ (Chỉ hiển thị nếu cần thiết) -->
                    <div class="mb-3">
                        <label for="customerAddress" class="form-label">Địa chỉ</label>
                        <textarea class="form-control" id="customerAddress" name="address" rows="4" disabled>{{ old('address', $booking->user->address ?? '') }}</textarea>
                    </div>
                   
                    <!-- Nút Check-Out -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Check-Out</button>
                        <a href="{{ route('admin.checkin-checkout.index') }}" class="btn btn-danger">Quay lại danh sách</a>
                    </div>
                </form>
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
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#checkOutForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn form gửi theo cách truyền thống

                // Lấy dữ liệu từ form
                var formData = {
                    _token: '{{ csrf_token() }}', // Token CSRF Laravel yêu cầu
                };

                // Gửi yêu cầu AJAX
                $.ajax({
                    url: $(this).attr('action'), // URL của route từ form
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        $('#resultMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                    },
                    error: function(xhr) {
                        // Hiển thị thông báo lỗi
                        var errorMessage = xhr.responseJSON.message || 'Có lỗi xảy ra!';
                        $('#resultMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
                    }
                });
            });
        });
    </script>
@endsection