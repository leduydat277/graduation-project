@extends('client.layouts.master')

@section('title')
    Danh sách phòng
@endsection

@section('content')
<section id="slider" data-aos="fade-up">
    <div class="container-fluid padding-side" >
      <div class="d-flex rounded-5"
        style="background-image: url(images/slider-image1.jpg); background-size: cover; background-repeat: no-repeat; height: 50vh; background-position: center;">
          <div class="row align-items-center m-auto">
            <div class="d-flex flex-wrap flex-column justify-content-center align-items-center">
              <h2 class="display-1 fw-normal">Rooms</h2>
              <nav class="breadcrumb">
                <a class="breadcrumb-item" href="index.html">Home</a>
                <span class="breadcrumb-item active" aria-current="page">Rooms</span>
              </nav>
            </div>
          </div>
      </div>
    </div>
  </section>

  <div class="post-wrap padding-small">
    <div class="container-fluid padding-side">
      <div class="row">
        <main class="post-list post-card-small">
          <div class="row g-lg-5">
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="room-item rounded-4 ">
                <img src="images/room1.jpg" alt="img" class="img-fluid rounded-4">
              </div>
              <div class="room-content">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                  <h4 class="display-6 fw-normal"><a href="#">Grand deluxe rooms</a></h4>
                  <p class="m-0"><span class="text-primary fs-4">$269</span>/night</p>
                </div>
                <p class="product-paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Allie
                  Molestiae at illum ipsum similique doloribus.</p>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-2">Price:</td>
                      <td class="price">299$ /Pernight</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Size:</td>
                      <td>10 ft</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Capacity:</td>
                      <td>Max person 2</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Bed:</td>
                      <td>Normal Beds</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Services:</td>
                      <td>Wifi, Television, Bathroom,...</td>
                    </tr>
                  </tbody>
                </table>
                <a href="room-details.html">
                  <p class="text-decoration-underline mt-3">Browse More</p>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="room-item rounded-4 ">
                <img src="images/room2.jpg" alt="img" class="img-fluid rounded-4">
              </div>
              <div class="room-content">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                  <h4 class="display-6 fw-normal"><a href="#">Sweet Family room</a></h4>
                  <p class="m-0"><span class="text-primary fs-4">$269</span>/night</p>
                </div>
                <p class="product-paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Allie
                  Molestiae at illum ipsum similique doloribus.</p>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-2">Price:</td>
                      <td class="price">299$ /Pernight</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Size:</td>
                      <td>10 ft</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Capacity:</td>
                      <td>Max persion 2</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Bed:</td>
                      <td>Normal Beds</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Services:</td>
                      <td>Wifi, Television, Bathroom,...</td>
                    </tr>
                  </tbody>
                </table>
                <a href="room-details.html">
                  <p class="text-decoration-underline mt-3">Browse More</p>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="room-item rounded-4 ">
                <img src="images/room3.jpg" alt="img" class="img-fluid rounded-4">
              </div>
              <div class="room-content">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                  <h4 class="display-6 fw-normal"><a href="#">Double Suite Room</a></h4>
                  <p class="m-0"><span class="text-primary fs-4">$269</span>/night</p>
                </div>
                <p class="product-paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Allie
                  Molestiae at illum ipsum similique doloribus.</p>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-2">Price:</td>
                      <td class="price">299$ /Pernight</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Size:</td>
                      <td>10 ft</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Capacity:</td>
                      <td>Max persion 2</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Bed:</td>
                      <td>Normal Beds</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Services:</td>
                      <td>Wifi, Television, Bathroom,...</td>
                    </tr>
                  </tbody>
                </table>
                <a href="room-details.html">
                  <p class="text-decoration-underline mt-3">Browse More</p>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="room-item rounded-4 ">
                <img src="images/room1.jpg" alt="img" class="img-fluid rounded-4">
              </div>
              <div class="room-content">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                  <h4 class="display-6 fw-normal"><a href="#">Grand deluxe rooms</a></h4>
                  <p class="m-0"><span class="text-primary fs-4">$269</span>/night</p>
                </div>
                <p class="product-paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Allie
                  Molestiae at illum ipsum similique doloribus.</p>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-2">Price:</td>
                      <td class="price">299$ /Pernight</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Size:</td>
                      <td>10 ft</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Capacity:</td>
                      <td>Max person 2</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Bed:</td>
                      <td>Normal Beds</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Services:</td>
                      <td>Wifi, Television, Bathroom,...</td>
                    </tr>
                  </tbody>
                </table>
                <a href="room-details.html">
                  <p class="text-decoration-underline mt-3">Browse More</p>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="room-item rounded-4 ">
                <img src="images/room2.jpg" alt="img" class="img-fluid rounded-4">
              </div>
              <div class="room-content">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                  <h4 class="display-6 fw-normal"><a href="#">Sweet Family room</a></h4>
                  <p class="m-0"><span class="text-primary fs-4">$269</span>/night</p>
                </div>
                <p class="product-paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Allie
                  Molestiae at illum ipsum similique doloribus.</p>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-2">Price:</td>
                      <td class="price">299$ /Pernight</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Size:</td>
                      <td>10 ft</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Capacity:</td>
                      <td>Max persion 2</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Bed:</td>
                      <td>Normal Beds</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Services:</td>
                      <td>Wifi, Television, Bathroom,...</td>
                    </tr>
                  </tbody>
                </table>
                <a href="room-details.html">
                  <p class="text-decoration-underline mt-3">Browse More</p>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
              <div class="room-item rounded-4 ">
                <img src="images/room3.jpg" alt="img" class="img-fluid rounded-4">
              </div>
              <div class="room-content">
                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                  <h4 class="display-6 fw-normal"><a href="#">Double Suite Room</a></h4>
                  <p class="m-0"><span class="text-primary fs-4">$269</span>/night</p>
                </div>
                <p class="product-paragraph ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Allie
                  Molestiae at illum ipsum similique doloribus.</p>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-2">Price:</td>
                      <td class="price">299$ /Pernight</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Size:</td>
                      <td>10 ft</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Capacity:</td>
                      <td>Max persion 2</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Bed:</td>
                      <td>Normal Beds</td>
                    </tr>
                    <tr>
                      <td class="pe-2">Services:</td>
                      <td>Wifi, Television, Bathroom,...</td>
                    </tr>
                  </tbody>
                </table>
                <a href="room-details.html">
                  <p class="text-decoration-underline mt-3">Browse More</p>
                </a>
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
