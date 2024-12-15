@extends('client.layouts.master')

@section('title')
    Quên mật khẩu
@endsection

@section('content')
    <style>
        .btn-primary {
            background: #FFE5CC;
            border: none;
        }

        .btn-primary:hover {
            background: #FFE5CC;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #FFE5CC;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #FFE5CC;
            box-shadow: 0 0 5px rgba(255, 229, 204, 0.5);
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .img-fluid {
            filter: drop-shadow(0 5px 10px rgba(255, 229, 204, 0.5));
            border-radius: 10px;
        }

        .alert {
            border-radius: 10px;
        }
    </style>

    <section class="vh-100" style="margin-top: 70px">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="forgotPasswordForm" method="POST" action="{{ route('client.sendMailForgotPassword') }}"
                        class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Quên Mật Khẩu</h2>
                            <p class="text-muted">Nhập email của bạn để đặt lại mật khẩu</p>
                        </div>

                        <!-- Success & Error Alerts -->
                        <div id="successMessage" class="alert alert-success d-none"></div>
                        <div id="errorMessage" class="alert alert-danger d-none"></div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email:</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Nhập địa chỉ email của bạn" />
                            <span class="text-danger" id="emailError"></span>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Gửi Yêu Cầu</button>
                        </div>
                    </form>

                    <!-- Link to Login -->
                    <p class="text-center mt-3">
                        <a href="{{ route('client.login') }}" class="text-primary">Quay lại trang đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#forgotPasswordForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn form gửi mặc định

                // Reset thông báo lỗi và thành công
                $('#emailError').text('');
                $('#successMessage').addClass('d-none').text('');
                $('#errorMessage').addClass('d-none').text('');

                // Thu thập dữ liệu từ form
                let formData = $(this).serialize();

                // Gửi dữ liệu qua Ajax
                $.ajax({
                    url: "{{ route('client.sendMailForgotPassword') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        $('#successMessage').removeClass('d-none').text('Yêu cầu đã được gửi thành công. Vui lòng kiểm tra email của bạn.');
                        $('#forgotPasswordForm')[0].reset(); // Reset form
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            console.log(errors);
                            
                            if (errors.email) {
                                $('#emailError').text("Không tìm thấy email này trong hệ thống."); // Hiển thị lỗi email
                            }
                        } else {
                            $('#errorMessage').removeClass('d-none').text('Đã xảy ra lỗi, vui lòng thử lại.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
