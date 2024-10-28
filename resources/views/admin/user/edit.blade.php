@extends('layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="col-10">
            <h2 class="text-center">{{ $title }}</h2>
            <div class="row">
                <form action="{{ route('admin.student.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="studentName" class="form-label">Tên sinh viên</label>
                        <input type="text" class="form-control" id="studentName" name="name"
                            value="{{ $model->name }}" placeholder="Nhập tên sinh viên">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="studentTel" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="studentTel" name="tel"
                            value="{{ $model->tel }}" placeholder="Nhập số điện thoại">
                    </div>
                    @error('tel')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="studentGender" class="form-label">Giới tính</label>
                        <select class="form-select" name="gender" id="studentGender">
                            <option selected disabled>Chọn giới tính</option>
                            <option value="Nam" {{ $model->gender === 'nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $model->gender === 'nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="class" class="form-label">Lớp học</label>
                        <select class="form-select" name="class_id" id="class">
                            <option selected disabled>Chọn lớp học</option>
                            @foreach ($dataClass as $class)
                                <option {{ $class->id === $model->class_id ? "selected" : ""}} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('class_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="studentAddress" class="form-label">Địa chỉ</label>
                        <textarea class="form-control" id="studentAddress" name="address" rows="4" placeholder="Nhập địa chỉ">{{ $model->address }}</textarea>
                    </div>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="studentImage" class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="studentImage" name="image">
                        @if ($model->image)
                            <img src="{{ asset('storage/' . $model->image) }}" alt="Student Image" class="img-fluid mt-2"
                                width="150">
                        @endif
                    </div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cập nhật sinh viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
