@extends('Front.layouts.app')

@section('content')
    <!-- Filter -->
    <section
        class="properties-banner position-relative overflow-hidden deep-blue properties-new-search properties-shopping-center">
        <div class="container">
            <div class="only-title text-center white">
                <h2>Properties - Shopping Center</h2>
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
                        <li class="active"><a href="{{ route('shoppingCenter') }}"><i class="fas fa-th-large"></i> GRID
                                VIEW</a></li>
                        <li class="map-view"><a href="{{ route('properties.mapview') }}">MAP VIEW</a></li>
                        {{-- <li class="split-view"><a href="{{ route('properties.mapview') }}">SPLIT VIEW</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>

  
    <!-- our-properties -->
    <section class="our-properties deep-blue properties-filter our-properties-new properties-page shopping-center-our-propertie">
        <div class="container">
            <div class="our-properties-section d-flex flex-wrap ">
                @foreach ($properties as $propery)
                    <div class="our-properties-wrap col-lg-4 col-sm-6">
                        <a href="{{ route('shoppingCenter.view', $propery->slug) }}">
                            <div class="properties-inner position-relative background"
                                style="background-image: url({{ !empty($propery->image_relative_url) && File::exists(public_path('property_image/' . $propery->image_relative_url . '')) ? asset('property_image/' . $propery->image_relative_url . '') : asset('assets/front/images/propery_image.png') }})">
                                <div class="content">
                                    <div class="left-content">
                                        <h3>{{ $propery->name }}</h3>
                                        {{-- <span style="width: 100%;">{{ $propery->address ?? '' }}</span>
                                        @if (!empty($propery->gla))
                                            <span>GLA: {{ $propery->gla }}</span>
                                        @endif --}}
                                        @php
                                            $add = '';                                            
                                            !empty($propery->city) ? $add .= $propery->city :'';
                                            !empty($propery->short_state_name) ? $add .= ', '.$propery->short_state_name :'';
                                            !empty($propery->gla) ? $add .= ', GLA - '.number_format($propery->gla) :'';
                                        @endphp
                                        <span>{{$add}}</span>
                                        {{-- @if (!empty($propery->city) || !empty($propery->state) || !empty($propery->gla))
                                            <span>
                                                @if (!empty($propery->city))
                                                    {{ $propery->city }}
                                                @endif
                                                @if (!empty($propery->state))
                                                    {{ ', ' . $propery->state }}
                                                @endif
                                                @if (!empty($propery->gla))
                                                    {{ ", GLA – " . number_format($propery->gla) }}
                                                @endif
                                            </span>
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
                {{ $properties->links('pagination::bootstrap-4') }}
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

            $.ajax({
                type: "GET",
                url: "{{ route('shoppingCenter') }}",
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
