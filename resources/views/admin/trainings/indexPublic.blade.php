@extends('layouts.public')

@section('head')
    <style>
        ul {
            list-style: disc;
            margin: 0;
            padding: 0;
        }

        #std {
            height: 115px;
        }

        #std div {
            border: solid 3px #01a449;
            border-radius: 5px;
            padding: 1.5rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #std div:hover {
            background: #01a449;
            border: solid 3px #01a449;
            padding: 1.5rem;
            color: white;
        }

        #std div span {
            display: block;
            text-align: center;
            font-size: 18px;
        }

        @media (min-width: 992px) {
            #trainings {
                margin-top: -6rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="triangle-wrap">
        <div class="triange"></div>
    </div>

    <div class="content-wrapper oh">
        <!-- detail training : start -->
        <section class="py-lg-5" id="detail-training">
            <img src="{{ Storage::disk('public')->url(@$training->image) }}" alt="" class="img-full-width mb-4"
                style="height: calc(100vh - 25rem); object-fit: cover" />
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="benefits box-shadow-large offset-top-171">
                            <h3 class="benefits__title text-green" style="text-align: left">
                                {{ @$training->title ?? 'Title' }}
                            </h3>
                            <div class="row">
                                <div class="col">
                                    {!! @$training->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- detail training : end -->


        <section class="section-wrap pb-72 pb-lg-40" id="services-trainings">
            <div class="container pt-5 mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="title-row">
                            <h2 class="section-title text-center text-green">
                                Another Services
                            </h2>
                        </div>
                    </div>
                </div>
                <section class="splide" aria-label="Splide Basic HTML Example" id="services-training">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($services as $service)
                                <li class="splide__slide">
                                    <div class="align-items-start d-flex flex-column w-100 blog-single-post-listing p-4">
                                        <a href="{{ route('services.show', $service->id) }}" class="w-100">
                                            <img src="{{ Storage::disk('public')->url($service->thumbnail) }}"
                                                alt="" style="width: 100%; height: 300px; object-fit: cover" />
                                        </a>
                                        <a href="{{ route('services.show', $service->id) }}"
                                            class="title text-primary text-center w-100"
                                            style="font-weight: bold">{{ $service->title }}</a>
                                        <p class="lead promo-section__text text-left w-100"
                                            style="display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;  overflow: hidden;">
                                            {{ $service->short_description_text }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </section>

        <!-- footer : start -->
        <x-public.contactus />
        <x-public.footer />
        <!-- footer : end -->

        <div id="back-to-top">
            <a href="#top"><i class="ui-arrow-up"></i></a>
        </div>
    </div>
    <!-- end content wrapper -->
@endsection

@section('script')
    <script>
        new Splide("#services-training", {
            pagination: true,
            arrows: false,
            perPage: 3,
            gap: '30px',
            breakpoints: {
                768: {
                    perPage: 2
                },
                425: {
                    perPage: 1
                }
            }
        }).mount();
    </script>
@endsection
