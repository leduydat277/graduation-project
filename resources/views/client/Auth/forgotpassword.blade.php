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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email:</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Nhập địa chỉ email của bạn" value="{{ old('email') }}" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
@endsection
