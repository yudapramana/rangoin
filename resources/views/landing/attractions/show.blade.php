@extends('layouts.landing.master')
@section('title', $attraction->meta_title_id ?? ($attraction->name_id ?? 'Attractions'))

@section('_styles')
    {{-- Vendor (match template) --}}
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    {{-- Leaflet (map optional) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        /* Page Title */
        /* .page-title.dark-background {
                                                                                        background-position: center;
                                                                                        background-size: cover;
                                                                                        background-repeat: no-repeat;
                                                                                        position: relative;
                                                                                        padding: 80px 0;
                                                                                    }

                                                                                    .page-title.dark-background::before {
                                                                                        content: "";
                                                                                        position: absolute;
                                                                                        inset: 0;
                                                                                        background: linear-gradient(180deg, rgba(0, 0, 0, .25), rgba(0, 0, 0, .65));
                                                                                    } */

        .page-title .container {
            position: relative;
            color: #fff;
        }

        .page-title .breadcrumbs ol {
            padding-left: 0;
            margin: 10px 0 0;
            list-style: none;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .page-title .breadcrumbs a {
            color: #fff;
            opacity: .85;
            text-decoration: none;
        }

        .page-title .breadcrumbs .current {
            opacity: .9;
        }

        /* Inner hero like template */
        .tour-hero .hero-image-wrapper {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
        }

        .tour-hero .hero-image-wrapper img {
            width: 100%;
            height: 420px;
            object-fit: cover;
        }

        .tour-hero .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, .15), rgba(0, 0, 0, .55));
            display: flex;
            align-items: end;
        }

        .tour-hero .hero-content {
            color: #fff;
            padding: 24px;
            width: 100%;
        }

        .tour-hero .hero-content h1 {
            margin-bottom: 8px;
        }

        .hero-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            font-weight: 500;
        }

        .hero-meta span i {
            margin-right: 6px;
        }

        .hero-tagline {
            margin-top: 8px;
            opacity: .95;
        }

        .btn-book {
            display: inline-block;
            margin-top: 14px;
            padding: 10px 16px;
            background: #0d6efd;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
        }

        /* Sections */
        .travel-tour-details.section {
            padding: 40px 0 60px;
        }

        .tour-overview h2,
        .tour-inclusions h3,
        .tour-pricing h2,
        .tour-gallery h2 {
            margin-bottom: 14px;
        }

        .tour-highlights ul {
            padding-left: 0;
            list-style: none;
        }

        .tour-highlights li {
            margin-bottom: 8px;
        }

        .tour-highlights i {
            color: #16a34a;
            margin-right: 8px;
        }

        .quick-stats .stat-card {
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 14px;
            height: 100%;
        }

        #map {
            width: 100%;
            height: 320px;
            border-radius: 14px;
            border: 1px solid #eee;
        }

        /* Pricing Compact */
        .pricing-compact {
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 16px;
        }

        .pricing-compact .price {
            font-size: 1.6rem;
            font-weight: 800;
        }

        /* Gallery grid */
        .gallery-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }

        .gallery-grid img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Final CTA */
        .final-cta .cta-content {
            text-align: center;
            border: 1px solid #eee;
            border-radius: 16px;
            padding: 22px;
        }

        .final-cta .btn-primary,
        .final-cta .btn-secondary {
            display: inline-block;
            margin: 6px;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
        }

        .final-cta .btn-primary {
            background: #0d6efd;
            color: #fff;
        }

        .final-cta .btn-secondary {
            background: #f3f4f6;
            color: #111;
        }

        .urgency-banner {
            margin-top: 10px;
            font-weight: 600;
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
        }
    </style>

    @php
        // SEO meta (ID first, fallback EN -> ZH)
        $loc = app()->getLocale();
        $pick = function (string $base) use ($attraction, $loc) {
            $f = fn($s) => data_get($attraction, $s);
            if ($loc === 'en' && $f($base . '_en')) {
                return $f($base . '_en');
            }
            if (in_array($loc, ['zh', 'zh_CN', 'zh_TW']) && $f($base . '_zh')) {
                return $f($base . '_zh');
            }
            return $f($base . '_id') ?? ($f($base . '_en') ?? $f($base . '_zh'));
        };

        $titleTxt = $pick('name');
        $subtitle = $pick('subtitle');
        $cityLabel = $pick('city');
        $locLabel = $pick('location_label') ?: ($cityLabel ?: optional($attraction->destination)->name_id);
        $desc = $pick('description');
        $culture = $pick('culture');
        $badgeLabel = $pick('badge_label');

        $metaTitle = $attraction->meta_title_id ?? $titleTxt;
        $metaDesc = $attraction->meta_description_id ?? \Illuminate\Support\Str::limit(strip_tags($desc ?? ''), 160);
        $metaImage = $attraction->image_main ?? $attraction->image_thumb;

        $priceMinor = $attraction->starting_price;
        $currency = $attraction->currency_code ?? 'IDR';
        $priceHuman = $priceMinor ? ($currency === 'IDR' ? 'Rp ' . number_format($priceMinor, 0, ',', '.') : number_format($priceMinor / 100, 2) . ' ' . $currency) : null;

        $gallery = is_array($attraction->gallery) ? $attraction->gallery : (json_decode($attraction->gallery ?? '[]', true) ?: []);
        $hasGeo = filled($attraction->lat) && filled($attraction->lng);
        $bgHero = $attraction->image_main ?? ($attraction->image_thumb ?? asset('tour/img/travel/showcase-8.webp'));
    @endphp

    <meta name="description" content="{{ $metaDesc }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    @if ($metaImage)
        <meta property="og:image" content="{{ $metaImage }}">
    @endif
@endsection

@section('content')
    @php use Illuminate\Support\Str; @endphp
    <main class="main">

        {{-- Page Title (Template-like) --}}
        <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ $bgHero }});">
            <div class="container position-relative">
                <h1>{{ $titleTxt }}</h1>
                <p class="mb-0">{{ $subtitle ?: Str::limit(strip_tags($desc ?? ''), 160) }}</p>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('attractions.index') }}">Attractions</a></li>
                        <li class="current">{{ $titleTxt }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Travel Tour Details Section -->
        <section id="travel-tour-details" class="travel-tour-details section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                {{-- Inner Hero (image + overlay + meta) --}}
                <div class="tour-hero mb-4">
                    <div class="hero-image-wrapper">
                        <img src="{{ $bgHero }}" alt="{{ $titleTxt }}" class="img-fluid w-100">
                        <div class="hero-overlay">
                            <div class="hero-content">
                                <h1>{{ $titleTxt }}</h1>
                                <div class="hero-meta">
                                    @if ($attraction->rating)
                                        <span class="rating"><i class="bi bi-star-fill"></i> {{ number_format($attraction->rating, 1) }} @if ($attraction->rating_count)
                                                ({{ number_format($attraction->rating_count) }} reviews)
                                            @endif
                                        </span>
                                    @endif
                                    @if ($locLabel)
                                        <span class="destination"><i class="bi bi-geo-alt"></i> {{ $locLabel }}</span>
                                    @endif
                                    @if ($priceHuman)
                                        <span class="price"><i class="bi bi-cash-coin"></i> From {{ $priceHuman }}</span>
                                    @endif
                                    @if ($badgeLabel)
                                        <span class="badge bg-light text-dark">{{ $badgeLabel }}</span>
                                    @endif
                                    @if ($attraction->is_popular_choice)
                                        <span class="badge bg-warning text-dark">Popular Choice</span>
                                    @endif
                                    @if ($attraction->is_best_value)
                                        <span class="badge bg-success">Best Value</span>
                                    @endif
                                    @if ($attraction->is_limited_spots)
                                        <span class="badge bg-danger">Limited Spots</span>
                                    @endif
                                </div>
                                @if ($subtitle)
                                    <p class="hero-tagline">{{ $subtitle }}</p>
                                @endif
                                <a href="#booking" class="btn-book">Check Availability</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Overview + Highlights --}}
                <div class="tour-overview" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>Overview</h2>
                            @if ($desc)
                                <p>{!! nl2br(e($desc)) !!}</p>
                            @else
                                <p>Discover the best of {{ $locLabel ?? 'this destination' }} — culture, nature, and unforgettable photo spots.</p>
                            @endif

                            {{-- Optional culture block --}}
                            @if ($culture)
                                <h3 class="mt-4">Culture & Heritage</h3>
                                <p>{!! nl2br(e($culture)) !!}</p>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <div class="tour-highlights">
                                <h3>Highlights</h3>
                                <ul>
                                    @if ($badgeLabel)
                                        <li><i class="bi bi-check-circle"></i> {{ $badgeLabel }}</li>
                                    @endif
                                    @if ($attraction->is_popular_choice)
                                        <li><i class="bi bi-check-circle"></i> Popular Choice</li>
                                    @endif
                                    @if ($attraction->is_best_value)
                                        <li><i class="bi bi-check-circle"></i> Best Value</li>
                                    @endif
                                    @if ($attraction->is_limited_spots)
                                        <li><i class="bi bi-check-circle"></i> Limited Spots</li>
                                    @endif
                                    @if (optional($attraction->destination)->name_id)
                                        <li><i class="bi bi-check-circle"></i> Destination: {{ optional($attraction->destination)->name_id }}</li>
                                    @endif
                                    @if ($locLabel)
                                        <li><i class="bi bi-check-circle"></i> Area: {{ $locLabel }}</li>
                                    @endif
                                </ul>
                            </div>

                            {{-- Pricing compact --}}
                            {{-- <div class="pricing-compact mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-semibold">Starting From</div>
                                        <div class="price">{{ $priceHuman ?? '—' }}</div>
                                        <small class="text-muted">{{ $currency }}</small>
                                    </div>
                                    @if ($attraction->rating)
                                        <div class="text-end">
                                            <div class="fw-semibold">Rating</div>
                                            <div class="h5 mb-0">{{ number_format($attraction->rating, 1) }}</div>
                                            <small class="text-muted">{{ number_format($attraction->rating_count ?? 0) }} reviews</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <a href="{{ url('/tours?attraction=' . $attraction->slug) }}" class="btn btn-primary">See Tours</a>
                                    <a href="{{ url('/packages?attraction=' . $attraction->slug) }}" class="btn btn-outline-secondary">See Packages</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                {{-- Quick stats + Map --}}
                <div class="mt-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="row g-3 quick-stats">
                        @if ($attraction->tours_count)
                            <div class="col-6 col-md-3">
                                <div class="stat-card">
                                    <div class="fw-semibold">Tours</div>
                                    <div class="h4 mb-0">{{ number_format($attraction->tours_count) }}</div>
                                </div>
                            </div>
                        @endif
                        @if ($attraction->packages_count)
                            <div class="col-6 col-md-3">
                                <div class="stat-card">
                                    <div class="fw-semibold">Packages</div>
                                    <div class="h4 mb-0">{{ number_format($attraction->packages_count) }}</div>
                                </div>
                            </div>
                        @endif
                        @if ($attraction->expeditions_count)
                            <div class="col-6 col-md-3">
                                <div class="stat-card">
                                    <div class="fw-semibold">Expeditions</div>
                                    <div class="h4 mb-0">{{ number_format($attraction->expeditions_count) }}</div>
                                </div>
                            </div>
                        @endif
                        @if ($hasGeo)
                            <div class="col-12 col-md-6">
                                <div id="map"></div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Gallery --}}
            {{-- @if (count($gallery))
                <div class="tour-gallery mt-5" data-aos="fade-up" data-aos-delay="360">
                    <h2>Photo Gallery</h2>
                    <div class="gallery-grid">
                        @foreach ($gallery as $idx => $img)
                            <div class="gallery-item">
                                <a href="{{ $img }}" class="glightbox" data-gallery="attr-{{ $attraction->slug }}">
                                    <img src="{{ $img }}" alt="{{ $titleTxt }} - {{ $idx + 1 }}" class="img-fluid" loading="lazy">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif --}}

            {{-- ============== GALLERY (Slider + Masonry, mengikuti halaman Gallery) ============== --}}
            @if (count($gallery))
                {{-- Gallery Slider Section --}}
                <section id="gallery-slider" class="gallery-slider section mt-0 pt-0" data-aos="fade-up" data-aos-delay="320">
                    <div class="container">
                        <div class="tour-gallery m-0 p-0" data-aos="fade-up" data-aos-delay="360">
                            <h2 class="p-0 m-0">Photo Gallery</h2>
                        </div>


                        <div class="gallery-container">
                            <div class="swiper init-swiper">
                                {{-- Swiper config persis seperti template --}}
                                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 800,
                        "autoplay": { "delay": 4000 },
                        "effect": "coverflow",
                        "grabCursor": true,
                        "centeredSlides": true,
                        "slidesPerView": "auto",
                        "coverflowEffect": { "rotate": 50, "stretch": 0, "depth": 100, "modifier": 1, "slideShadows": true },
                        "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
                        "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" },
                        "breakpoints": {
                            "320": { "slidesPerView": 1, "spaceBetween": 10 },
                            "768": { "slidesPerView": 2, "spaceBetween": 20 },
                            "1024": { "slidesPerView": 3, "spaceBetween": 30 }
                        }
                    }
                    </script>

                                <div class="swiper-wrapper">
                                    @foreach ($gallery as $idx => $img)
                                        <div class="swiper-slide">
                                            <div class="gallery-item">
                                                <div class="gallery-img">
                                                    <a class="glightbox" data-gallery="images-gallery-{{ $attraction->slug }}" href="{{ $img }}">
                                                        <img src="{{ $img }}" class="img-fluid" alt="{{ $titleTxt }} - {{ $idx + 1 }}" loading="lazy">
                                                        <div class="gallery-overlay">
                                                            <i class="bi bi-plus-circle"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>

                    </div>
                </section>
                {{-- /Gallery Slider Section --}}
            @endif


            {{-- Final CTA --}}
            <div class="final-cta mt-5" data-aos="fade-up" data-aos-delay="420">
                <div class="cta-content">
                    <h2>Ready to explore {{ $titleTxt }}?</h2>
                    <p>Plan your perfect day — tours, packages, and photo spots curated for you.</p>
                    <div class="cta-actions">
                        <a href="{{ url('/tours?attraction=' . $attraction->slug) }}" class="btn-primary">See Tours</a>
                        <a href="tel:+62" class="btn-secondary">Call Us</a>
                    </div>
                    @if ($attraction->is_limited_spots)
                        <div class="urgency-banner">
                            <i class="bi bi-clock"></i>
                            <span>Limited spots available — book soon!</span>
                        </div>
                    @endif
                </div>
            </div>

            </div>
        </section>
    </main>

    {{-- JSON-LD for SEO --}}
    <script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"TouristAttraction",
  "name": @json($titleTxt),
  "description": @json(strip_tags($desc ?? '')),
  @if($metaImage)"image": @json($metaImage),@endif
  @if($hasGeo)"geo": {"@type":"GeoCoordinates","latitude": {{ $attraction->lat }},"longitude": {{ $attraction->lng }}},@endif
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": {{ $attraction->rating ?? 0 }},
    "reviewCount": {{ $attraction->rating_count ?? 0 }}
  }
}
</script>
@endsection

@section('_scripts')
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    {{-- Leaflet --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        AOS && AOS.init({
            once: true
        });

        // GLightbox
        if (window.GLightbox) GLightbox({
            selector: '.glightbox'
        });

        // Leaflet Map
        (function() {
            const el = document.getElementById('map');
            if (!el) return;
            const lat = parseFloat(@json($attraction->lat));
            const lng = parseFloat(@json($attraction->lng));
            if (Number.isNaN(lat) || Number.isNaN(lng)) return;

            const map = L.map('map', {
                scrollWheelZoom: false
            }).setView([lat, lng], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup(@json($titleTxt)).openPopup();
        })();
    </script>
@endsection
