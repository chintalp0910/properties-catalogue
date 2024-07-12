@extends('Front.layouts.app')

@section('content')
    <!-- contact Us Banner -->
    <section class="properties-banner position-relative overflow-hidden deep-blue properties-new-search">
        <div class="only-title text-center white filter-title">
            <h2>Contact Us</h2>
        </div>
    </section>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mailSuccessMes">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @php
        $setting = Config::get('settings');
    @endphp
    <div class="contact-details">
        <div class="container">
            <div class="contact-details-wrap  d-flex flex-wrap ">
                <div class="contact_us_form">
                    <form action="{{ route('contactUs.sendMail') }}" method="post" id="contactUsForm">
                        @csrf
                        @method('POST')
                        <ul>
                            <li class="fname">
                                <label for="firstname">First Name</label>
                                <input type="text" id="firstname" name="firstname" placeholder="First Name"
                                    value="{{ old('firstname') ? old('firstname') : '' }}">
                                <span class="error">{{ $errors->first('firstname') }}</span>
                            </li>
                            <li class="lname">
                                <label for="lastname">Last Name</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Last Name"
                                    value="{{ old('lastname') ? old('lastname') : '' }}">
                                <span class="error">{{ $errors->first('lastname') }}</span>
                            </li>
                            <li class="email">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="email"
                                    value="{{ old('email') ? old('email') : '' }}">
                                <span class="error">{{ $errors->first('email') }}</span>
                            </li>
                            <li class="number">
                                <label for="number">contact number</label>
                                <input type="text" id="number" name="number" maxlength="15"
                                    placeholder="contact number" value="{{ old('number') ? old('number') : '' }}">
                                <span class="error">{{ $errors->first('number') }}</span>
                            </li>
                            <li class="Subject">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" placeholder="Subject"
                                    value="{{ old('subject') ? old('subject') : '' }}">
                                <span class="error">{{ $errors->first('subject') }}</span>
                            </li>
                            <li class="message">
                                <label for="message">message</label>
                                <textarea id="message" name="message" placeholder="your message">{{ old('message') ? old('message') : '' }}</textarea>
                                <span class="error">{{ $errors->first('message') }}</span>
                            </li>
                            <li class="captcha-wrap">
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                                <div class="captcha-input">
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha"
                                        name="captcha">
                                    <span class="error">
                                        @if (!empty($errors->first('captcha')))
                                            {{ 'Please enter valid captcha' }}
                                        @endif
                                    </span>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" name="submit">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="addess-wrap white">
                    <div class="inner">
                        <ul>
                            <li>
                                <h5>{{ array_key_exists('office_title1', $setting) ? strip_tags($setting['office_title1']) : '' }}
                                </h5>
                                <div class="address">
                                    <i class="fas fa-phone-alt"></i>
                                    <address>
                                        {!! array_key_exists('office_address1', $setting) ? nl2br($setting['office_address1']) : '' !!}
                                    </address>
                                </div>
                            </li>
                            <li>
                                <h5>{{ array_key_exists('office_title2', $setting) ? strip_tags($setting['office_title2']) : '' }}
                                </h5>
                                <div class="address">
                                    <i class="fas fa-phone-alt"></i>
                                    <address>
                                        {!! array_key_exists('office_address2', $setting) ? nl2br($setting['office_address2']) : '' !!}
                                    </address>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#contactUsForm").validate({
                rules: {
                    "firstname": {
                        required: true,
                    },
                    "lastname": {
                        required: true,
                    },
                    "email": {
                        required: true
                    },
                    "number": {
                        required: function validate(evt) {
                            evt.value = evt.value.replace(/[^0-9\+]/g, "");
                        },
                    },
                    "subject": {
                        required: true
                    },
                    "message": {
                        required: true
                    },
                    "captcha": {
                        required: true
                    },
                },
                messages: {
                    "firstname": {
                        required: 'Please enter first name'
                    },
                    "lastname": {
                        required: 'Please enter last name'
                    },
                    "email": {
                        required: 'Please enter email'
                    },
                    "number": {
                        required: 'Please enter contact number'
                    },
                    "subject": {
                        required: 'Please enter subject'
                    },
                    "message": {
                        required: 'Please enter message'
                    },
                    "captcha": {
                        required: 'Please enter captcha'
                    },
                },
            });

            setTimeout(function() {
                $(".alert-success").remove();
            }, 5000);

            $('#reload').click(function() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('reloadCaptcha') }}",
                    success: function(data) {
                        $(".captcha span").html(data.captcha);
                    }
                });
            });
        });
    </script>
@endpush
