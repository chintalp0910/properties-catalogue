@extends('Admin.Pages.layouts.app')
@push('css')
    <style type="text/css">
        .upload__box {
            padding: 40px;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn p {
            margin-bottom: 0;
            color: #000;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 100%;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;

            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {}

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }
        .image_order .upload__img-wrap>div {
            padding: 0 10px;
        }
        .image_order .upload__img-wrap>div .upload__img-box {
            width: 100%;
            padding: 0;
        }
        .image_order .upload__img-wrap>div {
            padding: 0 10px;
            padding-bottom: 14px;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            <form class="form" method="post" action="{{ route('properties.store') }}" id="propertyForm"
                enctype="multipart/form-data" class="dropzone">
                @csrf
                @method('POST')

                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Add Property</h3>
                        <!--  <a class="btn btn-round btn-info mb-1" href="{{ url('properties_list') }}"> <i class="icon-cog3"> </i> Back </a> -->
                        <div class="row breadcrumbs-top d-inline-block">

                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <a href="{{ route('properties.index') }}" class="btn btn-warning float-right"><i class="ft-x"></i>
                            Cancel</a>
                        <button type="submit" class="btn btn-primary mr-1 float-right">
                            <i class="la la-check-square-o"></i> Save
                        </button>
                    </div>
                </div>
                <div class="content-body">
                    <!-- Basic form layout section start -->
                    <section id="horizontal-form-layouts">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i>Gereral
                                                    Information</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="title">Title</label>
                                                        <input type="text" id="title" class="form-control"
                                                            placeholder="Title" name="name"
                                                            value="{{ old('name') ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="Area">Area</label>
                                                        <input type="text" id="Area" class="form-control"
                                                            placeholder="Area" name="square_foot"
                                                            value="{{ old('square_foot') ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="agent_name">Agent Name</label>
                                                        <select id="agent_name" name="agent_id[]"
                                                            class="form-control select2" multiple>
                                                            @foreach ($agents as $agent)
                                                                <option value="{{ $agent->id }}">{{ $agent->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div id="agenterrorTxt"></div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="state">State</label>
                                                                <input type="text" id="state" class="form-control"
                                                                    placeholder="State" name="state"
                                                                    value="{{ old('state') ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="city">City</label>
                                                                <input type="text" id="city" class="form-control"
                                                                    placeholder="City" name="city"
                                                                    value="{{ old('city') ?? '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="Address">Address</label>
                                                        <input type="text" id="Address" class="form-control"
                                                            placeholder="Address" name="address"
                                                            value="{{ old('address') ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="longitude">Longitude</label>
                                                                <input type="number" id="longitude" class="form-control"
                                                                    placeholder="Longitude" name="longitude"
                                                                    value="{{ old('longitude') ?? '' }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="latitude">Latitude</label>
                                                                <input type="number" id="latitude" class="form-control"
                                                                    placeholder="Latitude" name="latitude"
                                                                    value="{{ old('latitude') ?? '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="property_type">Property Type</label>
                                                        <select id="property_type" name="property_type_id"
                                                            class="form-control select2">
                                                            @foreach ($types as $type)
                                                                <option value="{{ $type->id }}">
                                                                    {{ $type->description }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div id="propertyTypeerrorTxt"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="gla">GLA</label>
                                                        <input type="number" id="gla" class="form-control"
                                                            placeholder="GLA" name="gla"
                                                            value="{{ old('gla') ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-link"></i>Document</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Brochure</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input fileUpload"
                                                                    id="brochure" name="brochure_relative_url">
                                                                <label class="custom-file-label" for="brochure"
                                                                    aria-describedby="brochure">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Site plan</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input fileUpload"
                                                                    id="site_plan" name="site_plan_relative_url">
                                                                <label class="custom-file-label" for="site_plan"
                                                                    aria-describedby="site_plan">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="userinput4">
                                                                Property image</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input fileUpload"
                                                                    id="image" name="image_relative_url"
                                                                    accept="image/*">
                                                                <label class="custom-file-label" for="property_image"
                                                                    aria-describedby="property_image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8"></div>
                                                    <div class="cil-md-4 ml-1 imgPreview">
                                                        <img src="{{ asset('app-assets/images/ico/favicon-icon.png') }}"
                                                            class="mt-1 border" id="imgPreview" height="80px"
                                                            width="80px" alt="image">
                                                        <span onclick="document.getElementById('image').click()">Edit
                                                            Picture</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8"></div>
                                                    <div class="col-md-4 mt-1">
                                                        <p><b>Note: </b>Recommended dimensions 409 X 285</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-tv"></i>Demographics
                                                </h4>
                                                <div class="row">
                                                    <section id="form-repeater">
                                                        <div class="">
                                                            <div class="col-sm-12 ">
                                                                <div class="repeater-default">
                                                                    <div>
                                                                        @foreach ($categories as $key1 => $category)
                                                                            <div data-repeater-item="" class="row">
                                                                                <div
                                                                                    class="form-group  col-sm-12 col-md-4">
                                                                                    @if ($key1 == 0)
                                                                                        <label
                                                                                            for="profession">Category</label>
                                                                                    @endif
                                                                                    <select class="form-control"
                                                                                        id="demographic_category"
                                                                                        name="demographic_category_id[]">
                                                                                        <option
                                                                                            value="{{ $category->id }}">
                                                                                            {{ $category->description }}
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                @foreach ($demographicMiles as $key => $demographicMile)
                                                                                    <div
                                                                                        class="form-group mb-1 col-sm-12 col-md-2">
                                                                                        @if ($key1 == 0)
                                                                                            <label
                                                                                                for="demographic_mile">{{ $key != 2 ? ($key == 0 ? $key + 1 : $key + 2) : $key + 3 }}
                                                                                                MILE</label>
                                                                                        @endif
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            id="demographic_mile_{{ $key + 1 }}"
                                                                                            placeholder="{{ $key != 2 ? ($key == 0 ? $key + 1 : $key + 2) : $key + 3 }} MILE"
                                                                                            name="demographic_mile[{{ $category->id }}][{{ $demographicMile->id }}]"
                                                                                            value="">
                                                                                    </div>
                                                                                @endforeach
                                                                                {{-- <div
                                                                            class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                            <button type="button"
                                                                                class="btn btn-danger"
                                                                                data-repeater-delete="">
                                                                                <i class="ft-x"></i>
                                                                                Delete</button>
                                                                        </div> --}}
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    {{-- <div class="form-group overflow-hidden">
                                                                    <button type="button" data-repeater-create=""
                                                                        class="btn btn-primary">
                                                                        <i class="ft-plus"></i>
                                                                        Add
                                                                    </button>
                                                                </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-clipboard"></i>Details</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group collapse show">
                                                            <label class="col-md-0 label-control"
                                                                for="description">Description </label>
                                                            <div class="col-md-12 mx-auto">
                                                                <textarea class=" form-control tinymce border-primary" name="description" id="description">{{ old('description') ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-12">
                                                    <div class="form-group collapse show">
                                                        <label class="col-md-0 label-control"
                                                            for="userinput8">Property Map :</label>
                                                        <div class="col-md-12 mx-auto">
                                                            <textarea class="form-control tinymce border-primary" name="properties_Property Map" id="properties_description"></textarea>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                    <div class="col-12">
                                                        <label class="col-md-0 label-control" for="userinput8">Anchor
                                                            Tenants </label>
                                                        <div class="upload__box">
                                                            <div class="upload__btn-box">
                                                                <label class="upload__btn border">
                                                                    <p>Upload images</p>
                                                                    <input type="file" multiple=""
                                                                        data-max_length="20" class="upload__inputfile"
                                                                        name="anchor_tenant[]">
                                                                </label>
                                                            </div>
                                                            <div class="upload__img-wrap"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><b>Note: </b> Recommended dimensions 116 X 47</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-image"></i>Gallery</h4>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="upload__box image_order">
                                                            <div class="upload__btn-box">
                                                                <label class="upload__btn border">
                                                                    <p>Upload images</p>
                                                                    <input type="file" multiple=""
                                                                        data-max_length="20" class="upload__inputfile"
                                                                        name="file[]" data-value="Gallery">
                                                                </label>
                                                            </div>
                                                            <div class="upload__img-wrap"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><b>Note: </b> Recommended dimensions 1462 X 570</p>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="show_in_map" id="showInMap" value="1" checked>
                                                            <label class="custom-control-label" for="showInMap">Show in map</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="input-group">
                                                                @foreach ($status as $item)
                                                                    <div
                                                                        class="d-inline-block custom-control custom-radio mr-1">
                                                                        <input type="radio" name="property_status_id"
                                                                            class="custom-control-input"
                                                                            id="status{{ $item->id }}"
                                                                            value="{{ $item->id }}"
                                                                            @if ($item->description == 'ACTIVE') {{ 'checked' }} @endif>
                                                                        <label class="custom-control-label"
                                                                            for="status{{ $item->id }}">{{ $item->description }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <div class="form-group">
                                                            <label>IS Featured</label>
                                                            <div class="input-group">
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="featured"
                                                                        class="custom-control-input featured" id="featured1"
                                                                        value="1">
                                                                    <label class="custom-control-label"
                                                                        for="featured1">YES</label>

                                                                </div>
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="featured"
                                                                        class="custom-control-input featured" id="featured2"
                                                                        value="0" checked>
                                                                    <label class="custom-control-label"
                                                                        for="featured2">NO</label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3 mb-2 orderby_featured">
                                                        <label for="orderby_featured">Orderby featured</label>
                                                        <input type="text" id="orderby_featured" class="form-control" placeholder="Orderby featured" name="orderby_featured" value="">
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-primary "><i
                                                    class="la la-check-square-o"></i>
                                                Save</button>
                                            <a href="{{ route('properties.index') }}" class="btn btn-warning"><i
                                                    class="ft-x"></i>
                                                Cancel</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                </section>
                <!-- // Basic form layout section end -->
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            ImgUpload();

            $("#propertyForm").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "square_foot": {
                        required: true
                    },
                    "state": {
                        required: true
                    },
                    "city": {
                        required: true
                    },
                    "agent_id[]": {
                        required: true
                    },
                },
                messages: {
                    "name": {
                        required: 'Please enter title'
                    },
                    "square_foot": {
                        required: 'Please enter area'
                    },
                    "state": {
                        required: 'Please enter state'
                    },
                    "city": {
                        required: 'Please enter city'
                    },
                    "agent_id[]": {
                        required: 'Please select agent'
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "agent_id[]") {
                        error.appendTo('#agenterrorTxt');
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('.fileUpload').on('change', function() {
                var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
                $(this).next('.custom-file-label').html(fileName);
            });
            if($('#featured2:checked').is(":checked")){
                $('.orderby_featured').hide();
            }
            $('.featured').on("change", function(){
                if($(this).val() == '0'){
                    $('.orderby_featured').hide();
                }else{
                    $('.orderby_featured').show();
                }
            });
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    var is_gallery = $(this).attr('data-value');
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    if (is_gallery == 'Gallery') {
                                        var html =
                                            "<div class='property-image-main'><a href=" + e
                                            .target.result +
                                            " data-fancybox='images' ><div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" +
                                            f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></i></div></div></div></a><div style='padding-top: 10px;'><input type='number' class='form-control'  placeholder='Image Order' name='image_order[]'></div></div>";
                                    } else {
                                        var html =
                                            "<div class='property-image-main'><a href=" + e
                                            .target.result +
                                            " data-fancybox='images' ><div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" +
                                            f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></i></div></div></div></a><div style='padding-top: 10px;'></div></div>";
                                    }
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                $(this).closest('.property-image-main').hide();
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                $('.upload__inputfile').val('');
            });
        }
    </script>
@endpush
