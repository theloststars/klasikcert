@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div class="content-wrapper oh">
        <section class="page-title text-center">
            <div class="container">
                <div class="page-title__holder">
                    <h1 class="page-title__title">News</h1>
                    <p class="page-title__subtitle">
                        Recent news about certification
                    </p>
                </div>
            </div>
        </section>

        <section class="section-wrap bottom-divider">
            <div class="container">
                <div class="row card-row">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4">
                            <article class="entry card box-shadow hover-up" style="height: 100%;margin-bottom: 5px;">
                                <div class="entry__img-holder card__img-holder">
                                    <a href="{{ route('blogs.showPublic', $blog->id) }}">
                                        <img src="{{ Storage::disk('public')->url($blog->thumbnail) }}" class="entry__img"
                                            alt="" style="height: 20rem;object-fit: cover;" />
                                    </a>
                                    <div class="entry__date">
                                        <span class="entry__date-day">{{ $blog->created_at->format('d') }}</span>
                                        <span class="entry__date-month">{{ $blog->created_at->format('M') }}</span>
                                    </div>
                                    <div class="entry__body card__body">
                                        <h4 class="entry__title text-green">
                                            <a href="{{ route('blogs.showPublic', $blog->id) }}">{{ $blog->title }}</a>
                                        </h4>
                                        <div class="entry__excerpt">
                                            <p
                                                style="display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;overflow: hidden;">
                                                {{ $blog->short_description ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                {{ $blogs->onEachSide(2)->links('pagination::default') }}

                <!-- Pagination -->
                {{-- <nav class="pagination">
                    <a href="#" class="pagination__page pagination__icon pagination__page--next"><i
                            class="ui-arrow-left"></i></a>
                    <span class="pagination__page pagination__page--current">1</span>
                    <a href="#" class="pagination__page">2</a>
                    <a href="#" class="pagination__page">3</a>
                    <a href="#" class="pagination__page">4</a>
                    <a href="#" class="pagination__page pagination__icon pagination__page--next"><i
                            class="ui-arrow-right"></i></a>
                </nav> --}}
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
