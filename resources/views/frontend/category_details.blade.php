<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <!--===== HERO AREA STARTS =======-->
        <div class="inner-header-section"
            style="background-image: url('{{ asset('uploads/products/' . ($category->details->thumbnail_image ?? 'default.jpg')) }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-heading-area">
                            <h2>{{ $category->category_name }}</h2>
                            <div class="space18"></div>
                            <div class="btn-area1">
                                <a href="{{ url('/') }}">Home</a>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="#">Category</a>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="#">{{ $category->category_name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!--===== HERO AREA ENDS =======-->

    <!--===== ABOUT AREA STARTS =======-->
        @if(!empty($category->details->description))
            <div class="about1 sp1 category-list">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="heading1">
                                <div class="space16"></div>
                                <div class="space16"></div>

                                {{-- Print description from DB --}}
                                {!! $category->details->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    <!--===== ABOUT AREA ENDS =======-->

    <!--===== SERVICE AREA STARTS =======-->
       @if(!empty($category->details->description) && $category->products->count())
            <div class="service5 sp2">
                <div class="container">
                    <div class="row">
                        @foreach($category->products as $index => $product)
                            <div class="col-lg-4 col-md-6" 
                                data-aos="fade-up" 
                                data-aos-duration="900" 
                                data-aos-offset="{{ 100 + ($index * 60) }}">
                                <div class="service5-boxarea">
                                    <div class="img1">
                                        <img src="{{ asset('uploads/products/'.$product->thumbnail_image) }}" 
                                            alt="{{ $product->product_name }}">
                                    </div>
                                    <div class="content-area">
                                        <a href="{{ route('frontend.product_details', $product->slug) }}" class="title">
                                            {{ $product->product_name }}
                                        </a>
                                        <div class="space28"></div>
                                        <div class="btn-area1">
                                            <a href="{{ route('frontend.product_details', $product->slug) }}" class="vl-btn6">
                                                Learn More <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    <!--===== SERVICE AREA ENDS =======-->



    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>