<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

        <div class="inner-header-section"
            style="background-image: url('https://mbihosting.in/DKT-india/assets/img/banner/7693.jpg');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-heading-area">
                            <h2>All Products</h2>
                            <div class="space18"></div>
                            <div class="btn-area1">
                                <a href="{{ url('/') }}">Home</a>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="#">All Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="service5 sp2" style="margin-top: 25px !important;">
            <div class="container">
                <div class="row">
                    @forelse($product_list as $index => $product)
                        <div class="col-lg-4 col-md-6 mb-4"  {{-- add mb-4 for vertical spacing --}}
                            data-aos="fade-up"
                            data-aos-duration="900"
                            data-aos-offset="{{ 100 + ($index * 60) }}">
                            <div class="service5-boxarea h-100"> {{-- optional: h-100 keeps boxes equal height --}}
                                <div class="img1">
                                    <img src="{{ asset('uploads/products/'.$product->thumbnail_image) }}" 
                                        alt="{{ $product->product_name }}">
                                </div>
                                <div class="content-area">
                                    <a href="#" class="title">{{ $product->product_name }}</a>
                                    <div class="space28"></div>
                                    <div class="btn-area1">
                                        <a href="#" class="vl-btn6">
                                            Learn More <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No products available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>