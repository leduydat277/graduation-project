<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Thanh Toán #{{ $payment->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .section-content {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col {
            flex: 1;
            padding: 5px;
        }

        .text-danger {
            color: #dc3545;
        }

        .badge {
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            color: #fff;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-warning {
            background-color: #ffc107;
        }

        .bg-info {
            background-color: #17a2b8;
        }

        .bg-danger {
            background-color: #dc3545;
        }
    </style>
</head>

<body>

    <div class="title">Hóa đơn Thanh Toán</div>

    <!-- Thông tin thanh toán -->
    <div class="section">
        <div class="section-title">Thông Tin Thanh Toán</div>
        <div class="section-content">
            <div class="row">
                <div class="col"><strong>Ngày Thanh Toán:</strong>
                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</div>
            </div>
            <div class="row">
                <div class="col"><strong>Tổng Số Tiền:</strong> <span
                        class="text-danger">{{ number_format($payment->total_price) }} VNĐ</span></div>
                <div class="col"><strong>Phương Thức Thanh Toán:</strong>
                    {{ $payment->payment_method == 1 ? 'Tiền mặt' : 'Chuyển khoản' }}</div>
                <div class="col"><strong>Trạng Thái Thanh Toán:</strong> <span
                        class="badge {{ $payment->payment_status == 1 ? 'bg-success' : 'bg-warning' }}">{{ $payment->payment_status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông tin đặt phòng -->
    <div class="section">
        <div class="section-title">Thông Tin Đặt Phòng</div>
        <div class="section-content">
            <div class="row">
                <div class="col"><strong>Người Đặt Phòng:</strong> {{ $payment->booking->user->name ?? 'N/A' }}</div>
                <div class="col"><strong>Ngày đến:</strong>
                    {{ \Carbon\Carbon::parse($payment->booking->check_in_date)->format('d-m-Y') }}</div>
                <div class="col"><strong>Ngày đi:</strong>
                    {{ \Carbon\Carbon::parse($payment->booking->check_out_date)->format('d-m-Y') }}</div>
            </div>
            <div class="row">
                <div class="col"><strong>Tổng Số Tiền Đặt Phòng:</strong> <span
                        class="text-danger">{{ number_format($payment->booking->total_price) }} VNĐ</span></div>
                <div class="col"><strong>Số Tiền Cọc:</strong> {{ number_format($payment->booking->tien_coc) }} VNĐ
                </div>
                <div class="col"><strong>Trạng Thái Đặt Phòng:</strong> <span
                        class="badge {{ $payment->booking->status == 1 ? 'bg-info' : 'bg-danger' }}">{{ $payment->booking->status == 1 ? 'Đang sử dụng' : 'Đã hủy' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông tin phòng -->
    <div class="section">
        <div class="section-title">Thông Tin Phòng</div>
        <div class="section-content">
            <div class="row">
                <div class="col"><strong>Tên Phòng:</strong> {{ $payment->booking->room->title ?? 'N/A' }}</div>
                <div class="col"><strong>Loại Phòng:</strong> {{ $payment->booking->room->roomType->type ?? 'N/A' }}
                </div>
            </div>
            <div class="row">
                <div class="col"><strong>Giá Mỗi Đêm:</strong> <span
                        class="text-danger">{{ number_format($payment->booking->room->price ?? 0) }} VNĐ</span></div>
                <div class="col"><strong>Sức Chứa:</strong> {{ $payment->booking->room->max_people ?? 'N/A' }} người
                </div>
            </div>
        </div>
    </div>

</body>

</html>
