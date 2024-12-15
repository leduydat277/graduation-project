@extends('client.layouts.master')

@section('title')
    Tiện nghi
@endsection

@section('content')
    @include('client.layouts.banner.banner')
    <style>
        #asset-type-container img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
    <section id="services" class="padding-medium">
        <div class="container-fluid padding-side">
            <div class="row" id="asset-type-container">
            </div>
        </div>
    </section>
    <script>
        async function fetchAssetType() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/all-asset-types');

                if (!response.ok) throw new Error('Không thể tải dữ liệu từ API.');

                const assetTypes = await response.json();
                const limitedAssetTypes = assetTypes.slice(0, 6);

                const assetTypeContainer = document.getElementById('asset-type-container');

                limitedAssetTypes.forEach(assetType => {
                    const assetTypeHTML = `
                    <div class="col-md-6 col-xl-4">
                        <div class="service mb-4 text-center rounded-4 p-5">
                            <div class="position-relative">
                                <img src="http://127.0.0.1:8000/storage/${assetType.image}" alt="${assetType.name}" class="img-fluid rounded">
                            </div>
                            <h4 class="display-6 fw-normal my-3">${assetType.name}</h4>
                            <p>${assetType.description}</p>
                            <a href="/services/${assetType.id}" class="btn btn-arrow">
                                <span class="text-decoration-underline">Xem thêm<svg width="18" height="18">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></span>
                            </a>
                        </div>
                    </div>
                `;
                    assetTypeContainer.insertAdjacentHTML('beforeend', assetTypeHTML);
                });
            } catch (error) {
                console.error('Lỗi:', error);
                
            }
        }
        document.addEventListener('DOMContentLoaded', fetchAssetType);
    </script>
@endsection
