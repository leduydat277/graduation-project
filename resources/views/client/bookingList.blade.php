@extends('client.layouts.master')

@section('title')
Danh sách đặt phòng
@endsection

@section('content')
<div class="container mt-5 position-relative" style="z-index: 1; display: flex; height: 100vh; margin-bottom: 40px">
    <div style="width: 1330px;  margin-top: 20px;">


        <!-- Bảng danh sách đặt phòng -->
        <div class="card shadow-sm position-relative" style="background-color: white; z-index: 2;">

            <h2 class="text-center mb-4 mt-3">Danh sách đặt phòng của bạn</h2>
            <div class="card-body">
                <table id="bookingListTable" class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">STT</th>
                            <th scope="col">Mã đặt phòng</th>
                            <th scope="col">Ngày đến</th>
                            <th scope="col">Ngày đi</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bookings->isEmpty())
                        <tr>
                            <th scope="col" colspan="7" class="text-danger">Không có dữ liệu</th>
                        </tr>
                        @else
                        @foreach ($bookings as $index => $item)
                        <tr>
                            <th scope="row" class="text-center">{{ $index + 1 }}</th>
                            <td>
                                <a class="text-info" style="text-decoration: underline"
                                    href="{{ route('client.detail_booking', ['bookingNumberId' => $item->booking_number_id]) }}">
                                    {{ $item->booking_number_id }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($item->check_in_date, 'Asia/Ho_Chi_Minh')->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($item->check_out_date, 'Asia/Ho_Chi_Minh')->format('d-m-Y') }}</td>
                            <td>{{ number_format($item->discount_price ?? 0) }} VNĐ</td>
                            <td>{{ $dataStatus[$item->status] }}</td>
                            <td>
                                <a href="{{ route('client.detail_booking', ['bookingNumberId' => $item->booking_number_id]) }}"
                                    class="btn btn-secondary btn-sm">Xem chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Ảnh nền dưới bảng -->
    <div class="background-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
        <div class="image-container" style="background-image: url('https://viadesign.vn/wp-content/uploads/2024/05/noi-that-khach-san-phong-ngu-3.jpg'); 
        background-size: cover; 
        background-position: center; 
        height: 100%; 
        filter: blur(3px); /* Thêm hiệu ứng mờ cho ảnh */
        transform: scale(1.1);
    ">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bookingListTable').DataTable({
            language: {
                lengthMenu: "Hiển thị _MENU_ mục",
                zeroRecords: "Không tìm thấy dữ liệu",
                info: "Hiển thị _PAGE_ trên _PAGES_ trang",
                infoEmpty: "Không có dữ liệu",
                infoFiltered: "(lọc từ _MAX_ mục)",
                search: "Tìm kiếm:",
                paginate: {
                    first: "Đầu",
                    last: "Cuối",
                    next: "Tiếp",
                    previous: "Trước"
                }
            },
            order: [
                [2, 'desc']
            ], // Sắp xếp mặc định theo cột "Ngày đặt" giảm dần
            columnDefs: [{
                    targets: 0,
                    orderable: false
                }, // Cột STT không cho phép sắp xếp
                {
                    targets: 1,
                    searchable: true
                }, // Cột Mã đặt phòng có thể tìm kiếm
                {
                    targets: [3, 4, 5],
                    searchable: true
                } // Tìm kiếm các cột "Loại phòng", "Giá phòng", "Trạng thái"
            ],
            pageLength: 10 // Hiển thị 10 dòng mỗi trang
        });
    });
</script>
@endpush