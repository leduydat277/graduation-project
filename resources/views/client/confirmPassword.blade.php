@extends('client.layouts.master')

@section('title')
    Quản lý mật khẩu
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div style="width: 1000px">
            <!-- Pills content -->
            <div class="tab-content">
                <h4>Mật khẩu cá nhân của bạn</h4>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="{{ route('updatePassword', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="password_old" class="form-label">Mật khẩu cũ</label>
                            <input type="text" class="form-control" id="name" name="password_old"
                                value="{{ old('password_old') }}" placeholder="Nhập mật khẩu cũ">
                            @error('password_old')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="text" class="form-control" id="name" name="password"
                                value="{{ old('password') }}" placeholder="Nhập mật khẩu mới">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password_new" class="form-label">nhập lại mật khẩu mới</label>
                            <input type="text" class="form-control" id="name" name="confirm_password_new"
                                value="{{ old('confirm_password_new') }}" placeholder="Nhập nhập lại mật khẩu mới">
                            @error('confirm_password_new')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
@endsection
