@extends('client.layouts.master')

@section('title')
    Lịch sử thanh toán
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div style="width: 1330px">
            <!-- Pills content -->
            <div class="tab-content">
                <h4>Lịch sử thanh toán của bạn</h4>
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <table class="table">
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
                            @endif
                            @foreach ($dataPayment as $index => $item)
                                <tr>
                                    <th scope="row" class="text-center">{{ $index + 1 }}</th> <!-- Tăng index bắt đầu từ 1 -->
                                    <td><a class="text-info" href="{{ route('client.detail_booking', $item->booking->booking_number_id) }}">{{ $item->payments_id_number }}</a></td>
                                    <td>{{ date('d/m/Y H:i:s', $item->payment_date) }}</td>
                                    <td>{{ number_format($item->total_price) }}</td>
                                    <td>{{ $item->payment_method == 1 ? 'Chuyển khoản' : 'Tiền mặt' }}</td>
                                    <td>{{ $dataStatus[$item->payment_status] }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
@endsection
