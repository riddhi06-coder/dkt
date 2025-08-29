<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


     <!--===== HERO AREA STARTS =======-->
    <div class="inner-header-section"
        style="background-image: url('{{ $privacy_policy->first() && $privacy_policy->first()->banner ? asset('uploads/home/' . $privacy_policy->first()->banner) : asset('assets/img/banner/default.jpg') }}'); 
            background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
        <div class="row">
            <div class="col-lg-6">
            <div class="hero-heading-area">
                <h2>{{ $privacy_policy->first()->banner_heading ?? 'Privacy Policy111' }}</h2>
                <div class="space18"></div>
                <div class="btn-area1">
                <a href="{{ url('/') }}">Home</a>
                <i class="fa-solid fa-angle-right"></i>
                <a href="#">{{ $privacy_policy->first()->banner_heading ?? 'Privacy Policy111' }}</a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

  <!--===== HERO AREA ENDS =======-->

  <div class="privacy-policy-sec sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="privacy-policy-content-sec">
            <p>
                {!! $privacy_policy->first()->description !!}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')

</body>
</html>