@extends('client.layouts.master')

@section('title', 'Đăng nhập')

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
            border-color: #FFE5CC;
            box-shadow: 0 0 5px rgba(255, 229, 204, 0.5);
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .text-danger {
            font-size: 0.9em;
        }
    </style>

    <section class="vh-100">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="{{ route('client.loginRequest') }}" class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Đăng nhập</h2>
                            <p class="text-muted">Nhập thông tin của bạn để đăng nhập</p>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Nhập địa chỉ email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Mật khẩu: <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nhập mật khẩu">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="mb-3">
                            <a href="{{ route('client.forgotPassword') }}" class="text-primary">Quên mật khẩu?</a>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                            <p class="mt-3 text-muted">
                                
                                <a href="{{ route('admin.login') }}" class="text-primary fw-bold">Đăng nhập bằng tài khoản admin</a>
                            </p>
                            <p class="mt-3 text-muted">
                                Chưa có tài khoản?
                                <a href="{{ route('client.register') }}" class="text-primary fw-bold">Đăng ký</a>
                            </p>
                        </div>
                    </form>
                </div>

        </div>
    </section>
@endsection
