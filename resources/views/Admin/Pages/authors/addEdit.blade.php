@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            @php
                $faction = $action == 'ADD' ? route('authors.store') : route('authors.update', $author->id);
            @endphp
            <form class="form" method="post" action="{{ $faction }}" id="authorForm" enctype="multipart/form-data">
                @csrf
                @if ($action == 'ADD')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        @if ($action == 'ADD')
                            <h3 class="content-header-title mb-0 d-inline-block">Add Author</h3>
                        @else
                            <h3 class="content-header-title mb-0 d-inline-block">Edit Author</h3>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <a href="{{ route('authors.index') }}" class="btn btn-warning float-right"><i class="ft-x"></i>
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
                                                <h4 class="form-section"><i class="ft-user-plus"></i>Author
                                                    Information</h4>

                                                <div class="row">
                                                    <div class="col-md-2 profilePic mb-3">
                                                        <div class="text-center">
                                                            <img src="{{ isset($author) && !empty($author->image_relative_url) ? asset('uploads/authors/' . $author->image_relative_url . '') : asset('assets/front/images/propery_image.png') }}"
                                                                class="border rounded-circle" id="imgPreview"
                                                                alt="image">
                                                            <span onclick="document.getElementById('image').click()">Edit
                                                                Picture</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-none">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Image</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="image" name="image_relative_url"
                                                                    accept="image/*">
                                                                <label class="custom-file-label" for="image"
                                                                    aria-describedby="image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="name" class="form-control"
                                                            placeholder="First Name" name="name"
                                                            value="{{ old('name') ? old('name') : $author->name ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="short_description">Short
                                                            Description</label>
                                                        <textarea class=" form-control" name="short_description" id="short_description" rows="3">{{ old('short_description') ? old('short_content') : $author->short_description ?? '' }}</textarea>
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
                                <a href="{{ route('authors.index') }}" class="btn btn-warning float-right"><i
                                        class="ft-x"></i>
                                    Cancel</a>
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
            $("#authorForm").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                },
                messages: {
                    "name": {
                        required: 'Please enter name'
                    },
                },
            });
        });
    </script>
@endpush
