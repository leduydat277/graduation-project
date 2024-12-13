@extends('client.layouts.master')

@section('title')
    Đặt phòng
@endsection

@section('content')
@include('client.layouts.banner.banner')
    <section class="checkout-wrap padding-small">
        <div class="container-fluid padding-side">
            <div class="display-header d-flex justify-content-between pb-3">
                <h4 class="display-6 fw-normal my-3">Make a Reservation</h4>
            </div>
            <form class="form-group mt-4">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <h4 class="text-dark pb-4">Details</h4>
                        <div class="billing-details">
                            <form id="form" class="form-group flex-wrap">
                                <div class="col-lg-12 mb-3">
                                    <label for="arrive-date" class="label-style fw-medium form-label">Select
                                        Room</label>
                                    <select class="form-select form-control ps-3" aria-label="Default select example">
                                        <option selected>Select Room</option>
                                        <option value="1">Classic Room</option>
                                        <option value="2">Standard Room</option>
                                        <option value="3">Superior Room</option>
                                        <option value="4">Junior Suite </option>
                                        <option value="5">Deluxe Room </option>
                                        <option value="6">Grand Superior Room</option>
                                        <option value="7">Family Special</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="exampleInputEmail1" class="form-label ">Room</label>
                                    <input type="number" value="1" name="quantity" class="form-control ps-3">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="exampleInputEmail1" class="form-label ">Guest</label>
                                    <input type="number" value="1" name="quantity" class="form-control ps-3">
                                </div>
                                <div class="form-input col-lg-12 mb-3">
                                    <label for="arrive-date" class="label-style fw-medium form-label">Check-in
                                        Date</label>
                                    <div class="form-input col-lg-12 d-flex mb-3">
                                        <div class="input-group date" id="datepicker">
                                            <input type="date" id="start" name="appointment" min="2023-01-01"
                                                max="2023-12-31" class="form-control ps-3">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-input col-lg-12 mb-3">
                                    <label for="return-date" class="label-style fw-medium form-label">Check-out
                                        Date</label>
                                    <div class="form-input col-lg-12 d-flex mb-3">
                                        <div class="input-group date" id="datepicker">
                                            <input type="date" id="start" name="appointment" min="2023-01-01"
                                                max="2023-12-31" class="form-control ps-3">
                                        </div>

                                    </div>

                                </div>
                                <div class="form-input col-lg-12 mb-3">
                                    <label for="name" class="label-style fw-medium form-label">Your Name</label>
                                    <input type="text" name="email" placeholder="Write Your Name Here"
                                        class="form-control ps-3 me-3">

                                </div>
                                <div class="form-input col-lg-12 mb-3">
                                    <label for="name" class="label-style fw-medium form-label">Your Email</label>

                                    <input type="text" name="email" placeholder="Write Your Email Here"
                                        class="form-control ps-3">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="name" class="label-style fw-medium form-label">Your Phone Number</label>

                                    <input type="text" name="email" placeholder="Phone Number"
                                        class="form-control ps-3">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="name" class="label-style fw-medium form-label">Your Message</label>

                                    <textarea placeholder="Write Your Message Here" class="form-control ps-3" rows="8"></textarea>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="your-order">
                            <h4 class="display-7 text-dark pb-4">Total Bill</h4>
                            <div class="total-price">
                                <table cellspacing="0" class="table table-borderless">
                                    <tbody>
                                        <tr class="subtotal border-top pt-2 pb-2 text-uppercase">
                                            <th>Subtotal</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol">$</span>2,370.00 </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="subtotal  border-bottom pt-2 pb-2 text-uppercase">
                                            <th>VAT</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol">$</span>250.00 </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="order-total border-bottom pt-2 pb-2 text-uppercase">
                                            <th>Total</th>
                                            <td data-title="Total">
                                                <span class="price-amount amount ps-5">
                                                    <bdi>
                                                        <span class="price-currency-symbol">$</span>2,620.00 </bdi>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="list-group mt-5 mb-3">
                                    <h4 class="display-7 text-dark pb-4">Payment Option</h4>

                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios1" value="" checked>
                                        <span>
                                            <strong class="text-uppercase">Direct bank transfer</strong>
                                            <small class="d-block text-body-secondary">Make your payment directly into
                                                our bank account. Please use your Order ID. Your order will shipped
                                                after funds have cleared in our account.</small>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios2" value="">
                                        <span>
                                            <strong class="text-uppercase">Check payments</strong>
                                            <small class="d-block text-body-secondary">Please send a check to Store
                                                Name, Store Street, Store Town, Store State / County, Store
                                                Postcode.</small>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios3" value="">
                                        <span>
                                            <strong class="text-uppercase">Cash</strong>
                                            <small class="d-block text-body-secondary">Pay with cash on site.</small>
                                        </span>
                                    </label>
                                    <label class="list-group-item d-flex gap-2 border-0">
                                        <input class="form-check-input flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios3" value="">
                                        <span>
                                            <strong class="text-uppercase">Paypal</strong>
                                            <small class="d-block text-body-secondary">Pay via PayPal; you can pay with
                                                your credit card if you don’t have a PayPal account.</small>
                                        </span>
                                    </label>
                                </div>
                                <button type="submit" name="submit" class="btn btn-arrow btn-primary mt-3"><span>Make
                                        Reservation <svg width="18" height="18">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
