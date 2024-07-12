@extends('Front.layouts.app')

@section('content')
    <!-- Blog header content -->
    <section class="deep-blue white">
        <div class="blog-header-content">
            @if (!empty($news->image) && File::exists(public_path('news_image/' . $news->image . '')))
                <div class="blog-featured "
                    style="background: url({{ asset('news_image/' . $news->image . '') }}) no-repeat top/cover; padding-top: 213px;padding-bottom: 213px;object-fit: cover;">
                    <div class="blog-header-content-wrap">
                        @if (!empty($news->date))
                            <span>{{ date_format($news->date, 'F d, Y') }}</span>
                        @endif
                        <h2>{{ $news->title }}</h2>
                        <p>{{ $news->short_content }}</p>
                    </div>
                </div>
            @else
                <div class="blog-featured "
                    style="background: #020e19; padding-top: 213px;padding-bottom: 213px;object-fit: cover;">
                    <div class="blog-header-content-wrap">
                        @if (!empty($news->date))
                            <span>{{ date_format($news->date, 'F d, Y') }}</span>
                        @endif
                        <h2>{{ $news->title }}</h2>
                        <p>{{ $news->short_content }}</p>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- Blog content -->
    <section class="blog-content deep-blue white">
        <div class="container">
            {{-- <div class="admin-details content-width">
                <div class="d-flex flex-wrap admin-inner">
                     @if (!empty($news->author->name))
                        <div class="left">
                            @if (!empty($news->author->image_relative_url) && File::exists(public_path('uploads/authors/' . $news->author->image_relative_url . '')))
                                <img src="{{ asset('uploads/authors/' . $news->author->image_relative_url) }}">
                            @endif

                            <div class="name">
                                <strong>{{ $news->author->name }}</strong>
                                @if (!empty($news->date))
                                    <p>{{ date('M d, Y', strtotime($news->date)) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="right">
                            <ul>
                                <li><a href="#"> <i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"> <i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    @endif 
                </div>
            </div> --}}
            <div class="content-title-wrap content-width ">
                {!! nl2br($news->content) ?? '' !!}
            </div>

            <!-- <div class="author-content-wrap content-width">
                <div class="author-image">
                    <img src="{{ asset('news_image/' . $news->image . '') }}">
                </div>
                <div class="author-content">
                    <div class="author-content-inner">
                        <p><span>Mika Matikainen</span> is a Design Founder & Advisor, Berlin School of Creative Leadership
                            Executive MBA participant, Zippie advisor, Wolt co-founder, and Nordic Rose stakeholder. </p>
                    </div>
                </div>
            </div> -->
            @php
                $setting = Config::get('settings');
            @endphp

            <div class="share-icon admin-details content-width">
                <ul>
                    @if (array_key_exists('facebook_link', $setting) && !empty($setting['facebook_link']))
                        <li><a href="{{ $setting['facebook_link'] }}"> <i class="fab fa-facebook"></i>Share on Facebook</a>
                        </li>
                    @endif
                    @if (array_key_exists('twitter_link', $setting) && !empty($setting['twitter_link']))
                        <li><a href="{{ $setting['twitter_link'] }}"> <i class="fab fa-twitter"></i>Share on Twitter</a>
                        </li>
                    @endif
                </ul>
            </div>
            @if (!empty($news->tag))
                @php
                    $tags = explode(',', $news->tag);
                @endphp
                <div class="tags content-width">
                    Tags:
                    <ul>
                        @foreach ($tags as $tag)
                            <li><a href="javascript:void(0)">{{ $tag }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- @if (!empty($news->author->name) && !empty($news->author->image_relative_url))
                <div class="admin-details content-width admin-description">
                    <div class="d-flex flex-wrap admin-inner">
                        <div class="left">
                            @if (!empty($news->author->image_relative_url) && File::exists(public_path('uploads/authors/' . $news->author->image_relative_url . '')))
                                <img src="{{ asset('uploads/authors/' . $news->author->image_relative_url) }}">
                            @endif
                            <div class="name">
                                <strong>{{ $news->author->name ?? '' }}</strong>
                                {{ $news->author->short_description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
        </div>
    </section>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.') }}js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
@endpush
