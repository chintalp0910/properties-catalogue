@extends('Admin.Pages.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            @include('Admin.Pages.layouts.alert')
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Change Password</h3>
                </div>
            </div>
            <div class="content-body">
                <section id="horizontal-form-layouts">
                    <form class="form" method="post" action="{{ route('administrator.changePassword') }}"
                        id="changePassForm">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content collpase show">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-unlock"></i>Password Information</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="password">New Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" id="password" class="form-control"
                                                            placeholder="New Password" name="password">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="confirm_password">Confirm Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" id="confirm_password" class="form-control"
                                                            placeholder="confirm password" name="confirm_password">
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
                                <a href="{{ route('dashboard') }}" class="btn btn-warning "><i class="ft-x"></i>
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
            $("#changePassForm").validate({
                rules: {
                    "password": {
                        required: true,
                    },
                    "confirm_password": {
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    "password": {
                        required: 'Please enter password'
                    },
                    "confirm_password": {
                        required: 'Please enter confirm password'
                    },
                },
            });
        });
    </script>
@endpush
