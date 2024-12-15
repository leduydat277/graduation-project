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
                    <form method="POST" action="{{ route('client.resetPassword') }}" class="p-4 rounded shadow bg-light">
                        @csrf
                        <div class="mb-4 text-center">
                            <h2 class="fw-bold">Đặt lại mật khẩu</h2>
                            <p class="text-muted">Nhập mật khẩu mới để thay đổi mật khẩu của bạn</p>
                        </div>

                        <!-- Hiển thị thông báo thành công -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Hiển thị lỗi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ request('token') }}">

                        <!-- Mật khẩu mới -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Mật khẩu mới:</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nhập mật khẩu mới" value="{{ old('password') }}" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Xác nhận mật khẩu -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Xác nhận mật khẩu:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Nhập lại mật khẩu"
                                value="{{ old('password_confirmation') }}" />
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nút Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Đặt lại mật khẩu</button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        <a href="{{ route('client.login') }}" class="text-primary">Quay lại trang đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
