    @extends('layouts.web')

    @section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/Slider 3.jpg') }}" class="d-block w-100" alt="..." height="900px">
                <div class="carousel-caption d-none d-md-block">
                    <a href="{{ url('/product') }}"><button class="btn btn-primary" type="submit">Shop Now</button></a><br><br>
                    <p>"Discover Style Redefined - Elevate Your Wardrobe with WearIT's Trendiest Collection!"</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/Slider 2.jpg') }}" class="d-block w-100" alt="..." height="900px">
                <div class="carousel-caption d-none d-md-block">
                    <a href="{{ url('/product') }}"><button class="btn btn-primary" type="submit">Shop Now</button></a><br><br>
                    <p>"Discover Style Redefined - Elevate Your Wardrobe with WearIT's Trendiest Collection!"</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/Slider 1.jpg') }}" class="d-block w-100" alt="..." height="900px">
                <div class="carousel-caption d-none d-md-block">
                    <a href="{{ url('/product') }}"><button class="btn btn-primary" type="submit">Shop Now</button></a><br><br>
                    <p>"Discover Style Redefined - Elevate Your Wardrobe with WearIT's Trendiest Collection!"</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Featured Products -->
    <section class="container my-5">
        <h2 class="text-center">Featured Products</h2>
        <div class="row" id="featured-products">

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/Ft product 1.png') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Black Hoodie</h5>
                        <p class="card-text">$24.99</p>
                        <a href="{{ url('/product') }}" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/Ft product 2.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Textured T-shirt</h5>
                        <p class="card-text">$14.99</p>
                        <a href="{{ url('/product') }}" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/Ft product 3.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Ripped Jeans</h5>
                        <p class="card-text">$29.99</p>
                        <a href="{{ url('/product') }}" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endsection


    