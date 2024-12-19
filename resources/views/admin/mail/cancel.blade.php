<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu hủy phòng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
            background-color: white;
            border-radius: 0 0 10px 10px;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
            margin-top: 20px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Yêu cầu hủy phòng được chấp nhận</h2>
        </div>
        <div class="content">
            <p>Chào <strong>{{ $name }}</strong>,</p>
            <p>Chúng tôi xin thông báo rằng yêu cầu hủy phòng của bạn đã được chấp nhận. Mã hoàn tiền của bạn là:</p>
            <p style="font-size: 24px; font-weight: bold;">
                <span class="badge">{{ $code_hoan_tien }}</span>
            </p>
            <p>Vui lòng giữ mã này để sử dụng khi hoàn tiền.</p>
            <p>Hãy liên hệ cho chúng tôi tại số Zalo: <strong>0336107429</strong> để nhận lại tiền.</p>
        </div>
        <div class="footer">
            <p>Trân trọng,</p>
            <p>Đội ngũ hỗ trợ khách hàng</p>
        </div>
    </div>
</body>

</html>
