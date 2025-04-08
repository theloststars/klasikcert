@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div class="content-wrapper oh">
        <!-- Page Title -->
        <section class="page-title text-center">
            <div class="container">
                <img src="{{ Storage::disk('public')->url(@$about->image) }}" alt=""
                    style="max-height: 28rem; width: 100%; object-fit: cover" />
                <div class="page-title__holder">
                </div>
            </div>
        </section>
        <!-- end page title -->

        <!-- Benefits -->
        <section class="section-wrap pb-5 mb-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="benefits box-shadow-large offset-top-171">
                            <h1 class="benefits__title text-center">About Us</h1>
                            <div class="row text-justify">
                                <p class="pb-3" style="color:rgba(0,0,0,0.8) !important;font-weight:300;font-size:19px;">
                                {{ $about->short}}
                                </p>
                                {!! @$about->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end benefits -->

        <!-- Statistic -->
        <section class="section-wrap bg-color-overlay pt-5 "
            style="background-image: url({{ asset('ssi-fe/src/img/statistic/statistic.jpg') }})">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="statistic">
                            <!-- <span class="statistic__number">36</span> -->
                            <!-- <h5 class="statistic__title">Sucessful Projects</h5> -->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="statistic">
                            <!-- <span class="statistic__number">100%</span> -->
                            <!-- <h5 class="statistic__title">Achieved ROI</h5> -->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="statistic">
                            <!-- <span class="statistic__number">550</span> -->
                            <!-- <h5 class="statistic__title">Happy Customers</h5> -->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="statistic">
                            <!-- <span class="statistic__number">3x</span> -->
                            <!-- <h5 class="statistic__title">Increased Profits</h5> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end statistic -->

        <!-- From Blog -->
        <section class="section-wrap">
            <div class="container">
                <div class="title-row title-row--boxed text-center">
                    <h2 class="section-title text-green">Latest News</h2>
                    <p class="subtitle">
                        Berita terkini mengenai Sertifikasi ISO maupun Legalitas
                        lainnya.
                    </p>
                </div>
                <!-- <div class="row card-row"> -->

                <div class="rts-blog-area4 blog-area5 rts-section-gap pb--120 pb_sm--60">
            <div class="container">
            <div class="row g-5 mt--20">
                @foreach ($blogs as $blog)
                                <div class="col-xl-4 col-lg-4 col-sm-12">
                                    <div class="service-one-inner-four">
                                        <div class="big-thumbnail-area">
                                            <a href="{{ route('blogs.showPublic', $blog->id) }}" class="thumbnail">
                                                <img style="height: 200px !important; width: 100% !important;object-fit: cover;" src="{{ Storage::disk('public')->url($blog->thumbnail) }}" alt="Business-service">
                                                <span class="date">{{ $blog->created_at->format('d-m-Y') }}</span>
                                            </a>
                                            <div class="content-box">
                                             
                                                <div class="content">
                                                    <h5 class="title">{{ $blog->title }}</h5>
                                                    <p class="desc">
                                                        {{ substr(strip_tags($blog->short_description), 0, 150) ?? '-' }}. . . .
                                                    </p>
                                                </div>
                                                <div class="button-area">
                                                    <a href="{{ route('blogs.showPublic', $blog->id) }}"><span><i class="far fa-arrow-right"></i></span>Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                <!-- <div class="text-center">
                    <a href="#" class="rts-btn btn-primary btn-primary-2 ml--20 ml_sm--5 header-one-btn quote-btn">Get Quote</a>    
                </div> -->
            
            </div>
                
        </div>
    </div>
    <!-- rts-service a
                <!-- </div> -->
            </div>
        </section>
        <!-- end from blog -->

        <!-- footer : start -->
        <x-public.contactus />
        <x-public.footer />
        <!-- footer : end -->

        <div id="back-to-top">
            <a href="#top"><i class="ui-arrow-up"></i></a>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
    </script>
@endsection
