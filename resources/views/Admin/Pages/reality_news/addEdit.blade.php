@extends('Admin.Pages.layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/ijaboCropTool.min.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            @php
                $faction = $action == 'ADD' ? route('reality-news.store') : route('reality-news.update', $news->id);
            @endphp
            <form class="form" method="post" action="{{ $faction }}" id="realityNewsForm"
                enctype="multipart/form-data">
                @csrf
                @if ($action == 'ADD')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <input type="hidden" name="image_url" id="image_url">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        @if ($action == 'ADD')
                            <h3 class="content-header-title mb-0 d-inline-block">Add News</h3>
                        @else
                            <h3 class="content-header-title mb-0 d-inline-block">Edit News</h3>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <a href="{{ route('reality-news.index') }}" class="btn btn-warning float-right"><i
                                class="ft-x"></i>
                            Cancel</a>
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
                                                <h4 class="form-section"><i class="ft-globe"></i>Reality News
                                                    Information</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="title">Title <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="title" class="form-control"
                                                            placeholder="Title" name="title"
                                                            value="{{ old('title') ? old('title') : $news->title ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="title">Date</label>
                                                        <input type="text" id="date" class="form-control"
                                                            placeholder="Select date" name="date"
                                                            value="{{ old('date') ? old('date') : $news->date ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="title">Publish By</label>
                                                        <input type="text" id="publish_by" class="form-control"
                                                            placeholder="Publish By" name="publish_by"
                                                            value="{{ old('publish_by') ? old('publish_by') : $news->publish_by ?? '' }}">
                                                    </div>
                                                    {{-- <div class="form-group col-md-6">
                                                        <label for="author_id">Author</label>
                                                        <select id="author_id" name="author_id"
                                                            class="form-control select2">
                                                            <option value="">Select Author</option>
                                                            @foreach ($authors as $author)
                                                                <option value="{{ $author->id }}"
                                                                    @if (isset($news) && $news->author_id == $author->id) {{ 'selected' }} @endif>
                                                                    {{ $author->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                    <div class="form-group col-md-6">
                                                        <label for="tag">Tags</label>
                                                        <select id="tag" name="tag[]" class="form-control select2"
                                                            multiple>
                                                            @if ($action == 'EDIT' && !empty($news->tag))
                                                                @php
                                                                    $tags = explode(',', $news->tag);
                                                                @endphp
                                                                @foreach ($tags as $tag)
                                                                    <option value="{{ $tag }}" selected>
                                                                        {{ $tag }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="short_description">Short
                                                            Description <span class="text-danger">*</span></label>
                                                        <textarea class=" form-control" name="short_content" id="short_content" rows="3">{{ old('short_content') ? old('short_content') : $news->short_content ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="content">Content <span
                                                                class="text-danger">*</span></label>
                                                        <textarea class=" form-control tinymce border-primary" name="content" id="content">{!! old('content') ? old('content') : $news->content ?? '' !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Image</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="image" name="image" accept="image/*">
                                                                <label class="custom-file-label" for="image"
                                                                    aria-describedby="image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imgPreview mb-2">
                                                        <img src="{{ isset($news) && !empty($news->image) ? asset('news_image/' . $news->image . '') : asset('app-assets/images/ico/favicon-icon.png') }}"
                                                            class="mt-1 border" id="imgPreview" height="80px"
                                                            width="80px" alt="image">
                                                        <span onclick="document.getElementById('image').click()">Edit
                                                            Picture</span>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><b>Note: </b> Recent News dimensions 615 X 341 And All News
                                                            dimensions 411 X 262 </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group">
                                                            <label>IS Featured</label>
                                                            <div class="input-group">
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="featured"
                                                                        class="custom-control-input" id="featured1"
                                                                        value="1"
                                                                        @if ((isset($news) && $news->featured == 1) || $action == 'ADD') {{ 'checked' }} @endif>
                                                                    <label class="custom-control-label"
                                                                        for="featured1">YES</label>

                                                                </div>
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="featured"
                                                                        class="custom-control-input" id="featured2"
                                                                        value="0"
                                                                        @if (isset($news) && $news->featured == 0) {{ 'checked' }} @endif>
                                                                    <label class="custom-control-label"
                                                                        for="featured2">NO</label>

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
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary mr-1"><i class="la la-check-square-o"></i>
                                    Save</button>
                                <a href="{{ route('reality-news.index') }}" class="btn btn-warning "><i
                                        class="ft-x"></i>
                                    Cancel</a>
                            </div>
                        </div>

                </div>
            </form>
        </div>
        </section>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('app-assets/js/ijaboCropTool.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var imgPreview = $('#imgPreview').attr("src");
            var date = new Date();
            if ($('#date').val() != null) {
                date = $('#date').val();
            }
            $("#date").flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: date,
            });
            $("#realityNewsForm").validate({
                rules: {
                    "title": {
                        required: true,
                    },
                    "short_content": {
                        required: true
                    },
                    "content": {
                        required: true
                    },
                },
                messages: {
                    "title": {
                        required: 'Please enter title'
                    },
                    "short_content": {
                        required: 'Please enter short description'
                    },
                    "content": {
                        required: 'Please enter content'
                    },
                },
            });
            $("#tag").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        });
        $('#image').ijaboCropTool({
          preview : '#imgPreview',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png', 'svg'],
          buttonsText:['CROP','CANCEL'],
          buttonsColor:['#30bf7d','#ee5155', -15],
        //processUrl:'{{ route("reality-news.store") }}',
        //withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
             alert(message);
          },
          onError:function(message, element, status){
            alert(message);
          }
       });
    </script>
@endpush
