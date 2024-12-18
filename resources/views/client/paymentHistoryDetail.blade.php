@extends('client.layouts.master')

@section('title')
    Chi tiết lịch sử thanh toán
@endsection

@section('content')
    <div class="d-flex justify-content-center" style="padding-bottom: 400px; padding-top: 50px">
        <div style="width: 100%" class="mx-5">
            <!-- Pills content -->
            <div class="tab-content">
                <h2 style="padding-bottom: 20px">Chi tiết lịch sử thanh toán</h2>
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Mã checkin</th>
                                <th scope="col">Thời gian đến</th>
                                <th scope="col">Thời gian đi</th>
                                <th scope="col">Tổng số tiền</th>
                                <th scope="col">Số tiền cọc</th>
                                <th scope="col">Mã phòng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $dataBooking->booking_number_id }}</td>
                                <td>{{ $dataBooking->code_check_in }}</td>
                                <td>{{ date('d/m/Y', $dataBooking->check_in_date) }} (14:00)</td>
                                <td>{{ date('d/m/Y', $dataBooking->check_out_date) }} (12:00)</td>
                                <td>{{ number_format($dataBooking->total_price) }}</td>
                                <td>{{ number_format($dataBooking->tien_coc) }}</td>
                                <td>{{ $dataBooking->room->roomId_number }}</td>
                                <td>{{ $dataStatus[$dataBooking->status] }}</td>
                                <td>
                                    @if ($dataBooking->status == 2 || $dataBooking->status == 3)
                                        <!-- Nút hủy phòng -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmCancelModal">
                                            Hủy phòng
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>


    
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
