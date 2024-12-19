@extends('client.layouts.master')

@section('title')
    Danh sách đặt phòng
@endsection

@section('content')
    <div class="d-flex justify-content-center" style="padding-bottom: 400px; padding-top: 50px">
        <div style="width: 1330px">
            <!-- Pills content -->
            <div class="tab-content">
                <h2 style="padding-bottom: 20px">Danh sách đặt phòng của bạn</h2>
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <table id="bookingListTable" class="table table-striped table-bordered">
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
                                        <td>{{ \Carbon\Carbon::createFromTimestamp($item->check_in_date, 'Asia/Ho_Chi_Minh')->format('d-m-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp($item->check_out_date, 'Asia/Ho_Chi_Minh')->format('d-m-Y') }}
                                        </td>
                                        <td>{{ number_format($item->discount_price ?? 0) }} VNĐ</td>
                                        <td>{{ $dataStatus[$item->status] }}</td>
                                        <td>
                                            <a href="{{ route('client.detail_booking', ['bookingNumberId' => $item->booking_number_id]) }}"
                                                class="btn btn-info btn-sm">Xem chi tiết</a>
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
