{{-- resources/views/landing.blade.php --}}
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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Poppins:wght@300;400;500;600;700;800;900&family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('tour/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('tour/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('tour/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('tour/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('tour/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('tour/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">
    <!-- HEADER -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
                {{-- <img src="{{ asset('tour/img/logo.webp') }}" alt=""> --}}
                <h1 class="sitename">RanahGo</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#" class="active">{{ __('landing.nav.home') }}</a></li>
                    <li><a href="#about">{{ __('landing.nav.about') }}</a></li>
                    <li><a href="#featured-destinations">{{ __('landing.nav.destinations') }}</a></li>
                    <li><a href="#featured-tours">{{ __('landing.nav.tours') }}</a></li>
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

    <main class="main">
        <!-- HERO -->
        <section id="travel-hero" class="travel-hero section dark-background">
            <div class="hero-background">
                <video autoplay muted loop playsinline>
                    {{-- <source src="{{ asset('tour/img/travel/video-2.mp4') }}" type="video/mp4"> --}}
                    <source src="{{ asset('tour/img/travel/rumah-gadang.mp4') }}" type="video/mp4">
                </video>
                <div class="hero-overlay"></div>
            </div>

            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="hero-text" data-aos="fade-up" data-aos-delay="100">
                            <h1 class="hero-title">{{ __('landing.hero.title') }}</h1>
                            <p class="hero-subtitle">{{ __('landing.hero.subtitle') }}</p>
                            <div class="hero-buttons">
                                <a href="#featured-destinations" class="btn btn-primary me-3">{{ __('landing.hero.btn_explore') }}</a>
                                <a href="#featured-tours" class="btn btn-outline">{{ __('landing.hero.btn_browse_tours') }}</a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-5">
                        <div class="booking-form-wrapper" data-aos="fade-left" data-aos-delay="200">
                            <div class="booking-form">
                                <h3 class="form-title">{{ __('landing.form.title') }}</h3>
                                <form action="#" method="GET">
                                    <div class="form-group mb-3">
                                        <label for="destination">{{ __('landing.form.destination') }}</label>
                                        <select name="destination" id="destination" class="form-select" required>
                                            <option value="">{{ __('landing.form.choose_destination') }}</option>
                                            <option value="bukittinggi">Bukittinggi</option>
                                            <option value="harau">Lembah Harau</option>
                                            <option value="maninjau">Danau Maninjau</option>
                                            <option value="mentawai">Kep. Mentawai</option>
                                            <option value="padang">Padang City</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="checkin">{{ __('landing.form.departure') }}</label>
                                                <input type="date" name="checkin" id="checkin" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="checkout">{{ __('landing.form.return') }}</label>
                                                <input type="date" name="checkout" id="checkout" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="adults">{{ __('landing.form.adults') }}</label>
                                                <select name="adults" id="adults" class="form-select" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="children">{{ __('landing.form.children') }}</label>
                                                <select name="children" id="children" class="form-select">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3+</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tour-type">{{ __('landing.form.tour_type') }}</label>
                                        <select name="tour_type" id="tour-type" class="form-select" required>
                                            <option value="">{{ __('landing.form.select_tour_type') }}</option>
                                            <option value="cultural">{{ __('landing.form.tour_types.cultural') }}</option>
                                            <option value="adventure">{{ __('landing.form.tour_types.adventure') }}</option>
                                            <option value="relaxation">{{ __('landing.form.tour_types.relaxation') }}</option>
                                            <option value="family">{{ __('landing.form.tour_types.family') }}</option>
                                            <option value="luxury">{{ __('landing.form.tour_types.luxury') }}</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">{{ __('landing.form.find_trip') }}</button>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        <!-- WHY US / ABOUT -->
        <section id="about" class="why-us section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center mb-5">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="content">
                            <h3>{{ __('landing.why.title') }}</h3>
                            <p>{{ __('landing.why.p1') }}</p>
                            <p>{{ __('landing.why.p2') }}</p>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <span data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="2" class="purecounter">0</span>
                                    <div class="stat-label">{{ __('landing.stats.travelers') }}</div>
                                </div>
                                <div class="stat-item">
                                    <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="2" class="purecounter">0</span>
                                    <div class="stat-label">{{ __('landing.stats.partners') }}</div>
                                </div>
                                <div class="stat-item">
                                    <span data-purecounter-start="0" data-purecounter-end="7" data-purecounter-duration="2" class="purecounter">0</span>
                                    <div class="stat-label">{{ __('landing.stats.years') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-image">
                            <img src="{{ asset('tour/img/travel/showcase-8.webp') }}" alt="Ranah Minang" class="img-fluid rounded-4">
                            <div class="experience-badge">
                                <div class="experience-number">7+</div>
                                <div class="experience-text">{{ __('landing.why.years_excellence') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="why-choose-section">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center mb-5" data-aos="fade-up" data-aos-delay="100">
                            <h3>{{ __('landing.why.heading') }}</h3>
                            <p>{{ __('landing.why.subtitle') }}</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                                <h4>{{ __('landing.why.cards.local_experts.title') }}</h4>
                                <p>{{ __('landing.why.cards.local_experts.body') }}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                                <h4>{{ __('landing.why.cards.safe_secure.title') }}</h4>
                                <p>{{ __('landing.why.cards.safe_secure.body') }}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-cash"></i></div>
                                <h4>{{ __('landing.why.cards.best_prices.title') }}</h4>
                                <p>{{ __('landing.why.cards.best_prices.body') }}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-headset"></i></div>
                                <h4>{{ __('landing.why.cards.support.title') }}</h4>
                                <p>{{ __('landing.why.cards.support.body') }}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                <h4>{{ __('landing.why.cards.global_destinations.title') }}</h4>
                                <p>{{ __('landing.why.cards.global_destinations.body') }}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="450">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="bi bi-star-fill"></i></div>
                                <h4>{{ __('landing.why.cards.premium_experience.title') }}</h4>
                                <p>{{ __('landing.why.cards.premium_experience.body') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURED DESTINATIONS (Sumbar) -->
        <section id="featured-destinations" class="featured-destinations section">
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ __('landing.featured_destinations.title') }}</h2>
                <div><span>{{ __('landing.featured_destinations.lead_1') }}</span> <span class="description-title">{{ __('landing.featured_destinations.lead_2') }}</span></div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="featured-destination">
                            <div class="destination-overlay">
                                <img src="{{ asset('tour/img/travel/destination-3.webp') }}" alt="Lembah Harau" class="img-fluid">
                                <div class="destination-info">
                                    <span class="destination-tag">{{ __('landing.destinations.popular') }}</span>
                                    <h3>Lembah Harau</h3>
                                    <p class="location"><i class="bi bi-geo-alt-fill"></i> Lima Puluh Kota</p>
                                    <p class="description">{{ __('landing.destinations.harau_desc') }}</p>
                                    <div class="destination-meta">
                                        <div class="tours-count"><i class="bi bi-collection"></i><span>{{ __('landing.destinations.packages', ['n' => 12]) }}</span></div>
                                        <div class="rating"><i class="bi bi-star-fill"></i><span>4.9 (312)</span></div>
                                    </div>
                                    <div class="price-info">
                                        <span class="starting-from">{{ __('landing.destinations.starting_from') }}</span>
                                        <span class="amount">IDR 2.950K</span>
                                    </div>
                                    <a href="#destination-details" class="explore-btn">
                                        <span>{{ __('landing.destinations.explore_now') }}</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-3">

                            <div class="col-12" data-aos="fade-left" data-aos-delay="300">
                                <div class="compact-destination">
                                    <div class="destination-image">
                                        <img src="{{ asset('tour/img/travel/destination-7.webp') }}" alt="Bukittinggi" class="img-fluid">
                                        <div class="badge-offer">{{ __('landing.badges.best_value') }}</div>
                                    </div>
                                    <div class="destination-details">
                                        <h4>Bukittinggi</h4>
                                        <p class="location"><i class="bi bi-geo-alt"></i> Jam Gadang & Ngarai Sianok</p>
                                        <p class="brief">{{ __('landing.destinations.bukittinggi_desc') }}</p>
                                        <div class="stats-row">
                                            <span class="tour-count"><i class="bi bi-calendar-check"></i> 10 {{ __('landing.common.tours') }}</span>
                                            <span class="rating"><i class="bi bi-star-fill"></i> 4.8</span>
                                            <span class="price">{{ __('landing.common.from_price', ['p' => 'IDR 1.750K']) }}</span>
                                        </div>
                                        <a href="#destination-details" class="quick-link">{{ __('landing.common.view_details') }} <i class="bi bi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" data-aos="fade-left" data-aos-delay="400">
                                <div class="compact-destination">
                                    <div class="destination-image">
                                        <img src="{{ asset('tour/img/travel/destination-11.webp') }}" alt="Danau Maninjau" class="img-fluid">
                                    </div>
                                    <div class="destination-details">
                                        <h4>Danau Maninjau</h4>
                                        <p class="location"><i class="bi bi-geo-alt"></i> Agam</p>
                                        <p class="brief">{{ __('landing.destinations.maninjau_desc') }}</p>
                                        <div class="stats-row">
                                            <span class="tour-count"><i class="bi bi-calendar-check"></i> 7 {{ __('landing.common.tours') }}</span>
                                            <span class="rating"><i class="bi bi-star-fill"></i> 4.7</span>
                                            <span class="price">{{ __('landing.common.from_price', ['p' => 'IDR 1.550K']) }}</span>
                                        </div>
                                        <a href="#destination-details" class="quick-link">{{ __('landing.common.view_details') }} <i class="bi bi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" data-aos="fade-left" data-aos-delay="500">
                                <div class="compact-destination">
                                    <div class="destination-image">
                                        <img src="{{ asset('tour/img/travel/destination-16.webp') }}" alt="Mentawai" class="img-fluid">
                                        <div class="badge-offer limited">{{ __('landing.badges.limited') }}</div>
                                    </div>
                                    <div class="destination-details">
                                        <h4>Kepulauan Mentawai</h4>
                                        <p class="location"><i class="bi bi-geo-alt"></i> Siberut–Sipora–Pagai</p>
                                        <p class="brief">{{ __('landing.destinations.mentawai_desc') }}</p>
                                        <div class="stats-row">
                                            <span class="tour-count"><i class="bi bi-calendar-check"></i> 5 {{ __('landing.common.expeditions') }}</span>
                                            <span class="rating"><i class="bi bi-star-fill"></i> 4.9</span>
                                            <span class="price">{{ __('landing.common.from_price', ['p' => 'IDR 6.900K']) }}</span>
                                        </div>
                                        <a href="#destination-details" class="quick-link">{{ __('landing.common.view_details') }} <i class="bi bi-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- FEATURED TOURS (static sample) -->
        <section id="featured-tours" class="featured-tours section">
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ __('landing.featured_tours.title') }}</h2>
                <div><span>{{ __('landing.featured_tours.lead_1') }}</span> <span class="description-title">{{ __('landing.featured_tours.lead_2') }}</span></div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="tour-card">
                            <div class="tour-image">
                                <img src="{{ asset('tour/img/travel/tour-1.webp') }}" alt="Beach Retreat" class="img-fluid" loading="lazy">
                                <div class="tour-badge">Top Rated</div>
                                <div class="tour-price">IDR 2.150K</div>
                            </div>
                            <div class="tour-content">
                                <h4>Coast & Island Escape</h4>
                                <div class="tour-meta">
                                    <span class="duration"><i class="bi bi-clock"></i> 3D2N</span>
                                    <span class="group-size"><i class="bi bi-people"></i> Max 8</span>
                                </div>
                                <p>Perpaduan pantai Padang—Pulau Pasumpahan—Sunset Pantai Air Manis.</p>
                                <div class="tour-highlights">
                                    <span>Padang</span><span>Pasumpahan</span><span>Air Manis</span>
                                </div>
                                <div class="tour-action">
                                    <a href="#booking" class="btn-book">Book Now</a>
                                    <div class="tour-rating">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                        <span>4.8 (95)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="tour-card">
                            <div class="tour-image">
                                <img src="{{ asset('tour/img/travel/tour-6.webp') }}" alt="Rainforest Trek" class="img-fluid" loading="lazy">
                                <div class="tour-badge cultural">Eco-Friendly</div>
                                <div class="tour-price">IDR 2.650K</div>
                            </div>
                            <div class="tour-content">
                                <h4>Harau Valley Adventure</h4>
                                <div class="tour-meta">
                                    <span class="duration"><i class="bi bi-clock"></i> 3D2N</span>
                                    <span class="group-size"><i class="bi bi-people"></i> Max 12</span>
                                </div>
                                <p>Tebing granit, air terjun Sarasah, dan aktivitas canyoning ringan.</p>
                                <div class="tour-highlights">
                                    <span>Harau</span><span>Payakumbuh</span><span>Lima Puluh Kota</span>
                                </div>
                                <div class="tour-action">
                                    <a href="#booking" class="btn-book">Book Now</a>
                                    <div class="tour-rating">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                                        <span>4.6 (70)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="tour-card">
                            <div class="tour-image">
                                <img src="{{ asset('tour/img/travel/tour-8.webp') }}" alt="Highlands" class="img-fluid" loading="lazy">
                                <div class="tour-badge adventure">Cultural</div>
                                <div class="tour-price">IDR 1.950K</div>
                            </div>
                            <div class="tour-content">
                                <h4>Bukittinggi Heritage</h4>
                                <div class="tour-meta">
                                    <span class="duration"><i class="bi bi-clock"></i> 2D1N</span>
                                    <span class="group-size"><i class="bi bi-people"></i> Max 15</span>
                                </div>
                                <p>City tour Jam Gadang—Ngarai Sianok—Lobang Jepang—kuliner Minang.</p>
                                <div class="tour-highlights">
                                    <span>Bukittinggi</span><span>Agam</span><span>Kuliner</span>
                                </div>
                                <div class="tour-action">
                                    <a href="#booking" class="btn-book">Book Now</a>
                                    <div class="tour-rating">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <span>4.9 (120)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                    <a href="#featured-tours" class="btn-view-all">{{ __('landing.common.view_all_tours') }}</a>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section id="testimonials" class="testimonials-home section">
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ __('landing.testimonials.title') }}</h2>
                <div><span>{{ __('landing.testimonials.lead_1') }}</span> <span class="description-title">{{ __('landing.testimonials.lead_2') }}</span></div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": { "delay": 5000 },
              "slidesPerView": "auto",
              "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
              "breakpoints": { "320": { "slidesPerView": 1, "spaceBetween": 40 }, "1200": { "slidesPerView": 3, "spaceBetween": 1 } }
            }
          </script>

                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p><i class="bi bi-quote quote-icon-left"></i>
                                    <span>Itinerary-nya rapi, pemandu ramah, dan spot fotonya luar biasa!</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('tour/img/person/person-m-9.webp') }}" class="testimonial-img" alt="">
                                <h3>Rafi</h3>
                                <h4>Traveler</h4>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p><i class="bi bi-quote quote-icon-left"></i>
                                    <span>Pengalaman otentik Minangkabau—kuliner, budaya, dan alam berpadu sempurna.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('tour/img/person/person-f-5.webp') }}" class="testimonial-img" alt="">
                                <h3>Sara</h3>
                                <h4>Designer</h4>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p><i class="bi bi-quote quote-icon-left"></i>
                                    <span>Timnya responsif 24/7. Anak-anak juga happy. Highly recommended!</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('tour/img/person/person-f-12.webp') }}" class="testimonial-img" alt="">
                                <h3>Jena</h3>
                                <h4>Store Owner</h4>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <!-- CTA + NEWSLETTER + BENEFITS -->
        <section id="call-to-action" class="call-to-action section light-background">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                    <div class="content-wrapper">
                        <div class="badge-wrapper">
                            <span class="promo-badge">{{ __('landing.cta.badge') }}</span>
                        </div>
                        <h2>{{ __('landing.cta.title') }}</h2>
                        <p>{{ __('landing.cta.body') }}</p>

                        <div class="action-section">
                            <div class="main-actions">
                                <a href="#featured-destinations" class="btn btn-explore"><i class="bi bi-compass"></i> {{ __('landing.cta.explore') }}</a>
                                <a href="#deals" class="btn btn-deals"><i class="bi bi-percent"></i> {{ __('landing.cta.deals') }}</a>
                            </div>

                            <div class="quick-contact">
                                <span class="contact-label">{{ __('landing.cta.need_help') }}</span>
                                <a href="tel:+628xx" class="contact-link"><i class="bi bi-telephone"></i> {{ __('landing.cta.phone') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="visual-element">
                        <img src="{{ asset('tour/img/travel/showcase-3.webp') }}" alt="Travel Adventure" class="hero-image" loading="lazy">
                        <div class="image-overlay">
                            <div class="stat-item">
                                <span class="stat-number">50+</span>
                                <span class="stat-label">{{ __('landing.cta.destinations') }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">1K+</span>
                                <span class="stat-label">{{ __('landing.cta.happy_travelers') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter inline -->
                <div class="newsletter-section" data-aos="fade-up" data-aos-delay="300">
                    <div class="newsletter-card">
                        <div class="newsletter-content">
                            <div class="newsletter-icon"><i class="bi bi-envelope-heart"></i></div>
                            <div class="newsletter-text">
                                <h3>Stay in the Loop</h3>
                                <p>Get exclusive travel deals and destination guides delivered to your inbox</p>
                            </div>
                        </div>

                        <form class="php-email-form newsletter-form" action="forms/newsletter.php" method="post">
                            <div class="form-wrapper">
                                <input type="email" name="email" class="email-input" placeholder="Your email address" required>
                                <button type="submit" class="subscribe-btn"><i class="bi bi-arrow-right"></i></button>
                            </div>

                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Welcome aboard! Check your email for exclusive offers.</div>

                            <div class="trust-indicators"><i class="bi bi-lock"></i><span>We protect your privacy. Unsubscribe anytime.</span></div>
                        </form>
                    </div>
                </div>

                <!-- Benefits inline -->
                <div class="benefits-showcase" data-aos="fade-up" data-aos-delay="400">
                    <div class="benefits-header">
                        <h3>Why Choose Our Adventures</h3>
                        <p>Experience the difference with our premium travel services</p>
                    </div>

                    <div class="benefits-grid">
                        <div class="benefit-card" data-aos="flip-left" data-aos-delay="450">
                            <div class="benefit-visual">
                                <div class="benefit-icon-wrap"><i class="bi bi-geo-alt"></i></div>
                                <div class="benefit-pattern"></div>
                            </div>
                            <div class="benefit-content">
                                <h4>Handpicked Destinations</h4>
                                <p>Every location is carefully selected by our travel experts for authentic experiences</p>
                            </div>
                        </div>

                        <div class="benefit-card" data-aos="flip-left" data-aos-delay="500">
                            <div class="benefit-visual">
                                <div class="benefit-icon-wrap"><i class="bi bi-award"></i></div>
                                <div class="benefit-pattern"></div>
                            </div>
                            <div class="benefit-content">
                                <h4>Award-Winning Service</h4>
                                <p>Recognized for excellence with 5-star ratings and industry awards</p>
                            </div>
                        </div>

                        <div class="benefit-card" data-aos="flip-left" data-aos-delay="550">
                            <div class="benefit-visual">
                                <div class="benefit-icon-wrap"><i class="bi bi-heart"></i></div>
                                <div class="benefit-pattern"></div>
                            </div>
                            <div class="benefit-content">
                                <h4>Personalized Care</h4>
                                <p>Tailored itineraries designed around your preferences and travel style</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER (inline) -->
    <footer id="footer" class="footer position-relative dark-background">
        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="#" class="d-flex align-items-center"><span class="sitename">RanahGo</span></a>
                    <div class="footer-contact pt-3">
                        <p>Padang, Sumatera Barat</p>
                        <p>Indonesia</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+62 8xx-xxxx-xxxx</span></p>
                        <p><strong>Email:</strong> <span>hello@ranahgo.id</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">{{ __('landing.nav.home') }}</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">{{ __('landing.nav.about') }}</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#featured-destinations">{{ __('landing.nav.destinations') }}</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#terms">{{ __('landing.nav.terms') }}</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Trip Custom</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Pemandu Lokal</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Kuliner Minang</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Dokumentasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Ikuti update promo dan destinasi RanahGo</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">RanahGo</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS -->
    <script src="{{ asset('tour/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tour/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('tour/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('tour/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('tour/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('tour/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('tour/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('tour/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('tour/js/main.js') }}"></script>
</body>

</html>
