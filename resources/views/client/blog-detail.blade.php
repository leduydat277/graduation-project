@extends('client.layouts.master')

@section('title')
    Chi tiết bài viết
@endsection

@section('content')
    <section id="slider" data-aos="fade-up">
        <div class="container-fluid padding-side">
            <div class="d-flex rounded-5"
                style="background-image: url(images/slider-image1.jpg); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
                <div class="row align-items-center m-auto">
                    <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                        <h2 class="display-1 fw-normal">Blog-Single</h2>
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="breadcrumb-item active" aria-current="page">Blog-Single</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="post-wrap padding-small">
        <div class="container-fluid padding-side">
            <div class="row g-5">
                <main class="post-grid col-md-9">
                    <div class="row">
                        <article class="post-item">

                            <h3 class="display-3 fw-normal mb-5">A Day in the Life of a Hotel Mellow Guest</h3>

                            <div class="hero-image">
                                <img src="images/post5.jpg" alt="single-post" class="img-fluid rounded-4">
                            </div>
                            <div class="post-content py-5">
                                <div class="post-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Consectetur facilisis
                                        vivamus massa magna.
                                        Blandit mauris libero condimentum commodo morbi consectetur sociis convallis sit.
                                        Magna diam amet
                                        justo sed vel dolor et volutpat integer. Iaculis sit sapien hac odio elementum
                                        egestas neque.
                                        Adipiscing purus euismod orci sem amet, et. Turpis erat ornare nisi laoreet est
                                        euismod.</p>
                                    <p>Sit suscipit tortor turpis sed fringilla lectus facilisis amet. Ipsum, amet dolor
                                        curabitur non
                                        aliquet orci urna volutpat. Id aliquam neque, ut vivamus sit imperdiet enim, lacus,
                                        vel. Morbi arcu
                                        amet, nulla fermentum vitae mattis arcu mi convallis. Urna in sollicitudin in
                                        vestibulum erat.
                                        Turpis faucibus augue ipsum, at aliquam. Cras sagittis tellus nunc integer vitae
                                        neque bibendum
                                        eget. Tempus malesuada et pellentesque maecenas. Sociis porttitor elit tincidunt
                                        tellus sit ornare.
                                        Purus ut quis sed venenatis eget ut ipsum, enim lacus. Praesent imperdiet vitae eu,
                                        eu tincidunt
                                        nunc integer sit.</p>
                                    <blockquote>“Sit suscipit tortor turpis sed fringilla lectus facilisis amet. Ipsum, amet
                                        dolor
                                        curabitur non aliquet orci urna volutpat. Id aliquam neque, ut vivamus sit imperdiet
                                        enim, lacus,
                                        vel.</blockquote>
                                    <h4 class="mt-4">Consectetur Facilisis Vivamus</h4>
                                    <ul class="inner-list mb-4">
                                        <li>Blandit mauris libero condimentum commodo sociis convallis sit.</li>
                                        <li>Magna diam amet justo sed vel dolor et volutpat integer.</li>
                                        <li>Laculis sit sapien hac odio elementum egestas neque.</li>
                                    </ul>
                                    <p>Morbi arcu amet, nulla fermentum vitae mattis arcu mi convallis. Urna in sollicitudin
                                        in vestibulum
                                        erat. Turpis faucibus augue ipsum, at aliquam. Cras sagittis tellus nunc integer
                                        vitae neque
                                        bibendum eget. Tempus malesuada et pellentesque maecenas. Sociis porttitor elit
                                        tincidunt tellus sit
                                        ornare. Purus ut ipsum, enim lacus. Praesent imperdiet vitae eu, eu tincidunt nunc
                                        integer sit.</p>
                                    <p>Tortor diam dignissim amet, in interdum aliquet. Magnis dictum et eros purus
                                        fermentum, massa
                                        ullamcorper sit sollicitudin. Nascetur libero elementum adipiscing mauris maecenas
                                        et magna. Etiam
                                        nec, rutrum a diam lacus, nunc integer etiam. Mattis pulvinar non viverra donec
                                        pellentesque. Odio
                                        mi consequat libero dolor. Porta ut diam lobortis eget leo, lectus. Nunc tempus
                                        feugiat massa
                                        laoreet ultrices diam magna quam. Congue auctor auctor luctus neque. Enim lorem
                                        ultrices diam donec.
                                        Sed id placerat consectetur faucibus.</p>

                                    <p>Id pulvinar amet. Consequat potenti mollis massa iaculis et, dolor, eget lectus.
                                        Aliquam
                                        pellentesque molestie felis fames sed eget non euismod eget. Et eget ullamcorper
                                        urna, elit ac diam
                                        tellus viverra lacus.</p>
                                    <p>Tortor diam dignissim amet, in interdum aliquet. Magnis dictum et eros purus
                                        fermentum, massa
                                        ullamcorper sit sollicitudin. Nascetur libero elementum adipiscing mauris maecenas
                                        et magna. Etiam
                                        nec, rutrum a diam lacus, nunc integer etiam. Mattis pulvinar non viverra donec
                                        pellentesque. Odio
                                        mi consequat libero dolor. Porta ut diam lobortis eget leo, lectus.</p>
                                    <p>Velit, praesent pharetra malesuada id pulvinar amet. Consequat potenti mollis massa
                                        iaculis et,
                                        dolor, eget lectus. Aliquam pellentesque molestie felis fames sed eget non euismod
                                        eget. Et eget
                                        ullamcorper urna, elit ac diam tellus viverra lacus.</p>
                                    <p>Tortor diam dignissim amet, in interdum aliquet. Magnis dictum et eros purus
                                        fermentum, massa
                                        ullamcorper sit sollicitudin. Nascetur libero elementum adipiscing mauris maecenas
                                        et magna. Etiam
                                        nec, rutrum a diam lacus, nunc integer etiam. Mattis pulvinar non viverra donec
                                        pellentesque. Odio
                                        mi consequat libero dolor. Porta ut diam lobortis eget leo, lectus.</p>
                                    <div class="post-bottom-link d-md-flex justify-content-between my-5">
                                        <div class="block-tag">
                                            <ul class="list-unstyled text-decoration-underline d-flex ">
                                                <li class="me-3">
                                                    <a href="#">Spa</a>
                                                </li>
                                                <li class="me-3">
                                                    <a href="#">Gym</a>
                                                </li>
                                                <li class="me-3">
                                                    <a href="#">Swimming</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="block-social-links d-flex align-items-center">
                                            <div class="element-title text-uppercase pe-4">Share:</div>
                                            <ul class="social-links d-flex flex-wrap list-unstyled m-0">
                                                <li class="social me-4">
                                                    <a href="#">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#facebook"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="social me-4">
                                                    <a href="#">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#twitter"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="social me-4">
                                                    <a href="#">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#linkedin"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="social me-4">
                                                    <a href="#">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#instagram"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li class="social">
                                                    <a href="#">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#youtube"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="single-post-navigation">
                                    <div class="post-navigation d-flex justify-content-between">
                                        <a class="post-prev text-decoration-none" href="#">
                                            <span class="page-nav-title text-decoration-underline text-uppercase ">How to
                                                take care of hotel room</span>
                                        </a>
                                        <a class="post-next text-decoration-none" href="#">
                                            <span
                                                class="page-nav-title text-decoration-underline text-uppercase text-end">Summer
                                                tips for resort
                                                owners</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <div id="post-author-info" class="border-top border-bottom py-4">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <div class="image-holder">
                                        <a href="#">
                                            <img src="images/team1.jpg" class="img-fluid" alt="author">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="post-author-content">
                                        <div class="element-title text-uppercase">
                                            <p class="text-decoration-none fs-5">James Younes</p>
                                        </div>
                                        <span class="author-position">Hotel Expert</span>
                                        <p class="mt-3">Nascetur libero elementum adipiscing mauris maecenas et magna.
                                            Etiam nec, rutrum a
                                            diam lacus,
                                            nunc integer etiam. Mattis pulvinar non viverra donec pellentesque. Odio mi
                                            consequat libero
                                            dolor. Porta ut diam lobortis eget leo, lectus. Tortor diam dignissim amet, in
                                            interdum aliquet.
                                            Magnis dictum et eros purus fermentum, massa ullamcorper sit sollicitudin.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section id="post-comment">
                            <div class="container">
                                <div class="row">
                                    <div class="comments-wrap mt-5">
                                        <h3 class="display-5 fw-normal mb-5">
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
                                        <h3 class="display-5 fw-normal mb-5">Leave a Comment</h3>
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
                <aside class="col-md-3">
                    <div class="post-sidebar">
                        <form class="position-relative mb-5">
                            <input type="text" class="form-control rounded-5 px-4 py-2 bg-transparent"
                                placeholder="Search">
                            <a href="#" class="position-absolute top-50 end-0 translate-middle-y p-1 me-3">
                                <svg width="20" height="20">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </a>
                        </form>
                        <div class="widget sidebar-categories border-animation-left mb-5">
                            <h4 class="widget-title fw-normal border-bottom pb-3 mb-3">Categories</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#" class="item-anchor text-decoration-none">All</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor text-decoration-none">Hotel</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor text-decoration-none">Resort</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor text-decoration-none">Spa</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor text-decoration-none">Swimming</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget block-tag mb-5">
                            <h4 class="widget-title fw-normal border-bottom pb-3 mb-3">Tags</h4>
                            <ul class="list-unstyled d-flex flex-wrap gap-2">
                                <li>
                                    <a href="#" class="btn btn-outline-secondary py-2 px-3">Hotel</a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-secondary py-2 px-3">Spa</a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-secondary py-2 px-3">Food</a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-outline-secondary py-2 px-3">Rooms</a>
                                </li>
                            </ul>
                        </div>

                        <div class="widget sidebar-recent-post mb-5">
                            <h4 class="widget-title fw-normal border-bottom pb-3 mb-3">Recent Posts</h4>
                            <div class="sidebar-post-item d-flex justify-content-center">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="image-holder">
                                            <a href="#">
                                                <img src="images/post1.jpg" alt="blog" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sidebar-post-content">
                                            <h5 class="post-title fs-5">
                                                <a href="#">How to clean roof properly</a>
                                            </h5>
                                            <p class=" m-0 lh-base" style="font-size: 14px;">Magnam at iusto omnis impedit
                                                minima sunt, aspernatur rem dolorem, dolorum quaerat eius quas ipsum ...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-post-item d-flex justify-content-center">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="image-holder">
                                            <a href="#">
                                                <img src="images/post2.jpg" alt="blog" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sidebar-post-content">
                                            <h5 class="post-title fs-5">
                                                <a href="#">Top 10 hacks for cleaning </a>
                                            </h5>
                                            <p class=" m-0 lh-base" style="font-size: 14px;">Magnam at iusto omnis impedit
                                                minima sunt, aspernatur rem dolorem, dolorum quaerat eius quas ipsum ...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-post-item d-flex justify-content-center">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="image-holder">
                                            <a href="#">
                                                <img src="images/post3.jpg" alt="blog" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sidebar-post-content">
                                            <h5 class="post-title fs-5">
                                                <a href="#">Best ways to clean your tiles</a>
                                            </h5>
                                            <p class=" m-0 lh-base" style="font-size: 14px;">Magnam at iusto omnis impedit
                                                minima sunt, aspernatur rem dolorem, dolorum quaerat eius quas ipsum ...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget sidebar-social-links border-animation-left">
                            <h4 class="widget-title fw-normal border-bottom pb-3 mb-3">Follow us:</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#" class="item-anchor">Facebook</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor">Twitter</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor">Pinterest</a>
                                </li>
                                <li>
                                    <a href="#" class="item-anchor">Youtube</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
