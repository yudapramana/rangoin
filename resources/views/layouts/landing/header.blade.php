<!-- HEADER -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
            {{-- <img src="{{ asset('tour/img/logo.webp') }}" alt=""> --}}
            <h1 class="sitename">RanahGo</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="/" class="active">{{ __('landing.nav.home') }}</a></li>
                <li><a href="#about">{{ __('landing.nav.about') }}</a></li>
                <li><a href="/destinations">{{ __('landing.nav.destinations') }}</a></li>
                <li><a href="/tours">{{ __('landing.nav.tours') }}</a></li>
                {{-- <li><a href="#featured-tours">{{ __('landing.nav.tours') }}</a></li> --}}
                <li><a href="#gallery">{{ __('landing.nav.gallery') }}</a></li>
                <li><a href="#blog">{{ __('landing.nav.blog') }}</a></li>

                <li class="dropdown">
                    <a href="#"><span>{{ __('landing.nav.more_pages') }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#destination-details">{{ __('landing.nav.destination_details') }}</a></li>
                        <li><a href="#tour-details">{{ __('landing.nav.tour_details') }}</a></li>
                        <li><a href="#booking">{{ __('landing.nav.booking') }}</a></li>
                        <li><a href="#testimonials">{{ __('landing.nav.testimonials') }}</a></li>
                        <li><a href="#faq">{{ __('landing.nav.faq') }}</a></li>
                        <li><a href="#blog-details">{{ __('landing.nav.blog_details') }}</a></li>
                        <li><a href="#terms">{{ __('landing.nav.terms') }}</a></li>
                        <li><a href="#privacy">{{ __('landing.nav.privacy') }}</a></li>
                        <li><a href="#404">404</a></li>
                    </ul>
                </li>

                <!-- Language Switcher (placeholder—sesuaikan dengan mekanisme locale-mu) -->
                <li class="dropdown">
                    <a href="#"><span><i class="bi bi-translate me-1"></i>{{ strtoupper(app()->getLocale()) }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="/locale/id">Bahasa Indonesia</a></li>
                        <li><a href="/locale/en">English</a></li>
                        <li><a href="/locale/zh">中文</a></li>
                    </ul>
                </li>

                <li><a href="#contact">{{ __('landing.nav.contact') }}</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="#featured-destinations">{{ __('landing.cta.get_started') }}</a>
    </div>
</header>
