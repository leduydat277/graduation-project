@extends('admin.layouts.admin')
@section('title')
Đổi mật khẩu Admin
@endsection
@section('css')
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">
<!--datatable css-->
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2>Đổi Mật Khẩu</h2>
<div class="live-preview">
    <form action="{{ route('change-password.change_password') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 position-relative">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" class="form-control"
                        placeholder="Enter your current password" name="current_password">
                    <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('current_password')"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-md-6">
                <div class="mb-3 position-relative">
                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                    <input type="password" id="new_password" class="form-control"
                        placeholder="Enter your new password" name="new_password">
                    <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('new_password')"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-md-6">
                <div class="mb-3 position-relative">
                    <label for="new_password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
                    <input type="password" id="new_password_confirmation" class="form-control"
                        placeholder="Confirm your new password" name="new_password_confirmation">
                    <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('new_password_confirmation')"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-12">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
</div>

<!-- JavaScript to toggle password visibility -->
<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling;
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<style>
    .position-relative {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        top: 70%;
        right: 10px;
        transform: translateY(-70%);
        cursor: pointer;
        color: #6c757d;
    }
    .toggle-password:hover {
        color: #495057;
    }
</style>



@endsection
@section('js')
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>

<script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.js')}}"></script>
@endsection