@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <!-- Triangle Image -->
     <!-- banner area start three -->
     <div class="rts-banner-area banner-three banner-four banner-five">
        <div class=" bg_banner-three bg_banner-four bg_image rts-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-three-inner banner-four-inner banner-five-inner">
                            <div class="banner-title">
                                <span class="subtitle-banner"><strong>WELCOME!</strong> START GROWING YOUR INSURANCE</span>
                                <!-- type headline start-->
                                <h1 class="title">
                                    Build Your Effective <br>
                                    <div class="changebox" style="height: 60px; width: 251px;">
                                        <span>Business</span>
                                        
                                    </div>
                                    Strategy
                                </h1>
                            </div>
                            <p class="disc">
                                Porttitor ornare fermentum aliquam pharetra facilisis gravida risus suscipit <br> Dui feugiat fusce conubia ridiculus tristique parturient
                            </p>
                            <p>
                                <a class="btn btn-primary" href="https://www.producthunt.com/">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                    </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner area end three -->

    <!-- rts-service area start -->
    <div class="rts-service-area rts-service-area5">
        <div class="container">
            <div class="row g-5 mt--20">
            @foreach ($services as $service)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="service-one-inner-four">
                        <a href="{{ route('services.show', $service->id) }}" class="icon">
                            <img src="{{ Storage::disk('public')->url($service->thumbnail) }}" alt="{{ $service->title }}">
                        </a>
                        <div class="content">
                            <h5 class="title">{{ $service->title }}</h5>
                            </p>
                        </div>
                        
                    </div>
                </div>
            @endforeach    
            </div>
        </div>
    </div>
    <!-- rts-service area end -->

    <!-- leading business solution area -->
    <div class="rts-business-solution rts-business-solution5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 col-md-12 first-child">
                    <div class="rts-business-solution-right">
                        <div class="title-area">
                            <span class="sub">
                                More About Us
                            </span>
                            <h2 class="title">
                                Here is your perfect Marketing Solution
                            </h2>
                        </div>
                        <div class="content-area">
                            <p class="disc">
                            {!! @$about->content !!}    
                            </p>
                            <!-- single business solution -->
                            <div class="single-business-solution-2">
                                <div class="content">
                                    <h6 class="title">
                                        Best Marketing Solutions <br> since 2002
                                    </h6>
                                </div>
                            </div>
                            <!-- single business solution end -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <!-- business solution left -->
                    <div class="rts-business-solution-left">
                        <div class="thumbnail">
                            <img src="assets/images/business-goal/03.jpg" alt="">
                            <div class="shape1">
                                <img src="assets/images/business-goal/icon/setting.png" alt="">
                            </div>
                            <div class="shape2">
                                <img src="assets/images/business-goal/icon/setting.png" alt="">
                            </div>
                            <div class="shape3">
                                <img src="assets/images/business-goal/icon/bag.png" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- business solution left End -->
                </div>
            </div>
        </div>
    </div>
    <!-- leading business solution area End -->

    <!-- start call to action area -->
    <div class="rts-callto-acation-area rts-callto-acation-area5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-two-wrapper">
                        <div class="title-area">
                            <h3 class="title animated fadeIn">Need Any Marketing Solutions? Contact With Us</h3>
                        </div>
                        <a class="rts-btn btn-secondary-3" href="contactus.html">Lets Work Together</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end call to action area -->

    <!-- business goal area -->
    <div class="rts-business-goal rts-business-goal5 mt--0 rts-section-gapBottom">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="title-area">
                        <span class="sub">
                            OUR STRATEGY
                        </span>
                        <h2 class="title">
                            Grow Your Business with <br> Finbiz Pro SEO
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <!-- business goal left -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 first-child">
                    <ul class="content-box first">
                        <li class="content left">
                            <h5 class="main-title">Financial Planning</h5>
                            <p class="desc">Purus dui eget sollicitudin curae leo proin platea cras, morbi torquent massa</p>
                        </li>
                        <li class="content left one">
                            <h5 class="main-title">Working Planning</h5>
                            <p class="desc">Purus dui eget sollicitudin curae leo proin platea cras, morbi torquent massa</p>
                        </li>
                        <li class="content left">
                            <h5 class="main-title">Project Planning</h5>
                            <p class="desc">Purus dui eget sollicitudin curae leo proin platea cras, morbi torquent massa</p>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 text-center">
                    <div class="business-goal-one">
                        <img src="assets/images/business-goal/characters.png" alt="Business_Goal">
                        <div class="shape"><img src="assets/images/business-goal/icon/line.png" alt=""></div>
                    </div>
                </div>
                <!-- business goal right -->

                <!-- right area business -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="content-box last">
                        <li class="content right">
                            <h5 class="main-title">Marketing Planning</h5>
                            <p class="desc">Purus dui eget sollicitudin curae leo proin platea cras, morbi torquent massa</p>
                        </li>
                        <li class="content right two">
                            <h5 class="main-title">Service Planning</h5>
                            <p class="desc">Purus dui eget sollicitudin curae leo proin platea cras, morbi torquent massa</p>
                        </li>
                        <li class="content right">
                            <h5 class="main-title">Placement Planning</h5>
                            <p class="desc">Purus dui eget sollicitudin curae leo proin platea cras, morbi torquent massa</p>
                        </li>
                    </ul>
                </div>
                <!-- right area business ENd -->
            </div>
        </div>
    </div>
    <!-- business goal area End -->

    <!-- testimonials area start -->
    <div class="rts-testimonials-h2-area rts-section-gap bg_testimonials-h2">
        <div class="container">
            <div class="row mb--30">
                <div class="col-12">
                    <div class="title-area testimonials-area-h2 text-center">
                        <span data-sal-delay="150" data-sal="slide-up" data-sal-duration="800" class="sal-animate">Customer
                            Testimonial</span>
                        <h2 class="title sal-animate" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                            Customer Feedback’s</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5">
            <div id="owl-testimonials" class="owl-carousel owl-theme owl-carousel--arrows-outside">
                    @foreach ($feedbacks as $feedback)
                    <div class="single-testimonials-h2">
                        <div class="body">
                            <h5 class="title">Good Feedback from Client</h5>
                            <p class="disc">
                            “{{ $feedback->feedback }}”
                            </p>
                        </div>
                        <div class="footer">
                            <div class="left">
                                <a class="thumbnail" href="#"><img src="{{ Storage::disk('public')->url($feedback->image) }}" alt="Testimonial Client"></a>
                                <div class="desig">
                                    <a href="#">
                                        <h6 class="title">
                                        {{ $feedback->name }}
                                        </h6>
                                    </a>
                                    <p>{{ $feedback->position }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- testimonials area end -->

    <!-- rts-service area start -->
    <div class="rts-blog-area4 blog-area5 rts-section-gap pb--120 pb_sm--60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center title-service-three">
                        <p class="pre-title">
                            Weekly Posts
                        </p>
                        <h2 class="title">Our Latest Post</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--20">
                @foreach ($blogs as $blog)
                                <div class="col-xl-4 col-lg-4 col-sm-12">
                                    <div class="service-one-inner-four">
                                        <div class="big-thumbnail-area">
                                            <a href="{{ route('blogs.showPublic', $blog->id) }}" class="thumbnail">
                                                <img src="{{ Storage::disk('public')->url($blog->thumbnail) }}" alt="Business-service">
                                                <span class="date">{{ $blog->created_at->format('d-m-Y') }}</span>
                                            </a>
                                            <div class="content-box">
                                                <div class="author-box">
                                                    <p class="author"><span>BUSINESS SOLUTION</span> / BY DAVID DOLEAN</p>
                                                </div>
                                                <div class="content">
                                                    <h5 class="title">{{ $blog->title }}</h5>
                                                    <p class="desc">{{ $blog->short_description ?? '-' }}</p>
                                                </div>
                                                <div class="button-area">
                                                    <a href="{{ route('blogs.showPublic', $blog->id) }}"><span><i class="far fa-arrow-right"></i></span>Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
            <div class="text-center">
                    <a href="#" class="rts-btn btn-primary btn-primary-2 ml--20 ml_sm--5 header-one-btn quote-btn">Get Quote</a>
                    
                </div></div>
                
        </div>
    </div>
    <!-- rts-service area end -->

    <!-- start trusted client section -->
    <div class="rts-trusted-client rts-trusted-client2 rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title-area-client text-center">
                        <p class="client-title">Our Trusted Clients</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="client-wrapper-one">
                    @foreach ($clients as $client)
                                <a href="#"><img src="{{ Storage::disk('public')->url($client->image) }}" alt="business_finbiz"></a>
                            @endforeach
                    </div>
        </div>
    </div>
    <!-- end trusted client section -->

    <!-- start footer area -->
    <!-- rts footer area start -->
    <div class="rts-footer-area footer-one footer-five rts-section-gapTop bg-footer-one">
        <div class="container bg-shape-f1">
            <!-- footer call to action area -->
            
            <!-- footer call to action area End -->
            <!-- rts footer area -->
            <div class="row pt--120 pt_sm--80 pb--80 pb_sm--40">
                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                    <div class="footer-one-single-wized">
                        <div class="wized-title">
                            <h5 class="title">Quick Links</h5>
                            <img src="assets/images/footer/under-title.png" alt="finbiz_footer">
                        </div>
                        <div class="quick-link-inner">
                            <ul class="links">
                                <li><a href="#"><i class="far fa-arrow-right"></i> Forum Support</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i> Help &amp; FAQ</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i> Contact Us</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i> Pricing &amp; Plans</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i> Cookie Policy</a></li>
                            </ul>
                            <ul class="links margin-left-70">
                                <li><a href="#"><i class="far fa-arrow-right"></i> About Us</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i> My Account</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i>Our Company</a></li>
                                <li><a href="#"><i class="far fa-arrow-right"></i>Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- footer mid area -->
                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                    <div class="footer-one-single-wized mid-bg">
                        <div class="wized-title">
                            <h5 class="title">Opening Hours</h5>
                            <img src="assets/images/footer/under-title.png" alt="finbiz_footer">
                        </div>
                        <div class="opening-time-inner">
                            <div class="single-opening">
                                <p class="day">Week Days</p>
                                <p class="time">09.00 - 24:00</p>
                            </div>
                            <div class="single-opening">
                                <p class="day">Saturday</p>
                                <p class="time">08:00 - 03.00</p>
                            </div>
                            <div class="single-opening mb--30 mb_sm--10">
                                <p class="day">Sunday</p>
                                <p class="time">Day Off</p>
                            </div>
                            <a href="#" class="rts-btn btn-primary contact-us">Contact Us</a>
                        </div>
                    </div>
                </div>
                <!-- footer mid area end -->

                <!-- footer end area post -->
                
                <!-- footer end area post end-->
            </div>
            <!-- rts footer area End -->
        </div>
        <!-- copyright area start -->
        <div class="rts-copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <p>SSAB - Copyright 2022. All rights reserved. Theme - Finbiz</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright area end -->
    </div>
    <!-- rts footer area end -->
    <!-- ENd footer Area -->
    <!-- end content wrapper -->
@endsection

@section('script')
    <script>
        new Splide("#ourServicesSlide", {
            pagination: true,
            arrows: false,
            perPage: 3,
            gap: "20px",
            breakpoints: {
                425: {
                    perPage: 1,
                },
                585: {
                    perPage: 2,
                },
            },
        }).mount();

        new Splide("#latestNewsSlide", {
            pagination: true,
            arrows: false,
            perPage: 3,
            gap: "20px",
            breakpoints: {
                768: {
                    perPage: 2,
                },
                555: {
                    perPage: 1,
                },
            },
        }).mount();

        new Splide("#ourClientsSlide", {
            pagination: true,
            arrows: false,
            perPage: 4,
            gap: "20px",
            breakpoints: {
                425: {
                    perPage: 2,
                },
                585: {
                    perPage: 3,
                },
            },
        }).mount();
    </script>
@endsection
