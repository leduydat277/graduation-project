@extends('client.layouts.master')

@section('title', 'Đăng ký tài khoản')

@section('content')
    <style>
        .btn-primary {
            background: #FFE5CC;
            border: none;
        }

        .btn-primary:hover {
            background: #FFCD9A;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #FFE5CC;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #FFCD9A;
            box-shadow: 0 0 5px rgba(255, 229, 204, 0.5);
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }
    </style>
    <section class="vh-110" style="margin-bottom: 70px ; margin-top: 70px">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="{{ route('client.registerRequest') }}" class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Đăng ký tài khoản</h2>
                            <p class="text-muted">Điền thông tin bên dưới để tạo tài khoản</p>
                        </div>

                        <!-- Họ -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mb-3">
                                <label for="last_name" class="form-label fw-semibold">Họ: <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                    value="{{ old('last_name') }}" placeholder="Họ của bạn">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tên -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label fw-semibold">Tên: <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                    value="{{ old('first_name') }}" placeholder="Tên của bạn">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email: <span
                                    class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" placeholder="Nhập địa chỉ email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Mật khẩu -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu: <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nhập mật khẩu">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Xác nhận mật khẩu -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Xác nhận mật khẩu: <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Nhập lại mật khẩu">
                        </div>

                        <!-- Nút Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Đăng ký</button>
                            <p class="mt-3 text-muted">Đã có tài khoản?
                                <a href="{{ route('client.login') }}" class="text-primary fw-bold">Đăng nhập</a>
                            </p>
                        </div>
                    </form>

                    <!-- Thông báo thành công -->
                    @if (session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
