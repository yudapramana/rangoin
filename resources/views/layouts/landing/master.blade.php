<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>

    <!-- ======= Styles ======= -->
    @include('layouts.landing.styles')

    @yield('_styles')

</head>

<body>

    <div class="sharethis-sticky-share-buttons"></div>

    <!-- ======= Header ======= -->
    @include('layouts.landing.header')

    <!-- ======= Main Content ======= -->
    @yield('content')


    <!-- ======= Footer ======= -->
    @include('layouts.landing.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- ======= Scripts ======= -->
    @include('layouts.landing.scripts')

    @yield('_scripts')



</body>

</html>
