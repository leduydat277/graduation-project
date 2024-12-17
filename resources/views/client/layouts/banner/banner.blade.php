<!-- <section id="slider" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <div class="d-flex rounded-5"
            style="background-image: url({{ asset('assets/client/images/slider-image1.jpg') }} ); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
            <div class="row align-items-center m-auto">
                <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                    <h2 class="display-1 fw-normal">{{$title}}</h2>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{route('client.home')}}">Trang chủ</a>
                        <span class="active" aria-current="page"> /<span class="text-decoration-underline">{{$title}}</span></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section id="slider" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <!-- Slide Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex rounded-5" 
                        style="background-image: url('https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2023/3/21/1170122/296817374_1015897554.jpg'); background-size: cover; background-position: center; height: 50vh;">
                        <div class="row align-items-center m-auto text-center text-white">
                        <h2 class="display-1 fw-bold text-white text-center text-shadow"> {{$title}} </h2>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex rounded-5" 
                        style="background-image: url('https://media-cdn-v2.laodong.vn/storage/newsportal/2023/3/21/1170122/Intercontinental-Han.jfif'); background-size: cover; background-position: center; height: 50vh;">
                        <div class="row align-items-center m-auto text-center text-white">
                        <h2 class="display-1 fw-bold text-white text-center text-shadow"> {{$title}} </h2>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex rounded-5" 
                        style="background-image: url('https://mia.vn/media/uploads/blog-du-lich/kham-pha-nhung-khach-san-view-ho-tay-duoc-nhieu-nguoi-ua-chuong-nhat-1660188181.jpg'); background-size: cover; background-position: center; height: 50vh;">
                        <div class="row align-items-center m-auto text-center text-white">
                        <h2 class="display-1 fw-bold text-white text-center text-shadow"> {{$title}} </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
