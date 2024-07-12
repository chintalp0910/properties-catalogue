@extends('Front.layouts.app')

@section('content')
    <!-- News Banner -->
    <section class="news-banner deep-blue pt-5">
        <div class="container-fluid">
            <div class="news-banner-wrap">
                <div class="inner d-flex flex-wrap align-items-center">
                    <div class="left col-sm-5 ">
                        <div class="image">
                            <img src="{{ asset('news_image/' . $latest->image) }}">
                        </div>
                    </div>
                    <div class="right col-sm-7 white">
                        <div class="right-inner">
                            <h2>{{ $latest->title }}</h2>
                            <p>{{ strip_tags($latest->short_content) }}</p>
                            <div class="date">{{ date('M d, Y', strtotime($latest->date)) }}</div>
                            <div class="button-1">
                                <a href="{{ route('news.view', $latest->seourl) }}">READ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- All News Post -->
    <section class="recent-news recent-news-new recent-news-new-all">
        <div class="container">
            <div class="main-title text-center">
                <h2>All News</h2>
            </div>
            <div class="recent-news-wrap d-flex flex-wrap">
                @foreach ($news_list as $news)
                    <div class="recent-news-inner">
                        <a href="{{ route('news.view', $news->seourl) }}" class="recent-inner">
                            <div class="inner background"
                                style="background-image: url({{ asset('news_image/' . $news->image) }});">
                            </div>
                            <div class="content text-center">
                                <div class="inner-content">
                                    <h4>{{ $news->title }}</h4>
                                    <div class="date">{{ date('M d, Y', strtotime($news->date)) }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- <div class="recent-news-inner">
                    <a href="#" class="recent-inner">
                        <div class="inner background"
                            style="background-image: url({{ asset('assets/front/images/news_A.png') }});">
                        </div>
                        <div class="content text-center">
                            <div class="inner-content">
                                <h4>Paramount Realty acquires a five property portfolio</h4>
                                <div class="date">May 22, 2022</div>
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>
            {{ $news_list->links('pagination::bootstrap-4') }}

        </div>
    </section>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.') }}js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
@endpush
