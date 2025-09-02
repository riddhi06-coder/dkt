 <div class="cta-footer-bg">
    <div class="cta4">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="cta-content-bg">
              <div class="row align-items-center">
                <div class="col-lg-6">
                  <div class="heading1">
                    <h3>Subscribe to Our Newsletter</h3>
                  </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                  <div class="images">
                    <form>
                      <input type="text" placeholder="Enter Your Email">
                      <button type="submit" class="vl-btn5">Subscribe <i class="fa-solid fa-arrow-right"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="vl-footer4-section-area">
      <div class="container">
        <div class="row">


         @php
            use App\Models\ContactDetail;
            $contact_us = ContactDetail::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        @endphp

          <div class="col-lg-3 col-md-6">
              <div class="footer-logo1">
                  <img src="{{ asset('frontend/assets/img/logo/DKT.png') }}" alt="">
                  <img src="{{ asset('frontend/assets/img/logo/Healthcare-Logo.png') }}" alt="">
                  <div class="space16"></div>
                  @foreach($contact_us as $contact)
                      <p>{{ $contact->desc }}</p>
                  @endforeach
                  <div class="space24"></div>

                  {{-- Social Media --}}
                @php
                    // Get first contact record (or null)
                    $contact = $contact_us->first();
                    // Decode JSON safely, fallback to empty array
                    $socials = $contact && $contact->social_media_links ? json_decode($contact->social_media_links, true) : [];
                @endphp

              <ul>
                @foreach($socials as $social)
                  <li>
                    <a href="{{ $social['link'] }}" target="_blank">
                      @switch($social['platform'])
                          @case('1') {{-- Facebook --}}
                              <i class="fa-brands fa-facebook-f"></i>
                              @break
                          @case('2') {{-- Twitter --}}
                              <i class="fa-brands fa-x-twitter"></i>
                          @break
                              @case('3') {{-- Instagram --}}
                                  <i class="fa-brands fa-instagram"></i>
                                  @break
                              @case('4') {{-- LinkedIn --}}
                                  <i class="fa-brands fa-linkedin-in"></i>
                                  @break
                              @case('5') {{-- YouTube --}}
                                  <i class="fa-brands fa-youtube"></i>
                                  @break
                              @default
                                  <i class="fa-solid fa-globe"></i>
                          @endswitch
                      </a>
                    </li>
                  @endforeach
                </ul>
            

              </div>
          </div>

          <div class="col-lg-4 col-md-6">
              <div class="vl-footer-widget contact">
                  <div class="space30 d-lg-none d-block"></div>
                  <h3>Contact Us</h3>
                  <div class="space6"></div>
                  <ul>
                      @foreach($contact_us as $contact)
                          <li>
                              <a href="{{ $contact->map_url }}" target="_blank">
                                  <i class="fa-solid fa-location-dot"></i>  {{ $contact->address }}
                              </a>
                          </li>
                          <li>
                              <a href="tel:{{ $contact->contact_number }}">
                                  <i class="fa-solid fa-phone"></i> {{ $contact->contact_number }}
                              </a>
                              @if($contact->other_contact_number)
                                  / <a href="tel:{{ $contact->other_contact_number }}">{{ $contact->other_contact_number }}</a>
                              @endif
                          </li>
                          <li>
                              <a href="mailto:{{ $contact->email }}">
                                  <i class="fa-solid fa-envelope"></i> {{ $contact->email }}
                              </a>
                          </li>
                      @endforeach
                  </ul>
              </div>
          </div>



          <div class="col-lg-3 col-md-6">
            <div class="space30 d-md-none d-block"></div>
            <div class="vl-footer-widget first-padding">
              <h3>Quick Links</h3>
              <div class="space6"></div>
              <ul>
                <li><a href="{{ route('frontend.about_us') }}">About Us</a></li>
                <li><a href="#">Press Release</a></li>
                <li><a href="#">Blogs</a></li>
                <li><a href="{{ route('frontend.join_us') }}">Join Us</a></li>
                <li><a href="{{ route('frontend.contact_us') }}">Contact Us</a></li>
                <li><a href="{{ route('frontend.terms_condition') }}">Terms & Conditions</a></li>
                <li><a href="{{ route('frontend.privacy_policy') }}">Privacy Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-6">
            <div class="space30 d-md-none d-block"></div>

            <div class="vl-footer-widget first-padding">
                <h3>Products</h3>
                <div class="space6"></div>
                <ul>
                    @php
                        $categories = \App\Models\ProductCategory::whereNull('deleted_by')->get();
                    @endphp

                    @forelse($categories as $category)
                        <li>
                            <a href="{{ route('frontend.category_details', $category->slug) }}">
                                {{ $category->category_name }}
                            </a>
                        </li>
                    @empty
                        <li>No categories available.</li>
                    @endforelse
                </ul>
            </div>


          </div>
        </div>


        <div class="space40"></div>
        <div class="row">
          <div class="col-lg-12">
            <div class="vl-copyright-area">
              <p>ⓒ Copyright 2025 DKT India. All right reserved | Designed & Developed By <a
                  href="https://www.matrixbricks.com/" target="_blank">Matrix Bricks</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>