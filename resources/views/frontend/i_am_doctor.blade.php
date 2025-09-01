<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <!--===== HERO AREA STARTS =======-->
    <div class="inner-header-section"
    style="background-image: url({{ $i_am_doctor ? asset('uploads/home/'.$i_am_doctor->banner) : asset('frontend/assets/img/banner/7693.jpg') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
        <div class="col-lg-6">
            <div class="hero-heading-area">
            <h2>{{ $i_am_doctor?->banner_heading ?? 'I am a Doctor11' }}</h2>
            <div class="space18"></div>
            <div class="btn-area1">
                <a href="{{ url('/') }}">Home</a>
                <i class="fa-solid fa-angle-right"></i>
                <a href="#">{{ $i_am_doctor?->banner_heading ?? 'I am a Doctor' }}</a>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!--===== HERO AREA ENDS =======-->

    <div class="iama-doctor-sec sp1">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-6 m-auto">
            <div class="heading2 space-margin60">
            <div class="space16"></div>
            <p>{!! $i_am_doctor?->description ?? 'Join hands with DKT India to promote informed sexual and reproductive health choices. As a trusted healthcare partner, you’ll gain access to our latest resources, professional support, and community outreach programs designed to benefit both you and your patients.' !!}</p>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="iama-doctor-boxarea" data-aos="fade-left" data-aos-duration="1200">
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
                    <input type="email" placeholder="Email">
                </div>
                </div>

                <div class="col-lg-6 col-md-6">
                <div class="input-area">
                    <input type="tel" placeholder="Phone Number">
                </div>
                </div>
                
                <div class="col-lg-12 col-md-12">
                <div class="input-area">
                    <input type="text" placeholder="Address">
                </div>
                </div>

                <div class="col-lg-12 col-md-12">
                <div class="input-area">
                    <textarea placeholder="Type Your Message"></textarea>
                </div>
                </div>

                <div class="col-lg-12 col-md-12">
                <div class="input-area iama-custom-btn-sec">
                    <button type="submit" class="vl-btn1">Submit <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </div>

            </div>
            </div>
        </div>
        </div>
    </div>
    </div>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>