@extends('layouts.public')

@section('head')
    <style>
        ul {
            list-style: disc;
            margin: 0;
            padding: 0;
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
            <img src="{{ Storage::disk('public')->url($standard->image) }}" alt="" class="img-full-width mb-4"
                style="height: calc(100vh - 25rem); object-fit: cover" />
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="benefits box-shadow-large offset-top-171">
                            <h3 class="benefits__title text-green" style="text-align: left">
                                {{ $standard->title }}
                            </h3>
                            <div class="row">
                                <div class="col">
                                    {!! $standard->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- detail training : end -->

        <!-- metodologi : star -->
        <section class="section-wrap pb-72 pb-lg-40 relative" id="metodologi">
            <img src="{{ asset('ssi-fe/src/img/unsplash/unsplash-3.jpg') }}" alt="" class=""
                style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: cover;opacity: 0.1;" />
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="title-row">
                            <h2 class="section-title text-center" style="color: white">
                                Metodologi
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row text-center pt-4">
                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/gap-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">Gap Analysis</h5>
                            <p>(Tinjauan Status Perencanaan)</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/education-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">Pelatihan<br />Awareness</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/computer-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">Sistem Desain dan<br />Pengembangan</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/education-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">Implementasi<br />Sistem</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/profiles-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">Pelatihan Internal<br />Audit</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/education-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">
                                Internal Audit &amp;<br />Manajemen Review
                            </h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/audit-icon.svg') }}" alt="" class="icon" />
                            <h5 class="mt-2">Persiapan<br />Audit Sertifikasi</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 mb-3">
                        <div class="wrapper">
                            <img src="{{ asset('ssi-fe/src/icons/certificate-icon.svg') }}" alt=""
                                class="icon" />
                            <h5 class="mt-2">Pendampingan<br />Audit Sertifikasi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- metodologi : end -->

        <!-- services : star -->
        <section class="section-wrap pb-72 pb-lg-40" id="services-trainings">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="title-row">
                            <h2 class="section-title text-center text-green">
                                Our Services
                            </h2>
                        </div>
                    </div>
                </div>
                <section class="splide" aria-label="Splide Basic HTML Example" id="services-training">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($services as $service)
                                <li class="splide__slide">
                                    <div class="align-items-start d-flex flex-column w-100">
                                        <a href="{{ route('services.show', $service->id) }}" class="w-100">
                                            <img src="{{ Storage::disk('public')->url($service->thumbnail) }}"
                                                alt="" style="width: 100%; height: 300px; object-fit: cover" />
                                        </a>
                                        <a href="{{ route('services.show', $service->id) }}"
                                            class="lead pt-2 text-green w-100"
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
        <!-- services : end -->

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
