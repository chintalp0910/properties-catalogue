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

        .remove-image {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: -25px;
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
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            <form class="form" method="post" action="{{ route('settings.updateCompanyPageSetting') }}" id="settingForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Update Company Page Settings</h3>
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <button type="submit" class="btn btn-primary mr-1 float-right">
                            <i class="la la-check-square-o"></i> Save
                        </button>
                    </div>
                </div>
                <div class="content-body">
                    <section id="horizontal-form-layouts">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-settings"></i>Company Page Settings
                                                </h4>
                                                <div class="row">
                                                    <input type="hidden" name="id"
                                                        value="{{ $companySetting->id ?? '' }}">
                                                    <div class="form-group col-md-6">
                                                        <label for="title">Title<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="title" class="form-control"
                                                            placeholder="Title" name="title"
                                                            value="{{ $companySetting->title ?? '' }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group collapse show">
                                                            <label class="col-md-0 label-control"
                                                                for="description">Description <span class="danger">*</span>
                                                            </label>
                                                            <div class="col-md-12 mx-auto">
                                                                <textarea class=" form-control tinymce border-primary" name="description" id="description">
                                                                    {{ $companySetting->description ?? '' }}
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 profilePic mb-3">
                                                        <div class="text-center">
                                                            <img src="{{ !empty($companySetting->p_image) ? asset('uploads/setting/company/' . $companySetting->p_image . '') : asset('assets/front/images/p-big-1-1.png') }}"
                                                                class="border rounded-circle" id="imgPreview"
                                                                alt="image">
                                                            <span onclick="document.getElementById('image').click()">Edit
                                                                image</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-none">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Image</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="image" name="p_image" accept="image/*">
                                                                <label class="custom-file-label" for="image"
                                                                    aria-describedby="image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 profilePic mb-3">
                                                        <div class="text-center">
                                                            <img src="{{ !empty($companySetting->map_image) ? asset('uploads/setting/company/' . $companySetting->map_image . '') : asset('assets/front/images/company_map_image_new.png') }}"
                                                                class="border rounded-circle" id="map_image_preview"
                                                                alt="image">
                                                            <span
                                                                onclick="document.getElementById('company_page_map_imge').click()">Edit
                                                                Map image</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-none">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Image</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="company_page_map_imge" name="map_image"
                                                                    accept="image/*">
                                                                <label class="custom-file-label" for="map_image"
                                                                    aria-describedby="image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <h4 class="form-section"><i class="ft-image"></i>Gallery</h4>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="upload__box image_order">
                                                            <div class="upload__btn-box">
                                                                <label class="upload__btn border">
                                                                    <p>Upload images</p>
                                                                    <input type="file" multiple=""
                                                                        data-max_length="20" class="upload__inputfile"
                                                                        name="image_name[]">
                                                                </label>
                                                            </div>
                                                            <div class="upload__img-wrap"></div>
                                                        </div>
                                                    </div>
                                                    @if (count($avatars) > 0)
                                                        @foreach ($avatars as $picture)
                                                            @if (File::exists(public_path('assets/front/images/' . $picture->image_name . '')))
                                                                <div class="col-md-2 mr-1 mb-2">
                                                                    <div class='upload__img-box'>
                                                                        <a href="{{ asset('assets/front/images/' . $picture->image_name . '') }}"
                                                                            data-fancybox="images">
                                                                            <div style="background-image: url({{ asset('assets/front/images/' . $picture->image_name . '') }})"
                                                                                data-number="0" data-file="download.jpeg"
                                                                                class="img-bg">
                                                                            </div>
                                                                        </a>
                                                                        <div class="remove-image" id="delete-image"
                                                                            data-id="{{ route('settings.deleteCompanyPageAvatar', $picture->id) }}">
                                                                        </div>
                                                                        <div style="padding-top: 10px;">
                                                                            <input type="text"
                                                                                class="form-control change_image_colorand_order"
                                                                                data-url="{{ route('settings.changeImageColorAndOrder', $picture->id) }}"
                                                                                data-key="sort_order"                                                                                placeholder="Image Order"
                                                                                name="sort_order"
                                                                                value="{{ $picture->sort_order }}">
                                                                        </div>
                                                                        <div style="padding-top: 10px;">
                                                                            <input type="text"
                                                                                class="form-control change_image_colorand_order" 
                                                                                data-url="{{ route('settings.changeImageColorAndOrder', $picture->id) }}"
                                                                                data-key="image_color"
                                                                                placeholder="Image Order"
                                                                                name="image_color"
                                                                                value="{{ $picture->image_color }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    {{-- @if (array_key_exists('company_page_hero_images', $value))
                                                        @php
                                                            $images = json_decode($value['company_page_hero_images']);
                                                        @endphp
                                                        @foreach ($images as $picture)
                                                            <div class="col-md-2 mr-1 mb-2">
                                                                <div class='upload__img-box'>
                                                                    <a href="{{ asset('uploads/setting/' . $picture->image . '') }}"
                                                                        data-fancybox="images">
                                                                        <div style="background-image: url({{ asset('uploads/setting/' . $picture->image . '') }})"
                                                                            data-number="0" data-file="download.jpeg"
                                                                            class="img-bg">
                                                                        </div>
                                                                    </a>
                                                                    <div class="remove-image" id="delete-image"
                                                                        data-id="{{ route('settings.deleteCompanyHeroImage', ['key' => 'company_page_hero_images', 'name' => $picture->image]) }}">
                                                                    </div>
                                                                    <div style="padding-top: 10px;">
                                                                        <select name='image_class[]'
                                                                            class='form-control select2 change_image_class' data-url="{{ route('settings.changeImageClass', ['key' => 'company_page_hero_images', 'name' => $picture->image]) }}">
                                                                            <option>Select image Color</option>
                                                                            <option value='hover_color' @if ($picture->image_class == 'hover_color') {{ 'selected' }} @endif>Hover color light green
                                                                            </option>
                                                                            <option value='hover_color_light' @if ($picture->image_class == 'hover_color_light') {{ 'selected' }} @endif>
                                                                                Hover color light blue</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif --}}
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
            $("#settingForm").validate({
                rules: {
                    "description": {
                        required: true,
                    },
                    "title": {
                        required: true,
                    },
                },
                messages: {
                    "description": {
                        required: 'Please enter description'
                    },
                    "title": {
                        required: 'Please enter title'
                    },
                },
            });

            $('#company_page_map_imge').change(function() {
                var file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#map_image_preview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('.change_image_colorand_order').on("keyup", function() {
                var url = $(this).attr('data-url');
                var key = $(this).attr('data-key');
                var val = $(this).val();

                $.ajax({
                    url: url,
                    data: key + "=" + val,
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

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
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
                                    var html =
                                        "<div class='property-image-main'><a href=" + e
                                        .target.result +
                                        " data-fancybox='images' ><div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" +
                                        f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></i></div></div></div></a><div style='padding-top: 10px;'><input type='number' class='form-control'  placeholder='Image Order' name='sort_order_1[]'></div><div style='padding-top: 10px;'><input type='text' class='form-control'  placeholder='Image Color code' name='image_color_1[]'></div></div>";
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
