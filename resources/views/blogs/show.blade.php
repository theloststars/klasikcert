@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div class="content-wrapper oh">
        
        <section class="py-lg-5" id="detail-training">
        <div class="blog-single-post-listing details mb--0">
                        <div class="thumbnail">
                            <img style="height: calc(100vh - 25rem); object-fit: cover;width:100%;" src="{{ Storage::disk('public')->url($blog->thumbnail) }}" alt="Business-Blog">
                        </div>
                        
                    </div>
                    <div class="container">
                <div class="page-title__holder">
                    <h1 class="page-title__title text-center">
                        {{ $blog->title }}
                    </h1>
                    <ul class="entry__meta">
                        {{-- <li class="entry__meta-author">
                            <a href="#" class="entry__meta-author-url">
                                <span>by DeoThemes</span>
                            </a>
                        </li> --}}
                        <li class="entry__meta-date text-center"><h5>
                        {{ $blog->created_at->format('d F Y') }}
                        </h5></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-wrap pt-40 pb-48">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="blog__content">
                            <article class="entry mb-0">
                                <div class="entry__article-wrap">
                                    <!-- Share -->
                                    {{-- <div class="entry__share" style="position: relative">
                                        <div class="sticky-col" style="">
                                            <div class="socials socials--rounded socials--large">
                                                <a class="social social-facebook" href="#" title="facebook"
                                                    target="_blank" aria-label="facebook">
                                                    <i class="ui-facebook"></i>
                                                </a>
                                                <a class="social social-twitter" href="#" title="twitter"
                                                    target="_blank" aria-label="twitter">
                                                    <i class="ui-twitter"></i>
                                                </a>
                                                <a class="social social-google-plus" href="#" title="google"
                                                    target="_blank" aria-label="google">
                                                    <i class="ui-google"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- share -->

                                    <div class="entry__article pb-5 mb-5">
                                        {!! $blog->body !!}
                                    </div>
                                    <!-- end entry article -->
                                </div>
                                <!-- end entry article wrap -->
                            </article>

                            {{-- <!-- Prev / Next Post --> --}}
                            {{-- <nav class="entry-navigation">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="single-post.html" class="entry-navigation__url entry-navigation--left">
                                            <img src="img/blog/prev_post.jpg" alt=""
                                                class="entry-navigation__img" />
                                            <div class="entry-navigation__body">
                                                <i class="ui-arrow-left"></i>
                                                <span class="entry-navigation__label">Previous Post</span>
                                                <h6 class="entry-navigation__title">
                                                    How to design your first mobile app
                                                </h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="single-post.html" class="entry-navigation__url entry-navigation--right">
                                            <div class="entry-navigation__body">
                                                <span class="entry-navigation__label">Next Post</span>
                                                <i class="ui-arrow-right"></i>
                                                <h6 class="entry-navigation__title">
                                                    How to design your first mobile app
                                                </h6>
                                            </div>
                                            <img src="img/blog/next_post.jpg" alt=""
                                                class="entry-navigation__img" />
                                        </a>
                                    </div>
                                </div>
                            </nav> --}}
                        </div>
                    </div>
                </div>
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
@endsection

@section('script')
@endsection
