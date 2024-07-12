@extends('Front.layouts.app')

@section('content')
    <section
        class="properties-banner position-relative overflow-hidden deep-blue properties-new-search properties-shopping-center">
        <div class="container">
            <div class="only-title text-center white">
                @if (request()->segment(count(request()->segments())) == 'single-tenant')
                    <h2>Properties - Single Tenant</h2>
                @elseif (request()->segment(count(request()->segments())) == 'medical-office')
                    <h2>Properties - Medical Office</h2>
                @elseif (request()->segment(count(request()->segments())) == 'mixed-use')
                    <h2>Properties - Mixed Use</h2>
                @elseif (request()->segment(count(request()->segments())) == 'warehouse')
                    <h2>Properties - Self Storage</h2>
                @elseif (request()->segment(count(request()->segments())) == 'shopping-center')
                    <h2>Properties - Shopping Center</h2>
                @elseif (request()->segment(count(request()->segments())) == 'under-development')
                    <h2>Properties - Under Development</h2>
                @elseif (request()->segment(count(request()->segments())) == 'pad-sites')
                    <h2>Properties - Pad Sites Available</h2>
                @else
                    <h2>Properties</h2>
                @endif
            </div>
            <div class="filter-section d-flex align-items-center">
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="search" name="property_name" id="property_name" placeholder="Property Name"
                        @isset($propertyName) value="{{ $propertyName }}" @endisset onkeyup="fliters()"
                        onsearch="OnSearch (this)">
                </div>
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="search" name="state" id="state" placeholder="STATE"
                        @isset($state) value="{{ $state }}" @endisset onkeyup="fliters()"
                        onsearch="OnSearch (this)">
                </div>
                <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="search" name="city" id="city" placeholder="CITY"
                        @isset($city) value="{{ $city }}" @endisset onkeyup="fliters()"
                        onsearch="OnSearch (this)">
                </div>
                {{-- <div class="filter-search
                        select-drop-down">
                    <select class="form-select form-select-lg mb-3 js-states form-control"
                        aria-label="form-select-lg example">
                        <option selected>FILTER BY SF</option>
                        @for ($i = 500; $i <= 10000; $i += 500)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div> --}}
                <div class="filter-search select-drop-down property-type-filter">
                    <select class="form-select form-select-lg mb-3 js-states form-control"
                        aria-label="form-select-lg example" name="property_types" id="property_types" onchange="fliters()">
                        <option value="ALL">PROPERTY TYPE</option>
                        @foreach ($propertyTypes as $type)
                            <option value="{{ $type->id }}"
                                @isset($property_types) @selected($property_types == $type->id) @endisset>
                                {{ $type->description }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="icon">
                    <ul>
                        <li class="active"><a href="{{ route('properties') }}"><i class="fas fa-th-large"></i> GRID
                                VIEW</a></li>
                        <li class="map-view"><a href="{{ route('properties.mapview') }}">MAP VIEW</a></li>
                        {{-- <li class="split-view"><a href="{{ route('properties.splitView') }}">SPLIT VIEW</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- our-properties -->
    <section class="our-properties deep-blue properties-filter our-properties-new properties-page">
        <div class="container">
            <div class="our-properties-section d-flex flex-wrap ">
                @foreach ($properties as $property)
                    <div class="our-properties-wrap col-lg-4 col-sm-6">
                        <a href="{{ route('properties.view', $property->slug) }}">
                            <div class="properties-inner position-relative background"
                                style="background-image: url({{ !empty($property->image_relative_url) && File::exists(public_path('property_image/' . $property->image_relative_url . '')) ? asset('property_image/' . $property->image_relative_url . '') : asset('assets/front/images/propery_image.png') }})">
                                <div class="content">
                                    <div class="left-content">
                                        <h3>{{ $property->name }}</h3>
                                        {{-- <span style="width: 100%;">{{ $property->address ?? '' }}</span> --}}
                                        @php
                                            $add = '';
                                            !empty($property->city) ? ($add .= $property->city) : '';
                                            !empty($property->short_state_name) ? ($add .= ', ' . $property->short_state_name) : '';
                                            !empty($property->gla) ? ($add .= ', GLA - ' . number_format($property->gla)) : '';
                                        @endphp
                                        <span>{{ $add }}</span>

                                        {{-- @if (!empty($property->city) || !empty($property->state) || !empty($property->gla))
                                            <span>
                                                @if (!empty($property->city))
                                                    {{ $property->city }}
                                                @endif
                                                @if (!empty($property->state))
                                                    {{ ', ' . $property->state }}
                                                @endif
                                                @if (!empty($property->gla))
                                                    {{ ", GLA – " . number_format($property->gla) }}
                                                @endif
                                            </span>
                                        @endif --}}
                                        {{-- @if (!empty($property->gla))
                                            <span style="padding: 0">GLA – {{ number_format($property->gla) }}</span>
                                        @endif --}}
                                    </div>
                                    <div class="button-1">
                                        VIEW
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>

    <script type="text/javascript">
        function fliters() {
            var property_name = $('#property_name').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var property_types = $('#property_types').val();
            var type = window.location.pathname.split("/").pop();
            var type = decodeURI(type);

            var url = '';
            if ('{{ Route::currentRouteName() }}' == 'properties' || type == 'properties-search') {
                url = "{{ route('properties') }}";
            }
            // else {
            //     url = "{{ route('properties.underDevelopment') }}";
            // }
                
            if (type == 'mixed-use' || type == 'warehouse' || type == 'single-tenant' || type == 'medical-office' || type ==
                'shopping-center' || type == 'under-development' || type == 'pad-sites') {
                var typeURL = '{{ route('properties.getProperties') }}'
                url = typeURL + '/' + type;
            }

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    property_name: property_name,
                    state: state,
                    city: city,
                    property_types: property_types,
                },
                cache: false,
                success: function(response) {
                    if (response.status == 'SUCCESS') {
                        $('.our-properties-section').html(response.data);
                    }
                }
            });
        }

        function OnSearch(input) {
            var property_name = $('#property_name').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var property_types = $('#property_types').val();

            if (property_name == '' || state == '' || city == '' || property_types == 'ALL') {
                fliters();
            }
        }
    </script>
@endpush
