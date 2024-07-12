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

        .remove-image {
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

        .remove-image:after {
            content: '\2716';
            font-size: 14px;
            color: white;
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
            <form class="form" method="post" action="{{ route('homepageSlider.update') }}" id="homepageSettingForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Update Slider</h3>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
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
                                                <h4 class="form-section"><i class="ft-settings"></i>Homepage
                                                    Setting</h4>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <nav class="mb-5">
                                                            <div class="nav nav-tabs nav-fill" id="nav-tab"
                                                                role="tablist">
                                                                <a class="nav-item nav-link active" id="hero-slider-tab"
                                                                    data-toggle="tab" href="#hero-slider" role="tab"
                                                                    aria-controls="hero-slider" aria-selected="true">Hero
                                                                    Slider</a>
                                                                <a class="nav-item nav-link" id="carousel-tab"
                                                                    data-toggle="tab" href="#carousel" role="tab"
                                                                    aria-controls="carousel" aria-selected="false">Carousel
                                                                    Slider</a>

                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <div class="tab-content" id="nav-tabContent">

                                                    <div class="tab-pane fade show active" id="hero-slider" role="tabpanel"
                                                        aria-labelledby="hero-slider-tab">
                                                        @if ($slider->count() > 0)
                                                            @foreach ($slider as $key => $item)
                                                                @if ($item->key == 'hero_slider')
                                                                    <div class="row" id="hero-slider">
                                                                        <div class="form-group col-md-6 mb-2">
                                                                            <label for="hero_slider_title">Title <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" id="hero_slider_title"
                                                                                class="form-control" placeholder="Title"
                                                                                name="hero_slider_title"
                                                                                value="{{ old('hero_slider_title') ?? $item->title }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6 mb-2">
                                                                            <input type="hidden" name="slider"
                                                                                id="slider" value="hero_slider">
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <h4 class="form-section"><i
                                                                                    class="ft-image"></i>Slider
                                                                            </h4>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="upload__box image_order">
                                                                                <div class="upload__btn-box">
                                                                                    <label class="upload__btn border">
                                                                                        <p>Upload images</p>
                                                                                        <input type="file" multiple=""
                                                                                            data-max_length="20"
                                                                                            class="upload__inputfile" data-action="Hero slider"
                                                                                            name="hero_slider[]">
                                                                                    </label>
                                                                                </div>
                                                                                <div class="upload__img-wrap"></div>
                                                                            </div>
                                                                        </div>
                                                                        @foreach ($item->value as $picture)
                                                                            <div class="col-md-2 mr-1 mb-2">
                                                                                <div class='upload__img-box'>
                                                                                    <div style="background-image: url({{ asset('uploads/homepage/' . $picture->image . '') }})"
                                                                                        data-number="0"
                                                                                        data-file="download.jpeg"
                                                                                        class="img-bg">
                                                                                        <div class="remove-image"
                                                                                            id="delete-image"
                                                                                            data-id="{{ route('homepageSlider.delete', ['id' => $item->id, 'name' => $picture->image]) }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div style="padding-top: 10px;">
                                                                                        <input type="text"
                                                                                            class="form-control image_order_change" data-url="{{ route('homepageSlider.changeSliderOrder', ['id' => $item->id, 'name' => $picture->image]) }}"
                                                                                            data-url=""
                                                                                            placeholder="Image Order" name="image_order[]"
                                                                                            value="{{ $picture->order }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="row" id="hero-slider">
                                                                <div class="form-group col-md-6 mb-2">
                                                                    <label for="hero_slider_title">Title <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" id="hero_slider_title"
                                                                        class="form-control" placeholder="Title"
                                                                        name="hero_slider_title"
                                                                        value="{{ old('hero_slider_title') ?? '' }}">
                                                                </div>
                                                                <div class="form-group col-md-6 mb-2">
                                                                    <input type="hidden" name="slider" id="slider"
                                                                        value="hero_slider">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h4 class="form-section"><i
                                                                            class="ft-image"></i>Slider
                                                                    </h4>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="upload__box">
                                                                        <div class="upload__btn-box">
                                                                            <label class="upload__btn border">
                                                                                <p>Upload images</p>
                                                                                <input type="file" multiple=""
                                                                                    data-max_length="20"
                                                                                    class="upload__inputfile"
                                                                                    name="hero_slider[]">
                                                                            </label>
                                                                        </div>
                                                                        <div class="upload__img-wrap"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-12 mb-1">
                                                                <p><b>Note: </b>Recommended dimensions 1462 X 824</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="tab-pane fade" id="carousel" role="tabpanel"
                                                        aria-labelledby="carousel-tab">
                                                        @if ($slider->count() > 0 && $item->key == 'carousel_slider')
                                                            @foreach ($slider as $item)
                                                                @if ($item->key == 'carousel_slider')
                                                                    <div class="row" id="carousel">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="carousel_slider__description">Short
                                                                                Description <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea class=" form-control" name="carousel_slider__description" id="carousel_slider__description"
                                                                                rows="3">{{ old('carousel_slider__description') ?? $item->title }}</textarea>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="upload__box image_order">
                                                                                <div class="upload__btn-box">
                                                                                    <label class="upload__btn border">
                                                                                        <p>Upload images</p>
                                                                                        <input type="file"
                                                                                            multiple=""
                                                                                            data-max_length="20"
                                                                                            class="upload__inputfile"
                                                                                            name="carousel_slider[]">
                                                                                    </label>
                                                                                </div>
                                                                                <div class="upload__img-wrap"></div>
                                                                            </div>
                                                                        </div>
                                                                        @foreach ($item->value as $picture)
                                                                            <div class="col-md-2 mr-1 mb-2">
                                                                                <div class='upload__img-box'>
                                                                                    <div style="background-image: url({{ asset('uploads/homepage/' . $picture->image . '') }})"
                                                                                        data-number="0"
                                                                                        data-file="download.jpeg"
                                                                                        class="img-bg">
                                                                                        <div class="remove-image"
                                                                                            id="delete-image"
                                                                                            data-id="{{ route('homepageSlider.delete', ['id' => $item->id, 'name' => $picture->image]) }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div style="padding-top: 10px;">
                                                                                        <input type="text"
                                                                                            class="form-control image_order_change" data-url="{{ route('homepageSlider.changeSliderOrder', ['id' => $item->id, 'name' => $picture->image]) }}"
                                                                                            data-url=""
                                                                                            placeholder="Image Order" name="image_order[]"
                                                                                            value="{{ $picture->order }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="row" id="carousel">
                                                                <div class="form-group col-md-6">
                                                                    <label for="carousel_slider__description">Short
                                                                        Description <span
                                                                            class="text-danger">*</span></label>
                                                                    <textarea class=" form-control" name="carousel_slider__description" id="carousel_slider__description"
                                                                        rows="3">{{ old('carousel_slider__description') ?? '' }}</textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="upload__box">
                                                                        <div class="upload__btn-box">
                                                                            <label class="upload__btn border">
                                                                                <p>Upload images</p>
                                                                                <input type="file" multiple=""
                                                                                    data-max_length="20"
                                                                                    class="upload__inputfile"
                                                                                    name="carousel_slider[]">
                                                                            </label>
                                                                        </div>
                                                                        <div class="upload__img-wrap"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-12 mb-1">
                                                                <p><b>Note: </b>Recommended dimensions 499 X 584</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-right mr-1"><i
                                        class="la la-check-square-o"></i>
                                    Save</button>
                            </div>
                        </div>
                </div>
            </form>
        </div>
        </section>
        <!-- // Basic form layout section end -->
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            ImgUpload();

            $("#homepageSettingForm").validate({
                rules: {
                    "hero_slider_title": {
                        required: function() {
                            return $('#slider').val() == "hero_slider";
                        }
                    },
                    "carousel_slider__description": {
                        required: function() {
                            return $('#slider').val() == "carousel_slider";
                        }
                    },
                    "hero_slider[]": {
                        required: function() {
                            return $('#slider').val() == "hero_slider";
                        }
                    },
                    "carousel_slider[]": {
                        required: function() {
                            return $('#slider').val() == "carousel_slider";
                        }
                    },
                },
                messages: {
                    "hero_slider_title": {
                        required: 'Please enter title'
                    },
                    "carousel_slider__description": {
                        required: 'Please enter short description'
                    },
                    "hero_slider[]": {
                        required: 'Please select hero slider'
                    },
                    "carousel_slider[]": {
                        required: 'Please select carousel slider'
                    },
                },
            });

            $('.image_order_change').on("keyup", function() {
                var url = $(this).attr('data-url');
                var val = $(this).val();

                $.ajax({
                    url: url,
                    data: "slider_order=" + val,
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function(response) {
                        if (response.status == "FAIL") {
                            Swal.fire({
                                type: "error",
                                title: "Image order change!",
                                text: response.message,
                                confirmButtonClass: "btn btn-danger",
                            });
                        }
                    },
                });
            });
        });

        $('#carousel-tab').on("click", function() {
            $('#slider').val('carousel_slider');
        });
        $('#hero-slider-tab').on("click", function() {
            $('#slider').val('hero_slider');
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    var action = $(this).attr('data-action');
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
                                    // var html =
                                    //     "<div class='upload__img-box'><div style='background-image: url(" +
                                    //     e.target.result + ")' data-number='" + $(
                                    //         ".upload__img-close").length + "' data-file='" + f
                                    //     .name +
                                    //     "' class='img-bg'><div class='upload__img-close'></i></div></div></div>";
                                    if(action == 'Hero slider'){
                                        var html =
                                            "<div class='property-image-main'><a href=" + e
                                            .target.result +
                                            " data-fancybox='images' ><div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" +
                                            f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></i></div></div></div></a><div style='padding-top: 10px;'><input type='number' class='form-control'  placeholder='Image Order' name='image_order[]'></div></div>";
                                    }else{
                                        var html =
                                            "<div class='property-image-main'><a href=" + e
                                            .target.result +
                                            " data-fancybox='images' ><div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" +
                                            f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></i></div></div></div></a><div style='padding-top: 10px;'><input type='number' class='form-control'  placeholder='Image Order' name='carousel_slider_order[]'></div></div>";
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

        $(document).on("click", "#delete-image", function() {
            var url = $(this).data("id");
            var myObject = $(this);
            var token = "{{ csrf_token() }}";
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this image!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!",
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "JSON",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(response) {
                            if (response.status == "SUCCESS") {
                                Swal.fire({
                                    type: "success",
                                    title: "Deleted!",
                                    text: response.message,
                                    confirmButtonClass: "btn btn-success",
                                });
                                myObject.parent().parent().remove();
                            }
                        },
                    });
                }
            });
        });
    </script>
@endpush
