@extends('client.layouts.master')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@section('title')
    Chi tiết phòng
@endsection
@section('content')
    @include('client.layouts.banner.banner')
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
    <div class="post-wrap my-5">
        <div class="container-fluid padding-side">
            <div class="row g-lg-5">
                <main class="post-grid col-lg-9">
                    <div class="row">
                        <article class="property">

                            <div class="row flex-column">
                                <div class="col-md-12">
                                    <div class="swiper product-large-slider">
                                        <div class="swiper-wrapper">
                                            @foreach ($images as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="product-large"
                                                        width="985px" height="580px" class="img-fluid img-product">
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- / product-large-slider -->
                                </div>
                                <div class="col-md-12 mt-2">
                                    <!-- product-thumbnail-slider -->
                                    <div thumbsSlider="" class="swiper product-thumbnail-slider">
                                        <div class="swiper-wrapper">
                                            @foreach ($images as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="image"
                                                        width="240" height="140" class="thumb-image img-fluid"
                                                        style="object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- / product-thumbnail-slider -->
                                </div>

                            </div>

                            <div class="post-content py-5">

                                <div class="d-flex justify-content-between align-items-center my-3">
                                    <h4 class="display-6 fw-normal">{{ $room->title }}</h4>
                                    <p class="m-0"><span
                                            class="text-primary fs-2">{{ number_format($room->price, 0, ',', '.') }}
                                            VNĐ</span>/đêm</p>
                                </div>
                                <p class="mb-xxl-5"><span>{{ $room->max_people }} Người</span>/Phòng</p>
                                <hr>
                                <div class="details my-5">
                                    <h4 class="display-6 fw-normal mb-3">Mô tả phòng</h4>
                                    <p> {{ $room->description }}
                                    </p>

                                </div>
                                <hr>
                                <div class="feature my-5">
                                    <h4 class="display-6 fw-normal mb-3">Tiện nghi phòng</h4>
                                    <div class="d-md-flex">
                                        <ul class="ms-4 me-5" id="asset-list">
                                            @foreach ($assets_type as $index => $asset)
                                                <li class="asset-item {{ $index >= 5 ? 'd-none' : '' }}">
                                                    {{ $asset->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if (count($assets_type) > 5)
                                        <button id="toggle-btn" class="btn btn-primary mt-3">Xem thêm</button>
                                    @endif
                                </div>
                                <hr>
                            </div>
                        </article>

                        <section id="post-comment">
                            <div class="container">
                                <div class="row">
                                    <div class="comments-wrap">
                                        <h3 class="display-6 fw-normal mb-5">
                                            <span class="count"></span> Bình luận
                                        </h3>
                                        <div class="comment-list">
                                            @foreach ($comments as $comment)
                                                <article class="comment-item pb-3 row">
                                                    <div class="col-md-10">
                                                        <div class="author-post mb-4">
                                                            <div
                                                                class="comment-meta text-uppercase d-flex gap-3 text-black">
                                                                <div class="author-name fw-semibold">
                                                                    {{ $comment->user->name }}</div>
                                                                <span class="meta-rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $comment->rating)
                                                                            ★
                                                                        @else
                                                                            ☆
                                                                        @endif
                                                                    @endfor
                                                                </span>
                                                            </div>
                                                            <p>{{ $comment->comment }}</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            @endforeach
                                        </div>
                                        <hr>
                                    </div>
                                    {{-- @if (Auth::check())
                                        <div class="comment-respond mt-5">
                                            <h3 class="display-6 fw-normal mb-5">Để lại bình luận</h3>
                                            <form method="post" class="form-group"
                                                action="{{ route('client.room-postComment') }}">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $room->id }}">
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="form-label">Đánh giá của bạn:</label>
                                                        <div class="rating">
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <input type="radio" id="star{{ $i }}"
                                                                    name="rating" value="{{ $i }}" />
                                                                <label for="star{{ $i }}"
                                                                    title="{{ $i }} sao">
                                                                    <i class="fas fa-star"></i>
                                                                </label>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 mb-3">
                                                        <textarea class="form-control bg-transparent ps-3 pt-3" id="comment" name="comment"
                                                            placeholder="Viết bình luận của bạn *"></textarea>
                                                    </div>
                                                </div>
                                                <button class="btn btn-arrow btn-primary mt-3" type="submit">
                                                    <span>Gửi<svg width="18" height="18">
                                                            <use xlink:href="#arrow-right"></use>
                                                        </svg></span></button>
                                            </form>
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
                <aside class="col-lg-3 mt-5">
                    <div>
                        <form id="bookingForm" class="form-group flex-wrap p-4 border rounded-4">
                            <h2 class="fs-2 text-black my-3 mb-5">Đặt Phòng</h2>
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <div class="col-lg-12 my-4">
                                <label for="checkin" class="form-label text-black">Ngày nhận</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" id="checkin" name="checkin" class="form-control ps-3 me-3"
                                        value="{{ isset($_GET['select-arrival-date_value']) ? $_GET['select-arrival-date_value'] : '' }}">
                                </div>
                                <div id="error-message-checkin" style="color: black; display: none;"></div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="checkout" class="form-label text-black">Ngày trả</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" id="checkout" name="checkout" class="form-control ps-3 me-3"
                                        value="{{ isset($_GET['select-departure-date_value']) ? $_GET['select-departure-date_value'] : '' }}">
                                </div>
                                <div id="error-message-checkout" style="color: black; display: none;"></div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="adult-quantity" class="form-label text-black">Số lượng người</label>
                                <input type="number" id="adult-quantity" name="quantity" class="form-control ps-3"
                                    value="{{ $_GET['quantity'] ?? 1 }}">
                                <div id="error-message" style="color: black; display: none;">Số lượng người không được
                                    vượt quá số lượng cho phép của phòng.</div>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-arrow btn-primary">Đặt ngay</button>
                            </div>
                        </form>
                        <div id="bookingSummary" class="mt-4 p-3 border rounded-4">
                            <h3 class="fs-3 text-black">Thông Tin Đặt Phòng</h3>
                            <p id="summary-checkin">Ngày nhận: Chưa chọn</p>
                            <p id="summary-checkout">Ngày trả: Chưa chọn</p>
                            <p id="summary-nights">Tổng số đêm: -</p>
                            <p id="summary-price">Tổng tiền: -</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-start;
        }

        .rating input[type="radio"] {
            display: none;
        }

        .rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating input[type="radio"]:checked~label,
        .rating label:hover,
        .rating label:hover~label {
            color: #ffc107;
        }

        .thumb-image {
            width: 240px;
            height: 140px;
            object-fit: cover;
        }

        .img-product {
            height: 580px;
            object-fit: cover;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const pricePerNight = {{ $room->price }};
            const maxPeople = {{ $room->max_people }};

            // Ẩn phần booking summary mặc định
            $('#bookingSummary').hide();

            function updateBookingSummary() {
                const checkinDate = $('#checkin').val();
                const checkoutDate = $('#checkout').val();
                const adultQuantity = parseInt($('#adult-quantity').val()) || 0;

                // Kiểm tra nếu cả checkin và checkout đều có giá trị
                if (!checkinDate || !checkoutDate) {
                    $('#bookingSummary').hide(); // Nếu chưa chọn đầy đủ ngày thì ẩn
                    return;
                }

                // Hiển thị phần bookingSummary nếu cả checkin và checkout đều có giá trị
                $('#bookingSummary').show(); // Hiển thị phần bookingSummary khi có đủ ngày

                const checkin = new Date(checkinDate);
                const checkout = new Date(checkoutDate);

                function formatDate(date) {
                    const day = date.getDate().toString().padStart(2, '0');
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                }

                const formattedCheckin = formatDate(checkin);
                const formattedCheckout = formatDate(checkout);

                // Kiểm tra xem ngày trả có lớn hơn ngày nhận không
                if (checkout <= checkin) {
                    $('#summary-checkin').text(`Ngày nhận: ${formattedCheckin}`);
                    $('#summary-checkout').text(`Ngày trả: ${formattedCheckout}`);
                    $('#summary-nights').text('Tổng số đêm: Lỗi');
                    $('#summary-price').text('Tổng tiền: Lỗi');
                    return;
                }

                // Kiểm tra số lượng người
                if (adultQuantity <= 0 || adultQuantity > maxPeople) {
                    $('#summary-checkin').text(`Ngày nhận: ${formattedCheckin}`);
                    $('#summary-checkout').text(`Ngày trả: ${formattedCheckout}`);
                    $('#summary-nights').text('Tổng số đêm: Lỗi số lượng người');
                    $('#summary-price').text('Tổng tiền: Lỗi số lượng người');
                    return;
                }

                const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                const totalPrice = nights * pricePerNight;

                $('#summary-checkin').text(`Ngày nhận: ${formattedCheckin}`);
                $('#summary-checkout').text(`Ngày trả: ${formattedCheckout}`);
                $('#summary-nights').text(`Tổng số đêm: ${nights}`);
                $('#summary-price').text(`Tổng tiền: ${totalPrice.toLocaleString('vi-VN')} VND`);
            }

            // Cập nhật thông tin mỗi khi có thay đổi trong checkin, checkout hoặc adult quantity
            $('#checkin, #checkout, #adult-quantity').on('change input', function() {
                updateBookingSummary();
            });

            // Cập nhật ngay khi trang được tải nếu có sẵn thông tin
            updateBookingSummary();
        });


        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('adult-quantity');
            const errorMessage = document.getElementById('error-message');
            const maxGuests = {{ $room->max_people }};
            quantityInput.min = 1;

            quantityInput.addEventListener('input', function() {
                const value = parseInt(quantityInput.value, 10);

                if (isNaN(value) || value <= 0) {
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = "Số lượng người không được âm hoặc bằng 0";
                    $('#adult-quantity').focus();
                    quantityInput.classList.add('is-invalid');
                } else {
                    errorMessage.style.display = 'none';
                    quantityInput.classList.remove('is-invalid');
                }

                if (value > maxGuests) {
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = "Số lượng người không được vượt quá " + maxGuests;
                    quantityInput.classList.add('is-invalid');
                } else {
                    errorMessage.style.display = 'none';
                    quantityInput.classList.remove('is-invalid');
                }
            });
        });


        // const maxGuests = {{ $room->max_people }};
        // const adultInput = document.getElementById('adult-quantity');
        // const errorMessage = document.getElementById('error-message');

        // adultInput.addEventListener('input', function() {
        //     const adultQuantity = parseInt(adultInput.value, 10);

        //     if (adultQuantity > maxGuests) {
        //         errorMessage.style.display = 'block';
        //         errorMessage.textContent = "Số lượng người không được vượt quá " + maxGuests;
        //     } else {
        //         errorMessage.style.display = 'none';

        //         adultInput.setCustomValidity("");
        //     }
        // });

        // document.getElementById('form').addEventListener('submit', function(e) {
        //     const adultQuantity = parseInt(adultInput.value, 10);

        //     if (adultQuantity > maxGuests) {
        //         e.preventDefault();
        //         alert("Số lượng người lớn không được vượt quá " + maxGuests + " người.");
        //     }
        // });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkinInput = document.getElementById("checkin");
            const checkoutInput = document.getElementById("checkout");
            const now = new Date();
            const hour = now.getHours();
            const minute = now.getMinutes();


            if (hour > 13 || (hour === 13 && minute >= 45)) {
                now.setDate(now.getDate() + 1);
            }

            const today = now.toISOString().split("T")[0];

            checkinInput.setAttribute("min", today);
            checkoutInput.setAttribute("min", today);

            checkinInput.addEventListener("change", function() {
                const checkinDate = new Date(checkinInput.value);

                const minCheckoutDate = new Date(checkinDate);

                minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);

                checkoutInput.value = "";
                checkoutInput.setAttribute("min", minCheckoutDate.toISOString().split("T")[0]);
            });

            checkoutInput.addEventListener("change", function() {
                const checkinDate = new Date(checkinInput.value);
                const checkoutDate = new Date(checkoutInput.value);

                if (checkoutDate <= checkinDate) {
                    alert("Ngày đi phải lớn hơn ngày đến ít nhất 1 ngày!");
                    checkoutInput.value = "";
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-btn');
            const assetItems = document.querySelectorAll('.asset-item');
            let isExpanded = false;

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    if (isExpanded) {
                        assetItems.forEach((item, index) => {
                            if (index >= 5) {
                                item.classList.add('d-none');
                            }
                        });
                        toggleBtn.textContent = 'Xem thêm';
                    } else {
                        assetItems.forEach(item => item.classList.remove('d-none'));
                        toggleBtn.textContent = 'Ẩn bớt';
                    }
                    isExpanded = !isExpanded;
                });
            }
        });

        // document.addEventListener("DOMContentLoaded", function() {
        //     const adultInput = document.getElementById("adult-quantity");
        //     const childrenInput = document.getElementById("children-quantity");

        //     childrenInput.value = 0;

        //     adultInput.addEventListener("input", function() {
        //         if (adultInput.value < 1) {
        //             adultInput.value = 1;
        //         }
        //     });

        //     childrenInput.addEventListener("input", function() {
        //         if (childrenInput.value < 0) {
        //             childrenInput.value = 0;
        //         }
        //     });

        //     adultInput.addEventListener("change", function() {
        //         if (adultInput.value < 1) {
        //             adultInput.value = 1;
        //         }
        //     });

        //     childrenInput.addEventListener("change", function() {
        //         if (childrenInput.value < 0) {
        //             childrenInput.value = 0;
        //         }
        //     });
        // });
    </script>

    <script type="module">
        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                _token: $('input[name="_token"]').val(),
                room_id: $('input[name="room_id"]').val(),
                checkin: $('#checkin').val(),
                checkout: $('#checkout').val(),
                adult_quantity: $('#adult-quantity').val(),
                children_quantity: $('#children-quantity').val()
            };

            const maxAdults = {{ $room->max_people }};
            const maxChildren = 2;

            const errorCheckin = document.getElementById('error-message-checkin');
            const errorCheckout = document.getElementById('error-message-checkout');
            const errorMessage = document.getElementById('error-message');
            const errorMessageChildren = document.getElementById('error-message-children');

            errorCheckin.style.display = 'none';
            errorCheckout.style.display = 'none';
            errorMessage.style.display = 'none';

            if (!formData.checkin) {
                errorCheckin.style.display = 'block';
                errorCheckin.textContent = "Vui lòng chọn ngày đến";
                $('#checkin').focus();
                return false;
            }

            if (!formData.checkout) {
                errorCheckout.style.display = 'block';
                errorCheckout.textContent = "Vui lòng chọn ngày đi";
                $('#checkout').focus();
                return false;
            }

            if (formData.adult_quantity <= 0) {
                errorMessage.style.display = 'block';
                errorMessage.textContent = "Số lượng người phải lớn hơn 0";
                $('#adult-quantity').focus();
                return false;
            }

            if (formData.adult_quantity > maxAdults) {
                errorMessage.style.display = 'block';
                errorMessage.textContent = "Số lượng người không được vượt quá " + maxAdults;
                $('#adult-quantity').focus();
                return false;
            }

            $.ajax({
                url: "{{ route('api.confirmInfor') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    if (response.type === 'success') {
                        window.location.href = response.url;
                    } else {
                        alert('Đã xảy ra lỗi khi gửi thông tin.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
                }
            });
        });


        $.ajax({
            url: `{{ route('api.checkDate', $room->id) }}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.type === 'success') {
                    const data = response.data;
                    const blockedDates = [];

                    if (data.length === 0) {
                        console.log("Phòng này hiện không có ngày đặt nào!");
                        return;
                    }

                    data.forEach(item => {
                        const fromDate = new Date(item.from * 1000);
                        let toDate = '';

                        if (item.to === 0) {
                            toDate = 'Trống đến hết năm';
                        } else {
                            toDate = new Date(item.to * 1000);
                        }

                        const formattedFromDate = fromDate.toISOString().split('T')[0];
                        let formattedToDate = '';
                        if (toDate === 'Trống đến hết năm') {
                            formattedToDate = toDate;
                        } else {
                            formattedToDate = toDate.toISOString().split('T')[0];
                        }

                        let currentDate = new Date(fromDate);
                        while (currentDate <= toDate) {
                            blockedDates.push(currentDate.toISOString().split('T')[0]);
                            currentDate.setDate(currentDate.getDate() + 1);
                        }

                        console.log(
                            `Từ ngày: ${formattedFromDate} - Đến ngày: ${formattedToDate === 'Trống đến hết năm' ? formattedToDate : formattedToDate} - Trạng thái: ${item.status === 1 ? 'Trống' : 'Đã đặt'}`
                        );
                    });

                    const checkinInput = document.getElementById("checkin");
                    const checkoutInput = document.getElementById("checkout");

                    function isDateBlocked(date) {
                        return blockedDates.includes(date);
                    }

                    const now = new Date();
                    const hour = now.getHours();
                    const minute = now.getMinutes();


                    if (hour > 13 || (hour === 13 && minute >= 45)) {
                        now.setDate(now.getDate() + 1);
                    }

                    const today = now.toISOString().split("T")[0];

                    checkinInput.setAttribute("min", today);
                    checkoutInput.setAttribute("min", today);

                    const checkinValidate = document.getElementById('checkin');
                    const checkoutValidate = document.getElementById('checkout');
                    const errorCheckin = document.getElementById('error-message-checkin');
                    const errorCheckout = document.getElementById('error-message-checkout');

                    checkinInput.addEventListener("change", function() {
                        const checkinDate = new Date(checkinInput.value);
                        const checkoutDate = new Date(checkoutInput.value);
                        const formattedCheckinDate = checkinDate.toISOString().split('T')[0];

                        if (isNaN(checkinDate)) {
                            errorCheckin.style.display = 'block';
                            errorCheckin.textContent = "Vui lòng chọn ngày nhận phòng hợp lệ.";
                            checkinInput.value = "";
                            return;
                        }

                        if (isDateBlocked(formattedCheckinDate)) {
                            errorCheckin.style.display = 'block';
                            checkinInput.value = "";
                            errorCheckin.textContent = "Ngày này đã có người đặt rồi";
                            $('#checkin').focus();
                        } else {
                            errorCheckin.style.display = 'none';
                        }
                    });

                    checkoutInput.addEventListener("change", function() {
                        const checkinDate = new Date(checkinInput.value);
                        const checkoutDate = new Date(checkoutInput.value);

                        if (isNaN(checkoutDate)) {
                            errorCheckout.style.display = "block";
                            errorCheckout.textContent = "Vui lòng chọn ngày trả phòng hợp lệ.";
                            checkoutInput.value = "";
                            return;
                        }

                        if (checkoutDate <= checkinDate) {
                            errorCheckout.style.display = "block";
                            errorCheckout.textContent = "Ngày trả phòng phải sau ngày nhận phòng.";
                            checkoutInput.value = "";
                            return;
                        }

                        let currentDate = new Date(checkinDate);
                        while (currentDate < checkoutDate) {
                            const formattedDate = currentDate.toISOString().split("T")[0];
                            if (isDateBlocked(formattedDate)) {
                                errorCheckout.style.display = "block";
                                errorCheckout.textContent =
                                    "Khoảng thời gian này đã được đặt, vui lòng chọn thời gian khác.";
                                checkoutInput.value = "";
                                return;
                            }
                            currentDate.setDate(currentDate.getDate() + 1);
                        }

                        errorCheckout.style.display = "none";
                    });
                } else {
                    console.log("Không có dữ liệu ngày đặt!");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error checking booking dates:", xhr, status, error);
                console.log("Đã xảy ra lỗi khi kiểm tra ngày đặt!");
            }
        });
    </script>
@endsection
