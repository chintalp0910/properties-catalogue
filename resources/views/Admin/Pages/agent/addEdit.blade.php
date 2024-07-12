@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            @php
                $faction = $action == 'ADD' ? route('agents.store') : route('agents.update', $agent->id);
            @endphp
            <form class="form" method="post" action="{{ $faction }}" id="agentForm" enctype="multipart/form-data">
                @csrf
                @if ($action == 'ADD')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        @if ($action == 'ADD')
                            <h3 class="content-header-title mb-0 d-inline-block">Add Agent</h3>
                        @else
                            <h3 class="content-header-title mb-0 d-inline-block">Edit Agent</h3>
                        @endif
                    </div>
                    <div class="col-md-6 col-12 mb-2">
                        <a href="{{ route('agents.index') }}" class="btn btn-warning float-right"><i class="ft-x"></i>
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
                                                <h4 class="form-section"><i class="ft-user"></i>Agent
                                                    Information</h4>

                                                <div class="row">
                                                    <div class="col-md-2 profilePic mb-3">
                                                        <div class="text-center">
                                                            <img src="{{ isset($agent) && !empty($agent->image_relative_url) ? asset('uploads/' . $agent->image_relative_url . '') : asset('assets/front/images/propery_image.png') }}"
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
                                                                    id="image" name="image_uploaded" accept="image/*">
                                                                <label class="custom-file-label" for="image"
                                                                    aria-describedby="image">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <p class="image-note"><b>Note: </b>Recommended dimensions 57 X 57</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="first_name" class="form-control"
                                                            placeholder="First Name" name="first_name"
                                                            value="{{ old('first_name') ? old('first_name') : $agent->first_name ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Last Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="last_name" class="form-control"
                                                            placeholder="Last Name" name="last_name"
                                                            value="{{ old('last_name') ? old('last_name') : $agent->last_name ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="email">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" id="email" class="form-control"
                                                            placeholder="Email" name="email"
                                                            value="{{ old('email') ? old('email') : $agent->email ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="phone">Phone <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="phone" class="form-control"
                                                            placeholder="Phone" name="phone" maxlength="15"
                                                            value="{{ old('phone') ? old('phone') : $agent->phone ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Fax </label>
                                                        <input type="text" id="fax" class="form-control"
                                                            placeholder="Fax" name="fax"
                                                            value="{{ old('fax') ? old('fax') : $agent->fax ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Category </label>
                                                        <input type="text" id="category" class="form-control"
                                                            placeholder="Category" name="category"
                                                            value="{{ old('category') ? old('category') : $agent->category ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">#Sorting </label>
                                                        <input type="text" id="a4a_sort" class="form-control"
                                                            placeholder="#Sorting" name="a4a_sort"
                                                            value="{{ old('a4a_sort') ? old('a4a_sort') : $agent->a4a_sort ?? '' }}">
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
                                <a href="{{ route('agents.index') }}" class="btn btn-warning float-right"><i
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
            $("#agentForm").validate({
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
                },
            });
        });

        // function performClick(elemId) {
        //     var elem = $('#image');
        //     console.log(elem);
        //     if (elem && document.createEvent) {
        //         var evt = document.createEvent("MouseEvents");
        //         evt.initEvent("click", true, false);
        //         elem.dispatchEvent(evt);
        //     }
        // }
    </script>
@endpush
