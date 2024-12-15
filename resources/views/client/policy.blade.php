@extends('client.layouts.master')

@section('title')
    Điều khoản
@endsection

@section('content')
@include('client.layouts.banner.banner')

    <section class="padding-small">
        <div class="container-fluid padding-side">
            <div class="row g-lg-5 my-4">
                <main class="col-lg-8">
                    <h4 class="display-6 fw-normal my-3">Frequently asked questions</h4>
                    <p>Malesuada nunc vel risus commodo viverra. Viverra accumsan in nisl nisi. Pretium nibh ipsum consequat
                        nisl
                        vel pretium. Tortor dignissim convallis aenean et tortor at risus viverra adipiscing.</p>
                    <div class="page-content my-5">

                        <div class="accordion" id="accordion-box">
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4 border-0" id="heading-one">
                                    <button class="accordion-button rounded-4" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">How to Book the time?</h3>
                                    </button>
                                </div>
                                <div id="collapse-one" class="accordion-collapse collapse show"
                                    aria-labelledby="heading-one">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-two">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-two" aria-expanded="false"
                                        aria-controls="collapse-two">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">Should do all steps compulsory?</h3>
                                    </button>
                                </div>
                                <div id="collapse-two" class="accordion-collapse collapse" aria-labelledby="heading-two">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-three">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-three" aria-expanded="false"
                                        aria-controls="collapse-three">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">Can i get discounts?</h3>
                                    </button>
                                </div>
                                <div id="collapse-three" class="accordion-collapse collapse"
                                    aria-labelledby="heading-three">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-four">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-four" aria-expanded="false"
                                        aria-controls="collapse-four">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">What informations should i need to
                                            provide when booking?</h3>
                                    </button>
                                </div>
                                <div id="collapse-four" class="accordion-collapse collapse" aria-labelledby="heading-four">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-five">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-five" aria-expanded="false"
                                        aria-controls="collapse-five">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">Can i cancel my Booking?</h3>
                                    </button>
                                </div>
                                <div id="collapse-five" class="accordion-collapse collapse"
                                    aria-labelledby="heading-five">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-six">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-six" aria-expanded="false"
                                        aria-controls="collapse-six">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">What’s your refund policy?</h3>
                                    </button>
                                </div>
                                <div id="collapse-six" class="accordion-collapse collapse" aria-labelledby="heading-six">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-seven">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-seven" aria-expanded="false"
                                        aria-controls="collapse-seven">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">I haven’t received my appoitment
                                            details</h3>
                                    </button>
                                </div>
                                <div id="collapse-seven" class="accordion-collapse collapse"
                                    aria-labelledby="heading-seven">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-eight">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-eight" aria-expanded="false"
                                        aria-controls="collapse-eight">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">How is charge determined?</h3>
                                    </button>
                                </div>
                                <div id="collapse-eight" class="accordion-collapse collapse"
                                    aria-labelledby="heading-eight">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-3 rounded-4">
                                <div class="accordion-header rounded-4" id="heading-nine">
                                    <button class="accordion-button rounded-4 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-nine" aria-expanded="false"
                                        aria-controls="collapse-nine">
                                        <h3 class="accordion-title fs-5 fw-bold m-0">Where is your hotel located?</h3>
                                    </button>
                                </div>
                                <div id="collapse-nine" class="accordion-collapse collapse"
                                    aria-labelledby="heading-nine">
                                    <div class="accordion-body">
                                        <div class="faqs-box">
                                            <div class="element-box margin-xsmall d-flex align-items-center">
                                                <div class="item-title">Quisque volutpat mattis eros. Nullam malesuada erat
                                                    ut turpis.
                                                    Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec
                                                    nec justo eget felis
                                                    facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean
                                                    dignissim pellentesque
                                                    felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                                                    consectetuer ligula
                                                    vulputate sem tristique cursus. </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <div class="inquiry-item col-lg-4">
                    <h3 class="section-title mb-3">Ask us anything</h3>
                    <p>Call Us +123 987 456 or just drop us your message at <a
                            href="mailto:contact@yourcompany.com">contact@yourcompany.com</a>. You can directly message us.
                    </p>
                    <form id="form" class="form-group flex-wrap">
                        <div class="form-input col-lg-12 d-flex mb-3">
                            <input type="text" name="email" placeholder="Write Your Name Here"
                                class="form-control ps-3 me-3">
                            <input type="text" name="email" placeholder="Write Your Email Here"
                                class="form-control ps-3">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="email" placeholder="Phone Number" class="form-control ps-3">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="email" placeholder="Write Your Subject Here"
                                class="form-control ps-3">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <textarea placeholder="Write Your Message Here" class="form-control ps-3" rows="8"></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-arrow btn-primary mt-3"><span>Submit <svg width="18"
                                        height="18">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
