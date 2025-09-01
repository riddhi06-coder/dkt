<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <!--===== HERO AREA STARTS =======-->
  <div class="inner-header-section"
    style="background-image: url({{ asset('frontend/assets/img/banner/7693.jpg') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="hero-heading-area">
            <h2>Contact Us</h2>
            <div class="space18"></div>
            <div class="btn-area1">
              <a href="{{ url('/') }}">Home</a>
              <i class="fa-solid fa-angle-right"></i>
              <a href="#">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== HERO AREA ENDS =======-->

<!--===== CONTACT AREA STARTS =======-->
<div class="contact1 sp1">
    <div class="container">
        <div class="row">
            <div class="row">
                @foreach($contact_us as $contact)
                    <!-- Address -->
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-contactbox">
                            <div class="icons">
                                <img src="{{ asset('frontend/assets/img/icons/time2.svg') }}" alt="">
                            </div>
                            <div class="content">
                                <h4>Contact Us</h4>
                                <a href="{{ $contact->map_url }}" target="_blank">{{ $contact->address }}</a>
                            </div>
                        </div>
                        <div class="space30 d-lg-none d-block"></div>
                    </div>

                    <!-- Phone -->
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-contactbox">
                            <div class="icons">
                                <img src="{{ asset('frontend/assets/img/icons/phn2.svg') }}" alt="">
                            </div>
                            <div class="content">
                                <h4>Call Us</h4>
                                <a href="tel:{{ $contact->contact_number }}">+91-{{ $contact->contact_number }}</a> / 
                                <a href="tel:{{ $contact->other_contact_number }}">{{ $contact->other_contact_number }}</a>
                            </div>
                        </div>
                        <div class="space30 d-lg-none d-block"></div>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-contactbox">
                            <div class="icons">
                                <img src="{{ asset('frontend/assets/img/icons/mail2.svg') }}" alt="">
                            </div>
                            <div class="content">
                                <h4>Email Us</h4>
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space60"></div>
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="heading1 text-center space-margin60">
                    <div class="space16"></div>
                    <h2 class="vl-section-title" data-aos="zoom-in" data-aos-duration="1000">Get In Touch With Us</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Side Image -->
            <div class="col-lg-6">
                <div class="img1 image-anime">
                    <img src="{{ asset('frontend/assets/img/about/contact-us-img-1.webp') }}" alt="">
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="contact1-boxarea" data-aos="fade-left" data-aos-duration="1200">
                    <form action="#" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="text" name="first_name" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="text" name="last_name" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="number" name="phone" placeholder="Phone Number" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <textarea name="message" placeholder="Type Your Message" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <button type="submit" class="vl-btn1">Submit <i class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Google Map -->
<div class="contact-maps-area">
    @foreach($contact_us as $contact)
        {!! $contact->i_frame !!}
    @endforeach
</div>
<!--===== CONTACT AREA ENDS =======-->



    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>