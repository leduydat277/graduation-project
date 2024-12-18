@extends('admin.layouts.admin')
@section('title')
    Danh sách đặt phòng
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
    <style>
        /* Tùy chỉnh các phần tử của phân trang */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 20px;
            text-align: center;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 4px;
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #f1f1f1;
            color: #333;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff;
            color: #fff;
        }

        /* Tùy chỉnh search input */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px 10px;
            margin-left: 10px;
            width: 250px;
        }

        /* Tùy chỉnh tiêu đề của các cột */
        .dataTables_wrapper .dataTables_filter label {
            font-weight: bold;
        }

        /* Tùy chỉnh wrapper của bảng */
        .dataTables_wrapper {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Tùy chỉnh giao diện của bảng */
        table.dataTable {
            width: 100% !important;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.dataTable thead {
            background-color: #f1f1f1;
        }

        table.dataTable thead th {
            padding: 10px;
            font-weight: bold;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }

        table.dataTable tbody td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        /* Tùy chỉnh giao diện khi không có dữ liệu */
        .dataTables_wrapper .dataTables_empty {
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #999;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="mt-3 mb-3 ms-3">
                <h4 class="card-title mb-0 flex-grow-1">Danh sách hủy phòng</h4>
            </div>
        </div>

        <!-- Booking Cancellation Table -->
        <div class="card">
            <!-- Hiển thị thông báo -->
            @if (session('success') || session('error'))
                <div class="col">
                    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show mb-0"
                        role="alert">
                        {{ session('success') ?? session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <label for="">Lọc theo</label>
                <select id="statusFilter" class="form-control">
                    <option value="">Tất cả</option>
                    <option value="pending">Đang chờ</option>
                    <option value="approved">Đã duyệt</option>
                    <option value="rejected">Bị từ chối</option>
                </select>
            </div>
            <div class="table-responsive">
                <table id="cancelBookingTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Mã Đặt Phòng</th>
                            <th>Lý do hủy</th>
                            <th>Mô tả</th>
                            <th>Ngày đặt</th>
                            <th>Ngày check-in</th>
                            <th>Ngày hủy</th>
                            <th>Hoàn tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
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
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $('#statusFilter').change(function() {
            $('#cancelBookingTable').DataTable().ajax.reload();
        });

        $('#cancelBookingTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('cancel.index') }}',
                data: function(d) {
                    d.status = $('#statusFilter').val();
                }
            },
            columns: [{
                    data: 'booking.booking_number_id',
                    name: 'booking_id'
                },
                {
                    data: 'reason',
                    name: 'reason'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'booking.created_at',
                    name: 'booking.created_at',
                    render: function(data, type, row) {
                        return new Date(data * 1000).toLocaleString('vi-VN', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                        });
                    }
                },
                {
                    data: 'booking.check_in_date',
                    name: 'booking.check_in_date',
                    render: function(data, type, row) {
                        return new Date(data * 1000).toLocaleString('vi-VN', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric'
                        });
                    }
                },
                {
                    data: 'cancelled_at',
                    name: 'cancelled_at',
                    render: function(data, type, row) {
                        return new Date(data * 1000).toLocaleString('vi-VN', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                        });
                    }
                },
                {
                    data: 'refund_badge',
                    name: 'refund',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'status_badge',
                    name: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'actions',
                    render: function(data, type, row) {
                        if (row.status !== 'approved') {
                            return `
                <a href="javascript:void(0);" class="btn btn-info btn-sm confirm-action" data-id="${data}" title="Xác nhận hoàn tiền">
                    <i class="fa-solid fa-check"></i>
                </a>`;
                        } else {
                            return '';
                        }
                    },
                    orderable: false,
                    searchable: false
                }

            ],
            dom: '<"top"f>rt<"bottom"lp><"clear">',
            language: {
                search: 'Tìm kiếm:',
                lengthMenu: 'Hiển thị _MENU_ mục mỗi trang',
                info: 'Hiển thị _START_ đến _END_ trong _TOTAL_ mục',
                paginate: {
                    previous: 'Trước',
                    next: 'Tiếp',
                }
            }
        });

        $(document).on('click', '.confirm-action', function() {
            var actionUrl = '/admin/cancel-booking/confirm/' + $(this).data('id');

            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Bạn sẽ chấp nhận hủy phòng cho đơn đặt phòng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, chấp nhận!',
                cancelButtonText: 'Hủy bỏ',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gửi yêu cầu POST đến server
                    $.post(actionUrl, {
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    }).done(function() {
                        window.location.href = '/admin/cancel-booking';
                    }).fail(function() {
                        Swal.fire({
                            title: 'Lỗi!',
                            text: 'Có lỗi xảy ra khi xử lý yêu cầu.',
                            icon: 'error'
                        });
                    });
                }
            });
        });
    </script>
@endsection
