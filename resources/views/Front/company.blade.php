@extends('Front.layouts.app')

@section('content')
    {{-- <section class="about-us-banner">
        <div class="about-us-banner-wrap d-flex flex-wrap">
            <div class="images">
                <img src="{{ asset('assets/front/images/Rich-Ozimek-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Jason-Fox-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Melissa-Thrasher-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Lee-Zekaria-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Alice-Ritter-BW.png') }}">
            </div>
            <div class="images ">
                <img src="{{ asset('assets/front/images/Arlene-Gray-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Julie-Ramsey-2.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Daniel-Ivler-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Martin-Safchik-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Casey-Cahill--BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Lisa-Vassallo-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Veronica-Floyd-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Taylor-Bushey-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Ken-Erxleben-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Timothy-Tracy-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Morris-D-Levy-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Catherene-Cardinale-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Karen-Hartsock-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Brian-Finley-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Beth-Fitch-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Kristie-Sindorf-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/David-M.-Levy-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Theresa-Burkholder-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Brian-Persinger-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Charles-Saka-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Bill-Lynch-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Andrea-Stelts-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Kristi-Pennington-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Marc-Impagliazzo-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Rob-D-Auria-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Donnalee-Sorenson-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Theresa-Sharo-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Joseph-Mizrahi-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Kate-Vicente-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Karen-Gard-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Maurice-Zekaria-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Melanie-Rettig-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Elliot-Alboucai-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Linda-McCandless-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Brigite-Luque-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Eric-Kelly-BW.png') }}">
            </div>
            <div class="images hover_color">
                <img src="{{ asset('assets/front/images/Jeanne-Torla-BW.png') }}">
            </div>
            <div class="images">
                <img src="{{ asset('assets/front/images/Josh-Shelton-BW.png') }}">
            </div>
            <div class="images hover_color_light">
                <img src="{{ asset('assets/front/images/Pat-Conte-BW.png') }}">
            </div>
        </div>
    </section> --}}

    @if (count($avatars) > 0)
        <section>
            <div class="about-us-banner-wrap d-flex flex-wrap">
                @foreach ($avatars as $picture)
                    @if (File::exists(public_path('assets/front/images/' . $picture->image_name . '')))
                        <div class="images" style="background-color: {{ $picture->image_color ?? '' }}">
                            <img src="{{ asset('assets/front/images/' . $picture->image_name . '') }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif


    <!-- Who we are section -->
    <section class="deep-blue about-us-new-conetnt company-section">
        <div class="about-us-content white">
            <div class="container">
                {{-- <h1>To us - integrity, innovation, and service are paramount.</h1> --}}
                <div class="company-section-inner d-flex flex-wrap">
                    <div class="company-right-img col-sm-5">
                        <div class="image">
                            {{-- <img src="{{ asset('assets/front/images/p-big-1-1.png') }}"> --}}
                            <img
                                src="{{ !empty($companySetting->p_image) ? asset('uploads/setting/company/' . $companySetting->p_image . '') : asset('assets/front/images/p-big-1-1.png') }}">
                        </div>
                    </div>
                    <div class="company-left-content col-sm-7">
                        <div class="content">
                            <h2 class="white">
                                {{ $companySetting->title ?? '' }}
                            </h2>
                            {!! $companySetting->description  !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="company_map_image">
                <img src="{{ !empty($companySetting->map_image) ? asset('uploads/setting/company/' . $companySetting->map_image . '') : asset('assets/front/images/company_map_image_new.png') }}"
                    alt="Map Image" class="company_map_image">
            </div>
            {{--            <div class="content container "> --}}
            {{--                <p>Paramount continues to adapt to a radically shifting commercial real estate landscape. Building our portfolio has always required a balance of patience and conservatism. Our team negotiates fairly, accurately, flexibly, and quickly, with an eye on long-term stability and success. Along the way we have forged long lasting partnerships which has proven to be a successful formula for over 30 years.</p> --}}
            {{--                <p>To us - integrity, vision, and & relationships are paramount. --}}
            {{--                </p> --}}
            {{--                    --}}{{-- <p>Through our strategic approach to leasing, we are partners in our retailers� success, helping many --}}
            {{--                        grow from mom-and-pops to local and regional chains. By becoming active members of the communities --}}
            {{--                        that are home to our centers, we build personal relationships with our consumers.</p> --}}
            {{--            </div> --}}
        </div>
    </section>
@endsection
@push('js')
    <!-- <script>
        var addressPoints = '<?php echo json_encode($properties); ?>';
        var map, markers;
    </script> -->
    <!-- <script type="text/javascript" src="{{ asset('assets/front/js/leaflet-src.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/front/js/leaflet.markercluster-src.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>

    <!-- <script>
        $(document).ready(function($) {
            var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    zoom: 2,
                    minZoom: 2,
                    attribution: 'Free source used',
                }),
                latlng = L.latLng(40.047929, -76.36233900000002);

            map = L.map('map', {
                center: latlng,
                zoom: 13,
                layers: [tiles]
            });
            map.scrollWheelZoom.enable();
            mapinit(1);
        });
    </script> -->
@endpush
