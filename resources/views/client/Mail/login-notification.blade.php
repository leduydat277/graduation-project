<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành công</title>
</head>

<body>
    <h2>Chào mừng {{ $user->name }} đến với SleepHotel!</h2>
    <p>Chúc mừng bạn đã đăng ký tài khoản thành công.</p>
    @if ($voucher)
        <p>Dưới đây là mã voucher chào mừng của bạn:</p>
        <h3 style="color: blue; font-weight: bold;">{{ $voucher->code_voucher }}</h3>
        <p>Giá trị:
            {{ $voucher->type === '%' ? $voucher->discount_value . '%' : number_format($voucher->discount_value) . ' VND' }}
        </p>
        <p>Đơn tối thiểu: {{ number_format($voucher->min_booking_amount) }} VND</p>
        <p>Hạn sử dụng đến: {{ date('d-m-Y', $voucher->end_date) }}</p>
    @else
        <p>Không có voucher khả dụng. Bạn vẫn có thể tận hưởng các dịch vụ tuyệt vời của chúng tôi!</p>
    @endif
    <p>Bạn có thể đọc qua điều khoản của chúng tôi:</p>
    <div class="text-center mb-4">
        <a href="{{ $policylink }}"
            style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Xem
            điều khoản</a>
    </div>
    <p>Hoặc bắt đầu trải nghiệm bằng cách đặt phòng ngay:</p>
    <div class="text-center mb-4">
        <a href="{{ $homelink }}"
            style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Đặt
            ngay</a>
    </div>
    <p>Trân trọng,<br>Đội ngũ SleepHotel</p>
</body>

</html>
