<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <!--===== HERO AREA STARTS =======-->
    <div class="inner-header-section"
        style="background-image: url('{{ asset('uploads/products/' . ($product->detail_thumbnail ?? 'default.jpg')) }}');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;">

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-heading-area">
                        <h2>{{ $product->product_name }}</h2>
                        <div class="space18"></div>
                        <div class="btn-area1">
                            <a href="{{ url('/') }}">Home</a>
                            <i class="fa-solid fa-angle-right"></i>
                            <a href="{{ route('frontend.category_details', $product->category_slug) }}">
                                {{ $product->category_name }}
                            </a>

                            <i class="fa-solid fa-angle-right"></i>
                            <a href="#">{{ $product->product_name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== HERO AREA ENDS =======-->

    <!--===== SERVICE AREA STARTS =======-->
    <section class="product-details sp1">
        <div class="container">
            <div class="row align-items-center">
                
                {{-- Product Images --}}
                <div class="col-md-6">
                    <div class="lightSlider-card">
                        <div class="demo">
                            <ul id="lightSlider">
                                @foreach($product->images ?? [$product] as $image)
                                    <li data-thumb="{{ asset('uploads/products/' . ($image->product_image ?? 'default.jpg')) }}">
                                        <img src="{{ asset('uploads/products/' . ($image->product_image ?? 'default.jpg')) }}" 
                                            alt="{{ $product->product_name }}">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Product Info --}}
                <div class="col-md-6">
                    <div class="product-info heading1">
                        <p class="mt-4">{!! $product->description ?? 'No description available.' !!}</p>

                        <div class="btn-area1 mt-4">
                            <a href="javascript:void(0)" class="vl-btn2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Enquire Now <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            @if(!empty($product->buy_now))
                                <a href="{{ $product->buy_now }}" class="vl-btn2" target="_blank">
                                    Buy Now <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Enquire Now</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="contact1">
                                            <div class="col-lg-12">
                                                <div class="contact1-boxarea aos-init aos-animate" data-aos="fade-left" data-aos-duration="1200">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="input-area">
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="input-area">
                                                                <input type="text" placeholder="Last Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="input-area">
                                                                <input type="email" placeholder="Email Address">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="input-area">
                                                                <input type="number" placeholder="Phone Number">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="input-area">
                                                                <textarea placeholder="Type Your Message"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="input-area">
                                                                <button type="submit" class="vl-btn1">
                                                                    Submit Message <i class="fa-solid fa-arrow-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!--===== VALUE AREA STARTS =======-->
    <div class="value-section product-details sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading1 value-header">
                        <div class="space32"></div>

                        <ul class="nav nav-pills nav-pills1" id="pills-tab1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home1-tab" data-bs-toggle="pill" data-bs-target="#pills-home1" type="button" role="tab" aria-controls="pills-home1" aria-selected="true">
                                    Composition
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile1-tab" data-bs-toggle="pill" data-bs-target="#pills-profile1" type="button" role="tab" aria-controls="pills-profile1" aria-selected="false">
                                    Uses of Tablet
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link m-0" id="pills-contact6-tab" data-bs-toggle="pill" data-bs-target="#pills-contact6" type="button" role="tab" aria-controls="pills-contact6" aria-selected="false">
                                    Direction to Use
                                </button>
                            </li>
                        </ul>

                        <div class="space32"></div>

                        <div class="tab-content" id="pills-tabContent1">

                            {{-- Composition Tab --}}
                            <div class="tab-pane fade show active heading1" id="pills-home1" role="tabpanel" aria-labelledby="pills-home1-tab" tabindex="0">
                                <p>Each {{ $product->product_name }} Combi pack contains: </p>
                                <div class="space20"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <tbody>
                                            @foreach(json_decode($product->composition ?? '[]', true) as $item)
                                                <tr>
                                                    <td><b>{{ $item['tablet_name'] ?? '' }}</b></td>
                                                    <td>{{ $item['dose'] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Uses of Tablet Tab --}}
                            <div class="tab-pane fade heading1" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile1-tab" tabindex="0">
                                <p>{!! $product->use_of_tablet ?? 'No information available.' !!}</p>
                            </div>

                            {{-- Direction to Use Tab --}}
                            <div class="tab-pane fade heading1" id="pills-contact6" role="tabpanel" aria-labelledby="pills-contact6-tab" tabindex="0">
                                <p>{!! $product->direction_to_use ?? 'No instructions available.' !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== VALUE AREA ENDS =======-->


    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>