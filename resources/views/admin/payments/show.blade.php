@extends('layouts.admin')
@section('title')
Detail Payment {{$payment->id}}
@endsection
@section('css')
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

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
@endsection
@section('content')



<div class="card ">
    <div class="card-header">
        <h4 class="card-title mb-0">Thông tin của thanh toán</h4>
    </div><!-- end card header -->
    <div class="card-body">
        <div id="users">
            <div data-simplebar style="height: 500px;" class="mx-n3">
                <ul class="list list-group list-group-flush mb-0">
                    @foreach ($payment->booking->detailBookings as $detailBooking) <br>
                    <li class="list-group-item" data-id="4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h3 class="fs-13 mb-1"><a href="#" class="link name text-body">Room Type: {{ $detailBooking->roomType->type }}</a></h3>
                                <p class="born timestamp text-muted mb-0" data-timestamp="45678">Total price: {{$payment->booking->total_price}}VNĐ</p>
                                
                                <br> 
                                <p class="born timestamp text-muted mb-0" data-timestamp="45678">{{$detailBooking->roomType->price_per_night}}vnđ/1 night</p>
                                <p class="born timestamp text-muted mb-0" data-timestamp="45678">Actual Number People: {{$detailBooking->actual_number_people}}</p>
                                <p class="born timestamp text-muted mb-0" data-timestamp="45678">Check in: {{$payment->booking->check_in_date}}</p>
                                <p class="born timestamp text-muted mb-0" data-timestamp="45678">Check out: {{$payment->booking->check_out_date}}</p>

                            </div>
                            <div class=""d-flex">
                                <div>
                                    @foreach ($detailBooking->roomType->roomTypeImages as $image)
                                    <img class="image avatar-xl rounded-circle" src="{{ $image->image_url }}" alt="" >
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div><!-- end card body -->
</div>
<!-- end card -->


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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.js')}}"></script>
@endsection