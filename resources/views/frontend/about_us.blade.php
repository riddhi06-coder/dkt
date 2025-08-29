<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <!--===== HERO AREA STARTS =======-->
        <div class="inner-header-section"
            style="background-image: url('{{ asset('uploads/about/' . $about->banner) }}');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-heading-area">
                            <h2>{{ $about->banner_heading }}</h2>
                            <div class="space18"></div>
                            <div class="btn-area1">
                                <a href="{{ route('frontend.index') }}">Home</a>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="{{ route('frontend.about_us') }}">About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--===== HERO AREA ENDS =======-->

    <!--===== ABOUT AREA STARTS =======-->
    <div class="about3 sp1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading3">
                        <div class="space8"></div>
                        <p>{!! $about->section1_description ?? '' !!} </p>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="row">
                        @if(!empty($about->gallery_images))
                            @php
                                $galleryImages = json_decode($about->gallery_images, true);
                            @endphp

                            @foreach($galleryImages as $index => $image)
                                <div class="col-lg-6 col-md-6 {{ $index == 0 ? 'col-lg-12' : '' }}">
                                    <div class="space30"></div>
                                    <div class="img1 image-anime" data-aos="zoom-in" data-aos-duration="{{ 900 + ($index * 200) }}">
                                        <img src="{{ asset('uploads/about/' . $image) }}" alt="about-image-{{ $index }}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--===== ABOUT AREA ENDS =======-->

    <!--===== CHOOSE AREA STARTS =======-->
    <div class="choose1 sp1">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-5">
            <div class="choose-images">
            <div class="row">
                    <div class="img1 image-anime">
                        <img src="{{ asset('uploads/about/' . ($about->section_image ?? 'default.webp')) }}" alt="">
                    </div>
            </div>
            </div>
        </div>

        <div class="col-lg-7">
            @php
                $divisions = json_decode($about->division_details);
            @endphp

            <div class="heading1">
                <p>{!! $about->section2_description ?? '' !!}</p>

                @foreach($divisions as $index => $division)
                    <div data-aos="fade-left" data-aos-duration="{{ 1200 + ($index*100) }}">
                        <div class="choose-boxarea">
                            <div class="icons">
                                <img src="{{ asset('uploads/about/' . $division->icon) }}" alt="">
                            </div>
                            <div class="content">
                                <h4>{{ $division->heading }}</h4>
                                <div class="space10"></div>
                                <p>{{ $division->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="space32"></div>
            </div>

        </div>
        </div>
    </div>
    </div>
    <!--===== CHOOSE AREA ENDS =======-->

    <!--===== ABOUT AREA STARTS =======-->
    <div class="about5 sp1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading5">
                        <div class="space16"></div>

                        {{-- Title --}}
                        <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="1000">
                            {{ $about->section3_title ?? '' }}
                        </h2>

                        <div class="space16"></div>

                        {{-- Description --}}
                        <p data-aos="fade-left" data-aos-duration="1100">
                            {!! $about->section3_description ?? '' !!}
                        </p>

                        <div class="space32"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about5-images">
                        {{-- Image --}}
                        <img src="{{ asset('uploads/about/' . $about->section_image1) }}" 
                            alt="{{ $about->section3_title ?? '' }}" 
                            class="elements15">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== ABOUT AREA ENDS =======-->

    <!--===== SERVICE AREA STARTS =======-->
        <div class="service2 sp2">
            <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto">
                <div class="heading2 text-center space-margin60">
                    <h5 class="vl-section-subtitle" data-aos="zoom-in" data-aos-duration="900"><svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                        <path
                        d="M9.9408 6.23921C10.2064 5.97357 10.3393 5.84075 10.4113 5.6821C10.4698 5.55333 10.4991 5.41323 10.4971 5.27181C10.4947 5.09758 10.4263 4.92266 10.2894 4.57282L8.50003 0L6.71065 4.5728C6.57375 4.92265 6.5053 5.09757 6.50288 5.2718C6.50092 5.41322 6.53022 5.55333 6.58871 5.6821C6.66076 5.84075 6.79358 5.97358 7.05923 6.23922L8.13346 7.31344C8.26446 7.44444 8.32996 7.50993 8.40594 7.53331C8.46725 7.55217 8.53281 7.55217 8.59412 7.5333C8.6701 7.50993 8.73559 7.44443 8.86659 7.31343L9.9408 6.23921Z"
                        fill="#fff" />
                        <path
                        d="M9.9408 9.76079C10.2064 10.0264 10.3393 10.1593 10.4113 10.3179C10.4698 10.4467 10.4991 10.5868 10.4971 10.7282C10.4947 10.9024 10.4263 11.0773 10.2894 11.4272L8.50003 16L6.71065 11.4272C6.57375 11.0774 6.5053 10.9024 6.50288 10.7282C6.50092 10.5868 6.53022 10.4467 6.58871 10.3179C6.66076 10.1592 6.79358 10.0264 7.05923 9.76078L8.13346 8.68656C8.26446 8.55556 8.32996 8.49007 8.40594 8.46669C8.46725 8.44783 8.53281 8.44783 8.59412 8.46669C8.6701 8.49007 8.73559 8.55557 8.86659 8.68657L9.9408 9.76079Z"
                        fill="#fff" />
                        <path
                        d="M16.5 8.00003L11.9272 9.78937C11.5773 9.92626 11.4024 9.99471 11.2282 9.99713C11.0868 9.99909 10.9467 9.96979 10.8179 9.9113C10.6593 9.83926 10.5264 9.70644 10.2608 9.4408L9.18657 8.36659C9.05557 8.23559 8.99007 8.1701 8.96669 8.09412C8.94783 8.03281 8.94783 7.96725 8.96669 7.90594C8.99007 7.82996 9.05556 7.76446 9.18656 7.63346L10.2608 6.55923C10.5264 6.29358 10.6592 6.16076 10.8179 6.08871C10.9467 6.03022 11.0868 6.00092 11.2282 6.00288C11.4024 6.0053 11.5774 6.07375 11.9272 6.21065L16.5 8.00003Z"
                        fill="#fff" />
                        <path
                        d="M6.73921 9.4408C6.47357 9.70644 6.34075 9.83926 6.1821 9.9113C6.05333 9.96979 5.91323 9.99909 5.77181 9.99713C5.59758 9.99471 5.42266 9.92626 5.07282 9.78937L0.5 8.00003L5.0728 6.21065C5.42265 6.07375 5.59757 6.0053 5.7718 6.00288C5.91322 6.00092 6.05333 6.03022 6.1821 6.08871C6.34075 6.16076 6.47358 6.29358 6.73922 6.55923L7.81344 7.63346C7.94444 7.76446 8.00993 7.82996 8.03331 7.90594C8.05217 7.96725 8.05217 8.03281 8.0333 8.09412C8.00993 8.1701 7.94443 8.2356 7.81343 8.36659L6.73921 9.4408Z"
                        fill="#fff" />
                    </svg> Vision & Values</h5>
                    <div class="space16"></div>
                    <h2 class="vl-section-title" data-aos="zoom-in" data-aos-duration="1000">Our Vision, Mission and Values
                    </h2>
                </div>
                </div>
            </div>

            <div class="row">
                @foreach($visionMissions as $item)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-offset="{{ 80 + $loop->index * 20 }}">
                        <div class="service1-boxarea">
                            <div class="icons">
                                @if($item->image)
                                    <img src="{{ asset('uploads/home/' . $item->image) }}" alt="{{ $item->title }}">
                                @else
                                    <img src="assets/img/icons/default.svg" alt="{{ $item->title }}">
                                @endif
                            </div>
                            <div class="space30"></div>
                            <div class="content-area">
                                <a href="#" class="title">{{ $item->heading }}</a>
                                <div class="space16"></div>
                                <p>{{ $item->title }}</p>
                                <div class="space24"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            </div>
        </div>
    <!--===== SERVICE AREA ENDS =======-->


    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>