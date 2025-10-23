@extends('layouts.landing.master')

@section('_styles')
    <style>
        .hero-wrap {
            position: relative;
            overflow: hidden;
            border-radius: 18px
        }

        .hero-wrap img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, .0) 20%, rgba(0, 0, 0, .65) 100%);
            display: flex;
            align-items: flex-end
        }

        .hero-content {
            color: #fff;
            padding: 24px
        }

        .badge-chip {
            display: inline-block;
            padding: .25rem .6rem;
            border-radius: 999px;
            background: #fff;
            color: #111;
            font-size: .8rem
        }

        .grid-attractions .card {
            border: 0;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
            border-radius: 16px;
            overflow: hidden;
            height: 100%
        }

        .grid-attractions .card-img-top {
            height: 220px;
            object-fit: cover
        }

        .stat-dot {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .92rem;
            color: #64748b
        }

        .price {
            font-weight: 600
        }

        .map-embed iframe {
            width: 100%;
            height: 360px;
            border: 0;
            border-radius: 16px
        }
    </style>
@endsection

@section('content')
    @php
        $locale = app()->getLocale();
        $nameKey = in_array($locale, ['id', 'en', 'zh']) ? "name_{$locale}" : 'name_id';
        $title = $d->{$nameKey} ?: $d->name_id;
        $type = strtoupper($d->type);
    @endphp

    {{-- Page Title --}}
    <div class="page-title dark-background" data-aos="fade" style="background-image:url({{ asset('tour/img/travel/showcase-8.webp') }});">
        <div class="container position-relative">
            <h1>Destination Details</h1>
            <p class="mb-0">Explore highlights, experiences, and practical info for {{ $title }}.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('landing.destinations.index') }}">Destinations</a></li>
                    <li class="current">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="travel-destination-details" class="travel-destination-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="50">

            {{-- HERO --}}
            <div class="destination-hero mb-4">
                <div class="hero-wrap" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ '/' . $d->image_url ?: asset('tour/img/travel/destination-12.webp') }}" alt="{{ $title }}">
                    <div class="hero-overlay">
                        <div class="hero-content">
                            <div class="mb-2">
                                <span class="badge-chip">{{ $type }}</span>
                                @if (!empty($d->filter))
                                    <span class="badge-chip ms-2">{{ ucfirst($d->filter) }}</span>
                                @endif
                            </div>
                            <h1 class="h2 mb-1">{{ $title }}</h1>
                            <p class="mb-0 opacity-75">
                                @if ($d->lat && $d->lng)
                                    <i class="bi bi-geo-alt"></i> {{ number_format($d->lat, 4) }}, {{ number_format($d->lng, 4) }}
                                @else
                                    Discover top attractions and curated experiences.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- OVERVIEW STATS --}}
            <div class="row g-3 mb-4" data-aos="fade-up" data-aos-delay="150">
                <div class="col-md-4">
                    <div class="p-3 border rounded-4 h-100 d-flex justify-content-between align-items-center">
                        <div class="stat-dot"><i class="bi bi-collection"></i> Attractions</div>
                        <div class="fs-4 fw-semibold">{{ $stats['count'] }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-4 h-100 d-flex justify-content-between align-items-center">
                        <div class="stat-dot"><i class="bi bi-star-fill"></i> Avg. Rating</div>
                        <div class="fs-4 fw-semibold">{{ $stats['avgRate'] ?: '–' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-4 h-100 d-flex justify-content-between align-items-center">
                        <div class="stat-dot"><i class="bi bi-cash-coin"></i> From</div>
                        <div class="fs-4 fw-semibold">
                            @if ($stats['minFrom'])
                                Rp {{ number_format($stats['minFrom'], 0, ',', '.') }}
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ATTRACTIONS GRID --}}
            {{-- <div class="attractions-section" data-aos="fade-up" data-aos-delay="200">
                <div class="section-header text-center mb-3">
                    <h2>Must-Visit Attractions in {{ $title }}</h2>
                    <p class="text-muted">Hand-picked highlights, tours, and experiences</p>
                </div>

                <div class="row gy-4">
                    @forelse ($d->attractions as $a)
                        @php
                            $aName = $a->{$nameKey} ?: $a->name_id;
                            $thumb = $a->image_main ?: $a->image_thumb ?: asset('tour/img/travel/destination-3.webp');
                            $badges = [];
                            if ($a->is_popular_choice) {
                                $badges[] = 'Popular';
                            }
                            if ($a->is_best_value) {
                                $badges[] = 'Best Value';
                            }
                            if ($a->is_limited_spots) {
                                $badges[] = 'Limited';
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ $thumb }}" alt="{{ $aName }}">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2 gap-2">
                                        @foreach ($badges as $b)
                                            <span class="badge rounded-pill bg-dark">{{ $b }}</span>
                                        @endforeach
                                        @if ($a->location_label_id)
                                            <span class="badge rounded-pill bg-secondary">{{ $a->location_label_id }}</span>
                                        @endif
                                    </div>
                                    <h5 class="card-title mb-1">{{ $aName }}</h5>
                                    @if ($a->subtitle_id)
                                        <div class="text-muted small mb-2">{{ $a->subtitle_id }}</div>
                                    @endif
                                    @if ($a->description_id)
                                        <p class="card-text mb-3" style="min-height:3.6em; line-height:1.2em; overflow:hidden;">{{ Str::limit(strip_tags($a->description_id), 160) }}</p>
                                    @endif

                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <div class="text-muted small">
                                            @if ($a->rating)
                                                <i class="bi bi-star-fill"></i> {{ $a->rating }}
                                            @else
                                                <i class="bi bi-star"></i> –
                                            @endif
                                            @if ($a->rating_count)
                                                <span>({{ $a->rating_count }})</span>
                                            @endif
                                        </div>
                                        <div class="price">
                                            @if ($a->starting_price)
                                                From Rp {{ number_format($a->starting_price, 0, ',', '.') }}
                                            @else
                                                &nbsp;
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light border text-center">Belum ada attraction aktif untuk destinasi ini.</div>
                        </div>
                    @endforelse
                </div>
            </div> --}}

            {{-- ATTRACTIONS SECTION (match template structure) --}}
            {{-- <div class="attractions-section" data-aos="fade-up" data-aos-delay="300">
                <div class="section-header">
                    <h2>Must-Visit Attractions in {{ $title }}</h2>
                    <p>Experience the best of what {{ $title }} has to offer</p>
                </div>

                <div class="row gy-4">
                    @forelse ($d->attractions as $a)
                        @php
                            $aName = $a->{$nameKey} ?: $a->name_id;
                            $thumb = $a->image_main ?: $a->image_thumb ?: asset('tour/img/travel/destination-3.webp');
                            $delay = 100 + ($loop->index % 3) * 100;
                            $short = $a->subtitle_id ?: Str::limit(strip_tags($a->description_id), 160);
                        @endphp

                        <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $delay }}">
                            <div class="attraction-item">
                                <div class="attraction-image">
                                    <img src="{{ $thumb }}" alt="{{ $aName }}" class="img-fluid" loading="lazy">
                                </div>
                                <div class="attraction-content">
                                    <h4>{{ $aName }}</h4>
                                    @if ($short)
                                        <p>{{ $short }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light border text-center">Belum ada attraction aktif untuk destinasi ini.</div>
                        </div>
                    @endforelse
                </div>
            </div> --}}

            {{-- ATTRACTIONS SECTION (match template structure) --}}
            <div class="attractions-section" data-aos="fade-up" data-aos-delay="300">
                <div class="section-header">
                    <h2>Must-Visit Attractions in {{ $title }}</h2>
                    <p>Experience the best of what {{ $title }} has to offer</p>
                </div>

                <div class="row gy-4">
                    @forelse ($d->attractions as $a)
                        @php
                            $aName = $a->{$nameKey} ?: $a->name_id;
                            $thumb = $a->image_main ?: $a->image_thumb ?: asset('tour/img/travel/destination-3.webp');
                            $delay = 100 + ($loop->index % 3) * 100;
                            $short = $a->subtitle_id ?: \Illuminate\Support\Str::limit(strip_tags($a->description_id), 160);
                            // URL detail (pakai named route yg kita buat sebelumnya)
                            $detailUrl = route('attractions.show', $a->slug);
                            // Jika Anda ingin pakai singular path: $detailUrl = url('/attraction/'.$a->slug);
                        @endphp

                        <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $delay }}">
                            <div class="attraction-item position-relative">
                                <div class="attraction-image">
                                    <a href="{{ $detailUrl }}">
                                        <img src="{{ $thumb }}" alt="{{ $aName }}" class="img-fluid" loading="lazy">
                                    </a>
                                </div>
                                <div class="attraction-content">
                                    <h4 class="mb-1">
                                        <a href="{{ $detailUrl }}" class="text-decoration-none">{{ $aName }}</a>
                                    </h4>
                                    @if ($short)
                                        <p class="mb-0">{{ $short }}</p>
                                    @endif
                                </div>

                                {{-- Membuat seluruh card bisa diklik --}}
                                <a class="stretched-link" href="{{ $detailUrl }}" aria-label="View {{ $aName }}"></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light border text-center">Belum ada attraction aktif untuk destinasi ini.</div>
                        </div>
                    @endforelse
                </div>
            </div>



            {{-- MAP --}}
            @if ($d->lat && $d->lng)
                <div class="map-section mt-5" data-aos="fade-up" data-aos-delay="250">
                    <div class="section-header">
                        <h2>Explore on Map</h2>
                        <p class="text-muted">Key area of {{ $title }}</p>
                    </div>
                    <div class="map-embed">
                        <iframe src="https://www.google.com/maps?q={{ $d->lat }},{{ $d->lng }}&z=11&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@section('_scripts')
    {{-- Jika master mu belum include AOS, Swiper, dll, biarkan layout yang handle. Tidak wajib tambahan JS di sini. --}}
@endsection
