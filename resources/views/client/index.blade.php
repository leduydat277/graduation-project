@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <style>
        .post-image {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-bottom: 2px solid #ddd;

        }

        .room-item {
            width: 100%;
            max-width: 500px;
            margin: auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .product-description {
            padding: 15px;
            color: #fff;
            text-align: left;
        }

        .product-description h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .product-description table {
            width: 100%;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #ccc;
        }

        #image-container .swiper-slide img {
            width: 100%;
            height: 700px;
            object-fit: cover;
        }

        #asset-type-container img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }
    </style>
    <section id="slider" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="d-flex rounded-5"
                style="background-image: url({{ asset('assets/client/images/slider-image.jpg') }}); background-size: cover; background-repeat: no-repeat; height: 85vh; background-position: center;">
                <div class="row align-items-center m-auto pt-5 px-4 px-lg-0">
                    <div class="text-start col-md-6 col-lg-5 col-xl-6 offset-lg-1">
                        <h2 class="display-1 fw-normal">SleepHotel - Cánh cổng đến sự bình yên.</h2>
                        <a href="{{ route('client.about') }}" class="btn btn-arrow btn-primary mt-3">
                            <span>Khám phá SleepHotel <svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-4 mt-5 mt-md-0">
                        <form id="form" action="/room" class="form-group flex-wrap bg-white p-5 rounded-4 ms-md-5">
                            <h3 class="display-5">Đặt Phòng</h3>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Ngày đến</label>
                                <div class="date position-relative bg-transparent" id="select-arrival-date">
                                    <a href="#" class="position-absolute top-50 end-0 translate-middle-y pe-2 ">

                                        <svg class="text-body" width="25" height="25">
                                            <use xlink:href="#calendar"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="error-message  p-2 rounded-3" id="arrival-error"
                                    style="color: black; font-style: italic; font-size: smaller;"></div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Ngày đi</label>
                                <div class="date position-relative bg-transparent" id="select-departure-date">
                                    <a href="#" class="position-absolute top-50 end-0 translate-middle-y pe-2 ">

                                        <svg class="text-body" width="25" height="25">
                                            <use xlink:href="#calendar"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="error-message  p-2 rounded-3" id="departure-error"
                                    style="color: black; font-style: italic; font-size: smaller;"></div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Số khách</label>
                                <input type="number" value="1" name="quantity" class="form-control text-black-50 ps-3"
                                    min="1">
                                <div class="error-message p-2 rounded-3" id="quantity-error"
                                    style="color: black; font-style: italic; font-size: smaller;"></div>
                            </div>
                            <div class="d-grid">
                                <button href="#" class="btn btn-arrow btn-primary mt-3">
                                    <span>Tìm kiếm phòng<svg width="18" height="18">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us" class="padding-large" style="padding-top: 100px">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <h3 class="display-3 text-center fw-normal w-100">Chào mừng đến với SleepHotel</h3>
            <div class="row align-items-start mt-3 mt-lg-5">
                <div class="col-lg-6">
                    <div class="p-5">
                        <p style="font-size: 18px">Chào mừng đến với Khách sạn SleepHotel, nơi sự thoải mái hòa quyện với sự yên tĩnh. Nằm ngay
                            trung
                            tâm thành phố nhộn nhịp, khách sạn của chúng tôi mang đến một nơi nghỉ dưỡng yên bình cho cả
                            khách du lịch và doanh nhân. Với các tiện nghi hiện đại và không gian ấm áp, chúng tôi cam kết
                            mang đến trải nghiệm tuyệt vời nhất cho bạn.</p>
                        <a href="{{ route('client.about') }}" class="btn btn-arrow btn-primary mt-3">
                            <span>Đọc thêm về chúng tôi <svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                    <img src="{{ asset('assets/client/images/about-img1.jpg') }}" alt="img"
                        class="img-fluid rounded-4 mt-4">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <img src="{{ asset('assets/client/images/about-img2.jpg') }}" alt="img"
                        class="img-fluid rounded-4">
                    <img src="{{ asset('assets/client/images/about-img3.jpg') }}" alt="img"
                        class="img-fluid rounded-4 mt-4">
                </div>
            </div>
        </div>
    </section>

    <section id="room" class="padding-medium" style="padding-top: 100px">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h3 class="display-3 fw-normal text-center">Khám phá các phòng của chúng tôi</h3>
                </div>
            </div>

            <div class="swiper room-swiper mt-5">
                <div class="swiper-wrapper" id="rooms-container">
                </div>
                <div class="swiper-pagination room-pagination position-relative mt-5"></div>
            </div>
        </div>
    </section>

    <section id="gallery" data-aos="fade-up">
        <h3 class="display-3 fw-normal text-center">Bộ sưu tập</h3>
        <p class="text-center col-lg-4 offset-lg-4 mb-5">Khám phá những hình ảnh về chỗ nghỉ tiện nghi của chúng tôi, với
            các tiện ích hiện đại và thiết kế trang nhã mang lại trải nghiệm khó quên.</p>
        <div class="container position-relative">
            <div class="row">
                <div class="swiper gallery-swiper offset-1 col-10">
                    <div class="swiper-wrapper" id="image-container">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="services" class="padding-medium">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <h3 class="display-3 text-center fw-normal col-lg-4 offset-lg-4">Tiện nghi của chúng tôi</h3>
            <div class="row mt-5" id="asset-type-container">
                <!-- Yoga & Meditation -->

            </div>
        </div>
    </section>
    <script>
        async function fetchRooms() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/all-rooms');
                if (!response.ok) throw new Error('Không thể tải dữ liệu từ API.');

                const rooms = (await response.json()).data;
                const roomsContainer = document.getElementById('rooms-container');
                roomsContainer.innerHTML = '';

                // Lấy 5 phòng đầu tiên
                const limitedRooms = rooms.slice(0, 5);

                limitedRooms.forEach(room => {
                    // Lấy ảnh đầu tiên từ mảng
                    const firstImage = room.image_room.length > 0 ? room.image_room[0] : 'default-image.jpg';

                    // Tạo HTML cho từng phòng
                    const roomHTML = `
                        <div class="swiper-slide">
                            <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
                                <img src="http://127.0.0.1:8000/storage/${firstImage}" alt="${room.title}" class="post-image img-fluid">
                                <div class="product-description position-absolute p-5 text-start">
                                    <h4 class="display-6 fw-normal text-white">${room.title}</h4>
                                    <p class="product-paragraph text-white">${room.description}</p>
                                    <table>
                                        <tbody>
                                            <tr class="text-white">
                                                <td class="pe-2">Giá:</td>
                                                <td class="price">${room.price} VND /Đêm</td>
                                            </tr>
                                            <tr class="text-white">
                                                <td class="pe-2">Diện tích:</td>
                                                <td>${room.room_area} m²</td>
                                            </tr>
                                            <tr class="text-white">
                                                <td class="pe-2">Sức chứa:</td>
                                                <td>${room.max_people} người</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <a href="/room/${room.id}" class="btn btn-arrow mt-3">

                                        <p class="text-decoration-underline text-white m-0 mt-2">Xem ngay</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                    roomsContainer.insertAdjacentHTML('beforeend', roomHTML);
                });
            } catch (error) {
                console.error('Lỗi:', error);
                
            }
        }

        document.addEventListener('DOMContentLoaded', fetchRooms);
    </script>

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

    <script>
        async function fetchImages() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/all-asset-types');

                if (!response.ok) throw new Error('Không thể tải dữ liệu từ API.');

                const images = await response.json(); // JSON trả về là một mảng
                const imageContainer = document.getElementById('image-container');
                imageContainer.innerHTML = ''; // Xóa nội dung cũ

                // Lặp qua từng phần tử của mảng
                images.forEach(image => {
                    const imageHTML = `
                <div class="swiper-slide">
                    <img src="http://127.0.0.1:8000/storage/${image.image}" alt="${image.name}" 
                        class="img-fluid rounded-4">
                </div>
            `;
                    imageContainer.insertAdjacentHTML('beforeend', imageHTML); // Thêm vào container
                });

            } catch (error) {
                console.error('Lỗi:', error);
                
            }
        }

        // Gọi hàm sau khi DOM đã tải xong
        document.addEventListener('DOMContentLoaded', fetchImages);
    </script>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();
            const arrivalDate = document.querySelector('input[name="select-arrival-date_value"]').value;
            const departureDate = document.querySelector('input[name="select-departure-date_value"]').value;
            const quantity = document.querySelector('input[name="quantity"]').value;

            console.log(arrivalDate, departureDate, quantity);

            clearErrors();

            let isValid = true;

            const today = new Date().toISOString().split('T')[0];

            if (arrivalDate < today) {
                isValid = false;
                document.getElementById('arrival-error').textContent = 'Quý khách vui lòng chọn ngày trong hiện tại hoặc tương lai';
            }

            if (departureDate < today) {
                isValid = false;
                document.getElementById('departure-error').textContent = 'Quý khách vui lòng chọn ngày trong hiện tại hoặc tương lai';
            }

            if (quantity <= 0) {
                isValid = false;
                document.getElementById('quantity-error').textContent =
                    'Quý khách vui lòng nhập lớn số khách lớn hơn 0';
            }

            if (new Date(departureDate) <= new Date(arrivalDate)) {
                isValid = false;
                document.getElementById('departure-error').textContent =
                    'Quý khách vui lòng nhập ngày trả phòng lớn hơn ngày nhận phòng ít nhất 1 ngày';
            }

            const arrivalDateTime = new Date(arrivalDate + 'T13:45:00');
            if (new Date() > arrivalDateTime) {
                isValid = false;
                document.getElementById('arrival-error').textContent =
                    'Vì khung giờ check-in, check-out của khách sạn. Quý khách hãy chọn ngày mai là ngày nhận phòng (đọc thêm trong điều khoản)';
            }

            if (isValid) {
                this.submit();
            }
        });

        function clearErrors() {
            document.getElementById('arrival-error').textContent = '';
            document.getElementById('departure-error').textContent = '';
            document.getElementById('quantity-error').textContent = '';
        }
    </script>
@endsection
