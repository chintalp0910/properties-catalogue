@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            @php
                $faction = $action == 'ADD' ? route('employers.store') : route('employers.update', $employer->id);
            @endphp
            <form class="form" method="post" action="{{ $faction }}" id="employerForm" enctype="multipart/form-data">
                @csrf
                @if ($action == 'ADD')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        @if ($action == 'ADD')
                            <h3 class="content-header-title mb-0 d-inline-block">Add Employer</h3>
                        @else
                            <h3 class="content-header-title mb-0 d-inline-block">Edit Employer</h3>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <a href="{{ route('employers.index') }}" class="btn btn-warning float-right"><i class="ft-x"></i>
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
                                                <h4 class="form-section"><i class="ft-user-plus"></i>Employer
                                                    Information</h4>

                                                <div class="row">
                                                    <div class="col-md-2 profilePic mb-3">
                                                        <div class="text-center">
                                                            <img src="{{ isset($employer) && !empty($employer->image_relative_url) ? asset('employer_image/' . $employer->image_relative_url . '') : asset('assets/front/images/propery_image.png') }}"
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
                                                    <div class="col-md-10">
                                                        <p><b>Note: </b>Recommended dimensions 150 X 150</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="first_name">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="first_name" class="form-control"
                                                            placeholder="First Name" name="first_name"
                                                            value="{{ old('first_name') ? old('first_name') : $employer->first_name ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="last_name">Last Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="last_name" class="form-control"
                                                            placeholder="Last Name" name="last_name"
                                                            value="{{ old('last_name') ? old('last_name') : $employer->last_name ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="email">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" id="email" class="form-control"
                                                            placeholder="Email" name="email"
                                                            value="{{ old('email') ? old('email') : $employer->email ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="phone">Phone <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="phone" class="form-control"
                                                            placeholder="Phone" name="phone" maxlength="15"
                                                            value="{{ old('phone') ? old('phone') : $employer->phone ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Fax</label>
                                                        <input type="text" id="fax" class="form-control"
                                                            placeholder="Fax" name="fax"
                                                            value="{{ old('fax') ? old('fax') : $employer->fax ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="category">Category <span
                                                                class="text-danger">*</span></label>
                                                        <select id="category" name="category"
                                                            class="form-control select2">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if (isset($employer) && $employer->category == $category->id) {{ 'selected' }} @endif>
                                                                    {{ $category->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div id="categoryerrorTxt"></div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="category">Office Type </label>
                                                        <select id="office_type_id" name="office_type_id"
                                                            class="form-control select2">
                                                            <option value="">Select Office Type</option>
                                                            @foreach ($officeType as $type)
                                                                <option value="{{ $type->id }}"
                                                                    @if (isset($employer) && $employer->office_type_id == $type->id) {{ 'selected' }} @endif>
                                                                    {{ $type->description }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div id="categoryerrorTxt"></div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">#Sorting <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" id="a4a_sort" class="form-control"
                                                            placeholder="#Sorting" name="a4a_sort"
                                                            value="{{ old('a4a_sort') ? old('a4a_sort') : $employer->a4a_sort ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="position">Position</label>
                                                        <input type="text" id="position" class="form-control"
                                                            placeholder="Position" name="position"
                                                            value="{{ old('position') ? old('position') : $employer->position ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="form-group">
                                                            <label>Break Display After</label>
                                                            <div class="input-group">
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="break_display_after"
                                                                        class="custom-control-input"
                                                                        id="break_display_after1" value="1"
                                                                        @if (isset($employer) && $employer->break_display_after == 1) {{ 'checked' }} @endif>
                                                                    <label class="custom-control-label"
                                                                        for="break_display_after1">YES</label>

                                                                </div>
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="break_display_after"
                                                                        class="custom-control-input"
                                                                        id="break_display_after2" value="0"
                                                                        @if ((isset($employer) && $employer->break_display_after == 0) || $action == 'ADD') {{ 'checked' }} @endif>
                                                                    <label class="custom-control-label"
                                                                        for="break_display_after2">NO</label>

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
                            <div class="col-md-12">
                                <a href="{{ route('employers.index') }}" class="btn btn-warning float-right"><i
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
            $("#employerForm").validate({
                rules: {
                    "first_name": {
                        required: true,
                    },
                    "last_name": {
                        required: true,
                    },
                    "email": {
                        required: true
                    },
                    "phone": {
                        required: function validate(evt) {
                            evt.value = evt.value.replace(/[^0-9\+]/g, "");
                        },
                    },
                    "category": {
                        required: true
                    },
                    "a4a_sort": {
                        required: true
                    },
                },
                messages: {
                    "first_name": {
                        required: 'Please enter first name'
                    },
                    "last_name": {
                        required: 'Please enter last name'
                    },
                    "email": {
                        required: 'Please enter email'
                    },
                    "phone": {
                        required: 'Please enter phone'
                    },
                    "category": {
                        required: 'Please select category'
                    },
                    "a4a_sort": {
                        required: 'Please enter sorting number'
                    },
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "category") {
                        error.appendTo('#categoryerrorTxt');
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
@endpush
