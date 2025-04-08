<!DOCTYPE html> 
<html lang="en">

<head>
    <title>KLASIK CERTIFICATE</title>
    <link rel="icon" href="{{asset('uclean/images/KCIlogo.png')}}" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <meta content="KLASIK CERTIFICATE" name="description" >
    <meta content="" name="keywords" >
    <meta content="" name="author" >
    <!-- CSS Files
    ================================================== -->
    <link href="{{asset('uclean/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{asset('uclean/css/plugins.css')}} " rel="stylesheet" type="text/css" >
    <link href="{{asset('uclean/css/swiper.css')}} " rel="stylesheet" type="text/css" >
    <link href="{{asset('uclean/css/style.css')}} " rel="stylesheet" type="text/css" >
    <link href="{{asset('uclean/css/coloring.css')}} " rel="stylesheet" type="text/css" >
    <!-- color scheme -->
    <link id="colors" href="{{asset('uclean/css/colors/scheme-01.css')}}" rel="stylesheet" type="text/css" >
    @yield('head')
</head>

<body>
    <main class="wrapper">
      <div class="float-text show-on-scroll">
        <span><a href="#">Scroll to top</a></span>
    </div>
    <div class="scrollbar-v show-on-scroll"></div>

    <!-- page preloader begin -->
    <div id="de-loader"></div>
    <x-public.navbar />
        <!-- Navigation -->
        <!-- end navigation -->

        @yield('content')
<!-- footer begin -->
<footer class="section-dark">
  <div class="container">
      <div class="row gx-5">
          <div class="col-lg-5 col-sm-12 order-lg-1 order-sm-2">
              <div class="row">
                  <div class="col-lg-6 col-sm-6">
                      <div class="widget">
                          <h5>Quick Links</h5>
                          <ul>
                              <li><a href="{{ route('landingpage') }}"><i class="far fa-arrow-right"></i> Home</a></li>
                              <li><a href="{{ route('check.certificate') }}"><i class="far fa-arrow-right"></i> Certificate Checking</a></li>
                              <li><a href="#contact-us"><i class="far fa-arrow-right"></i> Contact-us</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-6 col-sm-6">
                      <div class="widget">
                          <h5>Our Services</h5>
                          <ul>
                              <x-navbar.services />
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-sm-6 order-lg-2 order-sm-1">
              <div class="widget" id="contact-us">
                  <div class="fw-bold text-white"><i class="icofont-phone me-2 id-color-2"></i>Hot Line Number</div>
                  <x-navbar.phonenumber />

                  <div class="spacer-20"></div>

                  <div class="fw-bold text-white"><i class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                  <x-navbar.address />

                  <div class="spacer-20"></div>

                  <div class="fw-bold text-white"><i class="icofont-envelope me-2 id-color-2"></i>Send a Message</div>
                  <x-navbar.officeemail />
              </div>
          </div>
          {{-- logo section --}}
          <div class="col-lg-4 col-sm-6 order-lg-3 order-sm-3">
              {{-- <h2>logo</h2> --}}
              <div class="row">
                  @foreach ($footerlogos as $footlogo)
                  <div class="col-lg-4 col-sm-12">
                      <img class="img-fluid" src="{{ Storage::disk('public')->url($footlogo->thumbnail) }}" alt="" height="160">
                  </div>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
  <div class="subfooter">
      <div class="container">
          <div class="row g-4">
              <div class="col-md-12">
                  <div class="de-flex">
                      <div class="de-flex-col">
                          Copyright 2025 - KLASIK CERTIFICATION
                      </div>
                      {{-- <ul class="menu-simple">
                          <li><a href="#">Terms &amp; Conditions</a></li>
                          <li><a href="#">Privacy Policy</a></li>
                      </ul> --}}
                  </div>
              </div>
          </div>
      </div>
  </div>
</footer>
    </main>
    <!-- end main wrapper -->

    <!-- jQuery Scripts -->
    <script src="{{asset('uclean/js/plugins.js')}}"></script>
    <script src="{{asset('uclean/js/designesia.js')}}"></script>
    <script src="{{asset('uclean/js/swiper.js')}}"></script>
    <script src="{{asset('uclean/js/custom-marquee.js')}}"></script>
    <script src="{{asset('uclean/js/custom-swiper-1.js')}}"></script>
    <script src="{{asset('uclean/js/jquery.event.move.js')}}"></script>
    <script src="{{asset('uclean/js/jquery.twentytwenty.js')}}"></script>

    <script>
    $(window).on("load", function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.5});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.5, orientation: 'vertical'});
    });
    </script>
</body>

</html>
