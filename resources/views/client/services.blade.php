@extends('client.layouts.master')

@section('title')
    Tiện nghi
@endsection

@section('content')
    <section id="slider" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="d-flex rounded-5"
                style="background-image: url(images/slider-image1.jpg); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
                <div class="row align-items-center m-auto">
                    <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                        <h2 class="display-1 fw-normal">Services</h2>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="breadcrumb-item active" aria-current="page">Services</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="padding-medium">
        <div class="container-fluid padding-side">
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="service mb-4 text-center rounded-4 p-5">
                        <div class="position-relative">
                            <svg class="color" width="70" height="70">
                                <use xlink:href="#meditation"></use>
                            </svg>
                            <img src="images/pattern2.png" alt="img"
                                class="position-absolute top-100 start-50 translate-middle z-n1 pe-5">
                        </div>
                        <h4 class="display-6 fw-normal my-3">Yoga & Meditation</h4>
                        <p>Rejuvenate your body and mind with our yoga and meditation classes, led by experienced
                            instructors.
                            Whether you're a beginner or an advanced practitioner, our classes cater to all levels and offer
                            a
                            peaceful retreat from the hustle and bustle of the city. With serene surroundings and expert
                            guidance.</p>
                        <a href="service-details.html" class="btn btn-arrow border-0">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="service mb-4 text-center rounded-4 p-5">
                        <div class="position-relative">
                            <svg class="color" width="70" height="70">
                                <use xlink:href="#chef-hat"></use>
                            </svg>
                            <img src="images/pattern2.png" alt="img"
                                class="position-absolute top-100 start-50 translate-middle z-n1 pe-5">
                        </div>
                        <h4 class="display-6 fw-normal my-3">Dining</h4>
                        <p>Rejuvenate your body and mind with our yoga and meditation classes, led by experienced
                            instructors.
                            Whether you're a beginner or an advanced practitioner, our classes cater to all levels and offer
                            a
                            peaceful retreat from the hustle and bustle of the city. With serene surroundings and expert
                            guidance.</p>
                        <a href="service-details.html" class="btn btn-arrow border-0">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="service mb-4 text-center rounded-4 p-5">
                        <div class="position-relative">
                            <svg class="color" width="70" height="70">
                                <use xlink:href="#swimming"></use>
                            </svg>
                            <img src="images/pattern2.png" alt="img"
                                class="position-absolute top-100 start-50 translate-middle z-n1 pe-5">
                        </div>
                        <h4 class="display-6 fw-normal my-3">Rooftop Pool</h4>
                        <p>Rejuvenate your body and mind with our yoga and meditation classes, led by experienced
                            instructors.
                            Whether you're a beginner or an advanced practitioner, our classes cater to all levels and offer
                            a
                            peaceful retreat from the hustle and bustle of the city. With serene surroundings and expert
                            guidance.</p>
                        <a href="service-details.html" class="btn btn-arrow border-0">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="service mb-4 text-center rounded-4 p-5">
                        <div class="position-relative">
                            <svg class="color" width="70" height="70">
                                <use xlink:href="#dumbbells"></use>
                            </svg>
                            <img src="images/pattern2.png" alt="img"
                                class="position-absolute top-100 start-50 translate-middle z-n1 pe-5">
                        </div>
                        <h4 class="display-6 fw-normal my-3">Fitness Center</h4>
                        <p>Rejuvenate your body and mind with our yoga and meditation classes, led by experienced
                            instructors.
                            Whether you're a beginner or an advanced practitioner, our classes cater to all levels and offer
                            a
                            peaceful retreat from the hustle and bustle of the city. With serene surroundings and expert
                            guidance.</p>
                        <a href="service-details.html" class="btn btn-arrow border-0">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="service mb-4 text-center rounded-4 p-5">
                        <div class="position-relative">
                            <svg class="color" width="70" height="70">
                                <use xlink:href="#armchair"></use>
                            </svg>
                            <img src="images/pattern2.png" alt="img"
                                class="position-absolute top-100 start-50 translate-middle z-n1 pe-5">
                        </div>
                        <h4 class="display-6 fw-normal my-3">Event Spaces</h4>
                        <p>Rejuvenate your body and mind with our yoga and meditation classes, led by experienced
                            instructors.
                            Whether you're a beginner or an advanced practitioner, our classes cater to all levels and offer
                            a
                            peaceful retreat from the hustle and bustle of the city. With serene surroundings and expert
                            guidance.</p>
                        <a href="service-details.html" class="btn btn-arrow border-0">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="service mb-4 text-center rounded-4 p-5">
                        <div class="position-relative">
                            <svg class="color" width="70" height="70">
                                <use xlink:href="#wifi"></use>
                            </svg>
                            <img src="images/pattern2.png" alt="img"
                                class="position-absolute top-100 start-50 translate-middle z-n1 pe-5">
                        </div>
                        <h4 class="display-6 fw-normal my-3">Free Wi-Fi</h4>
                        <p>Rejuvenate your body and mind with our yoga and meditation classes, led by experienced
                            instructors.
                            Whether you're a beginner or an advanced practitioner, our classes cater to all levels and offer
                            a
                            peaceful retreat from the hustle and bustle of the city. With serene surroundings and expert
                            guidance.</p>
                        <a href="service-details.html" class="btn btn-arrow border-0">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
