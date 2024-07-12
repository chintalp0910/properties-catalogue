@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            <form class="form" method="post" action="{{ route('settings.update') }}" id="settingForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Update Settings</h3>
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
                                                <h4 class="form-section"><i class="ft-settings"></i>Site
                                                    Settings</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <nav class="mb-5">
                                                            <div class="nav nav-tabs nav-fill" id="nav-tab"
                                                                role="tablist">
                                                                <a class="nav-item nav-link active" id="general-tab"
                                                                    data-toggle="tab" href="#general" role="tab"
                                                                    aria-controls="general" aria-selected="true">General</a>
                                                                <a class="nav-item nav-link" id="newsletter-tab"
                                                                    data-toggle="tab" href="#newsletter" role="tab"
                                                                    aria-controls="newsletter"
                                                                    aria-selected="false">Newsletter</a>
                                                                <a class="nav-item nav-link" id="social_media-tab"
                                                                    data-toggle="tab" href="#social_media" role="tab"
                                                                    aria-controls="social_media"
                                                                    aria-selected="false">Social Media</a>
                                                                <a class="nav-item nav-link" id="homepage_milestone-tab"
                                                                    data-toggle="tab" href="#homepage_milestone"
                                                                    role="tab" aria-controls="homepage_milestone"
                                                                    aria-selected="false">Homepage Milestone</a>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <div class="tab-content" id="nav-tabContent">

                                                    <div class="tab-pane fade show active" id="general" role="tabpanel"
                                                        aria-labelledby="general-tab">
                                                        <div class="row" id="general">
                                                            <div class="col-md-2 profilePic mb-3">
                                                                <input type="hidden" name="action" value="general_setting">
                                                                <div class="text-center">
                                                                    <img src="{{ array_key_exists('header_logo', $value) ? asset('uploads/setting/' . $value['header_logo'] . '') : asset('assets/front/images/logo.png') }}"
                                                                        class="border rounded-circle" id="imgPreview"
                                                                        alt="image">
                                                                    <span
                                                                        onclick="document.getElementById('image').click()">Edit
                                                                        Header
                                                                        Logo</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-none">
                                                                <div class="form-group">
                                                                    <label for="userinput3">
                                                                        Image</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input"
                                                                            id="image" name="header_logo"
                                                                            accept="image/*">
                                                                        <label class="custom-file-label" for="image"
                                                                            aria-describedby="image">Choose
                                                                            file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-2 profilePic mb-3">
                                                                <div class="text-center">
                                                                    <img src="{{ array_key_exists('footer_logo', $value) ? asset('uploads/setting/' . $value['footer_logo'] . '') : asset('assets/front/images/footer-logo.png') }}"
                                                                        class="border rounded-circle"
                                                                        id="footer_logo_preview" alt="image">
                                                                    <span
                                                                        onclick="document.getElementById('footer_logo').click()">Edit
                                                                        Footer
                                                                        Logo</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-none">
                                                                <div class="form-group">
                                                                    <label for="userinput3">
                                                                        Image</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input"
                                                                            id="footer_logo" name="footer_logo"
                                                                            accept="image/*">
                                                                        <label class="custom-file-label" for="footer_logo"
                                                                            aria-describedby="image">Choose
                                                                            file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><b>Note: </b>Recommended dimensions 221 X 49</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><b>Note: </b>Recommended dimensions 40 X 60</p>
                                                            </div>
                                                            <div class="col-md-9"></div>
                                                            <div class="col-md-12">
                                                                <h4 class="form-section"><i
                                                                        class="ft-layers"></i>Addresses
                                                                </h4>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="office_title1">Office Title 1 <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="office_title1"
                                                                    class="form-control" placeholder="Office Title 1"
                                                                    name="office_title1"
                                                                    value="{{ old('office_title1') ?? array_key_exists('office_title1', $value) ? $value['office_title1'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="office_address1">Office Address 1 <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class=" form-control" name="office_address1" id="office_address1" rows="3">{{ old('office_address1') ?? array_key_exists('office_address1', $value) ? $value['office_address1'] : '' }}</textarea>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="office_title2">Office Title 2 <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" id="office_title2"
                                                                    class="form-control" placeholder="Office Title 2"
                                                                    name="office_title2"
                                                                    value="{{ old('office_title2') ?? array_key_exists('office_title2', $value) ? $value['office_title2'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="office_address2">Office Address
                                                                    2 <span class="text-danger">*</span></label>
                                                                <textarea class=" form-control" name="office_address2" id="office_address2" rows="3">{{ old('office_address2') ?? array_key_exists('office_address2', $value) ? $value['office_address2'] : '' }}</textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <h4 class="form-section">©</i> Copyright
                                                                </h4>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="copyright_content">Copyright
                                                                    Content</label>
                                                                <textarea class=" form-control" name="copyright_content" id="copyright_content" rows="3">{{ old('copyright_content') ?? array_key_exists('copyright_content', $value) ? $value['copyright_content'] : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="tab-pane fade" id="newsletter" role="tabpanel"
                                                        aria-labelledby="newsletter-tab">
                                                        <div class="row" id="newsletter">
                                                            <div class="form-group col-md-6">
                                                                <label for="api_key">API Key </label>
                                                                <input type="text" id="api_key" class="form-control"
                                                                    placeholder="API Key" name="api_key"
                                                                    value="{{ old('api_key') ?? array_key_exists('api_key', $value) ? $value['api_key'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="notes">Notes </label>
                                                                <textarea class=" form-control" name="notes" id="notes" rows="3">{{ old('notes') ?? array_key_exists('notes', $value) ? $value['notes'] : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="social_media" role="tabpanel"
                                                        aria-labelledby="social_media-tab">
                                                        <div class="row" id="social_media">
                                                            <div class="form-group col-md-6">
                                                                <label for="facebook_link">Facebook Link </label>
                                                                <input type="text" id="facebook_link"
                                                                    class="form-control" placeholder="Facebook Link"
                                                                    name="facebook_link"
                                                                    value="{{ old('facebook_link') ?? array_key_exists('facebook_link', $value) ? $value['facebook_link'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="instagram_link">Instagram Link </label>
                                                                <input type="text" id="instagram_link"
                                                                    class="form-control" placeholder="Instagram Link"
                                                                    name="instagram_link"
                                                                    value="{{ old('instagram_link') ?? array_key_exists('instagram_link', $value) ? $value['instagram_link'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="twitter_link">Twitter Link </label>
                                                                <input type="text" id="twitter_link"
                                                                    class="form-control" placeholder="Twitter Link"
                                                                    name="twitter_link"
                                                                    value="{{ old('twitter_link') ?? array_key_exists('twitter_link', $value) ? $value['twitter_link'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="linkedIn_link">LinkedIn Link </label>
                                                                <input type="text" id="linkedIn_link"
                                                                    class="form-control" placeholder="LinkedIn Link"
                                                                    name="linkedIn_link"
                                                                    value="{{ old('linkedIn_link') ?? array_key_exists('linkedIn_link', $value) ? $value['linkedIn_link'] : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="homepage_milestone" role="tabpanel"
                                                        aria-labelledby="homepage_milestone-tab">
                                                        <div class="row" id="homepage_milestone">
                                                            <div class="form-group col-md-6">
                                                                <label for="sf">SF <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" id="sf" class="form-control"
                                                                    placeholder="SF" name="sf"
                                                                    value="{{ old('sf') ?? array_key_exists('sf', $value) ? $value['sf'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="properties">Properties <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" id="properties"
                                                                    class="form-control" placeholder="Properties"
                                                                    name="properties"
                                                                    value="{{ old('properties') ?? array_key_exists('properties', $value) ? $value['properties'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="project_in_development">Project In Development
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="number" id="project_in_development"
                                                                    class="form-control"
                                                                    placeholder="Project In Development"
                                                                    name="project_in_development"
                                                                    value="{{ old('project_in_development') ?? array_key_exists('project_in_development', $value) ? $value['project_in_development'] : '' }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="states">States <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" id="states" class="form-control"
                                                                    placeholder="States" name="states"
                                                                    value="{{ old('states') ?? array_key_exists('states', $value) ? $value['states'] : '' }}">
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
            $("#settingForm").validate({
                rules: {
                    "office_title1": {
                        required: true,
                    },
                    "office_address1": {
                        required: true,
                    },
                    "office_title2": {
                        required: true,
                    },
                    "office_address2": {
                        required: true,
                    },
                    "sf": {
                        required: true,
                    },
                    "properties": {
                        required: true,
                    },
                    "project_in_development": {
                        required: true,
                    },
                    "states": {
                        required: true,
                    },
                },
                messages: {
                    "office_title1": {
                        required: 'Please enter office title 1'
                    },
                    "office_address1": {
                        required: 'Please enter office address 1'
                    },
                    "office_title2": {
                        required: 'Please enter office title 2'
                    },
                    "office_address2": {
                        required: 'Please enter office address 2'
                    },
                    "sf": {
                        required: 'Please enter sf count'
                    },
                    "properties": {
                        required: 'Please enter properties count'
                    },
                    "project_in_development": {
                        required: 'Please enter project in development count'
                    },
                    "states": {
                        required: 'Please enter states count'
                    },
                },
            });

            $('#footer_logo').change(function() {
                var file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#footer_logo_preview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
