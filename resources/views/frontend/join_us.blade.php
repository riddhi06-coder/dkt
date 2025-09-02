<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <!--===== HERO AREA STARTS =======-->
    <div class="inner-header-section"
        style="background-image: url({{ $join_us->banner_image ? asset('uploads/home/' . $join_us->banner_image) : asset('assets/img/banner/default.jpg') }}); 
            background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-heading-area">
                        <h2>{{ $join_us->banner_heading ?? 'Join Us' }}</h2>
                        <div class="space18"></div>
                        <div class="btn-area1">
                            <a href="{{ url('/') }}">Home</a>
                            <i class="fa-solid fa-angle-right"></i>
                            <a href="#">Join Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== HERO AREA ENDS =======-->

    <div class="join-us-one-sec sp1">
    <div class="container">
        <div class="row align-items-center">
        
        {{-- ✅ Section Image --}}
        <div class="col-lg-6">
            <div class="join-us-one-img" data-aos="zoom-in" data-aos-duration="1000">
            <img src="{{ $join_us->section_image ? asset('uploads/home/' . $join_us->section_image) : asset('assets/img/about/default.jpg') }}" 
                alt="Join Us Image" class="img-fluid">
            </div>
        </div>

        {{-- ✅ Section Text --}}
        <div class="col-lg-6">
            <div class="heading2" data-aos="fade-left" data-aos-duration="900">
            
            {{-- Sub-heading --}}
            <h5 class="vl-section-subtitle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                viewBox="0 0 16 16" fill="none">
                <path d="M9.4408 6.23921C9.70644 5.97357..." fill="#fff" />
                <path d="M9.4408 9.76079C9.70644 10.0264..." fill="#fff" />
                <path d="M16 8.00003L11.4272 9.78937..." fill="#fff" />
                <path d="M6.23921 9.4408C5.97357 9.70644..." fill="#fff" />
                </svg>
                Grow With Us
            </h5>

            <div class="space16"></div>

            <div class="space16"></div>

            <p>{!! $join_us->description_main !!}</p>
            
            </div>
        </div>

        </div>
    </div>
    </div>

    <div class="join-us-feature-sec sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="vl-blog-1-section-box heading2">
                    {!! $join_us->why_dkt_description !!}
                    </div>
                </div>
            </div>


        <div class="join-us-feature-inner-sec">
            <div class="row">
                @foreach($features as $index => $feature)
                    <div class="col-lg-4">
                        <div class="service-card home-services-card-section">
                            <div class="service-icon">
                                <img src="{{ asset('uploads/home/' . $feature['icon']) }}" alt="service">
                            </div>
                            <h5 class="title">{{ $feature['heading'] }}</h5>
                            <p>{{ $feature['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        </div>
    </div>

    <div class="open-position-one-sec sp1">
        <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
            <div class="heading2 text-center space-margin60">
                <h5 class="vl-section-subtitle" data-aos="fade-left" data-aos-duration="900"><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path
                    d="M9.4408 6.23921C9.70644 5.97357 9.83926 5.84075 9.9113 5.6821C9.96979 5.55333 9.99909 5.41323 9.99713 5.27181C9.99471 5.09758 9.92626 4.92266 9.78937 4.57282L8.00003 0L6.21065 4.5728C6.07375 4.92265 6.0053 5.09757 6.00288 5.2718C6.00092 5.41322 6.03022 5.55333 6.08871 5.6821C6.16076 5.84075 6.29358 5.97358 6.55923 6.23922L7.63346 7.31344C7.76446 7.44444 7.82996 7.50993 7.90594 7.53331C7.96725 7.55217 8.03281 7.55217 8.09412 7.5333C8.1701 7.50993 8.23559 7.44443 8.36659 7.31343L9.4408 6.23921Z"
                    fill="#fff" />
                    <path
                    d="M9.4408 9.76079C9.70644 10.0264 9.83926 10.1593 9.9113 10.3179C9.96979 10.4467 9.99909 10.5868 9.99713 10.7282C9.99471 10.9024 9.92626 11.0773 9.78937 11.4272L8.00003 16L6.21065 11.4272C6.07375 11.0774 6.0053 10.9024 6.00288 10.7282C6.00092 10.5868 6.03022 10.4467 6.08871 10.3179C6.16076 10.1592 6.29358 10.0264 6.55923 9.76078L7.63346 8.68656C7.76446 8.55556 7.82996 8.49007 7.90594 8.46669C7.96725 8.44783 8.03281 8.44783 8.09412 8.46669C8.1701 8.49007 8.23559 8.55557 8.36659 8.68657L9.4408 9.76079Z"
                    fill="#fff" />
                    <path
                    d="M16 8.00003L11.4272 9.78937C11.0773 9.92626 10.9024 9.99471 10.7282 9.99713C10.5868 9.99909 10.4467 9.96979 10.3179 9.9113C10.1593 9.83926 10.0264 9.70644 9.76079 9.4408L8.68657 8.36659C8.55557 8.23559 8.49007 8.1701 8.46669 8.09412C8.44783 8.03281 8.44783 7.96725 8.46669 7.90594C8.49007 7.82996 8.55556 7.76446 8.68656 7.63346L9.76078 6.55923C10.0264 6.29358 10.1592 6.16076 10.3179 6.08871C10.4467 6.03022 10.5868 6.00092 10.7282 6.00288C10.9024 6.0053 11.0774 6.07375 11.4272 6.21065L16 8.00003Z"
                    fill="#fff" />
                    <path
                    d="M6.23921 9.4408C5.97357 9.70644 5.84075 9.83926 5.6821 9.9113C5.55333 9.96979 5.41323 9.99909 5.27181 9.99713C5.09758 9.99471 4.92266 9.92626 4.57282 9.78937L0 8.00003L4.5728 6.21065C4.92265 6.07375 5.09757 6.0053 5.2718 6.00288C5.41322 6.00092 5.55333 6.03022 5.6821 6.08871C5.84075 6.16076 5.97358 6.29358 6.23922 6.55923L7.31344 7.63346C7.44444 7.76446 7.50993 7.82996 7.53331 7.90594C7.55217 7.96725 7.55217 8.03281 7.5333 8.09412C7.50993 8.1701 7.44443 8.2356 7.31343 8.36659L6.23921 9.4408Z"
                    fill="#fff" />
                </svg> {{ $join_us->section_heading }} </h5>
                <div class="space16"></div>
                <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="1000">{{ $join_us->section_title }}</h2>
            </div>
            </div>
        </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion open-position-accordion" id="accordionFlushExample">
                        @foreach($openings as $key => $opening)
                            <div class="accordion-item custom-accordion-item">
                                <h2 class="accordion-header" id="flush-heading{{ $key }}">
                                    <button class="accordion-button collapsed custom-accordion-btn" 
                                            type="button" 
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $key }}" 
                                            aria-expanded="false" 
                                            aria-controls="flush-collapse{{ $key }}">
                                        {{ $opening->job_role }}
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $key }}" 
                                    class="accordion-collapse collapse" 
                                    aria-labelledby="flush-heading{{ $key }}"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body custom-accordion-body">
                                        
                                        <div class="job-information-sec">
                                            <h5>Description :</h5>
                                            <p>{!! $opening->description_main !!}</p>
                                        </div>

                                        <div class="job-description-sec">
                                            <h5>Location :</h5>
                                            <p>{{ $opening->job_location }}</p>
                                        </div>

                                        <div class="btn-area1">
                                            @if($opening->job_pdf)
                                                <a href="{{ asset('uploads/jobs/' . $opening->job_pdf) }}" 
                                                target="_blank" 
                                                class="vl-btn2">
                                                Download PDF <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            @endif

                                            <!-- Apply Now Button -->
                                            <a href="#" 
                                            class="vl-btn2 apply-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#applyNowModal" 
                                            data-position="{{ $opening->job_role }}">
                                            Apply Now <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($openings->isEmpty())
                            <p class="text-center">No job openings available right now.</p>
                        @endif
                    </div>
                </div>
            </div>



        </div>
    </div>

    <div class="request-area" 
        style="background-image: url('{{ asset('uploads/home/' . $join_us->right_role_image) }}'); 
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat;">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                <div class="heading2" data-aos="fade-left" data-aos-duration="900">
                    <!-- <h2 class="vl-section-title">Didn't Find the Right Role?</h2> -->
                    <div class="space16"></div>
                    <p>{!! $join_us->right_role_description !!}</p>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="general-job-form-sec">

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
                        <input type="number" placeholder="Phone Number">
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12">
                        <div class="input-area">
                        <input type="text" placeholder="Position Applying For">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="input-area">
                        <input class="form-control custom-file-input" type="file" id="resumeUpload" required="">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="input-area">
                        <textarea placeholder="Type Your Message"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="input-area genral-job-btn-sec">
                        <button type="submit" class="vl-btn1">Submit <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>

                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Modal -->
    <div class="modal fade join-us-modal-sec" id="applyNowModal" tabindex="-1" aria-labelledby="applyNowModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header border-0">
            <h5 class="modal-title" id="applyNowModalLabel">Apply Now</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <!-- Modal Form -->
            <form id="jobApplicationForm">
                <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control custom-input" placeholder="First Name" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control custom-input" placeholder="Last Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control custom-input" placeholder="Email Address" required>
                </div>
                <div class="col-md-6">
                    <input type="tel" class="form-control custom-input" placeholder="Phone Number" required>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" id="openPosition" name="open_position" readonly placeholder="Open Position">
                </div>
                <div class="col-12">
                    <input class="form-control custom-file-input" type="file" id="resumeUpload" required>
                </div>
                <div class="col-12">
                    <textarea class="form-control custom-input" rows="4" placeholder="Type Your Message"></textarea>
                </div>
                </div>
                <div class="text-center mt-4">
                <div class="input-area">
                    <button type="submit" class="vl-btn1">Submit Message <i class="fa-solid fa-arrow-right"></i></button>
                </div>
                </div>
            </form>

            </div>
        </div>
        </div>
    </div>

    
    
    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>