<!-- Our Project -->
<section class="half-half-grid d-flex flex-wrap">
    <div class="col-sm-4 half-grid  d-flex align-items-center justify-content-center background"
        style="background-image: url({{ asset('assets/front/images/image-1.png') }});">
        <div class="content text-uppercase text-center">
            <h5> UNDER DEVELOPMENT</h5>
            <div class="button-1">
                <a href="{{ route('properties.getProperties', ['type' => 'under-development']) }}">EXPLORE</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 half-grid  d-flex align-items-center justify-content-center background"
        style="background-image: url({{ asset('assets/front/images/image-2.png') }});">
        <div class="content text-uppercase text-center">
            <h5>CURRENT PORTFOLIO</h5>
            <div class="button-1">
                <a href="{{ route('properties') }}">EXPLORE</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 half-grid  d-flex align-items-center justify-content-center background"
        style="background-image: url({{ asset('assets/front/images/news-post-2.png') }});">
        <div class="content text-uppercase text-center">
            <h5>PORTFOLIO MAP</h5>
            <div class="button-1">
                <a href="{{ route('properties.mapview') }}">EXPLORE</a>
            </div>
        </div>
    </div>
</section>
@php
$setting = Config::get('settings');
@endphp
<footer>
    <div class="footer-section d-flex flex-wrap">
        <div class="footer-left left-space col-sm-6 col-lg-9 col-md-8 ">
            <div class="d-flex flex-wrap ">
                <div class="col-sm-5">
                    <div class="address">
                        <strong>{{ array_key_exists('office_title1', $setting) ? strip_tags($setting['office_title1']) : '' }}</strong>
                        <p>{!! array_key_exists('office_address1', $setting) ? nl2br($setting['office_address1']) : '' !!}
                        </p>
                    </div>
                    <div class="address">
                        <strong>{{ array_key_exists('office_title2', $setting) ? strip_tags($setting['office_title2']) : '' }}</strong>
                        <p>{!! array_key_exists('office_address2', $setting) ? nl2br($setting['office_address2']) : '' !!}
                        </p>
                    </div>
                    <div class="footer-logo-text desktop-block">
                        <div class="footer-logo">
                            <img
                                src="{{ array_key_exists('footer_logo', $setting) ? asset('uploads/setting/' . $setting['footer_logo'] . '') : asset('assets/front/images/footer-logo.png') }}">
                        </div>
                        <div class="copyright-text">
                            {{-- <p>© {{ date('Y') }} All rights reserved. Paramount Realty Services, Inc. | <a href="#">Privacy
                                    Policy</a><br>This site is protected by reCAPTCHA and the Google Privacy Policy
                                and Terms of Service apply.</p> --}}
                            <p>{!! array_key_exists('copyright_content', $setting) ? nl2br($setting['copyright_content']) : '' !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-wrap">
                        <ul>
                            <li><a href="{{ route('home') }}">HOME</a></li>
                            <li><a href="{{ route('properties') }}">PROPERTIES</a></li>
                            <li><a href="{{ route('company') }}">COMPANY</a></li>
                            <li><a href="{{ route('news') }}">NEWS</a></li>
                            <li><a href="{{ route('team') }}">Our Team</a></li>
                            <li><a href="{{ route('contactUs') }}">CONTACT US</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="footer-wrap">
                        <ul>
                            {{-- <li><a href="{{ route('shoppingCenter') }}">Shopping Center</a></li> --}}
                            <li><a href="{{ route('properties.getProperties',['type' => 'shopping-center']) }}">Shopping Center</a></li>
                            <li><a href="{{ route('properties.getProperties',['type' => 'single-tenant']) }}">Single Tenant</a></li>
                            <li><a href="{{ route('properties.getProperties',['type' => 'medical-office']) }}">Medical Office</a></li>
                            {{-- <li><a href="{{ route('properties.underDevelopment') }}">Under Development</a></li> --}}
                            <li><a href="{{ route('properties.getProperties', ['type' => 'under-development']) }}">Under Development</a></li>
                            <li><a href="{{ route('properties.getProperties',['type' => 'mixed-use']) }}">Mixed Use</a></li>
                            <li><a href="{{ route('properties.getProperties',['type' => 'warehouse']) }}">Self Storage</a></li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        <div class="footer-right deep-blue col-sm-6 col-lg-3 col-md-4">
            <div class="Subscribe-form">
                <h3>Subscribe to our newsletter</h3>
                <form action="#" method="post" onsubmit="return false">
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                    <input type="submit" value="Submit" name="submit">
                </form>
                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.</p> --}}
                <p>{!! array_key_exists('notes', $setting) ? nl2br($setting['notes']) : '' !!}</p>
            </div>
            <div class="follow-us">
                <h5>Follow us</h5>
                <ul>
                    @if (array_key_exists('facebook_link', $setting) && !empty($setting['facebook_link']))
                        <li><a href="{{ $setting['facebook_link'] }}"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if (array_key_exists('twitter_link', $setting) && !empty($setting['twitter_link']))
                        <li><a href="{{ $setting['twitter_link'] }}"><i class="fab fa-twitter"></i></a></li>
                    @endif
                    @if (array_key_exists('instagram_link', $setting) && !empty($setting['instagram_link']))
                        <li><a href="{{ $setting['instagram_link'] }}"><i class="fab fa-instagram"></i></a></li>
                    @endif
                    @if (array_key_exists('linkedIn_link', $setting) && !empty($setting['linkedIn_link']))
                        <li><a href="{{ $setting['linkedIn_link'] }}"><i class="fab fa-linkedin"></i></a></li>
                    @endif

                </ul>
            </div>
            <div class="mobile-block">
                <div class="footer-logo-text ">
                    <div class="footer-logo">
                        <img
                            src="{{ array_key_exists('footer_logo', $setting) ? asset('uploads/setting/' . $setting['footer_logo'] . '') : asset('assets/front/images/footer-logo.png') }}">
                    </div>
                    <div class="copyright-text">
                        {{-- <p>© {{ date('Y') }} All rights reserved. Paramount Realty Services, Inc. | <a
                                href="#">Privacy Policy</a>
                            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service
                            apply.</p> --}}
                        {{ array_key_exists('copyright_content', $setting) ? strip_tags($setting['copyright_content']) : '' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
