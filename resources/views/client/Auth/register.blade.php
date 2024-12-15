@extends('client.layouts.master')

@section('title')
    Đăng ký tài khoản
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


    <section class="vh-110" style="margin-top: 70px">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="registerForm" method="POST" class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Đăng ký tài khoản</h2>
                            <p class="text-muted">Điền thông tin bên dưới để tạo tài khoản</p>
                        </div>

                        <!-- Họ và tên -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="fullName" class="form-label fw-semibold">Họ và tên: <span class="text-danger">*</span></label>
                                <input type="text" id="fullName" name="name" class="form-control"
                                    placeholder="Nhập họ và tên của bạn" oninput="splitFullName()" />
                                <span class="text-danger" id="nameError"></span>
                            </div>
                        </div>

                        <!-- Họ và Tên -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="lastName" class="form-label fw-semibold">Họ:</label>
                                <input type="text" id="lastName" name="last_name" class="form-control" placeholder="Họ"
                                    readonly />
                                <span class="text-danger" id="lastNameError"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="firstName" class="form-label fw-semibold">Tên:</label>
                                <input type="text" id="firstName" name="first_name" class="form-control"
                                    placeholder="Tên" readonly />
                                <span class="text-danger" id="firstNameError"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="email" class="form-label fw-semibold">Email: <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Nhập địa chỉ email hợp lệ" />
                                <span class="text-danger" id="emailError"></span>
                            </div>
                        </div>

                        <!-- Số CCCD -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="cccd" class="form-label fw-semibold">
                                    Số CCCD: <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="cccd" name="cccd" class="form-control" placeholder="Nhập số CCCD của bạn" />
                                <span class="text-danger" id="cccdError"></span>
                            </div>
                        </div>
                        

                        <!-- Số điện thoại -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="phone" class="form-label fw-semibold">Số điện thoại: <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    placeholder="Nhập số điện thoại" />
                                <span class="text-danger" id="phoneError"></span>
                            </div>
                        </div>
                        <!-- Mật khẩu và Xác nhận mật khẩu -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">Mật khẩu: <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Nhập mật khẩu" />
                                <span class="text-danger" id="passwordError"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label fw-semibold">Xác nhận mật khẩu: <span class="text-danger">*</span></label>
                                <input type="password" id="confirmPassword" name="password_confirmation"
                                    class="form-control" placeholder="Xác nhận mật khẩu" />
                                <span class="text-danger" id="passwordConfirmationError"></span>
                            </div>
                        </div>

                        <!-- Nút Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Đăng ký</button>
                            <p class="mt-3 text-muted">Đã có tài khoản? <a href="{{ route('client.login') }}"
                                    class="text-primary fw-bold">Đăng nhập</a></p>
                        </div>

                        <!-- Thông báo -->
                        <div id="successMessage" class="alert alert-success d-none mt-3"></div>
                        <div id="errorMessage" class="alert alert-danger d-none mt-3"></div>
                    </form>

                    <script>
                        function splitFullName() {
                            const fullName = document.getElementById('fullName').value.trim();
                            const names = fullName.split(' ');

                            if (names.length > 1) {
                                const lastName = names.slice(0, -1).join(' '); // Họ
                                const firstName = names[names.length - 1]; // Tên

                                document.getElementById('lastName').value = lastName;
                                document.getElementById('firstName').value = firstName;
                            } else {
                                document.getElementById('lastName').value = '';
                                document.getElementById('firstName').value = fullName;
                            }
                        }
                    </script>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#registerForm').on('submit', function(e) {
                                e.preventDefault(); // Ngăn gửi form mặc định

                                let formData = $(this).serialize(); // Lấy dữ liệu từ form

                                $.ajax({
                                    url: "{{ route('client.registerRequest') }}",
                                    type: "POST",
                                    data: formData,
                                    success: function(response) {
                                        // Hiển thị thông báo thành công
                                        $('#successMessage').text(response.success).removeClass('d-none');
                                        $('#errorMessage').addClass('d-none');
                                        // Xóa thông báo lỗi cũ
                                        $('.text-danger').text('');
                                        // Reset form
                                        $('#registerForm')[0].reset();
                                    },
                                    error: function(xhr) {
                                        // Xóa thông báo lỗi cũ
                                        $('.text-danger').text('');
                                        $('#successMessage').addClass('d-none');

                                        // Hiển thị lỗi
                                        if (xhr.status === 422) {
                                            let errors = xhr.responseJSON.errors;
                                            for (let field in errors) {
                                                $(`#${field}Error`).text(errors[field][0]);
                                            }
                                        } else {
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
