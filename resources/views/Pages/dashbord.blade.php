<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

   @include('Include.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header>
      @include('Layout.navbar')        
    </header>

    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

@include('Layout.sidebar')

    <!-- END: Main Menu-->

    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            
            <div class="content-body">
                <!-- line chart section start -->
                <h1>test</h1>
                <!-- // line chart section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   @include('Include.footer')

    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>