@extends('admin.layouts.admin')
@section('title')
{{ $title }}
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/assets/libs/gridjs/theme/mermaid.min.css') }}">
<link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
<link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
<link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
    type="text/css" />
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

<form id="editForm" class="container" action="{{ route('others.update', ['other' => $other->id]) }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name1" name="name" required value="{{$other->name}}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Loại</label>
        <input type="text" class="form-control" id="type1" name="type" required value="{{$other->type}}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Mô tả</label>
        <input type="text" class="form-control" id="description1" name="description" value="{{$other->description}}">
    </div>
    <div class="mb-3">
        <img id="imageToDelete" src="/storage/{{$other->value}}" width="200px">
        <label for="otherValue" class="form-label">Dữ liệu (nhập 1 trong 2 loại dưới đây)</label>
        <input type="file" class="form-control" name="value" id="fileInputU"> <br>
        <textarea type="text" class="form-control" id="otherValueU" name="valuee" placeholder="nhập dữ liệu">{{$other->value}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
</form>



@endsection
@section('js')
<script>
    // check inputfile
    document.getElementById('fileInputU').addEventListener('change', function() {
        document.getElementById('otherValue').disabled = this.files.length > 0;
    });
    document.getElementById('otherValueU').addEventListener('input', function() {
        document.getElementById('fileInputU').disabled = this.value.trim() !== '';
    });
    document.getElementById('fileInputU').addEventListener('change', function() {
        document.getElementById('otherValueU').disabled = this.files.length > 0;
    });
    document.getElementById('otherValueU').addEventListener('input', function() {
        document.getElementById('fileInputU').disabled = this.value.trim() !== '';
    });


    document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('fileInput'); // Thẻ input file
    var textArea = document.getElementById('otherValueU'); // Thẻ textarea
    var image = document.getElementById('imageToDelete'); // Thẻ img
    var imageSrc = '{{ $other->value }}'; 
    
    // Kiểm tra nếu ảnh bắt đầu bằng "upload/others/"
    if (imageSrc.startsWith('upload/others/')) {
        console.log(imageSrc);
        // Nếu đúng, hiển thị ảnh và xóa dữ liệu trong textarea
        textArea.value = ''; // Xóa nội dung trong textarea
    } else {
        // Nếu không đúng, ẩn ảnh và giữ lại dữ liệu trong textarea
        image.style.display = 'none'; // Ẩn ảnh
        textArea.value = imageSrc; // Hiển thị dữ liệu trong textarea
    }

    // Khi ảnh được chọn trong file input
    fileInput.addEventListener('change', function() {
        // Kiểm tra nếu có file ảnh
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                // Tạo URL cho ảnh
                image.src = event.target.result;
                image.style.display = 'block';  // Hiển thị ảnh
                textArea.value = '';  // Xóa dữ liệu trong textarea khi ảnh được hiển thị
            };

            reader.onerror = function() {
                image.style.display = 'none';  // Ẩn ảnh khi có lỗi
                textArea.value = 'Có lỗi khi tải ảnh';  // Hiển thị thông báo lỗi trong textarea
            };

            reader.readAsDataURL(file);  // Đọc file ảnh dưới dạng data URL
        }
    });

    // Kiểm tra xem ảnh có bị lỗi không khi tải lên
    image.onerror = function() {
        image.style.display = 'none';  // Ẩn ảnh nếu có lỗi
        textArea.value = 'Có lỗi khi tải ảnh, vui lòng thử lại.';  // Hiển thị dữ liệu trong textarea khi có lỗi
    };
});





    // end check inputfile
</script>
<script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/plugins.js') }}"></script>

<!-- prismjs plugin -->
<script src="{{ asset('assets/admin/assets/libs/prismjs/prism.js') }}"></script>

<!-- gridjs js -->
<script src="{{ asset('assets/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script>
<!-- gridjs init -->

<!-- App js -->
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection