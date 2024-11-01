@extends('layouts.admin')
@section('title')
List Payments
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


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">List Payments</h5>
                    </div>
                    <div class="card-body">
                        <div class="form row">
                        <!-- FROM LỌC THEO NGÀY -->
                        <form class="col-9" id="date-filter-form" action="javascript:void(0);">
                            <div class="row g-3 mb-3 align-items-center">
                                <div class="col-sm-auto">
                                    <div class="input-group">
                                        <input type="text" id="date-range-input" class="form-control border-0 dash-filter-picker shadow" placeholder="Chọn khoảng thời gian" data-provider="flatpickr">
                                        <div class="input-group-text bg-primary border-primary text-white">
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                </div>
                            </div>
                        </form>
                        <form class="col-3" id="export-excel-form" action="javascript:void(0);">
                            <button type="submit" class="btn btn-success">Xuất file Excel</button>
                        </form>
                        </div>
                        <!-- END FROM -->
                        <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Booking ID</th>
                                    <th>Account</th>
                                    <th>Code</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="payment-tbody">
                                @foreach($payments as $key => $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->booking_id }}</td>
                                    <td>alo {{ $payment->booking->user->name}}</td>
                                    <td>{{ $payment->code }}</td>
                                    <td>{{ $payment->amount }}vnđ</td>
                                    <td><?= ($payment->payment_method == 1) ? 'Tiền mặt' : 'Chuyển khoản' ?></td>
                                    <td>{{ $payment->payment_date }}</td>
                                    <td><span style="color: <?= $payment->status->color ?>;" class="badge bg-info-subtle">{{ $payment->status->name }}</span></td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{route('payment.show',$payment->id)}}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> See Detail</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<!-- JS FORM LỌC -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo flatpickr với chế độ chọn khoảng thời gian
        flatpickr('#date-range-input', {
            mode: 'range',
            dateFormat: 'Y-m-d', // Định dạng ngày để dễ xử lý với JavaScript
        });

        // Xử lý sự kiện submit của form để lọc dữ liệu
        document.getElementById('date-filter-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const dateRange = document.getElementById('date-range-input').value.split(' to ');

            // Kiểm tra nếu người dùng chọn đủ 2 ngày
            if (dateRange.length === 2) {
                const startDate = new Date(dateRange[0]);
                const endDate = new Date(dateRange[1]);

                // Lấy tất cả các hàng trong bảng
                const rows = document.querySelectorAll('#payment-tbody tr');
                rows.forEach(row => {
                    const paymentDate = new Date(row.querySelector('td:nth-child(7)').innerText.trim());

                    // Kiểm tra xem payment_date có nằm trong khoảng đã chọn không
                    if (paymentDate >= startDate && paymentDate <= endDate) {
                        row.style.display = ''; // Hiển thị hàng nếu nằm trong khoảng
                    } else {
                        row.style.display = 'none'; // Ẩn hàng nếu không nằm trong khoảng
                    }
                });
            } else {
                alert('Vui lòng chọn khoảng thời gian hợp lệ.');
            }
        });
    });

// <!-- END JS FORM LỌC -->

// <!-- js để xuất file Excel -->
    document.getElementById('export-excel-form').addEventListener('submit', function(event) {
        event.preventDefault();
        // Lấy dữ liệu từ bảng
        var table = document.getElementById('model-datatables');
        var wb = XLSX.utils.table_to_book(table, { sheet: "Payments" });

        // Xuất file Excel
        XLSX.writeFile(wb, 'DanhSachThanhToan.xlsx');
    });
    </script>
<!--end js để xuất file Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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

<script src="{{ asset('assets/admin/assets/js/pages/datatables.init.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>




@endsection