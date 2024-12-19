@extends('client.layouts.master')

@section('title')
    Đặt phòng
@endsection
@section('css')
    <style>
        .subtotal th {
            display: block;
            /* Đặt tiêu đề trên một dòng riêng */
            margin-bottom: 8px;
            /* Thêm khoảng cách dưới tiêu đề */
            font-size: 16px;
            /* Kích thước chữ cho tiêu đề */
        }

        .subtotal .price-amount {
            display: block;
            /* Đặt toàn bộ phần giá trên một dòng riêng */
            margin-left: 0;
            /* Đảm bảo giá căn thẳng lề trái */
            font-size: 14px;
            /* Kích thước chữ cho giá */
            color: #555;
            /* Màu chữ giá (tuỳ chỉnh theo thiết kế) */
        }

        .price-currency-symbol img {
            display: block;
            /* Đặt ảnh trên một dòng riêng */
            margin-bottom: 8px;
            /* Thêm khoảng cách dưới ảnh */
        }

        .price-currency-symbol {
            display: block;
            /* Đặt giá trên một dòng riêng */
            margin-top: 4px;
            /* Khoảng cách giữa ảnh và giá */
        }
    </style>
@endsection
@section('content')
    <section id="slider" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="d-flex rounded-5"
                style="background-image: url({{ asset('assets/client/images/slider-image1.jpg') }} ); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
                <div class="row align-items-center m-auto">
                    <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                        <h2 class="display-1 fw-normal">Đặt phòng</h2>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="{{ route('client.home') }}">Trang chủ</a>
                            <span class="active" aria-current="page"> /<span class="text-decoration-underline">Đặt
                                    phòng</span></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout-wrap padding-small">
        <div class="container-fluid padding-side">
            <div class="display-header d-flex justify-content-between pb-3">
                <h4 class="display-6 fw-normal my-3">Nhập thông tin chi tiết về bạn</h4>
            </div>
            <form id="bookingForm" class="form-group mt-4">
                <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="billing-details">
                            <div class="row">
                                <div class="form-input col-lg-6 mb-3">
                                    <label for="name" class="label-style fw-medium form-label">Họ</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Nhập họ của bạn"
                                        class="form-control ps-3 me-3" value="{{ Auth::user()->last_name }}">
                                </div>
                                <div class="form-input col-lg-6 mb-3">
                                    <label for="name" class="label-style fw-medium form-label">Tên</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="Nhập tên của bạn"
                                        class="form-control ps-3 me-3" value="{{ Auth::user()->first_name }}">
                                </div>
                            </div>
                            <div class="form-input col-lg-12 mb-3">
                                <label for="name" class="label-style fw-medium form-label">Địa chỉ email</label>

                                <input type="text" name="email" id="email"
                                    placeholder="Nhập địa chỉ email của bạn." class="form-control ps-3"
                                    value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="name" class="label-style fw-medium form-label">Số điện thoại</label>

                                <input type="text" name="phone" id="phone"
                                    placeholder="Nhập số điện thoại của bạn." class="form-control ps-3"
                                    value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="name" class="label-style fw-medium form-label">Địa chỉ</label>

                                <input type="text" name="address" id="address" placeholder="Nhập địa chỉ của bạn."
                                    class="form-control ps-3" value="{{ Auth::user()->address }}">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="name" class="label-style fw-medium form-label">Ghi chú</label>

                                <textarea class="form-control ps-3" rows="8" name="message" id="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="your-order">
                            <h4 class="display-7 text-dark pb-4">Chi tiết đặt phòng</h4>
                            <div class="total-price">
                                <table cellspacing="0" class="table table-borderless">
                                    <tbody>
                                        <tr class="subtotal border-top pt-2 pb-2 text-uppercase">
                                            <th>{{ $room->title }}</th>
                                            <td class="price-currency-symbol">Giá một đêm:
                                                {{ number_format($room->price, 0, ',', '.') }} VND</td>
                                            <td data-title="Image">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol">
                                                            <img src="{{ asset('storage/' . $room->thumbnail_image) }}"
                                                                alt="" width="100px">
                                                        </span>
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal border-top pt-2 pb-2 text-uppercase">
                                            <th>Ngày đến</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span id="check_in_date"
                                                            class="price-currency-symbol">{{ $checkIn }} </bdi>(14:00)
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal  border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Ngày đi</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span id="check_out_date"
                                                            class="price-currency-symbol">{{ $checkout }}</bdi>(12:00)
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Số lượng người</th>
                                            <td colspan="2" data-title="Subtotal">
                                                <div class="d-flex flex-column align-items-start">
                                                    <span class="price-amount amount ps-5">
                                                        <bdi>
                                                            <span id="adult" data-quantity="{{ $adult_quantity }}"
                                                                class="price-currency-symbol">{{ $adult_quantity }}
                                                                người</span>
                                                        </bdi>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="subtotal border-top pt-2 pb-2 text-uppercase">
                                            <th>Tổng số ngày</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol">{{ $totalDays }}</bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Tổng tiền gốc</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol" id="originalPrice">
                                                            {{ number_format($room->price * $totalDays, 0, ',', '.') }} VND
                                                        </span>
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Giảm giá</th>
                                            <td data-title="Discount">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol" id="discountAmount">
                                                            0 VND
                                                        </span>
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Tổng tiền sau giảm</th>
                                            <td data-title="Final Total">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol" id="finalPrice">
                                                            {{ number_format($room->price * $totalDays, 0, ',', '.') }} VND
                                                        </span>
                                                    </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="list-group mt-5 mb-3">
                                    <h4 class="display-7 text-dark pb-4">Thanh toán</h4>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio" name="payment_type"
                                            id="payment_type" value="1">
                                        <span>
                                            <strong class="text-uppercase">Thanh toán 30%</strong>
                                            <span id="payment_30_price" class="ms-auto">-
                                                {{ number_format($room->price * $totalDays * 0.3, 0, ',', '.') }}VND</span>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio" name="payment_type"
                                            id="payment_type" value="2">
                                        <span>
                                            <strong class="text-uppercase">Thanh toán tất cả</strong>
                                            <span id="payment_full_price" class="ms-auto">-
                                                {{ number_format($room->price * $totalDays, 0, ',', '.') }}VND</span>
                                        </span>
                                    </label>
                                </div>
                                <button type="submit" name="submit" class="btn btn-arrow btn-primary mt-3"><span>Đặt
                                        phòng<svg width="18" height="18">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg></span></button>
            </form>
            <div class="voucherForm">
                <form id="voucherForm" class="d-flex align-items-center">
                    <div class="form-input col-lg-9 mb-0 me-3">
                        <label for="voucher" class="label-style fw-medium form-label">Mã giảm
                            giá</label>
                        <input type="text" name="voucher" id="voucher"
                            placeholder="Nếu có mã giảm giá hãy nhập vào đây" class="form-control ps-3">
                    </div>
                    <input type="hidden" name="price" value="{{ $room->price * $totalDays }}">
                    <button type="submit" name="submit" class="btn btn-arrow btn-primary" style="margin-top: 25px">
                        <span>Nhập mã</span>
                    </button>
                </form>
            </div>
            <div id="voucherInfo" style="display: none;">
                <div class="stack" style="display: flex; flex-direction: column; gap: 16px;">
                    <div class="stack-row" style="display: flex; justify-content: space-between;">
                        <span style="font-weight: 500; color: #555;">Tên Voucher:</span>
                        <span style="font-weight: 400; color: #888;" id="voucherName">N/A</span>
                    </div>
                    <div class="stack-row" style="display: flex; justify-content: space-between;">
                        <span style="font-weight: 500; color: #555;">Loại Voucher:</span>
                        <span style="font-weight: 400; color: #888;" id="voucherType">N/A</span>
                    </div>
                    <div class="stack-row" style="display: flex; justify-content: space-between;">
                        <span style="font-weight: 500; color: #555;">Giá trị giảm giá:</span>
                        <span style="font-weight: 400; color: #888;" id="voucherDiscount">N/A</span>
                    </div>
                    <button id="cancelVoucher" class="btn btn-danger" style="margin-top: 16px;">Hủy
                        Voucher</button>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        let voucher_id;
        document.getElementById('voucher').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        $('#voucherForm').on('submit', function(e) {
            e.preventDefault();

            const voucherCode = $('#voucher').val().trim();
            const price = $('input[name="price"]').val();
            const originalPriceElement = $('#originalPrice');
            const discountAmountElement = $('#discountAmount');
            const finalPriceElement = $('#finalPrice');
            const payment_30_price = $('#payment_30_price');
            const payment_full_price = $('#payment_full_price');
            const totalPrice = parseInt(originalPriceElement.text().replace(/\D/g, ''), 10);

            if (!voucherCode) {
                toastr.error(`Vui lòng nhập voucher!`, 'Lỗi', {
                    positionClass: 'toast-top-right',
                    timeOut: 5000,
                });
                return;
            }

            $.ajax({
                url: '/api/voucher',
                method: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    voucher: voucherCode,
                    price: price
                }),
                success: function(response) {
                    if (response.type === 'success') {
                        toastr.success('Áp dụng voucher thành công!', 'Thành công', {
                            positionClass: 'toast-top-right',
                            timeOut: 5000,
                        });

                        const newTotalPrice = updateTotalPrice(totalPrice, response.voucher);

                        const discountValue = totalPrice - newTotalPrice;

                        discountAmountElement.text(`${discountValue.toLocaleString('vi-VN')} VND`);
                        finalPriceElement.text(`${newTotalPrice.toLocaleString('vi-VN')} VND`);
                        payment_30_price.text(`${(newTotalPrice * 0.3).toLocaleString('vi-VN')} VND`);
                        payment_full_price.text(`${newTotalPrice.toLocaleString('vi-VN')} VND`);
                        $('#voucherInfo').show();
                        $('#voucherName').text(response.voucher.name);
                        $('#voucherType').text(response.voucher.type);
                        voucher_id = response.voucher.id;
                        if (response.voucher.type === '%') {
                            $('#voucherDiscount').text(response.voucher.discount_value + "%");
                        } else if (response.voucher.type === 'fixed') {
                            const formattedDiscount = new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND',
                            }).format(response.voucher.discount_value);
                            $('#voucherType').text('Cố định');
                            $('#voucherDiscount').text(formattedDiscount);
                        }

                    } else {
                        toastr.error(`Áp dụng voucher thất bại: ${response.message}`, 'Lỗi', {
                            positionClass: 'toast-top-right',
                            timeOut: 5000,
                        });
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi áp dụng voucher:', error);
                    alert('Lỗi không xác định khi áp dụng voucher.');
                },
            });
        });

        $('#cancelVoucher').on('click', function(e) {
            e.preventDefault();
            $('#voucherInfo').hide();
            $('#voucherName').text('N/A');
            $('#voucherType').text('N/A');
            $('#voucherDiscount').text('N/A');
            const voucherCode = $('#voucher').val('');

            const totalPrice = parseInt($('#originalPrice').text().replace(/\D/g, ''), 10);
            $('#payment_30_price').text(`${(totalPrice * 0.3).toLocaleString('vi-VN')} VND`);
            $('#payment_full_price').text(`${totalPrice.toLocaleString('vi-VN')} VND`);
            $('#finalPrice').text(`${totalPrice.toLocaleString('vi-VN')} VND`);
            $('#discountAmount').text('0 VND');
            voucher_id = null;
        });

        const updateTotalPrice = (totalPrice, voucher) => {
            let newTotalPrice = totalPrice;

            if (voucher.type === '%') {
                newTotalPrice = totalPrice - (totalPrice * (voucher.discount_value / 100));
            } else if (voucher.type === 'fixed') {
                newTotalPrice = totalPrice - voucher.discount_value;
            }

            newTotalPrice = Math.max(0, newTotalPrice);

            console.log('Tổng tiền sau giảm:', newTotalPrice);
            return newTotalPrice;
        };

        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();

            var checkInDateText = $('#check_in_date').text().trim();
            var checkOutDateText = $('#check_out_date').text().trim();

            function formatDateToISOString(dateString) {
                var dateParts = dateString.split('-');
                return dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
            }

            var formattedCheckInDate = formatDateToISOString(checkInDateText);
            var formattedCheckOutDate = formatDateToISOString(checkOutDateText);

            var checkInDate = new Date(formattedCheckInDate).getTime();
            var checkOutDate = new Date(formattedCheckOutDate).getTime();

            var adultQuantity = document.getElementById('adult').getAttribute('data-quantity');
            console.log(adultQuantity);

            var formData = {
                user_id: {{ Auth::user()->id }},
                check_in_date: checkInDate,
                check_out_date: checkOutDate,
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('input[name="email"]').val(),
                phone: $('input[name="phone"]').val(),
                address: $('#address').val(),
                message: $('#message').val(),
                room_id: $('#room_id').val(),
                payment_type: $('input[name="payment_type"]:checked').val(),
                voucher_id: voucher_id,
                total_price: $('#finalPrice').text().replace('VND', '').trim().replace(/\./g, ''),
                message: $('#message').val(),
                adults_quantity: adultQuantity,
            };

            console.log(formData);


            $.ajax({
                url: '/api/booking',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.type === 'success') {
                        Swal.fire({
                            title: 'Bạn có đảm bảo các thông tin trên là chính xác?',
                            text: "Nếu các thông tin chính xác, bạn sẽ được chuyển đến trang thanh toán.",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Tiếp tục',
                            cancelButtonText: 'Hủy',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = response.paymentUrl;
                            }
                        });
                    } else {
                        var errors = response.message;

                        if (errors.first_name) {
                            toastr.error(errors.first_name.join(', '), 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('input[name="first_name"]').addClass('is-invalid');
                        } else {
                            $('input[name="first_name"]').removeClass('is-invalid');
                        }

                        if (errors.last_name) {
                            toastr.error(errors.last_name.join(', '), 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('input[name="last_name"]').addClass('is-invalid');
                        } else {
                            $('input[name="last_name"]').removeClass('is-invalid');
                        }

                        if (errors.email) {
                            toastr.error(errors.email.join(', '), 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('input[name="email"]').addClass('is-invalid');
                        } else {
                            $('input[name="email"]').removeClass('is-invalid');
                        }

                        if (errors.phone) {
                            toastr.error(errors.phone.join(', '), 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('input[name="phone"]').addClass('is-invalid');
                        } else {
                            $('input[name="phone"]').removeClass('is-invalid');
                        }

                        if (errors.address) {
                            toastr.error(errors.address.join(', '), 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                            $('input[name="address"]').addClass('is-invalid');
                        } else {
                            $('input[name="address"]').removeClass('is-invalid');
                        }

                        if (errors.payment_type) {
                            toastr.error(errors.payment_type.join(', '), 'Lỗi', {
                                positionClass: 'toast-top-right',
                                timeOut: 5000,
                            });
                        }
                        if (errors.redirect) {
                            window.location = errors.redirect;
                        }
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Lỗi kết nối với server. Vui lòng thử lại sau!', 'Lỗi', {
                        positionClass: 'toast-top-right',
                        timeOut: 5000,
                    });
                }
            });

        });
    </script>
@endsection
