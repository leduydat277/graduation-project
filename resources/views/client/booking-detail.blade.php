@extends('client.layouts.master')

@section('title')
    Chi tiết đặt phòng
@endsection

@section('content')
    @include('client.layouts.banner.banner')
    <section class="order-details-wrap padding-small">
        <div class="container-fluid padding-side">
            <div class="display-header d-flex justify-content-between pb-3">
                <h4 class="display-6 fw-normal my-3">Chi tiết đặt phòng</h4>
            </div>
            <div class="order-summary">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="customer-details">
                            <h5 class="mb-4">Thông tin khách hàng</h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Họ và tên: {{ $booking->last_name . ' ' . $booking->first_name }}</strong>
                                </li>
                                <li class="list-group-item"><strong>Email: {{ $booking->email }}</strong> </li>
                                <li class="list-group-item"><strong>Số điện thoại: {{ $booking->phone }}</strong></li>
                                <li class="list-group-item"><strong>Địa chỉ: {{ $booking->address }}</strong></li>
                                <li class="list-group-item"><strong>Ghi chú: {{ $booking->message }}</strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="order-details">
                            <h5 class="mb-4">Thông tin đặt phòng</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Phòng: {{ $booking->room->title }}</strong></li>
                                <li class="list-group-item">
                                    <strong>Ngày đến:
                                        {{ \Carbon\Carbon::createFromTimestamp($booking->check_in_date)->format('d-m-Y') }}
                                         (14:00)
                                    </strong>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ngày đi:
                                        {{ \Carbon\Carbon::createFromTimestamp($booking->check_out_date)->format('d-m-Y') }}
                                        (12:00)
                                    </strong>
                                </li>
                                <li class="list-group-item"><strong>Số lượng người: {{ $booking->adult }}</strong></li>
                                <li class="list-group-item">
                                    <strong>Tổng số ngày:
                                        {{ $totalDays }}
                                    </strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row g-5 mt-4">
                    <div class="col-lg-12">
                        <div class="payment-summary">
                            <h5 class="mb-4">Tóm tắt thanh toán</h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Tổng tiền gốc: {{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Giảm giá: {{ number_format($booking->discount_value, 0, ',', '.') }} VNĐ</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền sau giảm: {{ number_format($booking->discount_price, 0, ',', '.') }}
                                            VNĐ</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái đơn:
                                            @if ($booking->status === 0)
                                                Chưa thanh toán
                                            @elseif ($booking->status === 1)
                                                Đang thanh toán
                                            @elseif ($booking->status === 2)
                                                Đã thanh toán cọc
                                            @elseif ($booking->status === 3)
                                                Đã thanh toán tổng tiền
                                            @elseif ($booking->status === 4)
                                                Đang sử dụng
                                            @elseif ($booking->status === 5)
                                                Đã hủy
                                            @elseif ($booking->status === 6)
                                                Hoàn thành
                                            @else
                                                Chưa thanh toán
                                            @endif
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Hình thức thanh toán:
                                            @if ($payment->payment_method == 0)
                                                Tiền mặt
                                            @elseif ($payment->payment_method == 1)
                                                Chuyển khoản
                                            @else
                                                Không rõ
                                            @endif
                                        </th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Nút Hủy Đơn -->
                            @if ($booking->status != 5)
                                <button id="cancelOrderBtn" class="btn btn-danger mt-3">Hủy đơn hàng</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 text-center">
                        <a href="{{ route('client.home') }}" class="btn btn-primary">Trang chủ</a>
                        <a href="{{ route('paymentHistory') }}" class="btn btn-primary">Danh sách lịch sử thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="modal"></div>
@endsection
@section('js')
    <script type="module">
        $('#cancelOrderBtn').on('click', function() {
            let url = `{{ route('cancelBooking.index') }}`;
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(res) {
                    if (res.type == 'success') {
                        $('#modal').html(res.view);
                        $('#cancelReasonModal').modal('show');
                    }
                },
                error: function(e) {
                    notification(e.responseJSON.type, e.responseJSON.title, e.responseJSON
                        .content);
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#confirmBookingBtn', function(e) {
                e.preventDefault();

                var reasonId = $('#cancelReasonSelect').val();
                var description = $('#cancelReason').val();

                $.ajax({
                    url: '{{ route('cancelBooking.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        reason_id: reasonId,
                        description: description,
                        bookingId: '{{ $booking->id }}'
                    },
                    success: function(response) {
                        if (response.type == "success") {
                            toastr.success(response.message, 'Thành công', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('#cancelReasonModal').modal('hide');
                            window.location.reload();
                        } else {
                            var errors = response.message;
                            toastr.error(errors, 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('#cancelReasonModal').modal('hide');
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
@endsection
