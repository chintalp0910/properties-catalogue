@extends('Front.layouts.app')

@section('content')
    <section
        class="properties-banner position-relative overflow-hidden deep-blue properties-new-search properties-shopping-center">
        <div class="container">
            <div class="only-title text-center white">
                <h2>Properties</h2>
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
                        <li><a href="{{ route('properties') }}"><i class="fas fa-th-large"></i> GRID
                                VIEW</a></li>
                        <li class="map-view active"><a href="{{ route('properties.mapview') }}">MAP VIEW</a></li>
                        {{-- <li class="split-view"><a href="{{ route('properties.splitView') }}">SPLIT VIEW</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div id="map" style="width: 100%; height: 550px;"></div>
@endsection
@push('js')
    <script>
        var addressPoints = '<?php echo json_encode($properties); ?>';
        var map, markers;
    </script>

    <script type="text/javascript" src="{{ asset('assets/front/js/leaflet-src.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/leaflet.markercluster-src.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>

    <script>
        function fliters() {
            var property_name = $('#property_name').val();
            var state = $('#state').val();
            var city = $('#city').val();
            var property_types = $('#property_types').val();

            $.ajax({
                type: "GET",
                url: "{{ route('properties.mapview') }}",
                async: false,
                data: {
                    property_name: property_name,
                    state: state,
                    city: city,
                    property_types: property_types,
                },
                cache: false,
                success: function(response) {
                    if (response.status == 'SUCCESS') {
                        addressPoints = JSON.stringify(response.data);
                        mapinit(0);
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

        $(document).ready(function($) {
            var tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
                maxZoom: 18,
                zoom: 2,
                minZoom: 2,
                attribution: 'Free source used',
            }),
            latlng = L.latLng(40.047929, -76.36233900000002);

            map = L.map('map', {center: latlng, zoom: 13, layers: [tiles]});
            map.scrollWheelZoom.enable();
            mapinit(1);
        });
    </script>
@endpush
