<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            color: #1f2937;
            font-size: 26px;
            margin-bottom: 15px;
            text-align: center;
        }

        p {
            color: #4b5563;
            line-height: 1.6;
            margin: 10px 0;
        }

        strong {
            color: #1f2937;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            padding: 15px;
            background-color: #f1f5f9;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }

        .footer a {
            color: #1f2937;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Xin chào, {{ $name }}</h1>
        <p>Mã check-in của bạn là: <strong>{{ $checkin_code }}</strong></p>
        <p>Ngày đến: <strong>{{ $check_in_date }}</strong></p>
        <p>Ngày đi: <strong>{{ $check_out_date }}</strong></p>
        <p>Cảm ơn bạn đã chọn khách sạn của chúng tôi!</p>

        <div class="footer">
            <p>Chúc bạn có một ngày tuyệt vời!</p>
            <p>Liên hệ với chúng tôi qua email: <strong><a
                        href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a></strong>
            </p>
        </div>
    </div>
</body>

</html>
