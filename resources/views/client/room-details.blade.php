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
                    <div class=" ">
                        <form id="bookingForm" class="form-group flex-wrap p-4 border rounded-4">
                            <h2 class=" fs-2 text-black my-3 mb-5">Đặt Phòng</h2>
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Ngày nhận</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" id="checkin" name="checkin" class="form-control ps-3 me-3">
                                </div>
                                <div id="error-message-checkin" style="color: black; display: none;"></div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Ngày trả</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" id="checkout" name="checkout" class="form-control ps-3 me-3">
                                </div>
                                <div id="error-message-checkout" style="color: black; display: none;"></div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Người lớn</label>
                                <input type="number" id="adult-quantity" value="1" name="quantity"
                                    class="form-control ps-3">
                                <div id="error-message" style="color: black; display: none;">Số lượng người lớn không được
                                    vượt quá số lượng cho phép của phòng.</div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Trẻ em</label>
                                <input type="number" id="children-quantity" value="0" name="quantity"
                                    class="form-control ps-3">
                                <div id="error-message-children" style="color: black; display: none;">Số lượng trẻ em
                                    không
                                    được vượt quá số lượng cho phép của phòng.</div>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-arrow btn-primary">Đặt ngay</button>
                            </div>
                        </form>
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
            width: 985px;
            height: 580px;
            object-fit: cover;
        }
    </style>
    <script>
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

        document.addEventListener("DOMContentLoaded", function() {
            const adultInput = document.getElementById("adult-quantity");
            const childrenInput = document.getElementById("children-quantity");

            adultInput.value = 1;
            childrenInput.value = 0;

            adultInput.addEventListener("input", function() {
                if (adultInput.value < 1) {
                    adultInput.value = 1;
                }
            });

            childrenInput.addEventListener("input", function() {
                if (childrenInput.value < 0) {
                    childrenInput.value = 0;
                }
            });

            adultInput.addEventListener("change", function() {
                if (adultInput.value < 1) {
                    adultInput.value = 1;
                }
            });

            childrenInput.addEventListener("change", function() {
                if (childrenInput.value < 0) {
                    childrenInput.value = 0;
                }
            });
        });
    </script>

    <script type="module">
        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();

            // Lấy dữ liệu từ form
            var formData = {
                _token: $('input[name="_token"]').val(),
                room_id: $('input[name="room_id"]').val(),
                checkin: $('#checkin').val(),
                checkout: $('#checkout').val(),
                adult_quantity: $('#adult-quantity').val(),
                children_quantity: $('#children-quantity').val()
            };

            // Giới hạn số lượng người lớn và trẻ em
            const maxAdults = {{ $room->max_people }};
            const maxChildren = 2;
            const checkinValidate = document.getElementById('checkin');
            const checkoutValidate = document.getElementById('checkout');
            const errorCheckin = document.getElementById('error-message-checkin');
            const errorCheckout = document.getElementById('error-message-checkout');
            const adultInput = document.getElementById('adult-quantity');
            const errorMessage = document.getElementById('error-message');
            const childrenInput = document.getElementById('children-quantity');
            const errorMessageChildren = document.getElementById('error-message-children');

            // if (adultQuantity > maxGuests) {
            //     errorCheckin.style.display = 'block';
            // } else {
            //     errorMessage.style.display = 'none';
            //     adultInput.setCustomValidity("");
            // }

            if (!formData.checkin) {
                errorCheckin.style.display = 'block';
                errorCheckin.textContent = "Vui lòng chọn ngày đến";
                $('#checkin').focus();
                return false;
            }

            if (!formData.checkout) {
                errorCheckout.style.display = 'block';
                errorCheckin.textContent = "Vui lòng chọn ngày đi"
                $('#checkout').focus();
                return false;
            }

            if (formData.adult_quantity > maxAdults) {
                errorMessage.style.display = 'block';
                return;
            }

            if (formData.children_quantity > maxChildren) {
                errorMessageChildren.style.display = 'block';
                return;
            }

            $.ajax({
                url: "{{ route('api.confirmInfor') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    if (response.type === 'success') {
                        window.location.href = response
                            .url;
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

                    const today = new Date().toISOString().split("T")[0];
                    checkinInput.setAttribute("min", today);
                    checkoutInput.setAttribute("min", today);

                    const checkinValidate = document.getElementById('checkin');
                    const checkoutValidate = document.getElementById('checkout');
                    const errorCheckin = document.getElementById('error-message-checkin');
                    const errorCheckout = document.getElementById('error-message-checkout');

                    checkinInput.addEventListener("change", function() {
                        const checkinDate = new Date(checkinInput.value);
                        const formattedCheckinDate = checkinDate.toISOString().split('T')[0];

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
                        const checkoutDate = new Date(checkoutInput.value);
                        const formattedCheckoutDate = checkoutDate.toISOString().split('T')[0];

                        if (isDateBlocked(formattedCheckoutDate)) {
                            errorCheckout.style.display = 'block';
                            checkoutInput.value = "";
                            errorCheckout.textContent = "Ngày này đã có người đặt rồi";
                        } else {
                            errorCheckout.style.display = 'none';
                        }
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

        const maxGuests = {{ $room->max_people }};

        const adultInput = document.getElementById('adult-quantity');
        const errorMessage = document.getElementById('error-message');

        adultInput.addEventListener('input', function() {
            const adultQuantity = parseInt(adultInput.value, 10);

            if (adultQuantity > maxGuests) {
                errorMessage.style.display = 'block';
                adultInput.setCustomValidity("Số lượng người lớn không được vượt quá " + maxGuests +
                    " người.");
            } else {
                errorMessage.style.display = 'none';
                adultInput.setCustomValidity("");
            }
        });

        const maxChildren = 2;

        const childrenInput = document.getElementById('children-quantity');
        const errorMessageChildren = document.getElementById('error-message-children');

        childrenInput.addEventListener('input', function() {
            const childrenQuantity = parseInt(childrenInput.value, 10);

            if (childrenQuantity > maxChildren) {
                errorMessageChildren.style.display = 'block';
                childrenInput.setCustomValidity("Số lượng trẻ em không được vượt quá " + maxChildren +
                    " trẻ em.");
            } else {
                errorMessageChildren.style.display = 'none';
                childrenInput.setCustomValidity("");
            }
        });

        document.getElementById('form').addEventListener('submit', function(e) {
            const adultQuantity = parseInt(adultInput.value, 10);

            if (adultQuantity > maxGuests) {
                e.preventDefault();
                alert("Số lượng người lớn không được vượt quá " + maxGuests + " người.");
            }
        });

        document.getElementById('form').addEventListener('submit', function(e) {
            const childrenQuantity = parseInt(childrenInput.value, 10);

            if (childrenQuantity > maxChildren) {
                e.preventDefault();
                alert("Số lượng trẻ em không được vượt quá " + maxChildren + " trẻ em.");
            }
        });
    </script>
@endsection
