<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="fw-bold">Đặt lại mật khẩu</h2>
                    </div>
                    <div class="card-body">
                        <p class="fs-5">Xin chào,</p>
                        <p class="mb-4">Bạn đã yêu cầu đặt lại mật khẩu. Nhấn vào nút bên dưới để đặt lại mật khẩu:</p>
                        <div class="text-center mb-4">
                            <a href="{{ $resetLink }}" class="btn btn-primary btn-lg px-4 py-2">Đặt lại mật khẩu</a>
                        </div>
                        <p class="text-muted">Lưu ý: Liên kết này sẽ hết hạn sau <strong>5 phút</strong>.</p>
                        <hr>
                        <p class="text-muted">Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
                        <p class="text-muted">Trân trọng,<br>Đội ngũ hỗ trợ của chúng tôi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
