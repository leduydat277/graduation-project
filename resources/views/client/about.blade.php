@extends('client.layouts.master')

@section('title')
    Về chúng tôi
@endsection

@section('content')
@include('client.layouts.banner.banner')

    <section id="about-us" class="padding-medium">
        <div class="vertical-element">
            <div class="container-fluid padding-side">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6">
                        <div class="image-holder">
                            <img src="{{ asset('assets/client/images/item1.jpg') }} " alt="about-us" class="img-fluid rounded-4">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-element p-5">
                            <h3 class="display-3 fw-normal">Who are we?</h3>
                            <p>The beginning of our journey vel tellus Turpis purus, gravida orci, fringilla a. Ac
                                sed
                                eu fringilla odio mi. Consequat pharetra at magna imperdiet cursus ac faucibus sit
                                libero. Ultricies quam nunc, lorem sit lorem urna, pretium aliquam ut. In vel, quis
                                donec dolor id in. Pulvinar commodo mollis diam sed facilisis at magna imperdiet
                                cursus
                                ac faucibus sit libero.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="vertical-element mt-md-5 py-md-5">
            <div class="container-fluid padding-side">
                <div class="row flex-row-reverse align-items-center">
                    <div class="col-lg-6">
                        <div class="image-holder text-right">
                            <img src="{{ asset('assets/client/images/item3.jpg') }} " alt="about-us" class="img-fluid rounded-4">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-element p-5">
                            <h3 class="display-3 fw-normal">Choose us for best services</h3>
                            <p>We are nunc, lorem sit lorem urna, pretium aliquam ut. In vel, quis donec dolor id
                                in.
                                Pulvinar commodo mollis diam sed facilisis at magna imperdiet cursus ac faucibus sit
                                libero. Dignissim lacus, turpis ut suspendisse vel tellus. Turpis purus, gravida
                                orci,
                                fringilla a. Ac sed eu fringilla odio mi. Consequat pharetra at magna imperdiet
                                cursus
                                ac faucibus sit libero.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="info">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">25K <span
                            class="position-absolute top-50 end-50 translate-middle z-n1 ps-lg-4 pt-lg-4"><img
                                src="{{ asset('assets/client/images/pattern1.png') }} " alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">Happy Customer</p>
                </div>
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">160 <span
                            class="position-absolute top-50 translate-middle z-n1"><img src="{{ asset('assets/client/images/pattern1.png') }} "
                                alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">Total Rooms</p>
                </div>
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">25 <span
                            class="position-absolute top-100 pb-5 translate-middle z-n1"><img src="{{ asset('assets/client/images/pattern1.png') }} "
                                alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">award wins</p>
                </div>
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">200 <span
                            class="position-absolute top-50 end-50 pb-lg-4 pe-lg-2 translate-middle z-n1"><img
                                src="{{ asset('assets/client/images/pattern1.png') }} " alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">Total Members</p>
                </div>
            </div>
        </div>
    </section>

    <section id="vid" class="padding-medium">
        <div class="container-fluid padding-side">
            <h3 class="display-3 fw-normal text-center">View our Hotel</h3>
            <div class="imageblock me-4 position-relative mt-5">
                <img class="img-fluid" src="{{ asset('assets/client/images/video.jpg') }} " alt="img">
                <a type="button" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/W_tIumKa8VY"
                    data-bs-target="#myModal" class="play-btn position-absolute top-50 start-50 translate-middle">
                    <svg class="play-icon" width="70" height="70">
                        <use xlink:href="#play"></use>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
