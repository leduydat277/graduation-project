@extends('admin.layouts.admin')
@section('title')
{{ $title }}
@endsection
@section('css')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!--datatable css-->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <!-- Modal checkin -->
    <div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="checkinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkinModalLabel">Thêm thông tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="checkinForm" action="{{route('checkin-checkout.checkin',$booking->id)}}" method="post">
                        @csrf
                        <!-- Form fields -->
                        <div class="mb-3">
                            <label for="checkInDate" class="form-label">CCCD</label>
                            <input type="number" name="cccd" class="form-control" id="cccd"
                                placeholder="nhập số cccd" required>
                        </div>
                        <div class="mb-3">
                            <label for="checkInDate" class="form-label">Mã nhận phòng</label>
                            <input type="text" name="code" class="form-control" id="code"
                                placeholder="nhập code của bạn" required>
                        </div>
                        <div id="error-message" class="text-danger"></div> 
                        <!-- You can add more fields if needed -->
                        <button type="submit" class="btn btn-primary">Xác nhận nhận phòng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




        <!-- Booking Details -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary ">
                        <h5 class="mb-0 text-white">Thông tin đặt phòng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Booking Info -->
                            <div class="col-md-6">
                                <h6 class="text-muted">Thông tin đơn hàng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Mã Đơn:</strong> <span class="text-primary">{{ $booking->booking_number_id }}</span></p>
                                    <p><strong>Loại phòng:</strong> {{ $booking->room->roomType->type ?? 'Không rõ' }}</p>
                                    <p><strong>Tên Phòng:</strong> {{ $booking->room->title }}</p>
                                    <p><strong>Tổng tiền:</strong>
                                        <span
                                            class="badge bg-success fs-6">{{ number_format($booking->total_price, 0, ',', '.') }}đ</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="col-md-6">
                                <h6 class="text-muted">Thông tin khách hàng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Tên khách hàng:</strong> {{ $booking->first_name }}
                                        {{ $booking->last_name }}</p>
                                    <p><strong>Email:</strong> {{ $booking->email }}</p>
                                    <p><strong>Số điện thoại:</strong> {{ $booking->phone }}</p>
                                    <p><strong>Địa chỉ:</strong> {{ $booking->address }}</p>
                                    <p><strong>CCCD:</strong> {{ $booking->CCCD_booking ?? 'Không rõ' }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                            $checkInDate = date('d-m-Y', $booking->check_in_date);
                            $checkOutDate = date('d-m-Y', $booking->check_out_date);
                            $TimeDate = date('H:i d-m-Y', $booking->created_at);
 
                            $checkInTimestamp = strtotime($checkInDate);
                            $checkOutTimestamp = strtotime($checkOutDate);

                            $numberOfNights = ($checkOutTimestamp - $checkInTimestamp) / (60 * 60 * 24);
                        @endphp

                        <!-- Booking Summary -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Chi tiết đặt phòng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Thời gian đặt:</strong> {{ $TimeDate }}</p>
                                    <p><strong>Ngày đến:</strong> {{ $checkInDate }}</p>
                                    <p><strong>Ngày đi:</strong> {{ $checkOutDate }}</p>
                                    <p><strong>Số đêm ở:</strong> {{ $numberOfNights }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Trạng thái đơn hàng</h6>
                                <div class="border rounded p-3 mb-3">
                                    <p><strong>Tiền cọc:</strong>
                                        <span
                                            class="badge bg-warning fs-6">{{ number_format($booking->tien_coc, 0, ',', '.') }}đ</span>
                                    </p>
                                    <p><strong>Trạng thái:</strong>
                                        @switch($booking->status)
                                            @case(0)
                                                <span class="badge bg-warning">chưa thanh toán</span>
                                            @break

                                            @case(1)
                                                <span class="badge bg-warning">Đang thanh toán</span>
                                            @break

                                            @case(2)
                                                <span class="badge bg-success">Đã thanh toán tiền cọc</span>
                                            @break

                                            @case(3)
                                                <span class="badge bg-success">Đã thanh toán tổng tiền đơn</span>
                                            @break

                                            @case(4)
                                                <span class="badge bg-info">Đang sử dụng</span>
                                            @break

                                            @case(5)
                                                <span class="badge bg-danger">Đã hủy</span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">Không rõ</span>
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                            @if(in_array($booking->status, [1, 2]))
                            <button class="btn btn-success w-25" data-bs-toggle="modal" data-bs-target="#checkinModal" type="submit">CheckIn</button>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('checkin-checkout.index') }}" class="btn btn-secondary me-2">
                                <i class="ri-arrow-go-back-line align-bottom"></i> Quay lại
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.getElementById('checkinForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var cccd = document.getElementById('cccd').value;
    var code = document.getElementById('code').value;
    var errorMessage = document.getElementById('error-message');
    errorMessage.innerHTML = '';
    var validCode = "{{$booking->code_check_in}}";
    if (code !== validCode) {
        errorMessage.innerHTML += 'Mã nhận phòng không đúng';
    }
    if (errorMessage.innerHTML === '') {
        this.submit(); 
    }
});

</script>

@endsection
@section('js')
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endsection
