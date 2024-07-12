<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    @include('Admin.Pages.layouts.head')

    <!-- Custom CSS -->
    @stack('css')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- Header -->
    @include('Admin.Pages.layouts.header')

    <!-- Sidebar -->
    @include('Admin.Pages.layouts.sidebar')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('Admin.Pages.layouts.footer')

    <!-- Custom JS -->
    @stack('js')
</body>

</html>
