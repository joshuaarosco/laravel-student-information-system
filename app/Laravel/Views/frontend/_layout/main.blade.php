<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    @include('frontend._components.metas')
    @include('frontend._includes.styles')
    @yield('page-styles')
</head>
<body>
    <!--  THEME PRELOADER AREA -->
    <div id="preloader-wrapper">
        <div class="preloader-wave-effect"></div>
    </div><!-- THEME PRELOADER AREA END --><!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start of header area -->
        @include('frontend._components.header')

        @yield('content')

        @include('frontend._components.footer')
    </div>
    @include('frontend._includes.scripts')
    @yield('page-scripts')
</body>
</html>