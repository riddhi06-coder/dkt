<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


<!--===== HERO AREA STARTS =======-->
<div class="inner-header-section"
    style="background-image: url('{{ $terms_condition->first() && $terms_condition->first()->banner ? asset('uploads/home/' . $terms_condition->first()->banner) : asset('assets/img/banner/default.jpg') }}'); 
           background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-heading-area">
                    <h2>{{ $terms_condition->first()->banner_heading ?? 'Terms of Use' }}</h2>
                    <div class="space18"></div>
                    <div class="btn-area1">
                        <a href="{{ url('/') }}">Home</a>
                        <i class="fa-solid fa-angle-right"></i>
                        <a href="#">{{ $terms_condition->first()->banner_heading ?? 'Terms of Use' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== HERO AREA ENDS =======-->


<div class="terms-of-use-sec sp1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                @forelse($terms_condition as $term)
                    <div class="terms-of-use-content-sec mb-4">
                        <div>{!! $term->description !!}</div> <!-- renders HTML content from editor -->
                    </div>
                @empty
                    <p>No Terms & Conditions available.</p>
                @endforelse

            </div>
        </div>
    </div>
</div>



    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>