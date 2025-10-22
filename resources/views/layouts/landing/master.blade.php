<!DOCTYPE html>
<html lang="{{ __('landing.html_lang') }}">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ __('landing.meta.title') }}</title>
    <meta name="description" content="{{ __('landing.meta.description') }}">
    <meta name="keywords" content="{{ __('landing.meta.keywords') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ __('landing.og.title') }}">
    <meta property="og:description" content="{{ __('landing.og.description') }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/og/ranahgo.jpg') }}">
    <meta name="theme-color" content="#0ea5e9">

    <!-- Favicons -->
    <link href="{{ asset('tour/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('tour/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


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

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- ======= Scripts ======= -->
    @include('layouts.landing.scripts')

    @yield('_scripts')



</body>

</html>
