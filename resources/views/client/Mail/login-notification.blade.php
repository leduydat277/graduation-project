<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo đăng nhập</title>
</head>
<body>
    <h2>Chào mường :  {{ $user->name }} đến với SleepHotel</h2>
    <p>Bạn đã đăng nhập vào hệ thống SleepHotel thành công vào lúc {{ $loginTime }}.</p>
    <p>Bạn có thể đọc qua điều khoản của chúng tôi: </p>
    <div class="text-center mb-4">
        <a href="{{ $policylink }}" class="btn btn-primary btn-lg px-4 py-2">Xem ngay</a>
    </div>
    <p>Bạn có thể đặt phòng ngay:  </p>
    <div class="text-center mb-4">
        <a href="{{ $homelink }}" class="btn btn-primary btn-lg px-4 py-2">Đặt ngay</a>
    </div>
    <p>Nếu đây không phải là bạn, vui lòng liên hệ với chúng tôi ngay lập tức để đảm bảo an toàn cho tài khoản của bạn.</p>
    <p>Trân trọng,<br>Đội ngũ SleepHotel</p>
</body>
</html>
