<section id="slider" data-aos="fade-up">
    <div class="container-fluid padding-side">
        <div class="d-flex rounded-5"
            style="background-image: url({{ asset('assets/client/images/slider-image1.jpg') }} ); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
            <div class="row align-items-center m-auto">
                <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
                    <h2 class="display-1 fw-normal">{{$title}}</h2>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{route('client.home')}}">Home</a>
                        <span class="active" aria-current="page"> /{{$title}}</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>