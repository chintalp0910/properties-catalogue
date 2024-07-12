<?php /** @var \App\ModelsExtended\Property $property */ ?>
<?php /** @var \Illuminate\Support\Collection | \App\ModelsExtended\HomepageSlider[]  $homepageSliderCollections */ ?>
<?php /** @var \Illuminate\Support\Collection $homeSlider */ ?>
<?php /** @var \Illuminate\Support\Collection $carouselSlider */ ?>
@extends('Front.layouts.app')

@section('content')
    <!-- Hero banner -->
    @php
        $title = '';
    @endphp
    <section class="properties-hero-banner home-new-banner-slider">
        <div class="properties-banner-slider ">
            @foreach ($homepageSliderCollections as $item)
                @if ($item->key == 'hero_slider')
                    @php
                        $title = $item->title;
                    @endphp

                    @if ($homeSlider->count())
                    @foreach ($homeSlider as $picture)
                        <div class="properties-img">
                            <div class="images">
                                <img src="{{ asset('uploads/homepage/' . $picture->image . '') }}">
                            </div>
                        </div>
                    @endforeach
                    @endif
                @endif
            @endforeach
            {{-- <div class="properties-img">
                    <div class="images">
                        <img src="{{ asset('assets/front/images/banner-bg-2.png') }}">
                    </div>
                </div>
                <div class="properties-img">
                    <div class="images">
                        <img src="{{ asset('assets/front/images/banner-bg-3.png') }}">
                    </div>
                </div>
                <div class="properties-img">
                    <div class="images">
                        <img src="{{ asset('assets/front/images/banner-bg-4.png') }}">
                    </div>
                </div>
                <div class="properties-img">
                    <div class="images">
                        <img src="{{ asset('assets/front/images/banner-bg-5.png') }}">
                    </div>
                </div> --}}
        </div>
        <div class="herobanner overflow-hidden home-hero-banner">
            <div class="container">
                <div class="banner-section white">
                    <h1 class="pb-3">
                        <div class="text-holder"></div>
                    </h1>
                </div>
                <div class="banner-search search-form-new pt-5">
                    <form action="{{ route('properties.search') }}">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search Property Name, City, State, or Zip" name="search"
                               id="homeSearch" data-url="{{ route('home.propertySearch') }}">
                        <div class="search-property" id="homeSearchResult"></div>
                        <button type="submit">View</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <span id="slider_title" data-title="{{ $title }}"></span>

    <!-- Partnerships -->
    <section class="partnerships-section deep-blue overflow-hidden Partnerships-new">
        @foreach ($homepageSliderCollections as  $item)
            @if ($item->key == 'carousel_slider')
                <div class="partnerships-title white">
                    <p>{!! nl2br($item->title) !!}</p>
                </div>
                <div class="partnerships-slider owl-carousel">
                    @if ($carouselSlider->count())
                    @foreach ($carouselSlider as $picture)
                        <div class="partnerships-img">
                            <div class="images">
                                <img src="{{ asset('uploads/homepage/' . $picture->image . '') }}">
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            @endif
        @endforeach


        <!-- /*  Mobile  partnerships*/ -->
        <div class="mobile-partnerships-slider">
            <div class="mobile-partnerships-new">
                <div class="partnerships-slider-for-1 slider-for" data-slick='{"autoplay": true, "autoplaySpeed": 5000}'>
                    @foreach ($carouselSlider as $picture)
                        <div class="partnerships-img">
                            <div class="images">
                                <img src="{{ asset('uploads/homepage/' . $picture->image . '') }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="partnerships-slider-nav-1 slider-nav">
                    @foreach ($carouselSlider as $picture)
                        <div class="partnerships-img">
                            <div class="images">
                                <img src="{{ asset('uploads/homepage/' . $picture->image . '') }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    <!-- Counter -->
    @php
        $setting = Config::get('settings');
    @endphp
    <section class="counter-section counter-section-main-new deep-blue">
        <div class="container">
            <div class="counter-wrap counter-wrap-new d-flex flex-wrap">
                <div class="counter-inner">
                    <div class="inner">
                        <div class="count">
                            <div class="count-num"
                                 data-count="{{ array_key_exists('sf', $setting) ? $setting['sf'] : '0' }}">0
                            </div>
                            <span>MILLION</span>
                        </div>
                        <div class="content">
                            <h4>SF</h4>
                        </div>
                    </div>
                </div>
                <div class="counter-inner">
                    <div class="inner">
                        <div class="count">
                            <div class="count-num"
                                 data-count="{{ array_key_exists('properties', $setting) ? $setting['properties'] : '0' }}">
                                0
                            </div>
                        </div>
                        <div class="content">
                            <h4>Properties</h4>
                        </div>
                    </div>
                </div>
                <div class="counter-inner">
                    <div class="inner">
                        <div class="count">
                            <div class="count-num"
                                 data-count="{{ array_key_exists('project_in_development', $setting) ? $setting['project_in_development'] : '0' }}">
                                0
                            </div>
                        </div>
                        <div class="content">
                            <h4>Projects in Development</h4>
                        </div>
                    </div>
                </div>
                <div class="counter-inner">
                    <div class="inner">
                        <div class="count">
                            <div class="count-num"
                                 data-count="{{ array_key_exists('states', $setting) ? $setting['states'] : '0' }}">0
                            </div>
                        </div>
                        <div class="content">
                            <h4>States</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($properties->count())
        <!-- Our Properties -->
        <section class="our-properties deep-blue our-properties-new ">
            <div class="container">
                <div class="main-title text-center white">
                    <h2>Featured Properties</h2>
                </div>
                <div class="our-properties-section d-flex flex-wrap ">
                    @foreach ($properties as $property)
                        <div class="our-properties-wrap col-sm-4">
                            <a href="{{ route('properties.view', $property->slug) }}">
                                <div class="properties-inner position-relative background"
                                     style="background-image: url({{ $property->getFullUrlOrDefaultUrl() }});">
                                    <div class="content">
                                        <div class="left-content">
                                            <h3>{{ $property->name }}</h3>
                                            <span style="width: 100%">
                                                @php
                                                $add = '';
                                                !empty($property->city) ? ($add .= $property->city) : '';
                                                !empty($property->short_state_name) ? ($add .= !empty($property->city)?', ' . $property->short_state_name:"") : '';
                                                @endphp
                                                {{ $add }}
                                            </span>
                                            @if (!empty($property->gla))
                                                <span>GLA – {{ number_format($property->gla) }}</span>
                                            @endif
                                        </div>
                                        <div class="button-1">
                                            VIEW
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="view-all-property">
                        <a href="{{ route('properties') }}">All Properties</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (!empty($news_list))
        <!-- Recent News -->
        <section class="recent-news recent-news-new">
            <div class="container">
                <div class="main-title text-center">
                    <h2>Recent News</h2>
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
            </div>
        </section>
    @endif
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
@endpush
