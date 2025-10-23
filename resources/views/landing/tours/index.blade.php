@extends('layouts.landing.master')
@section('title', 'Tours')

@section('_styles')
    {{-- Styling ringan agar kartu mirip template Anda --}}
    {{-- <style>
        .featured-tour-card,
        .tour-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            height: 100%;
        }

        .featured-tour-card .tour-image,
        .tour-card .tour-image {
            position: relative;
        }

        .featured-tour-card img,
        .tour-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .tour-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #111827;
            color: #fff;
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 999px;
        }

        .tour-price {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: #fff;
            color: #111827;
            padding: 6px 10px;
            font-weight: 600;
            border-radius: 999px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .1);
        }

        .tour-content {
            padding: 16px 18px;
        }

        .tour-details,
        .tour-meta {
            display: flex;
            gap: 12px;
            align-items: center;
            color: #6b7280;
            font-size: 14px;
        }
    </style> --}}
@endsection

@section('content')

    {{-- Page Title --}}
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('tour/img/travel/showcase-8.webp') }});">
        <div class="container position-relative">
            <h1>{{ __('landing.tours.title') ?? 'Tours' }}</h1>
            <p>{{ __('landing.tours.subtitle') ?? 'Find your perfect tour and start your journey.' }}</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li class="current">Tours</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="travel-tours" class="travel-tours section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            {{-- Intro --}}
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <h2>{{ __('landing.tours.find_title') ?? 'Find Your Perfect Tour' }}</h2>
                    <p>{{ __('landing.tours.find_desc') ?? 'Discover unforgettable travel experiences with our curated collection of tours.' }}</p>
                </div>
            </div>

            {{-- Filters (GET) --}}
            {{-- <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-12">
                    <form class="tour-filters" method="GET" action="{{ route('tours.index') }}">
                        <div class="row g-2">
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control" name="q" value="{{ $filters['q'] }}" placeholder="{{ __('landing.tours.search_placeholder') ?? 'Search tour title, code…' }}">
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <select class="form-select" name="duration">
                                    <option value="">{{ __('landing.tours.duration') ?? 'Duration' }}</option>
                                    @foreach (['1-3' => '1-3 Days', '4-7' => '4-7 Days', '8-14' => '8-14 Days', '15+' => '15+ Days'] as $val => $label)
                                        <option value="{{ $val }}" @selected($filters['duration'] === $val)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <select class="form-select" name="price">
                                    <option value="">{{ __('landing.tours.price_range') ?? 'Price Range' }}</option>
                                    @foreach (['0-500', '$0 - $500', '500-1000', '$500 - $1,000', '1000-2000', '$1,000 - $2,000', '2000+', '$2,000+'] as $k => $label)
                                        @if (is_string($k))
                                            <option value="{{ $k }}" @selected($filters['price'] === $k)>{{ $label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 d-grid">
                                <button class="btn btn-primary"><i class="bi bi-search"></i> {{ __('landing.tours.apply') ?? 'Apply' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            {{-- Featured Tours Slider --}}
            @if ($featured->count())
                <div class="row mb-5" data-aos="fade-up" data-aos-delay="300">
                    <div class="col-12">
                        <h3 class="section-subtitle mb-4">{{ __('landing.tours.featured') ?? 'Featured Tours' }}</h3>
                        <div class="featured-tours-slider swiper init-swiper">
                            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": { "delay": 5000 },
                "slidesPerView": 1,
                "spaceBetween": 30,
                "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
                "breakpoints": { "768": { "slidesPerView": 2 }, "1200": { "slidesPerView": 3 } }
              }
            </script>
                            <div class="swiper-wrapper">
                                @foreach ($featured as $f)
                                    <div class="swiper-slide">
                                        <div class="featured-tour-card">
                                            <div class="tour-image">
                                                <img src="{{ $f['image'] }}" alt="{{ $f['title'] }}" class="img-fluid">
                                                @if ($f['badge'])
                                                    <div class="tour-badge">{{ $f['badge'] }}</div>
                                                @endif
                                            </div>
                                            <div class="tour-content">
                                                <h4>{{ $f['title'] }}</h4>
                                                @if ($f['summary'])
                                                    <p>{{ $f['summary'] }}</p>
                                                @endif
                                                <div class="tour-meta">
                                                    <span class="duration"><i class="bi bi-clock"></i> {{ $f['duration'] }}</span>
                                                    {{-- @if ($f['price'])
                                                        <span class="price">{{ $f['price'] }}</span>
                                                    @endif --}}
                                                </div>
                                                <a href="{{ $f['url'] }}" class="btn btn-primary">{{ __('landing.tours.view_details') ?? 'View Details' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- All Tours Grid --}}
            <div class="row" data-aos="fade-up" data-aos-delay="400">
                <div class="col-12">
                    <h3 class="section-subtitle mb-4">{{ __('landing.tours.all') ?? 'All Tours' }}</h3>
                    <div class="row">
                        @forelse($tours as $t)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="tour-card h-100 d-flex flex-column">
                                    <div class="tour-image">
                                        <img src="{{ $t['image'] }}" alt="{{ $t['title'] }}" class="img-fluid">
                                        {{-- @if ($t['price'])
                                            <div class="tour-price">{{ $t['price'] }}</div>
                                        @endif --}}
                                    </div>
                                    <div class="tour-content">
                                        <h4>{{ $t['title'] }}</h4>
                                        @if ($t['summary'])
                                            <p>{{ $t['summary'] }}</p>
                                        @endif
                                        <div class="tour-details">
                                            <span><i class="bi bi-clock"></i> {{ $t['duration'] }}</span>
                                            @if ($t['rating'])
                                                <span><i class="bi bi-star-fill"></i> {{ $t['rating'] }} ({{ $t['rating_count'] }})</span>
                                            @endif
                                        </div>
                                        <a href="{{ $t['url'] }}" class="btn btn-outline-primary mt-2">{{ __('landing.tours.view_tour') ?? 'View Tour' }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning">{{ __('landing.tours.none') ?? 'No tours found.' }}</div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $tours->links() }}
                    </div>
                </div>
            </div>

            {{-- CTA (opsional, tetap dari template) --}}
            <div class="row" data-aos="fade-up" data-aos-delay="500">
                <div class="col-12">
                    <div class="cta-section text-center">
                        <h3>{{ __('landing.tours.cta_title') ?? 'Not Sure What to Choose?' }}</h3>
                        <p>{{ __('landing.tours.cta_desc') ?? 'Our travel experts are here to help you find the perfect tour.' }}</p>
                        <div class="cta-buttons">
                            <a href="#" class="btn btn-primary me-3">{{ __('landing.tours.contact_experts') ?? 'Contact Our Experts' }}</a>
                            <a href="#" class="btn btn-outline-primary">{{ __('landing.tours.take_quiz') ?? 'Take Our Travel Quiz' }}</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('_scripts')
    <script>
        // Auto-submit saat ubah filter select
        document.querySelectorAll('select[name="duration"], select[name="price"]').forEach(el => {
            el.addEventListener('change', () => el.form.submit());
        });
    </script>
@endsection
