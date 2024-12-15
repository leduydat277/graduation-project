@extends('client.layouts.master')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <style>
        .btn-primary {
            background: #FFE5CC;
            /* Thay đổi màu nền */
            border: none;
        }

        .btn-primary:hover {
            background: #FFE5CC;
            /* Giữ màu nền khi hover */
            color: #555;
            /* Màu chữ */
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .divider:after,
        .divider:before {
            content: '';
            flex: 1;
            height: 1px;
            background: #FFE5CC;
            /* Thay đổi màu divider */
        }

        .divider p {
            margin: 0 10px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #FFE5CC;
            /* Thay đổi màu border */
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #FFE5CC;
            /* Thay đổi màu khi focus */
            box-shadow: 0 0 5px rgba(255, 229, 204, 0.5);
            /* Thay đổi màu shadow */
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .img-fluid {
            filter: drop-shadow(0 5px 10px rgba(255, 229, 204, 0.5));
            /* Thay đổi màu shadow */
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
                    <form id="loginForm" method="POST" action="{{ route('client.loginRequest') }}"
                        class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Đăng nhập</h2>
                            <p class="text-muted">Nhập thông tin của bạn để đăng nhập</p>
                        </div>

                        <!-- Success Message -->
                        <div id="successMessage" class="alert alert-success d-none mt-3"></div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="alert alert-danger d-none mt-3"></div>

                        <!-- Email Input -->
                        <div class="form-outline mb-4">
                            <label class="form-label fw-semibold" for="email">Email: <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Nhập địa chỉ email hợp lệ" />
                            <span class="text-danger" id="emailError"></span>
                        </div>

                        <!-- Password Input -->
                        <div class="form-outline mb-3">
                            <label class="form-label fw-semibold" for="password">Mật khẩu: <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nhập mật khẩu" />
                            <span class="text-danger" id="passwordError"></span>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('client.forgotPassword') }}" class="text-primary">Quên mật khẩu?</a>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                            <p class="mt-3 text-muted">Chưa có tài khoản?
                                <a href="{{ route('client.register') }}" class="text-primary fw-bold">Đăng ký</a>
                            </p>
                        </div>
                    </form>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#loginForm').on('submit', function(e) {
                                e.preventDefault(); // Ngăn form gửi bình thường

                                // Reset thông báo lỗi
                                $('#emailError').text('');
                                $('#passwordError').text('');
                                $('#successMessage').addClass('d-none').text('');
                                $('#errorMessage').addClass('d-none').text('');

                                // Thu thập dữ liệu từ form
                                let formData = $(this).serialize();

                                // Gửi dữ liệu qua Ajax
                                $.ajax({
                                    url: "{{ route('client.loginRequest') }}",
                                    type: "POST",
                                    data: formData,
                                    success: function(response) {
                                        // Hiển thị thông báo thành công
                                        $('#successMessage').text(response.success).removeClass('d-none');
                                        setTimeout(function() {
                                            window.location.href = "{{ route('client.home') }}";
                                        }, 1000); // Chuyển hướng sau 2 giây
                                    },
                                    error: function(xhr) {
                                        if (xhr.status === 422) {
                                            // Hiển thị lỗi cho từng trường cụ thể
                                            let errors = xhr.responseJSON.errors;
                                            
                                            
                                            if (errors.email) {
                                                $('#emailError').text('Email hoặc mật khẩu không đúng.');
                                            }
                                            if (errors.password) {
                                                $('#passwordError').text(errors.password[0]);
                                            }
                                        } else {
                                            // Hiển thị lỗi chung nếu có vấn đề khác
                                            $('#errorMessage').text('Đã xảy ra lỗi, vui lòng thử lại sau.')
                                                .removeClass('d-none');
                                        }
                                    }
                                });
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </section>
@endsection
