@extends('client.layouts.master')

@section('title')
    Bài viết
@endsection

@section('content')
@include('client.layouts.banner.banner')

    <div class="post-wrap padding-small">
        <div class="container-fluid padding-side">
            <div class="row">
                <main class="post-list post-card-small">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="blog-post position-relative overflow-hidden rounded-4">
                                <img src="images/post3.jpg" class="blog-img img-fluid rounded-4" alt="img">
                                <div class="position-absolute bottom-0 p-5">
                                    <a href="#"><span
                                            class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Hotels</span></a>
                                    <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">A Day in the Life of a
                                            Hotel Mellow Guest</a></h4>
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
                                    <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">Guide to Seasonal
                                            Activities in the City</a></h4>
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
                                    <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">A Look Inside Hotel
                                            Mellow's Suites</a></h4>
                                    <p class="m-0 align-items-center"><svg width="19" height="19">
                                            <use xlink:href="#clock"></use>
                                        </svg> 22 Feb, 2024</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="blog-post position-relative overflow-hidden rounded-4">
                                <img src="images/post3.jpg" class="blog-img img-fluid rounded-4" alt="img">
                                <div class="position-absolute bottom-0 p-5">
                                    <a href="#"><span
                                            class="bg-secondary text-body m-0 px-2 py-1 rounded-2 fs-6">Hotels</span></a>
                                    <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">A Day in the Life of a
                                            Hotel Mellow Guest</a></h4>
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
                                    <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">Guide to Seasonal
                                            Activities in the City</a></h4>
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
                                    <h4 class="display-6 fw-normal mt-2"><a href="blog-single.html">A Look Inside Hotel
                                            Mellow's Suites</a></h4>
                                    <p class="m-0 align-items-center"><svg width="19" height="19">
                                            <use xlink:href="#clock"></use>
                                        </svg> 22 Feb, 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
                        <ul class="pagination align-items-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    Previous
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    Next</a>
                            </li>
                        </ul>
                    </nav>

                </main>
            </div>
        </div>
    </div>
@endsection
