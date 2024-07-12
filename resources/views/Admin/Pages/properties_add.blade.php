<!DOCTYPE html>
<html class="loading" lang="en">

<!-- BEGIN: Head-->
@include('Admin.Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('Admin.Include.header')

    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    @include('Admin.Include.sidebar')
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add Property</h3>
                    <!--  <a class="btn btn-round btn-info mb-1" href="{{ url('properties_list') }}"> <i class="icon-cog3"> </i> Back </a> -->
                    <div class="row breadcrumbs-top d-inline-block">

                    </div>
                </div>
                <div class="col-md-6 col-12 mb-2">
                    <a href="{{ route('properties_all') }}" class="btn btn-warning float-right"><i
                            class="ft-x"></i>
                        Cancel</a>
                    <a href="{{ route('properties_all') }}" class="btn btn-primary mr-1 float-right">
                        <i class="la la-check-square-o"></i> Save
                    </a>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form" method="post" onsubmit="return false">
                                @csrf
                                @method('POST')
                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Gereral
                                                    Information</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="projectinput1">Title</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                            placeholder="Title" name="title">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="projectinput2">Area</label>
                                                        <input type="text" id="projectinput2" class="form-control"
                                                            placeholder="Area" name="area">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="projectinput3">Agent Name</label>
                                                        <select id="issueinput6" name="agent_name"
                                                            class="form-control select2" multiple>
                                                            <option value="0">paramount</option>
                                                            <option value="1">paramount 1</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="projectinput4">State</label>
                                                                <input type="text" id="projectinput4"
                                                                    class="form-control" placeholder="State"
                                                                    name="state">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="projectinput4">City</label>
                                                                <input type="text" id="projectinput4"
                                                                    class="form-control" placeholder="City"
                                                                    name="city">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="projectinput4">Address</label>
                                                        <input type="text" id="projectinput4" class="form-control"
                                                            placeholder="Address" name="address">
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="projectinput4">Longitude</label>
                                                                <input type="text" id="projectinput4"
                                                                    class="form-control" placeholder="Longitude"
                                                                    name="longitude">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="projectinput4">Latitude</label>
                                                                <input type="text" id="projectinput4"
                                                                    class="form-control" placeholder="Latitude"
                                                                    name="latitude">
                                                            </div>
                                                        </div>
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
                                                <h4 class="form-section"><i class="ft-link"></i> Document</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="userinput3">
                                                                Brochure :</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="inputGroupFile02">
                                                                <label class="custom-file-label" for="inputGroupFile02"
                                                                    aria-describedby="inputGroupFile02">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="userinput4">
                                                                Site plan :</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="inputGroupFile02">
                                                                <label class="custom-file-label" for="inputGroupFile02"
                                                                    aria-describedby="inputGroupFile02">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
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
                                                <h4 class="form-section"><i class="ft-tv"></i> Demographics
                                                </h4>
                                                <div class="row">
                                                    <section id="form-repeater">
                                                        <div class="">
                                                            <div class="col-sm-12 ">
                                                                <div class="repeater-default">
                                                                    <div data-repeater-list="category">
                                                                        <div data-repeater-item=""
                                                                            class="row">
                                                                            <div class="form-group  col-sm-12 col-md-2">
                                                                                <label for="profession">Category</label>
                                                                                <br>
                                                                                <select class="form-control"
                                                                                    id="profession" name="category">
                                                                                    {{-- <option value="">
                                                                                        Personal</option>
                                                                                    <option value=""> Aggent
                                                                                    </option> --}}
                                                                                    @foreach ($categories as $category)
                                                                                        <option
                                                                                            value="{{ $category->id }}">
                                                                                            {{ $category->description }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @foreach ($demographicMiles as $key => $demographicMile)
                                                                                <div
                                                                                    class="form-group mb-1 col-sm-12 col-md-2">
                                                                                    <label for="pass">MILE
                                                                                        {{ $key + 1 }}</label>
                                                                                    <br>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="mile{{ $key + 1 }}"
                                                                                        placeholder="MILE {{ $key + 1 }}"
                                                                                        name="mile[]"
                                                                                        value="{{ $demographicMile->description }}">
                                                                                </div>
                                                                            @endforeach
                                                                            <div
                                                                                class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-repeater-delete="">
                                                                                    <i class="ft-x"></i>
                                                                                    Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group overflow-hidden">
                                                                        <button type="button"
                                                                        data-repeater-create=""
                                                                        class="btn btn-primary">
                                                                        <i class="ft-plus"></i>
                                                                        Add
                                                                    </button>
                                                                    </div>
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
                                                <h4 class="form-section"><i class="ft-clipboard"></i> Details</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group collapse show">
                                                            <label class="col-md-0 label-control"
                                                                for="userinput8">Description :</label>
                                                            <div class="col-md-12 mx-auto">
                                                                <textarea class=" form-control tinymce border-primary" name="properties_description" id="properties_description">
                                                                    Realty have been developing residential, commercial and social club projects of over 64 lac sq. mtrs. (69 million sq. ft. approx) in Ahmedabad, Mumbai.
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group collapse show">
                                                            <label class="col-md-0 label-control"
                                                                for="userinput8">Property Map :</label>
                                                            <div class="col-md-12 mx-auto">
                                                                <textarea class="form-control tinymce border-primary" name="properties_Property Map" id="properties_description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group collapse show">
                                                            <label class="col-md-0 label-control"
                                                                for="userinput8">Anchor Tenants :</label>
                                                            <div class="col-md-12 mx-auto">
                                                                <textarea class="form-control tinymce border-primary" name="properties_Anchor_Tenants" id="properties_description"></textarea>
                                                            </div>
                                                        </div>
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
                                                <h4 class="form-section"><i class="ft-image"></i> Gallery</h4>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card-content collapse show">
                                                            <div class="card-body">
                                                                <div class="dropzone dropzone-area" action="#"
                                                                    id="dpz-multiple-files">
                                                                    <div class="dz-message"
                                                                        style="margin-top: -66px">Drop Files Here To
                                                                        Upload</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <div class="input-group">
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="customer1"
                                                                        class="custom-control-input" id="yes" value="1"
                                                                        checked>
                                                                    <label class="custom-control-label"
                                                                        for="yes">Active</label>
                                                                </div>
                                                                <div
                                                                    class="d-inline-block custom-control custom-radio">
                                                                    <input type="radio" name="customer1"
                                                                        class="custom-control-input" id="no">
                                                                    <label class="custom-control-label"
                                                                        for="no">Inactive</label>
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
                                        <div class="float-right">
                                            <a href="{{ route('properties_all') }}" class="btn btn-primary "><i
                                                    class="la la-check-square-o"></i>
                                                Save</a>
                                            <a href="{{ route('properties_all') }}" class="btn btn-warning"><i
                                                    class="ft-x"></i>
                                                Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- <script type="text/javascript">
        $(document).ready(function() {

            Dropzone.autoDiscover = false;
            $(".my-dp-zone").dropzone();
        })
    </script> -->
    @include('Admin.Include.footer')

</body>
<!-- END: Body-->

</html>
