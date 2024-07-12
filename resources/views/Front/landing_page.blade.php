<!DOCTYPE html>
<html>

<!-- Head -->
@include('Front.layouts.head')

<body>

    <section>
        <div class="landing-page background" style="background-image: url({{ asset('assets/front/images/landing-page-banner.jpg')}})">
            <div class="landing-page-inner">
                <div class="logo"><a href="#"><img src="{{ asset('assets/front/images/logo.png')}}"></a></div>
                <h1>LMS is now Paramount Realty</h1>
                <div class="button-1"><a href="{{ \Illuminate\Support\Str::of(env('APP_URL'))->finish("/")->append("home") }}" class="text-uppercase">GO TO WEBSITE</a></div>
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js')}}"></script>

</body>

</html>
