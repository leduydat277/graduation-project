@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <section id="slider" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="d-flex rounded-5"
                style="background-image: url(images/slider-image.jpg); background-size: cover; background-repeat: no-repeat; height: 85vh; background-position: center;">
                <div class="row align-items-center m-auto pt-5 px-4 px-lg-0">
                    <div class="text-start col-md-6 col-lg-5 col-xl-6 offset-lg-1">
                        <h2 class="display-1 fw-normal">Hotel mellow Your Gateway to Serenity.</h2>
                        <a href="room.html" class="btn btn-arrow btn-primary mt-3">
                            <span>Explore rooms <svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-4 mt-5 mt-md-0">
                        <form id="form" class="form-group flex-wrap bg-white p-5 rounded-4 ms-md-5">
                            <h3 class="display-5">Check availability</h3>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Check-In</label>
                                <div class="date position-relative bg-transparent" id="select-arrival-date">
                                    <a href="#" class="position-absolute top-50 end-0 translate-middle-y pe-2 ">

                                        <svg class="text-body" width="25" height="25">
                                            <use xlink:href="#calendar"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Check-Out</label>
                                <div class="date position-relative bg-transparent" id="select-departure-date">
                                    <a href="#" class="position-absolute top-50 end-0 translate-middle-y pe-2 ">

                                        <svg class="text-body" width="25" height="25">
                                            <use xlink:href="#calendar"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Rooms</label>
                                <input type="number" value="1" name="quantity"
                                    class="form-control text-black-50 ps-3">
                            </div>
                            <div class="col-lg-12 my-4">
                                <label class="form-label text-uppercase">Guests</label>
                                <input type="number" value="1" name="quantity"
                                    class="form-control text-black-50 ps-3">
                            </div>
                            <div class="d-grid">
                                <button href="#" class="btn btn-arrow btn-primary mt-3">
                                    <span>Check availability<svg width="18" height="18">
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

    <section id="about-us" class="padding-large">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <h3 class="display-3 text-center fw-normal col-lg-4 offset-lg-4">Mellow: Your Gateway to Serenity</h3>
            <div class="row align-items-start mt-3 mt-lg-5">
                <div class="col-lg-6">
                    <div class="p-5">
                        <p>Welcome to Hotel Mellow, where comfort meets tranquility. Nestled in the heart of a bustling
                            city, our
                            hotel offers a peaceful retreat for both business and leisure travelers. With modern amenities,
                            and a
                            warm, inviting atmosphere, we strive to make your stay with us.</p>
                        <a href="about.html" class="btn btn-arrow btn-primary mt-3">
                            <span>Read About Us <svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                    <img src="images/about-img1.jpg" alt="img" class="img-fluid rounded-4 mt-4">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <img src="images/about-img2.jpg" alt="img" class="img-fluid rounded-4">
                    <img src="images/about-img3.jpg" alt="img" class="img-fluid rounded-4 mt-4">

                </div>
            </div>
        </div>
    </section>

    <section id="info">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">25K <span
                            class="position-absolute top-50 end-50 translate-middle z-n1 ps-lg-4 pt-lg-4"><img
                                src="images/pattern1.png" alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">Happy Customer</p>
                </div>
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">160 <span
                            class="position-absolute top-50 translate-middle z-n1"><img src="images/pattern1.png"
                                alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">Total Rooms</p>
                </div>
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">25 <span
                            class="position-absolute top-100 pb-5 translate-middle z-n1"><img src="images/pattern1.png"
                                alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">award wins</p>
                </div>
                <div class="col-md-3 text-center mb-4 mb-lg-0">
                    <h3 class="display-1 fw-normal text-primary position-relative">200 <span
                            class="position-absolute top-50 end-50 pb-lg-4 pe-lg-2 translate-middle z-n1"><img
                                src="images/pattern1.png" alt="pattern" class="img-fluid"></span></h3>
                    <p class="text-capitalize">Total Members</p>
                </div>
            </div>
        </div>
    </section>

    <section id="room" class="padding-medium">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h3 class="display-3 fw-normal text-center">Explore our rooms</h3>
                </div>
                <a href="room.html" class="btn btn-arrow btn-primary mt-3">
                    <span>Explore rooms<svg width="18" height="18">
                            <use xlink:href="#arrow-right"></use>
                        </svg></span>
                </a>
            </div>

            <div class="swiper room-swiper mt-5">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
                            <img src="images/room1.jpg" alt="img" class="post-image img-fluid rounded-4">
                            <div class="product-description position-absolute p-5 text-start">
                                <h4 class="display-6 fw-normal text-white">Grand deluxe rooms</h4>
                                <p class="product-paragraph text-white">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit.
                                    Molestiae at illum ipsum similique doloribus.</p>
                                <table>
                                    <tbody>
                                        <tr class="text-white">
                                            <td class="pe-2">Price:</td>
                                            <td class="price">299$ /Pernight</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Size:</td>
                                            <td>10 ft</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Capacity:</td>
                                            <td>Max persion 2</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Bed:</td>
                                            <td>Normal Beds</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-details.html">
                                    <p class="text-decoration-underline text-white m-0 mt-2">Browse Now</p>
                                </a>
                            </div>
                        </div>
                        <div class="room-content text-center mt-3">
                            <h4 class="display-6 fw-normal"><a href="room-details.html">Grand deluxe rooms</a></h4>
                            <p><span class="text-primary fs-4">$269</span>/night</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
                            <img src="images/room3.jpg" alt="img" class="post-image img-fluid rounded-4">
                            <div class="product-description position-absolute p-5 text-start">
                                <h4 class="display-6 fw-normal text-white">Sweet Family room</h4>
                                <p class="product-paragraph text-white">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit.
                                    Molestiae at illum ipsum similique doloribus.</p>
                                <table>
                                    <tbody>
                                        <tr class="text-white">
                                            <td class="pe-2">Price:</td>
                                            <td class="price">299$ /Pernight</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Size:</td>
                                            <td>10 ft</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Capacity:</td>
                                            <td>Max persion 4</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Bed:</td>
                                            <td>Normal Beds</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-details.html">
                                    <p class="text-decoration-underline text-white m-0 mt-2">Browse Now</p>
                                </a>
                            </div>
                        </div>
                        <div class="room-content text-center mt-3">
                            <h4 class="display-6 fw-normal"><a href="room-details.html">Sweet Family room</a></h4>
                            <p><span class="text-primary fs-4">$360</span>/night</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
                            <img src="images/room2.jpg" alt="img" class="post-image img-fluid rounded-4">
                            <div class="product-description position-absolute p-5 text-start">
                                <h4 class="display-6 fw-normal text-white">Perfect Double Room</h4>
                                <p class="product-paragraph text-white">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit.
                                    Molestiae at illum ipsum similique doloribus.</p>
                                <table>
                                    <tbody>
                                        <tr class="text-white">
                                            <td class="pe-2">Price:</td>
                                            <td class="price">299$ /Pernight</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Size:</td>
                                            <td>10 ft</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Capacity:</td>
                                            <td>Max persion 2</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Bed:</td>
                                            <td>Normal Beds</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-details.html">
                                    <p class="text-decoration-underline text-white m-0 mt-2">Browse Now</p>
                                </a>
                            </div>
                        </div>
                        <div class="room-content text-center mt-3">
                            <h4 class="display-6 fw-normal"><a href="room-details.html">Perfect Double Room</a></h4>
                            <p><span class="text-primary fs-4">$450</span>/night</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
                            <img src="images/room1.jpg" alt="img" class="post-image img-fluid rounded-4">
                            <div class="product-description position-absolute p-5 text-start">
                                <h4 class="display-6 fw-normal text-white">Grand deluxe rooms</h4>
                                <p class="product-paragraph text-white">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit.
                                    Molestiae at illum ipsum similique doloribus.</p>
                                <table>
                                    <tbody>
                                        <tr class="text-white">
                                            <td class="pe-2">Price:</td>
                                            <td class="price">299$ /Pernight</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Size:</td>
                                            <td>10 ft</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Capacity:</td>
                                            <td>Max persion 2</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Bed:</td>
                                            <td>Normal Beds</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-details.html">
                                    <p class="text-decoration-underline text-white m-0 mt-2">Browse Now</p>
                                </a>
                            </div>
                        </div>
                        <div class="room-content text-center mt-3">
                            <h4 class="display-6 fw-normal"><a href="room-details.html">Grand deluxe rooms</a></h4>
                            <p><span class="text-primary fs-4">$269</span>/night</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-item position-relative bg-black rounded-4 overflow-hidden">
                            <img src="images/room3.jpg" alt="img" class="post-image img-fluid rounded-4">
                            <div class="product-description position-absolute p-5 text-start">
                                <h4 class="display-6 fw-normal text-white">Sweet Family room</h4>
                                <p class="product-paragraph text-white">Lorem ipsum dolor sit amet, consectetur adipisicing
                                    elit.
                                    Molestiae at illum ipsum similique doloribus.</p>
                                <table>
                                    <tbody>
                                        <tr class="text-white">
                                            <td class="pe-2">Price:</td>
                                            <td class="price">299$ /Pernight</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Size:</td>
                                            <td>10 ft</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Capacity:</td>
                                            <td>Max persion 4</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Bed:</td>
                                            <td>Normal Beds</td>
                                        </tr>
                                        <tr class="text-white">
                                            <td class="pe-2">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-details.html">
                                    <p class="text-decoration-underline text-white m-0 mt-2">Browse Now</p>
                                </a>
                            </div>
                        </div>
                        <div class="room-content text-center mt-3">
                            <h4 class="display-6 fw-normal"><a href="room-details.html">Sweet Family room</a></h4>
                            <p><span class="text-primary fs-4">$360</span>/night</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination room-pagination position-relative mt-5"></div>
            </div>
        </div>
    </section>

    <section id="gallery" data-aos="fade-up">
        <h3 class="display-3 fw-normal text-center">our gallery</h3>
        <p class="text-center col-lg-4 offset-lg-4 mb-5">Explore images of our well-appointed accommodations, featuring
            modern amenities and stylish decor designed to make your stay a memorable one. Admire the stunning views of the
            city skyline from our rooftop pool, where you can relax and unwind after a day of exploring the city.</p>
        <div class="container position-relative">
            <div class="row">
                <div class="swiper gallery-swiper offset-1 col-10">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="images/item3.jpg" alt="img" class="img-fluid rounded-4">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/item2.jpg" alt="img" class="img-fluid rounded-4">
                        </div>
                        <div class="swiper-slide">
                            <img src="images/item1.jpg" alt="img" class="img-fluid rounded-4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-absolute top-50 start-0 translate-middle-y main-slider-button-prev d-none d-md-block">
                <svg class="bg-secondary rounded-circle p-3" width="70" height="70">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
            <div class="position-absolute top-50 end-0 translate-middle-y main-slider-button-next d-none d-md-block">
                <svg class="bg-secondary rounded-circle p-3" width="70" height="70">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
            <div class="position-absolute top-100 end-50 translate-middle main-slider-button-prev mt-5 d-md-none d-block">
                <svg class="bg-secondary rounded-circle p-2" width="50" height="50">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
            <div
                class="position-absolute top-100 start-50 translate-middle main-slider-button-next mt-5 ms-4 d-md-none d-block">
                <svg class="bg-secondary rounded-circle p-2" width="50" height="50">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
        </div>
    </section>

    <section id="services" class="padding-medium">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <h3 class="display-3 text-center fw-normal col-lg-4 offset-lg-4">Our services & facilities</h3>
            <div class="row mt-5">
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
                        <a href="service-details.html" class="btn btn-arrow">
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
                        <a href="service-details.html" class="btn btn-arrow">
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
                        <a href="service-details.html" class="btn btn-arrow">
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
                        <a href="service-details.html" class="btn btn-arrow">
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
                        <a href="service-details.html" class="btn btn-arrow">
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
                        <a href="service-details.html" class="btn btn-arrow">
                            <span class="text-decoration-underline">Read More<svg width="18" height="18">
                                    <use xlink:href="#arrow-right"></use>
                                </svg></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="padding-medium pt-0">
        <div class="container-fluid padding-side" data-aos="fade-up">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h3 class="display-3 fw-normal text-center">Our Blogs & events</h3>
                </div>
                <a href="blog.html" class="btn btn-arrow btn-primary mt-3">
                    <span>More Blog<svg width="18" height="18">
                            <use xlink:href="#arrow-right"></use>
                        </svg></span>
                </a>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="blog-post position-relative overflow-hidden rounded-4">
                        <img src="images/post3.jpg" class="blog-img img-fluid rounded-4" alt="img">
                        <div class="position-absolute bottom-0 p-5">
                            <a href="#"><span
                                    class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Hotels</span></a>
                            <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">A Day in the Life of a Hotel
                                    Mellow Guest</a></h4>
                            <p class="m-0 align-items-center"><svg width="19" height="19">
                                    <use xlink:href="#clock"></use>
                                </svg> 22 Feb, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="blog-post position-relative overflow-hidden rounded-4">
                        <img src="images/post2.jpg" class="blog-img img-fluid rounded-4" alt="img">
                        <div class="position-absolute bottom-0 p-5">
                            <a href="#"><span
                                    class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Activites</span></a>
                            <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">Guide to Seasonal Activities
                                    in the City</a></h4>
                            <p class="m-0 align-items-center"><svg width="19" height="19">
                                    <use xlink:href="#clock"></use>
                                </svg> 22 Feb, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="blog-post position-relative overflow-hidden rounded-4">
                        <img src="images/post1.jpg" class="blog-img img-fluid rounded-4" alt="img">
                        <div class="position-absolute bottom-0 p-5">
                            <a href="#"><span
                                    class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Rooms</span></a>
                            <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">A Look Inside Hotel Mellow's
                                    Suites</a></h4>

                            <p class="m-0 align-items-center"><svg width="19" height="19">
                                    <use xlink:href="#clock"></use>
                                </svg> 22 Feb, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 mb-4">
                    <div class="blog-post position-relative overflow-hidden rounded-4">
                        <img src="images/post5.jpg" class="blog-img img-fluid rounded-4" alt="img">
                        <div class="position-absolute bottom-0 p-4">
                            <a href="#"><span
                                    class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Activites</span></a>
                            <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">Why Hotel Mellow Is the
                                    Perfect Staycation
                                    Destination</a></h4>
                            <p class="m-0 align-items-center"><svg width="19" height="19">
                                    <use xlink:href="#clock"></use>
                                </svg> 22 Feb, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="blog-post position-relative overflow-hidden rounded-4">
                        <img src="images/post4.jpg" class="blog-img img-fluid rounded-4" alt="img">
                        <div class="position-absolute bottom-0 p-5">
                            <a href="#"><span
                                    class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Rooms</span></a>
                            <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">The Benefits of Booking
                                    Directly with Hotel Mellow</a>
                            </h4>
                            <p class="m-0 align-items-center"><svg width="19" height="19">
                                    <use xlink:href="#clock"></use>
                                </svg> 22 Feb, 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
