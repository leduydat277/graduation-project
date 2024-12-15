@extends('client.layouts.master')

@section('title')
    Đặt lại mật khẩu
@endsection

@section('content')
    <style>
        .btn-primary {
            background: #FFE5CC;
            border: none;
        }

        .btn-primary:hover {
            background: #FFCD9A;
            color: #fff;
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
    </style>

    <section class="vh-100" style="margin-top: 70px">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="resetPasswordForm" method="POST" action="{{ route('client.resetPassword') }}"
                        class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Đặt lại mật khẩu</h2>
                            <p class="text-muted">Nhập mật khẩu mới để thay đổi mật khẩu của bạn</p>
                        </div>

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ request('token') }}">

                        <!-- Mật khẩu mới -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu mới:</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nhập mật khẩu mới" />
                            <span class="text-danger" id="passwordError"></span>
                        </div>

                        <!-- Xác nhận mật khẩu -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Xác nhận mật khẩu:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Nhập lại mật khẩu" />
                            <span class="text-danger" id="passwordConfirmationError"></span>
                        </div>

                        <!-- Nút Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Đặt lại mật khẩu</button>
                        </div>

                        <!-- Thông báo -->
                        <div id="successMessage" class="alert alert-success d-none mt-3"></div>
                        <div id="errorMessage" class="alert alert-danger d-none mt-3"></div>
                    </form>

                    <p class="text-center mt-3">
                        <a href="{{ route('client.login') }}" class="text-primary">Quay lại trang đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resetPasswordForm').on('submit', function(e) {
                e.preventDefault();

                // Reset lỗi
                $('#passwordError').text('');
                $('#passwordConfirmationError').text('');

                // Thu thập dữ liệu form
                const formData = $(this).serialize();

                // Gửi yêu cầu qua Ajax
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#successMessage').text(response.success).removeClass('d-none');
                        $('#errorMessage').addClass('d-none');
                        setTimeout(() => {
                            window.location.href = "{{ route('client.login') }}";
                        }, 1000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.password) {
                                $('#passwordError').text(errors.password[0]);
                            }
                            if (errors.password_confirmation) {
                                $('#passwordConfirmationError').text(errors
                                    .password_confirmation[0]);
                            }
                        } else {
                            $('#errorMessage').text('Đã xảy ra lỗi, vui lòng thử lại.')
                                .removeClass('d-none');
                        }
                    }
                });
            });
        });
    </script>
@endsection
