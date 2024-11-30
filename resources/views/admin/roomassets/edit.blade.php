@extends('admin.layouts.admin')
@section('title')
    {{ $title }}
@endsection
@section('css')
    <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/admin/assets/js/layout.js') }}"></script>
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container--default .select2-selection--single .select2-selection__clear {
            display: none;
        }

        .select2-container--default .select2-selection--single {
            height: 36px !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-top: 4px;
            margin-left: 6px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            margin-top: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="w-100 d-flex justify-content-center align-items-center">
            <div class="col-9">
                <h2 class="text-center">{{ $title }}</h2>
                <form action="{{ route('ras.update', $room->id) }}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="asset_type_id" class="form-label">Tiện Nghi</label>
                        <select class="form-control select2" id="asset_type_id" name="assets_type_id">
                            <option value="">Chọn tiện nghi</option>
                            @foreach ($assetTypes as $assetType)
                                <option value="{{ $assetType->id }}"
                                    {{ old('assets_type_id') == $assetType->id ? 'selected' : '' }}>
                                    {{ $assetType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assets_type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Cập Nhật Tiện Nghi</button>
                        <a href="{{ route('room-assets.show', $room->id) }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn một tùy chọn",
                allowClear: true
            });
        });
    </script>
@endsection
