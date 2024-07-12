@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    @if ($action == 'ADD')
                        <h3 class="content-header-title mb-0 d-inline-block">Add Administrator</h3>
                    @else
                        <h3 class="content-header-title mb-0 d-inline-block">Edit Administrator</h3>
                    @endif
                    <div class="row breadcrumbs-top d-inline-block">

                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="horizontal-form-layouts">
                    @php
                        $faction = $action == 'ADD' ? route('administrator.store') : route('administrator.update', $administrator->id);
                    @endphp
                    <form class="form" method="post" action="{{ $faction }}" id="administratorForm"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($action == 'ADD')
                            @method('POST')
                        @else
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i>Administrator
                                                    Information</h4>
                                                <div class="row">
                                                    <div class="col-md-2 profilePic mb-3">
                                                        <div class="text-center">
                                                            <img src="{{ isset($administrator) && !empty($administrator->image_relative_url) ? asset('administrator_image/' . $administrator->image_relative_url . '') : asset('assets/front/images/propery_image.png') }}"
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
                                                            placeholder="Name" name="name"
                                                            value="{{ old('name') ? old('name') : $administrator->name ?? '' }}">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="email">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" id="email" class="form-control"
                                                            placeholder="Email" name="email"
                                                            value="{{ old('email') ? old('email') : $administrator->email ?? '' }}">
                                                    </div>
                                                    @if ($action == 'ADD')
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="password">Password <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="password" id="password" class="form-control"
                                                                data-type="{{ $action == 'ADD' ? 'ADD' : 'EDIT' }}"
                                                                placeholder="{{ $action == 'ADD' ? 'Password' : 'Leave it blank to keep same password' }}"
                                                                name="password" value="">
                                                        </div>
                                                    @endif
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" id="phone" class="form-control"
                                                            placeholder="Phone" name="phone" maxlength="10"
                                                            value="{{ old('phone') ? old('phone') : $administrator->phone ?? '' }}">
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
                                <a href="{{ route('administrator.index') }}" class="btn btn-warning "><i
                                        class="ft-x"></i>
                                    Cancel</a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var type = $('#password').attr('data-type');
            $("#administratorForm").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "email": {
                        required: true
                    },
                    "password": {
                        required: function() {
                            return type == 'ADD';
                        }
                    },
                },
                messages: {
                    "name": {
                        required: 'Please enter title'
                    },
                    "email": {
                        required: 'Please enter email'
                    },
                    "password": {
                        required: 'Please enter password'
                    },
                },
            });
        });
    </script>
@endpush
