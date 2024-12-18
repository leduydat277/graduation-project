@extends('client.layouts.master')

@section('title')
    Lịch sử thanh toán
@endsection

@section('content')
    <div class="d-flex justify-content-center" style="padding-bottom: 400px; padding-top: 50px">
        <div style="width: 1330px">
            <!-- Pills content -->
            <div class="tab-content">
                <h2 style="padding-bottom: 20px">Lịch sử thanh toán của bạn</h2>
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <table id="paymentHistoryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">STT</th>
                                <th scope="col">Mã hóa đơn</th>
                                <th scope="col">Ngày thanh toán</th>
                                <th scope="col">Số tiền</th>
                                <th scope="col">Loại thanh toán</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$dataPayment)
                                <tr>
                                    <th scope="col" colspan="6" class="text-danger">Không có dữ liệu</th>
                                </tr>
                            @else
                                @foreach ($dataPayment as $index => $item)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $index + 1 }}</th>
                                        <td>
                                            <a class="text-info" style="text-decoration: underline" href="{{ route('paymentHistoryDetail', $item->id) }}">
                                                {{ $item->payments_id_number }} 
                                            </a>
                                        </td>
                                        <td>{{ date('d/m/Y H:i:s', $item->payment_date) }}</td>
                                        <td>{{ number_format($item->total_price) }} VNĐ</td>
                                        <td>{{ $item->payment_method == 1 ? 'Chuyển khoản' : 'Tiền mặt' }}</td>
                                        <td>{{ $dataStatus[$item->payment_status] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#paymentHistoryTable').DataTable({
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
                order: [[2, 'desc']], // Sắp xếp mặc định theo cột "Ngày thanh toán" giảm dần
                columnDefs: [
                    { targets: 0, orderable: false }, // Cột STT không cho phép sắp xếp
                    { targets: 1, searchable: true }, // Cột Mã hóa đơn có thể tìm kiếm
                    { targets: [3, 4, 5], searchable: true } // Tìm kiếm các cột "Số tiền", "Loại thanh toán", "Trạng thái"
                ],
                pageLength: 10 // Hiển thị 10 dòng mỗi trang
            });
        });
    </script>
@endpush
    

