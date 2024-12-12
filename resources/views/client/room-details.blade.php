@extends('client.layouts.master')

@section('title')
    Chi tiết phòng
@endsection

@section('content')
    <section id="slider" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="d-flex rounded-5"
                style="background-image: url(images/slider-image1.jpg); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
                <div class="row align-items-center m-auto">
                    <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                        <h2 class="display-1 fw-normal">Room-Details</h2>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="breadcrumb-item active" aria-current="page">Room-Details</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="post-wrap my-5">
        <div class="container-fluid padding-side">
            <div class="row g-lg-5">
                <main class="post-grid col-lg-9">
                    <div class="row">
                        <article class="property">

                            <div class="row flex-column">
                                <div class="col-md-12">
                                    <!-- product-large-slider -->
                                    <div class="swiper product-large-slider">
                                        <div class="swiper-wrapper">

                                            <div class="swiper-slide">
                                                <img src="images/item1.jpg" alt="product-large" class="img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item2.jpg" alt="product-large" class="img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item3.jpg" alt="product-large" class="img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item1.jpg" alt="product-large" class="img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item2.jpg" alt="product-large" class="img-fluid">
                                            </div>

                                        </div>
                                    </div>
                                    <!-- / product-large-slider -->
                                </div>
                                <div class="col-md-12 mt-2">
                                    <!-- product-thumbnail-slider -->
                                    <div thumbsSlider="" class="swiper product-thumbnail-slider">
                                        <div class="swiper-wrapper">

                                            <div class="swiper-slide">
                                                <img src="images/item1.jpg" alt="image" class="thumb-image img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item2.jpg" alt="image" class="thumb-image img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item3.jpg" alt="image" class="thumb-image img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item1.jpg" alt="image" class="thumb-image img-fluid">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="images/item2.jpg" alt="image" class="thumb-image img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / product-thumbnail-slider -->
                                </div>

                            </div>

                            <div class="post-content py-5">

                                <div class="d-flex justify-content-between align-items-center my-3">
                                    <h4 class="display-6 fw-normal">Grand deluxe rooms</h4>
                                    <p class="m-0"><span class="text-primary fs-2">$269</span>/night</p>
                                </div>
                                <hr>
                                <div class="overview my-5">
                                    <h4 class="display-6 fw-normal mb-3">Room Overview</h4>
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                                        <div class="col d-flex align-items-start">
                                            <iconify-icon icon="fluent:bed-24-regular"
                                                class="property-icon border border-primary text-primary fs-4 p-3"></iconify-icon>
                                            <div class="ms-4">
                                                <h5 class="fw-bold">Bed</h5>
                                                <p>2</p>
                                            </div>
                                        </div>
                                        <div class="col d-flex align-items-start">
                                            <iconify-icon icon="material-symbols:shower-outline"
                                                class="property-iconborder border border-primary text-primary fs-4 p-3"></iconify-icon>
                                            <div class="ms-4">
                                                <h5 class="fw-bold">Bath</h5>
                                                <p>2</p>
                                            </div>
                                        </div>
                                        <div class="col d-flex align-items-start">
                                            <iconify-icon icon="fluent:person-16-regular"
                                                class="property-iconborder border border-primary text-primary fs-4 p-3"></iconify-icon>
                                            <div class="ms-4">
                                                <h5 class="fw-bold">Person</h5>
                                                <p>4</p>
                                            </div>
                                        </div>
                                        <div class="col d-flex align-items-start">
                                            <iconify-icon icon="bi:wifi"
                                                class="property-iconborder border border-primary text-primary fs-4 p-3"></iconify-icon>
                                            <div class="ms-4">
                                                <h5 class="fw-bold">WiFi</h5>
                                                <p>Free</p>
                                            </div>
                                        </div>
                                        <div class="col d-flex align-items-start">
                                            <iconify-icon icon="material-symbols:ac-unit"
                                                class="property-iconborder border border-primary text-primary fs-4 p-3"></iconify-icon>
                                            <div class="ms-4">
                                                <h5 class="fw-bold">Air Conditioner</h5>
                                                <p>Yes</p>
                                            </div>
                                        </div>
                                        <div class="col d-flex align-items-start">
                                            <iconify-icon icon="fluent:tv-24-regular"
                                                class="property-iconborder border border-primary text-primary fs-4 p-3"></iconify-icon>
                                            <div class="ms-4">
                                                <h5 class="fw-bold">TV Cable</h5>
                                                <p>Yes</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="price my-5">
                                    <h4 class="display-6 fw-normal mb-3">Price Details</h4>
                                    <p> <span class="fw-bold">Per Night :</span> $299</p>
                                    <p> <span class="fw-bold">Service Charge :</span> $80 </p>
                                    <p> <span class="fw-bold">Cleaning Fee :</span> $50</p>
                                </div>
                                <hr>
                                <div class="details my-5">
                                    <h4 class="display-6 fw-normal mb-3">Room Details</h4>
                                    <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet minima
                                        dignissimos, voluptates quasi nam laboriosam? Esse aut, velit a ullam numquam
                                        excepturi quidem porro sunt eaque, aperiam cupiditate, iure dignissimos?
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, aut explicabo
                                        sunt nesciunt saepe consequatur hic voluptates facilis beatae veniam ut totam
                                        cum? Atque cupiditate corrupti, consequuntur pariatur dolorum laborum.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem assumenda,
                                        perspiciatis velit est possimus sapiente consequatur dolorem! Alias a eos quae?
                                        Modi eos quo reiciendis, aliquam sequi dicta laborum esse.
                                    </p>

                                </div>
                                <hr>
                                <div class="feature my-5">
                                    <h4 class="display-6 fw-normal mb-3">Features & Amenities</h4>
                                    <div class="d-md-flex">
                                        <ul class="ms-4 me-5">
                                            <li>Air Conditioning </li>
                                            <li>Barbeque </li>
                                            <li>Dryer </li>
                                            <li>Gym </li>
                                            <li>Lawn </li>
                                            <li>Microwave </li>
                                        </ul>
                                        <ul class="ms-4">
                                            <li>Outdoor Shower </li>
                                            <li>Refrigerator </li>
                                            <li>Swimming Pool </li>
                                            <li>TV Cable </li>
                                            <li>Washer </li>
                                            <li>WiFi </li>
                                        </ul>
                                    </div>

                                </div>
                                <hr>
                                <div class="address my-5">
                                    <h4 class="display-6 fw-normal mb-3">Location</h4>
                                    <div class="d-flex">
                                        <div class="me-5">
                                            <p> <span class="fw-bold">Address :</span> 10425 Tabor St</p>
                                            <p> <span class="fw-bold">City :</span> Los Angeles</p>
                                            <p> <span class="fw-bold">State/county :</span> California</p>
                                        </div>
                                        <div class="ms-5">
                                            <p> <span class="fw-bold">Zip/Postal Code :</span> 90034</p>
                                            <p> <span class="fw-bold">Area :</span> Brookside</p>
                                            <p> <span class="fw-bold">Country :</span> United States</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </article>

                        <section id="post-comment">
                            <div class="container">
                                <div class="row">
                                    <div class="comments-wrap">
                                        <h3 class="display-6 fw-normal mb-5">
                                            <span class="count">3</span> Comments
                                        </h3>
                                        <div class="comment-list">
                                            <article class="comment-item pb-3 row">
                                                <div class="col-md-2">
                                                    <img src="images/commentor-item1.jpg" alt="default"
                                                        class="commentor-image img-fluid rounded-circle">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="author-post mb-4">
                                                        <div class="comment-meta text-uppercase d-flex gap-3 text-black">
                                                            <div class="author-name fw-semibold">Lufy carlson</div>
                                                            <span class="meta-date">Jul 10</span>
                                                        </div>
                                                        <p>Tristique tempis condimentum diam done ullancomroer sit element
                                                            henddg sit he
                                                            consequert.Tristique tempis condimentum diam done ullancomroer
                                                            sit element henddg sit he
                                                            consequert.</p>
                                                        <div class="comments-reply border-animation">
                                                            <a href="#">
                                                                <i class="icon icon-mail-reply"></i>Reply </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <article class="comment-item pb-3 row child-comments">
                                                <div class="col-md-2">
                                                    <img src="images/commentor-item2.jpg" alt="default"
                                                        class="commentor-image img-fluid rounded-circle">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="author-post mb-4">
                                                        <div class="comment-meta text-uppercase d-flex gap-3 text-black ">
                                                            <div class="author-name fw-semibold">Lora leigh</div>
                                                            <span class="meta-date">Jul 10</span>
                                                        </div>
                                                        <p>Tristique tempis condimentum diam done ullancomroer sit element
                                                            henddg sit he
                                                            consequert.Tristique tempis condimentum diam done ullancomroer
                                                            sit element henddg sit he
                                                            consequert.</p>
                                                        <div class="comments-reply border-animation">
                                                            <a href="#">
                                                                <i class="icon icon-mail-reply"></i>Reply </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <article class="comment-item pb-3 row">
                                                <div class="col-md-2">
                                                    <img src="images/commentor-item3.jpg" alt="default"
                                                        class="commentor-image img-fluid rounded-circle">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="author-post mb-4">
                                                        <div class="comment-meta text-uppercase d-flex gap-3 text-black ">
                                                            <div class="author-name fw-semibold">Natalie dormer</div>
                                                            <span class="meta-date">Jul 10</span>
                                                        </div>
                                                        <p>Tristique tempis condimentum diam done ullancomroer sit element
                                                            henddg sit he
                                                            consequert.Tristique tempis condimentum diam done ullancomroer
                                                            sit element henddg sit he
                                                            consequert.</p>
                                                        <div class="comments-reply border-animation">
                                                            <a href="#">
                                                                <i class="icon icon-mail-reply"></i>Reply </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="comment-respond mt-5">
                                        <h3 class="display-6 fw-normal mb-5">Leave a Comment</h3>
                                        <p>Your email address will not be published. Required fields are marked *</p>
                                        <form method="post" class="form-group ">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <textarea class="form-control bg-transparent ps-3 pt-3" id="comment" name="comment"
                                                        placeholder="Write your comment here *"></textarea>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <input class="form-control bg-transparent ps-3" type="text"
                                                        name="author" id="author"
                                                        placeholder="Write your full name here *">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input class="form-control bg-transparent ps-3" type="email"
                                                        name="email" id="email"
                                                        placeholder="Write your e-mail address *">
                                                </div>
                                                <div class="col-lg-12">
                                                    <label class="d-flex align-items-center">
                                                        <input type="checkbox" class="checked-box me-2">
                                                        <span class="label-body">Save my name, email, and website in this
                                                            browser for the next
                                                            time.</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="btn btn-arrow btn-primary mt-3" type="submit">
                                                <span>Submit<svg width="18" height="18">
                                                        <use xlink:href="#arrow-right"></use>
                                                    </svg></span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
                <aside class="col-lg-3 mt-5">
                    <div class=" ">
                        <form id="form" class="form-group flex-wrap p-4 border rounded-4">
                            <h2 class=" fs-2 text-black my-3 mb-5">Reserve Now</h2>

                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Check-In</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" id="start" name="appointment" min="2023-01-01"
                                        max="2023-12-31" class="form-control ps-3 me-3">
                                </div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Check-Out</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" id="start" name="appointment" min="2023-01-01"
                                        max="2023-12-31" class="form-control ps-3 me-3">
                                </div>
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Room</label>
                                <input type="number" value="1" name="quantity" class="form-control ps-3">
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Adult</label>
                                <input type="number" value="1" name="quantity" class="form-control ps-3">
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Children</label>
                                <input type="number" value="0" name="quantity" class="form-control ps-3">
                            </div>
                            <div class="col-lg-12 my-4">
                                <label for="exampleInputEmail1" class="form-label text-black">Your
                                    Message</label>
                                <textarea placeholder="Write Your Message Here" class="form-control ps-3" rows="8"></textarea>
                            </div>
                            <div class="d-grid mb-3">
                                <button class="btn btn-arrow btn-primary"> <span>Check Availabitily<svg width="18"
                                            height="18">
                                            <use xlink:href="#arrow-right"></use>
                                        </svg></span></button>
                            </div>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
