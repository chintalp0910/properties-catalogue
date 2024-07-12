<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<!-- BEGIN: Header-->
@include('Admin.Pages.layouts.head')

<!-- Styles -->
<link rel="stylesheet" href="{{asset('/css/app.css')}}"/>

<!-- END: Header-->

<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page" data-open="click"
      data-menu="vertical-menu-modern" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <img src="{{ asset('app-assets/images/logo/logo-dark.png') }}"
                                         alt="branding logo">
                                </div>

                            </div>

                            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                    <span> Account Details</span></p>
                            <div class="card-body">


                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />


                                <form class="form-horizontal" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="email"  class="form-control" name="email"
                                               placeholder="Your Email" required value="{{ old('email') }}">
                                        <div class="form-control-position">
                                            <i class="la la-user"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control" id="user-password" name="password"
                                               placeholder="Enter Password" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                    </fieldset>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember" name="remember">
                                                <label for="remember-me"> Remember Me</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a
                                                    href="{{ route('password.request') }}" class="card-link">Forgot
                                                Password?</a></div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-info btn-block">
                                        <i class="ft-unlock"></i> Login</button>
                                </form>
                            </div>
{{--                            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">--}}
{{--                                    <span>New to Modern--}}
{{--                                        ?</span></p>--}}
{{--                            <div class="card-body">--}}
{{--                                <a href="register-with-bg-image.html" class="btn btn-outline-danger btn-block"><i--}}
{{--                                            class="la la-user"></i>--}}
{{--                                    Register</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
        </div>
        </section>

    </div>
</div>
</div>
<!-- END: Content-->
@include('Admin.Pages.layouts.footer')

<!-- BEGIN: Vendor JS-->

<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
