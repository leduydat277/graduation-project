@extends('client.layouts.master')

@section('title')
    Quản lý tài khoản
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div style="width: 1000px">
            <!-- Pills content -->
            <div class="tab-content">
                <h4>Thông tin cá nhân của bạn</h4>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="{{ route('updateProficeUser', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $data->name) }}" placeholder="Nhập tên">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input disabled type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $data->email) }}" placeholder="Nhập email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone', $data->phone) }}" placeholder="Nhập số điện thoại">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $data->address) }}" placeholder="Nhập địa chỉ">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            @if (!empty($data->image))
                                <img style="width: 200px;" src="{{ $data->image }}" alt="img">
                            @endif
                        </div>
                        

                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh đại diện</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                    <div class="text-start">
                        <p><a href="/confirm-password">Đổi mật khẩu</a></p>
                    </div>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
@endsection
