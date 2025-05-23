@extends('layouts.public')

@section('head')
@endsection

@section('content')

<!-- header close -->
<!-- content begin -->
<div class="no-bottom no-top" id="content">


    <div id="top"></div>

    <section class="section-dark text-light no-top no-bottom position-relative overflow-hidden z-1000">
        <div class="v-center">
            <div class="swiper">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="swiper-inner" data-bgimage="url({{asset('uclean/images/side-view-cropped-unrecognizable-business-people-working-common-desk.jpg')}})">
                        <div class="sw-caption">
                            <div class="container">
                                <div class="row g-4 justify-content-center">

                                    <div class="spacer-double"></div>

                                    <div class="col-lg-7 text-center">     
                                        <div class="spacer-single"></div>
                                        <div class="sw-text-wrapper">
                                            <div class="subtitle mb-2">KLASIK CERTIFICATION</div>
                                            <h1 class="slider-title mb-3">Enhance Your Business, Trust and Quality</h1>
                                            <p class="slider-teaser mb-3">with Reliable ISO Certification</p>
                                            <div class="spacer-10"></div>
                                            <a class="btn-main bg-color-2 text-dark mb10 mb-3" href="#contact-us">Contact Us</a>
                                        </div>
                                    </div>

                                    <div class="spacer-single"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sw-overlay op-4"></div>
                    </div>
                </div>
                <!-- Slides -->

                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="swiper-inner" data-bgimage="url( {{asset('uclean/images/group-people-working-out-business-plan-office.jpg')}} )">
                        <div class="sw-caption">
                            <div class="container">
                                <div class="row g-4 justify-content-center">

                                    <div class="spacer-double"></div>

                                    <div class="col-lg-7 text-center">     
                                        <div class="spacer-single"></div>
                                        <div class="sw-text-wrapper">
                                            <div class="subtitle mb-2">KLASIK CERTIFICATION</div>
                                            <h1 class="slider-title mb-3">Boost Your Business Competitiveness</h1>
                                            <p class="slider-teaser mb-3">with International-Standard ISO Certification</p>
                                            <div class="spacer-10"></div>
                                            <a class="btn-main bg-color-2 text-dark mb10 mb-3" href="#contact-us">Call Us Us</a>
                                        </div>
                                    </div>

                                    <div class="spacer-single"></div>
                                </div>

                            </div>
                        </div>
                        <div class="sw-overlay op-4"></div>
                    </div>
                </div>
                <!-- Slides -->
                

              </div>
              <!-- If we need pagination -->
              <div class="swiper-pagination"></div>

              <!-- If we need navigation buttons -->
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>

              <!-- If we need scrollbar -->
              <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </section>

    <section class="bg-color-3 text-light section-dark">
        <div class="container relative">
            <div class="row g-4 gx-5 align-items-center">
                <div class="col-lg-6 relative">
                    <div class="relative z-1000">
                        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">About KLASIK</div>
                        <h2>Professional, Accurate and Reliable
                            Certification Services</h2>
                        <p>PT. Klasik Certification Indonesia adalah lembaga sertifikasi yang berdiri pada bulan Desember 2024, dengan komitmen kuat untuk memberikan layanan sertifikasi ISO yang profesional, terpercaya, dan berstandar internasional.</p>
                        <a class="btn-main bg-color-2 text-dark wow fadeInUp" data-wow-delay=".6s" href="#about-us">About Us</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <img src="{{ asset('uclean/images/pexels-sora-shimazaki-5668859.jpg') }}" class="img-fluid rounded-10 mb-4 w-70 ms-30 wow scaleIn" alt="">
                            <img src="{{ asset('uclean/images/pexels-polina-zimmerman-3746957.jpg') }}" class="img-fluid rounded-10 wow scaleIn" alt="">
                        </div>
                        <div class="col-6">
                            <div class="spacer-single sm-hide"></div>
                            <img src="{{ asset('uclean/images/pexels-olly-3760067.jpg') }}" class="img-fluid rounded-10 mb-4 wow scaleIn" alt="">
                            <img src="{{ asset('uclean/images/pexels-thirdman-5256816.jpg') }}" class="img-fluid rounded-10 w-70 wow scaleIn" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-color-3 no-top text-light section-dark relative">
        <img src="{{ asset('uclean/images/deco/s1.webp') }}" class="w-10 mt-min-60 abs start-10 wow scaleOut" alt="">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="subtitle wow fadeInUp mb-3">Our Services</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">ISO Certification Services</h2>
                    <p class="lead mb-0 wow fadeInUp">With professional experience and expertise, we are ready to support you through every step of the ISO certification process.</p>
                    <div class="spacer-single"></div>
                    <div class="spacer-half"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container mt-min-120">
            <div class="row g-4">
                
                @foreach ($services as $service)
                <div class="col-lg-4 col-sm-6">
                    <div class="relative mb-3">
                        <a href="{{ route('services.show', $service->id) }}" class="d-block hover mb-3">
                            <div class="relative overflow-hidden rounded-1 shadow-soft">
                                {{-- <img src="{{ Storage::disk('public')->url($service->thumbnail) }}" class="w-50 end-0 absolute hover-op-0" alt="{{ $service->title }}"> --}}
                                <div class="absolute z-2 start-0 w-100 abs-middle fs-36 text-white text-center">
                                    <span class="btn-main hover-op-1">Read More</span>
                                </div>
                                <img src="{{ Storage::disk('public')->url($service->thumbnail) }}" class="img-fluid hover-scale-1-2" alt="{{ $service->title }}">
                            </div>
                        </a>
                        <h4>{{ $service->title }}</h4>
                        <p class="no-bottom">{!!  substr(strip_tags($service->short_description), 0, 250)!!} . . . .</p>
                    </div>
                </div>

                {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="service-one-inner-four">
                        <a href="{{ route('services.show', $service->id) }}" class="icon">
                            <img src="{{ Storage::disk('public')->url($service->thumbnail) }}" style="height: 200px !important; width: 100% !important;object-fit: cover;" alt="{{ $service->title }}">
                        </a>
                        <div class="content">
                            <a href="{{ route('services.show', $service->id) }}" class="icon">
                                <h5 class="title">{{ $service->title }}</h5>
                            </a>
                                <p class="disc">
                                {!!  substr(strip_tags($service->short_description), 0, 250)!!} . . . .
                                </p>
                        </div>
                        <a href="{{ route('services.show', $service->id) }}" class="rts-btn btn-primary-3"> Read More</a>
                    </div>
                </div> --}}
                @endforeach   
            </div>
        </div>
    </section>
    <section class="relative bg-color-2" style="background-size: cover; background-repeat: no-repeat;">
        <div class="container" style="background-size: cover; background-repeat: no-repeat;">
            <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                
                <div class="text-center ">
                    <b class="sub text-white">
                        WHY CHOOSE US?
                    </b>
                    <h2 class="title">
                        Why Choose <br> KLASIK Certification Indonesia ?
                    </h2>
                </div>
                
                @foreach ($whyus  as $why)
                <div class="col-lg-4 col-md-6" style="background-size: cover; background-repeat: no-repeat;">
                    <div class="relative bg-white p-4 rounded-1" style="background-size: cover; background-repeat: no-repeat;">
                        <div class="ps-50" style="background-size: cover; background-repeat: no-repeat;">
                            <h4 class="mb-0">{{$why->title}}</h4>
                            <p class="mb-0">{{$why->short_description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-color-3" style="background-size: cover; background-repeat: no-repeat;">
        <div class="container" style="background-size: cover; background-repeat: no-repeat;">
            <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                <div class="col-lg-6 offset-3 relative">
                    <div class="relative z-1000">
                        {{-- <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Why Choose Us</div> --}}
                        <h1 class="text-center text-white">Article From Us</h1>
                    </div>
                </div>
                
                
                @foreach ($blogs as $blog)
                <div class="col-lg-4 col-sm-6">
                   
                    <div class="relative mb-3">
                        <div class="card" style="border-radius: 20px;">
                            <div class="card-body p-3">
                                <a href="{{ route('blogs.showPublic', $blog->id) }}" class="d-block hover mb-3">
                                    <div class="relative overflow-hidden rounded-1 shadow-soft">
                                        {{-- <img src="{{ Storage::disk('public')->url($service->thumbnail) }}" class="w-50 end-0 absolute hover-op-0" alt="{{ $service->title }}"> --}}
                                        <div class="absolute z-2 start-0 w-100 abs-middle fs-36 text-white text-center">
                                            <span class="btn-main hover-op-1">Read More</span>
                                        </div>
                                        <img src="{{ Storage::disk('public')->url($blog->thumbnail) }}" class="img-fluid hover-scale-1-2" alt="{{ $service->title }}">
                                    </div>
                                </a>
                                <div class="p-2">
                                    <h4>{{ $blog->title }}</h4>
                                    <p class="no-bottom">{!!  substr(strip_tags($blog->short_description), 0, 250)!!}...</p>
                                </div>
                                <a href="{{ route('blogs.showPublic', $blog->id) }}" class="btn-main w-100 p-3 mt-3">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach   
                
            </div>
        </div>
    </section>
    
    <section class="border-top" style="background-size: cover; background-repeat: no-repeat;">
        <div class="container" style="background-size: cover; background-repeat: no-repeat;">
            <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                <div class="col-lg-6 offset-lg-3 text-center" style="background-size: cover; background-repeat: no-repeat;">
                    <div class="subtitle wow fadeInUp mb-3 animated" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-name: fadeInUp;">Clients</div>
                    <h2 class="wow fadeInUp animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Our Client</h2>
                </div>
            </div>
            <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                @foreach ($clients as $client)
                <div class="col-lg-3 col-sm-12" style="background-size: cover; background-repeat: no-repeat;">
                    <img src="{{ Storage::disk('public')->url($client->image) }}" class="img-fluid rounded-10px" alt="">
                </div>
            @endforeach
            
                

            </div>
        </div>
    </section>
    <section class="no-top">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="subtitle wow fadeInUp mb-3">Testimonials</div>
                    <h2 class="mb-4 wow fadeInUp" data-wow-delay=".2s">Good Feedback from Client</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="owl-carousel owl-theme wow fadeInUp" id="testimonial-carousel">
                    @foreach ($feedbacks as $feedback)
                    <div class="item">
                        <div class="relative p-2">
                            <div class="relative">
                                <img class="relative z-2 w-80px mb-3 rounded-1" alt="Testimonial Client" src="{{ Storage::disk('public')->url($feedback->image) }}">
                            </div>
                            <div class="mt-4 text-dark fw-600">{{ $feedback->name }}.<span>{{ $feedback->position }}</span></div>
                            <div class="de-rating-ext mb-3">
                                <span class="d-stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </div>
                            <p>“{{ $feedback->feedback }}”</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light relative no-top no-bottom overflow-hidden" style="background-size: cover; background-repeat: no-repeat;">
        <div class="container-fluid position-relative half-fluid" style="background-size: cover; background-repeat: no-repeat;">
          <div class="container" style="background-size: cover; background-repeat: no-repeat;">
            <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
              <!-- Image -->
              <div class="col-lg-6 position-lg-absolute left-half h-100" style="background-size: cover; background-repeat: no-repeat;">
                {{-- <a class="absolute start-0 w-100 abs-middle fs-36 text-white text-center z-2 popup-youtube" href="https://www.youtube.com/watch?v=AkSwAc7ApNc">
                    <div class="player invert bg-color-2 no-border rounded-1 wow scaleIn animated" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-name: scaleIn;"><span></span></div>
                </a> --}}
                <div class="image bgcustom" data-bgimage="url({{asset('uclean/images/pexels-sora-shimazaki-5668859.jpg')}}) center" style="background: url(&quot;images/misc/12.webp&quot;) center center / cover no-repeat;"></div>
              </div>
              <!-- Text -->
              <div class="col-lg-6 offset-lg-6" style="background-size: cover; background-repeat: no-repeat;">
                    <div class="spacer-single" style="background-size: cover; background-repeat: no-repeat;"></div>
                    <div class="spacer-double" style="background-size: cover; background-repeat: no-repeat;"></div>
                    <div class="ps-lg-5" style="background-size: cover; background-repeat: no-repeat;">
                        <h3>Do you have any question?</h3>
                        
                        <form name="contactForm" id="contact_form" class="form-border" method="post" action="{{ route('contactus.email') }}?notCheck=1">
                            @csrf
                                <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                                    <div class="col-md-6 mb-3" style="background-size: cover; background-repeat: no-repeat;">
                                        <div class="field-set" style="background-size: cover; background-repeat: no-repeat;">
                                            <input type="text" name="company_name" id="name" class="form-control" placeholder="Your Company Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" style="background-size: cover; background-repeat: no-repeat;">
                                        <div class="field-set" style="background-size: cover; background-repeat: no-repeat;">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" style="background-size: cover; background-repeat: no-repeat;">
                                        <div class="field-set" style="background-size: cover; background-repeat: no-repeat;">
                                            <input type="text" name="location" id="location" class="form-control" placeholder="Your location" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6         mb-3" style="background-size: cover; background-repeat: no-repeat;">
                                        <div class="field-set" style="background-size: cover; background-repeat: no-repeat;">
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required="">
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="field-set mb-4" style="background-size: cover; background-repeat: no-repeat;">
                                    <textarea name="message" id="message" class="form-control" rows="5" placeholder="Your Message" required=""></textarea>
                                </div>

                                <div id="submit" class="mt20" style="background-size: cover; background-repeat: no-repeat;">
                                    <input type="submit" id="send_message" value="Send Message" class="btn-main">
                                </div>

                                {{-- <div id="success_message" class="success" style="background-size: cover; background-repeat: no-repeat;">
                                    Your message has been sent successfully. Refresh this page if you want to send more messages.
                                </div>
                                <div id="error_message" class="error" style="background-size: cover; background-repeat: no-repeat;">
                                    Sorry there was an error sending your form.
                                </div> --}}
                            </form>
                    </div>
                    <div class="spacer-double" style="background-size: cover; background-repeat: no-repeat;"></div>
                    <div class="spacer-single" style="background-size: cover; background-repeat: no-repeat;"></div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section class="relative bg-color text-light no-top no-bottom overflow-hidden">
        <div class="container-fluid position-relative half-fluid">
          <div class="container">
            <div class="row g-4">
              <!-- Image -->
              <div class="col-lg-6 position-lg-absolute left-half h-100">
                <section class="relative overflow-hidden" style="background-size: cover; background-repeat: no-repeat;">
                    <div class="container" style="background-size: cover; background-repeat: no-repeat;">
                        <div class="row g-4 grid-divider" style="background-size: cover; background-repeat: no-repeat;">
                            <div class="col-md-3 wow fadeInRight animated" data-wow-delay=".2s" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">
                                <div class="text-center" style="background-size: cover; background-repeat: no-repeat;">       
                                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa fa-phone"></i>
                                    <h5 class="mb-0">Hot Line number</h5>
                                    <x-navbar.phonenumber />
                                </div>
                            </div>
                            <div class="col-md-3 wow fadeInRight animated" data-wow-delay=".6s" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-delay: 0.6s; animation-name: fadeInRight;">
                                <div class="text-center" style="background-size: cover; background-repeat: no-repeat;">                         
                                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa fa-solid fa-location-dot"></i>  
                                    <h5 class="mb-0">Location</h5>
                                    <x-navbar.address />
                                </div>
                            </div>
                            <div class="col-md-3 wow fadeInRight animated" data-wow-delay=".8s" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-delay: 0.8s; animation-name: fadeInRight;">
                                <div class="text-center" style="background-size: cover; background-repeat: no-repeat;">
                                    <i class="bg-color text-light fs-32 p-30 circle mb-3 fa fa-envelope"></i>
                                    <h5 class="mb-0">Email</h5>
                                    <x-navbar.emails />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
              </div>
              <!-- Text -->
              <div class="col-lg-6 offset-lg-6">
                    <div class="spacer-single"></div>
                    <div class="spacer-double"></div>
                    <div class="ps-lg-5">
                        <div class="subtitle wow fadeInUp mb-3">Contact With Us</div>
                        <h2 class="wow fadeInUp">Enhance Your Business, Trust and Quality</h2>
                        <div class="spacer-10"></div>
                        <a class="btn-main btn-line wow fadeInUp" href="#contact-us">Contact Us</a>
                    </div>
                    <div class="spacer-double"></div>
                    <div class="spacer-single"></div>
              </div>
            </div>
          </div>
        </div>
    </section>

    {{-- <section class="pt-30 pb-0">
        <div class="container relative">
            <div class="row g-4 gx-5 align-items-center">
                <div class="col-lg-6 relative">
                    <div class="relative z-1000">
                        <div class="subtitle wow fadeInUp" data-wow-delay=".0s">Join Our Team</div>
                        <h2>Join Our Team of Professionals Cleaners</h2>
                        <p>Join our team and be part of a dynamic, professional, and supportive environment! Enjoy flexible schedules, competitive pay, and growth opportunities while helping create spotless, welcoming spaces for our valued clients.</p>

                        <a href="contact.html" class="btn-main">Join Now</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="{{ asset('uclean/images/misc/2.webp') }}" class="w-100" alt="">
                </div>

            </div>
        </div>
    </section> --}}

</div>
<!-- content close -->


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
