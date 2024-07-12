<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<head>
    @include('Front.layouts.head')
    @stack('css')
</head>

<body>
    <!-- Header -->
    @include('Front.layouts.header')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('Front.layouts.footer')
    @stack('js')
</body>

</html>
