@extends('client.layouts.master')

@section('title')
    Chi tiết lịch sử thanh toán
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div style="width: 1330px">
            <!-- Pills content -->
            <div class="tab-content">
                <h4>Chi tiết lịch sử thanh toán của bạn</h4>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $dataBooking->booking_number_id }}</td>
                                <td>{{ $dataBooking->code_check_in }}</td>
                                <td>{{ date('d/m/Y', $dataBooking->check_in_date) }}</td>
                                <td>{{ date('d/m/Y', $dataBooking->check_out_date) }}</td>
                                <td>{{ number_format($dataBooking->total_price) }}</td>
                                <td>{{ number_format($dataBooking->tien_coc) }}</td>
                                <td>{{ $dataBooking->room->roomId_number }}</td>
                                <td>{{ $dataStatus[$dataBooking->status]}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
@endsection
