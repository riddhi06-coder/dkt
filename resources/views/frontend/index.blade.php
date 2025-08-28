<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <div class="hero2-dots-slider">
        <div class="hero2-section-slider">
            @foreach($homeBanners as $banner)
                <div class="hero2-section"
                    style="background-image: url({{ asset('uploads/home/' . $banner->thumbnail) }}); 
                        background-position: center; 
                        background-size: cover; 
                        background-repeat: no-repeat;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero-header">
                                    <h5>
                                        <img src="{{ asset('assets/img/icons/sub-logo1.svg') }}" alt=""> 
                                        {{ $banner->banner_heading }}
                                    </h5>
                                    <div class="space16"></div>
                                    <h1>{{ $banner->banner_title }}</h1>
                                    <div class="space16"></div>
                                    <p>{!! $banner->description !!}</p>
                                    <div class="space42"></div>
                                    <div class="play-btns-area">
                                        <div class="btn-area1">
                                            <a href="#" class="vl-btn2">
                                                Get Started <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                        @if($banner->banner_video)
                                        <a href="{{ asset('uploads/home/' . $banner->banner_video) }}" 
                                        class="play-btn popup-youtube">
                                            <span class="video"><i class="fa-solid fa-play"></i></span> Watch Video
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="about2 sp1">
        <div class="container">
            <div class="row align-items-center">

                {{-- Left Column: Main Image --}}
                <div class="col-lg-6">
                    <div class="about-img" data-aos="zoom-in" data-aos-duration="1000">
                        @if($intro && $intro->image)
                            <img src="{{ asset('uploads/home/' . $intro->image) }}" alt="Team at DKT India Office">
                        @else
                            <img src="assets/img/about/0E7A7711.webp" alt="Team at DKT India Office">
                        @endif
                    </div>
                </div>

                {{-- Right Column: Text --}}
                <div class="col-lg-6">
                    <div class="heading2" data-aos="fade-left" data-aos-duration="900">
                        <h5 class="vl-section-subtitle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
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
                            </svg> About Us
                        </h5>

                        <div class="space16"></div>

                        <div class="space16"></div>
                        <p>{!! $intro->description ?? 'DKT India was established in 1992...' !!}</p>

                        <div class="space24"></div>
                        <div class="btn-area1">
                            <a href="javascript:void(0)" class="vl-btn2">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            @if($intro && $intro->results_image)
                                <a href="{{ asset('uploads/home/' . $intro->results_image) }}" class="vl-btn2 image-popup-vertical-fit">
                                    2024 Results <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            @else
                                <a href="assets/img/about/DKT-India.webp" class="vl-btn2 image-popup-vertical-fit">
                                    2024 Results <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="brand-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-brand-slider">
                        <div class="slider-brand-area2">
                            @if($intro && $intro->gallery_images)
                                @foreach(json_decode($intro->gallery_images) as $gallery)
                                    <div class="img1">
                                        <img src="{{ asset('uploads/home/' . $gallery) }}" alt="Gallery Image">
                                    </div>
                                @endforeach
                            @else
                                {{-- fallback static images --}}
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="img1">
                                        <img src="assets/img/clients/c{{ $i }}.webp" alt="Client {{ $i }} Logo">
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space60"></div>

    <div class="service5 sp2">
        <div class="container">
            <div class="row align-items-center space-margin60">
            <div class="col-lg-6">
                <div class="vl-blog-1-section-box heading2">
                <h5 class="vl-section-subtitle" data-aos="zoom-in" data-aos-duration="900">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M9.4408 6.23921C9.70644 5.97357 9.83926 5.84075 9.9113 5.6821C9.96979 5.55333 9.99909 5.41323 9.99713 5.27181C9.99471 5.09758 9.92626 4.92266 9.78937 4.57282L8.00003 0L6.21065 4.5728C6.07375 4.92265 6.0053 5.09757 6.00288 5.2718C6.00092 5.41322 6.03022 5.55333 6.08871 5.6821C6.16076 5.84075 6.29358 5.97358 6.55923 6.23922L7.63346 7.31344C7.76446 7.44444 7.82996 7.50993 7.90594 7.53331C7.96725 7.55217 8.03281 7.55217 8.09412 7.5333C8.1701 7.50993 8.23559 7.44443 8.36659 7.31343L9.4408 6.23921Z" fill="#fff" />
                    <path d="M9.4408 9.76079C9.70644 10.0264 9.83926 10.1593 9.9113 10.3179C9.96979 10.4467 9.99909 10.5868 9.99713 10.7282C9.99471 10.9024 9.92626 11.0773 9.78937 11.4272L8.00003 16L6.21065 11.4272C6.07375 11.0774 6.0053 10.9024 6.00288 10.7282C6.00092 10.5868 6.03022 10.4467 6.08871 10.3179C6.16076 10.1592 6.29358 10.0264 6.55923 9.76078L7.63346 8.68656C7.76446 8.55556 7.82996 8.49007 7.90594 8.46669C7.96725 8.44783 8.03281 8.44783 8.09412 8.46669C8.1701 8.49007 8.23559 8.55557 8.36659 8.68657L9.4408 9.76079Z" fill="#fff" />
                    <path d="M16 8.00003L11.4272 9.78937C11.0773 9.92626 10.9024 9.99471 10.7282 9.99713C10.5868 9.99909 10.4467 9.96979 10.3179 9.9113C10.1593 9.83926 10.0264 9.70644 9.76079 9.4408L8.68657 8.36659C8.55557 8.23559 8.49007 8.1701 8.46669 8.09412C8.44783 8.03281 8.44783 7.96725 8.46669 7.90594C8.49007 7.82996 8.55556 7.76446 8.68656 7.63346L9.76078 6.55923C10.0264 6.29358 10.1592 6.16076 10.3179 6.08871C10.4467 6.03022 10.5868 6.00092 10.7282 6.00288C10.9024 6.0053 11.0774 6.07375 11.4272 6.21065L16 8.00003Z" fill="#fff" />
                    <path d="M6.23921 9.4408C5.97357 9.70644 5.84075 9.83926 5.6821 9.9113C5.55333 9.96979 5.41323 9.99909 5.27181 9.99713C5.09758 9.99471 4.92266 9.92626 4.57282 9.78937L0 8.00003L4.5728 6.21065C4.92265 6.07375 5.09757 6.0053 5.2718 6.00288C5.41322 6.00092 5.55333 6.03022 5.6821 6.08871C5.84075 6.16076 5.97358 6.29358 6.23922 6.55923L7.31344 7.63346C7.44444 7.76446 7.50993 7.82996 7.53331 7.90594C7.55217 7.96725 7.55217 8.03281 7.5333 8.09412C7.50993 8.1701 7.44443 8.2356 7.31343 8.36659L6.23921 9.4408Z" fill="#fff" />
                    </svg> Products
                </h5>
                <div class="space16"></div>
                <h2 class="vl-section-title" data-aos="zoom-in" data-aos-duration="1000">Our Products</h2>
                </div>
            </div>
            <div class="col-lg-3"></div>


            <div class="col-lg-3">
                <div class="btn-area1 text-end d-none d-lg-block">
                <a href="#" class="vl-btn2">Discover Products<i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
                <div class="gallery-slider-area3">
                    @foreach($productCategories as $category)
                        <div class="gallery-images-area">
                            <div class="service5-boxarea">
                                <div class="img1">
                                    <img src="{{ asset('uploads/products/' . $category->thumbnail_image) }}" 
                                        alt="{{ $category->category_name }}">
                                </div>
                                <div class="content-area">
                                    <a href="#" class="title">{{ $category->category_name }}</a>
                                    <div class="space10"></div>
                                    <p>{{ $category->description }}</p>
                                    <div class="space28"></div>
                                    <div class="btn-area1">
                                        <a href="#" class="vl-btn6">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row d-block d-lg-none mt-4 text-center">
            <div class="col-12">
                <a href="#" class="vl-btn2">Discover Products <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            </div>
        </div>
    </div>

    <div class="gallery1 sp1">
        <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
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
                </svg> Our Gallery</h5>
                <div class="space16"></div>
                <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="1000">Social Impact</h2>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="gallery-slider-area">
                    @foreach($socialGallery as $item)
                        @php
                            $isVideo = $item->banner_video ? true : false;
                            $imagePath = $item->image ? asset('uploads/home/' . $item->image) : null;
                            $link = $isVideo ? $item->banner_video : $imagePath;
                        @endphp

                        <a href="{{ $link }}" class="{{ $isVideo ? 'popup-youtube' : 'image-popup-vertical-fit' }}">
                            <div class="gallery-images-area">
                                <div class="img1">
                                    <img src="{{ $imagePath ?? 'assets/img/default.png' }}" alt="{{ $item->title }}">
                                </div>
                                <div class="media-type-icon">
                                    <i class="fa-{{ $isVideo ? 'brands fa-youtube' : 'regular fa-image' }}"></i>
                                </div>
                                <div class="content-area">
                                    <div class="icons">
                                        <span class="{{ $isVideo ? 'popup-youtube' : 'image-popup-vertical-fit' }}">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </div>
                                    <h5>{{ $item->heading }}</h5>
                                    <div class="space16"></div>
                                    <div class="title">{{ $item->title }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </div>

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
    </div>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>