@extends('Front.layouts.app')

@section('content')
    <!-- Properties Banner  -->
    @if (count($property->property_pictures) > 0)
        <section class="properties-hero-banner properDetailPage">
            <div class="container-fluid">
                <div class="properties-banner-slider">
                    @foreach ($property->property_pictures as $picture)
                        <div class="properties-img">
                            <div class="images">
                                <img src="{{ asset('gallery/' . $picture->image_relative_url . '') }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--  -->
    <section class="properties-address deep-blue">
        <div class="container-fluid">
            <div class="properties-address-inner d-flex flex-wrap">
                <div class="properties-left col-md-6 col-sm-auto properties-title-border deep-blue-color">
                    <h2>{{ $property->name }}</h2>
                    <ul>
                        @if (!empty($property->address)|| !empty($property->city) || !empty($property->short_state_name))
                            <li><i class="fas fa-map-marker-alt"></i>                                
                                @php
                                    $add = '';
                                    !empty($property->address) ? $add .= $property->address :'';
                                    !empty($property->city) ? $add .= ', '.$property->city :'';
                                    !empty($property->short_state_name) ? $add .= ', '.$property->short_state_name :'';
                                @endphp
                                {{$add}}
                            </li>
                        @endif
                        @if (!empty($property->square_foot) && $property->square_foot !== "0" )
                            <li><img src="{{ asset('assets/front/images/expand-arrow.svg') }}">{{ $property->square_foot }}
                            </li>
                            @else
                                <li><img src="{{ asset('assets/front/images/expand-arrow.svg') }}">Not Available
                                </li>
                        @endif

                        @if (!empty($property->gla))
                            <li><img src="{{ asset('assets/front/images/gla.png') }}">{{ number_format($property->gla) }}</li>
                        @endif
                    </ul>
                </div>
                <div class="properties-right col-md-6 col-sm-auto ">
                    <div class="inner">
                        @if (!empty($property->brochure_relative_url) &&
                            File::exists(public_path('brochure_relative/' . $property->brochure_relative_url . '')))
                            <div class="download-text d-flex flex-wrap  align-items-center justify-content-between ">
                                <div class="content d-flex flex-wrap  align-items-center ">
                                    <img src="{{ asset('assets/front/images/Brochure.png') }}">
                                    <span>Brochure</span>
                                </div>

                                <div class="download-btn button-1">
                                    <a href="{{ asset('brochure_relative/' . $property->brochure_relative_url . '') }}"
                                        download="">DOWNLOAD
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if (!empty($property->site_plan_relative_url) &&
                            File::exists(public_path('site_plan/' . $property->site_plan_relative_url . '')))
                            <div class="download-text d-flex flex-wrap align-items-center justify-content-between">
                                <div class="content d-flex flex-wrap  align-items-center">
                                    <img src="{{ asset('assets/front/images/Site-Plan.png') }}">
                                    <span>Site Plan</span>
                                </div>
                                <div class="download-btn button-1">
                                    <a href="{{ asset('site_plan/' . $property->site_plan_relative_url . '') }}"
                                        download="">DOWNLOAD
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <div
                    class="properties-left col-md-12 col-sm-auto properties-content-wrap properties-title-border deep-blue-color">
                    {!! $property->description ?? '' !!}
                </div> --}}
            </div>
        </div>
    </section>

    <!-- propertie-view list -->
    <section class="propertie-view-section deep-blue">
        <div class="container-fluid">
            <div class="propertie-view-list ">
                <ul>
                    @if (!empty($property->site_plan_relative_url) &&
                        File::exists(public_path('site_plan/' . $property->site_plan_relative_url . '')))
                        <li><a href="#site-plan" class="text-uppercase">SITE PLAN</a></li>
                    @endif
                    @if (!empty($property->anchor_tenant))
                        <li><a href="#anchor-tenants" class="text-uppercase">ANCHOR TENANTS</a></li>
                    @endif
                    @if (count($property->property_demographics) > 0)
                        <li><a href="#demographics" class="text-uppercase">DEMOGRAPHICS</a></li>
                    @endif
                    @if (!empty($property->latitude) && !empty($property->longitude))
                        <li><a href="#property-map" class="text-uppercase">PROPERTY MAP</a></li>
                    @endif
                </ul>
            </div>
            @if (count($property->agents) > 0)
                <!-- Leasing Contact -->
                <div class="leasing-contact" id="leasing-contact">
                    <div class="inner d-flex flex-wrap align-items-center row">
                        <div class="properties-title-border col-md-4 col-sm-auto deep-blue-color">
                            <h2>Leasing Contact</h2>
                        </div>
                        <div class="contact-box-wrap col-md-8 col-sm-auto">
                            <div class="contact-box-inner d-flex flex-wrap">
                                @foreach ($property->agents as $agent)
                                    <div class="contact-box minimum-width-378">
                                        <div class="name">
                                            <div class="left">
                                                <h4>{{ $agent->name }}</h4>
                                                <div class="contact-add">
                                                    <ul>
                                                        <li><i class="fas fa-phone-alt"></i><a
                                                                href="tel:{{ $agent->phone }}">{{ $agent->phone }}</a>
                                                        </li>
                                                        <li><i class="fas fa-envelope"></i><a
                                                                href="mailto:{{ $agent->email }}">{{ $agent->email }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="right minimum-height-167" >
                                            @if (!empty($agent->image_relative_url))
                                                <img src="{{ asset('uploads/' . $agent->image_relative_url . '') }}">
                                            @endif
                                        </div>
                                        </div>

                                        
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Site Plan -->
            @if (!empty($property->site_plan_relative_url) &&
                File::exists(public_path('site_plan/' . $property->site_plan_relative_url . '')))
                <div class="site-plan background-white" id="site-plan">
                    <div class="properties-title-border deep-blue-color">
                        <h2>Site Plan</h2>
                    </div>
                    <div class="map">
                        <img src="{{ asset('site_plan/' . $property->site_plan_relative_url . '') }}">
                    </div>
                </div>
            @endIf

            @if (!empty($property->anchor_tenant))
                <!-- Anchor Tenants -->
                <div class="anchor-tenants background-white" id="anchor-tenants">
                    <div class="properties-title-border deep-blue-color">
                        <h2>Anchor Tenants</h2>
                    </div>
                    <ul>
                        @foreach ($property->anchor_tenant as $picture)
                            <div class="anchor-tenant-image mr-1 mb-2 ">
                                <div class='upload__img-box'>
                                    <li>
                                        <img src="{{ asset('uploads/properties/anchor_tenant/' . $picture . '') }}"
                                            width="120px" alt="Anchor Tenant">
                                    </li>
                                </div>
                            </div>
                        @endforeach

                        {{-- <li><img src="{{ asset('assets/front/images/Anchor-Tenants-1.png') }}"></li>
                        <li><img src="{{ asset('assets/front/images/Anchor-Tenants-2.png') }}"></li>
                        <li><img src="{{ asset('assets/front/images/Anchor-Tenants-3.png') }}"></li> --}}
                    </ul>
                </div>
            @endif
            @if (count($property->property_demographics) > 0)
                <!-- Demographics -->
                <div class="demographics background-white demographics-new" id="demographics">
                    <div class="properties-title-border deep-blue-color">
                        <h2>Demographics</h2>
                    </div>
                    <div class="propertie-list_wrap">
                        <div class="propertie-list">
                            <ul class="list-title">
                                <li>CATEGORY</li>
                                <li>1 MILE</li>
                                <li>3 MILE</li>
                                <li>5 MILE</li>
                            </ul>
                            @foreach ($demoCategories as $demoCategory)
                                <ul>
                                    <li>{{ $demoCategory->description }}</li>
                                    @foreach ($property->property_demographics as $demographic)
                                        @if ($demoCategory->id == $demographic->demographic_category_id)
                                            <li>{{ $demographic->value ?? 'N/A' }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($property->latitude) && !empty($property->longitude))
                <!-- Property-Map -->
                <div class="property-map background-white" id="property-map">
                    <div class="properties-title-border deep-blue-color">
                        <h2>Property Map</h2>
                    </div>
                    <div class="map">
                        {{-- <img src="{{ asset('assets/front/images/map-2.png') }}"> --}}
                        <div id="property_map" style="height: 554px"></div>
                        {{-- <iframe id="myIframe"
                            src="https://maps.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}&hl=es;z=14&amp;output=embed"
                            width="100%" height="450" frameborder="0"></iframe> --}}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
@push('js')
    <style>
        @media only screen and (min-width: 500px){
            .minimum-height-167{ min-height: 167px; }
            .minimum-width-378{ min-width: 378px; }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}">
    </script>
    <script type="text/javascript">
        if ('{{ $property->latitude }}' != '' && '{{ $property->longitude }}' != '') {
            google.maps.event.addDomListener(window, 'load', propertyMap);

            function propertyMap() {
                const zoom = 13;
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: zoom,
                    minZoom: zoom - 3,
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng('{{ $property->latitude }}',
                        '{{ $property->longitude }}'), // New York

                    styles: [{
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                "color": "#444444"
                            }]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [{
                                "color": "#f2f2f2"
                            }]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [{
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [{
                                "visibility": "simplified"
                            }]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [{
                                    "color": "#d2d9da"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels",
                            "stylers": [{
                                    "saturation": "-100"
                                },
                                {
                                    "lightness": "-5"
                                },
                                {
                                    "weight": "0.66"
                                },
                                {
                                    "visibility": "off"
                                },
                                {
                                    "color": "#14bfd5"
                                }
                            ]
                        }
                    ]
                };

                var mapElement = document.getElementById('property_map');
                var map = new google.maps.Map(mapElement, mapOptions);

                const icon = {
                    url: "{{ asset('assets/front/css/images/marker-icon-property-transp.png') }}", // url
                    // scaledSize: new google.maps.Size(30, 30), // scaled size
                    // origin: new google.maps.Point(0, 0), // origin
                    // anchor: new google.maps.Point(0, 0) // anchor
                };

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng('{{ $property->latitude }}',
                        '{{ $property->longitude }}'),
                    map: map,
                    title: '{{ $property->name }}',
                    icon: icon,
                });
            }
        }
    </script>
@endpush
