<div class="preloader">
    <div class="loading-container">
      <div class="loading"></div>
      <div id="loading-icon"><img src="{{ asset('frontend/assets/img/logo/dkt-white.webp') }}" alt=""></div>
    </div>
  </div>
  <div class="paginacontainer">
    <div class="progress-wrap">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>
  </div>


    <!--=====HEADER START=======-->
  <header class="homepage5-body">
    <div id="vl-header-sticky" class="vl-header-area vl-transparent-header">
      <div class="container-fluid">
        <div class="row align-items-center row-bg1">
          <div class="col-lg-1 col-md-6 col-6">
            <div class="vl-logo">
              <a href="{{ route('frontend.index') }}"><img src="{{ asset('frontend/assets/img/logo/DKT.png') }}" alt=""></a>
            </div>
          </div>

              <div class="col-lg-10 d-none d-lg-block">
                <div class="vl-main-menu text-center">
                  <nav class="vl-mobile-menu-active">
                    <ul>
                      <li><a href="{{ route('frontend.index') }}">Home</a></li>
                      <li><a href="{{ route('frontend.about_us') }}">About Us</a></li>

                      <li>
                          <a href="{{ route('frontend.product_list') }}">Products <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                          <ul class="sub-menu">

                              @php
                                  $categories = \App\Models\ProductCategory::with([
                                      'products' => function($q) {
                                          $q->whereNull('deleted_by');
                                      },
                                      'details'
                                  ])
                                  ->whereNull('deleted_by')
                                  ->get();
                              @endphp


                              @foreach($categories as $category)
                                  <li>
                                      <a href="{{ route('frontend.category_details', $category->slug) }}" class="span-arrow">
                                          {{ $category->category_name }}
                                          @if($category->products->count() > 0)
                                              <span><i class="fa-solid fa-angle-right d-lg-block d-none"></i></span>
                                          @endif
                                      </a>

                                      @if($category->products->count() > 0)
                                          <ul class="sub-menu menu1">
                                              @foreach($category->products as $product)
                                                  <li>
                                                      <a href="{{ route('frontend.product_details', $product->slug ?? '#') }}">
                                                          {{ $product->product_name }}
                                                      </a>
                                                  </li>
                                              @endforeach
                                          </ul>
                                      @endif
                                  </li>
                              @endforeach

                          </ul>
                      </li>

                      <li><a href="#">HerKare Academy</a></li>

                      <li class="has-dropdown">
                        <a href="#">News & Media <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                        <ul class="sub-menu">
                          <li><a href="#">Press Releases</a></li>
                          <li><a href="#">Blogs</a></li>
                        </ul>
                      </li>

                      <li class="has-dropdown">
                        <a href="#">Partner With Us <span><i
                              class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                        <ul class="sub-menu">
                          <li><a href="{{ route('frontend.i_am_doctor') }}">I am a Doctor</a></li>
                          <li><a href="{{ route('frontend.i_am_chemist') }}">I am a Chemist</a></li>
                          <li><a href="{{ route('frontend.i_am_distributor') }}">I am a Distributor</a></li>
                        </ul>
                      </li>

                      <li><a href="{{ route('frontend.join_us') }}">Join Us</a></li>
                      <li><a href="{{ route('frontend.contact_us') }}">Contact Us</a></li>
                    </ul>
                  </nav>
                </div>
              </div>

              <div class="col-lg-1 col-md-6 col-6">
                <div class="vl-logo-right">
                      <a href="{{ route('frontend.index') }}"><img src="{{ asset('frontend/assets/img/logo/Healthcare-Logo.png') }}" alt=""></a>
                  </div>
                  <div class="vl-header-action-item d-block d-lg-none">
                      <button type="button" class="vl-offcanvas-toggle">
                        <i class="fa-solid fa-bars-staggered"></i>
                      </button>
                   </div>
              </div>
        </div>
      </div>
    </div>
  </header>
    <!--===== MOBILE HEADER STARTS =======-->
    <div class="homepage1-body">
    <div class="vl-offcanvas">
        <div class="vl-offcanvas-wrapper">
            <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
                <div class="vl-offcanvas-logo">
                    <a href="{{ route('frontend.index') }}"><img src="{{ asset('frontend/assets/img/logo/dkt-white.webp') }}" alt=""></a>
                </div>
                <div class="vl-offcanvas-close">
                <button class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <div class="vl-offcanvas-menu d-lg-none mb-40">
                <nav></nav>
            </div>

            <div class="space20"></div>
            <div class="vl-offcanvas-info">
                <h3 class="vl-offcanvas-sm-title">Contact Us</h3>
                <div class="space20"></div>
                <span><a href="#"> <i class="fa-regular fa-envelope"></i> customercare@dktindia.org</a></span>
                <span><a href="#"><i class="fa-solid fa-location-dot"></i> Hem-Dil, 67 A, Linking Road, Opp. St. Lawrence High School, Santacruz (W), Mumbai – 400 054</a></span>
            </div>
            <div class="space20"></div>
            <div class="vl-offcanvas-social">
                <h3 class="vl-offcanvas-sm-title">Follow Us</h3>
                <div class="space20"></div>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>

        </div>
    </div>
    <div class="vl-offcanvas-overlay"></div>
</div>
    <!--===== MOBILE HEADER STARTS =======-->
    <!--=====HEADER END =======-->