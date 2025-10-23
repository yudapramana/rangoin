{{-- resources/views/tours/show.blade.php --}}
@extends('layouts.landing.master')
@section('title', $tour->title ?? 'Tour Details')

@section('_styles')
    <style>
        .tour-hero .hero-image-wrapper {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
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
            padding: 18px 20px;
            width: 100%;
        }

        .hero-meta,
        .tour-meta {
            display: flex;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
            color: #e5e7eb;
            font-size: 14px;
        }

        .tour-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .tour-badge {
            background: #111827;
            color: #fff;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .price-chip {
            background: #fff;
            color: #111827;
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
        }

        /*
                                                    .tour-highlights ul {
                                                        padding-left: 0;
                                                        list-style: none;
                                                        margin: 0;
                                                        display: grid;
                                                        grid-template-columns: repeat(2, minmax(0, 1fr));
                                                        gap: 8px 14px;
                                                    }

                                                    .tour-highlights li {
                                                        display: flex;
                                                        gap: 8px;
                                                        align-items: flex-start;
                                                    }

                                                    **/

        /* .itinerary-timeline {
                            position: relative;
                        }

                        .itinerary-item {
                            display: flex;
                            gap: 16px;
                            padding: 16px 0;
                            border-bottom: 1px solid #eef2f7;
                        }

                        .day-number {
                            min-width: 64px;
                            height: 64px;
                            border-radius: 12px;
                            background: #f3f4f6;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: 700;
                        } */

        .day-content h4 {
            margin-bottom: 6px;
        }

        .day-details {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            color: #6b7280;
            font-size: 14px;
            margin-top: 6px;
        }

        .chip {
            background: #f3f4f6;
            color: #374151;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 12px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
        }

        @media (max-width: 992px) {
            .tour-highlights ul {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endsection

@section('content')

    @php
        // Fallback gambar hero
        $hero = $tour->hero_image_url ?: asset('tour/img/travel/showcase-8.webp');

        // Formatter harga: IDR -> "IDR 2.150K", selain itu angka biasa
        $fmtPrice = function (?int $amount, ?string $ccy) {
            if (!$amount) {
                return null;
            }
            $ccy = strtoupper($ccy ?: 'IDR');
            if ($ccy === 'IDR') {
                $k = $amount / 1000;
                return sprintf('IDR %sK', number_format($k, 0, ',', '.'));
            }
            return sprintf('%s %s', $ccy, number_format($amount, 0, ',', '.'));
        };

        $displayPrice = $fmtPrice($tour->sale_price ?: $tour->price, $tour->currency);
        $durationText = "{$tour->duration_days} " . __('landing.tours.days') . (isset($tour->duration_nights) ? " / {$tour->duration_nights} " . __('landing.tours.nights') : '');
        $destinations = collect($tour->countries ?? [])
            ->filter()
            ->implode(', ');
        $badgeText = match ($tour->badge_type) {
            'top_rated' => __('landing.badges.top_rated'),
            'newly_added' => __('landing.badges.newly_added'),
            'limited' => $tour->badge_label_id ?? ($tour->badge_label_en ?? ($tour->badge_label_zh ?? __('landing.badges.limited'))),
            default => null,
        };
    @endphp

    {{-- Page Title (breadcrumb) --}}
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('tour/img/travel/showcase-8.webp') }});">
        <div class="container position-relative">
            <h1>{{ __('landing.tours.details_title') ?? 'Tour Details' }}</h1>
            <p>{{ __('landing.tours.details_subtitle') ?? 'Plan your journey with complete details and day-by-day itinerary.' }}</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li><a href="{{ route('tours.index') }}">{{ __('landing.tours.all') ?? 'All Tours' }}</a></li>
                    <li class="current">{{ $tour->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="travel-tour-details" class="travel-tour-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            {{-- Hero --}}
            <div class="tour-hero mb-4">
                <div class="hero-image-wrapper">
                    <img src="{{ $hero }}" alt="{{ $tour->title }}" class="img-fluid w-100">
                    <div class="hero-overlay">
                        <div class="hero-content">
                            <h1 class="mb-1">{{ $tour->title }}</h1>
                            @if ($tour->tagline)
                                <p class="mb-2">{{ $tour->tagline }}</p>
                            @endif
                            <div class="hero-meta">
                                <span class="duration"><i class="bi bi-calendar"></i> {{ $durationText }}</span>
                                @if ($destinations)
                                    <span class="destination"><i class="bi bi-geo-alt"></i> {{ $destinations }}</span>
                                @endif
                                @if ($tour->rating_avg)
                                    <span class="rating"><i class="bi bi-star-fill"></i> {{ number_format($tour->rating_avg, 1) }} ({{ $tour->rating_count }})</span>
                                @endif
                                @if ($displayPrice)
                                    <span class="price-chip">{{ __('landing.tours.from') ?? 'From' }} {{ $displayPrice }}</span>
                                @endif
                            </div>
                            <div class="tour-badges">
                                @if ($badgeText)
                                    <span class="tour-badge">{{ $badgeText }}</span>
                                @endif
                                @if ($tour->badge_type === 'limited' && $tour->badge_limited_spots)
                                    <span class="tour-badge">{{ __('landing.tours.spots_left') ?? 'Spots left' }}: {{ $tour->badge_limited_spots }}</span>
                                @endif
                                @if ($tour->group_max)
                                    <span class="tour-badge"><i class="bi bi-people"></i> {{ __('landing.tours.max') ?? 'Max' }} {{ $tour->group_max }}</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <a href="#booking" class="btn btn-primary">{{ __('landing.tours.check_availability') ?? 'Check Availability' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Overview + Highlights --}}
            <div class="tour-overview" data-aos="fade-up" data-aos-delay="150">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>{{ __('landing.tours.overview') ?? 'Tour Overview' }}</h2>
                        @if ($tour->overview)
                            {!! nl2br(e($tour->overview)) !!}
                        @elseif($tour->short_desc)
                            <p>{{ $tour->short_desc }}</p>
                        @endif

                        <div class="tour-meta mt-3">
                            @if ($tour->code)
                                <span class="chip"><i class="bi bi-hash"></i> {{ $tour->code }}</span>
                            @endif
                            @if ($tour->group_min)
                                <span class="chip"><i class="bi bi-people"></i> {{ __('landing.tours.min') ?? 'Min' }} {{ $tour->group_min }}</span>
                            @endif
                            @if ($tour->currency)
                                <span class="chip"><i class="bi bi-cash-coin"></i> {{ strtoupper($tour->currency) }}</span>
                            @endif
                        </div>

                        @if ($tour->topics && $tour->topics->count())
                            <div class="card p-3 mt-3">
                                <h6 class="mb-2">{{ __('landing.tours.themes') ?? 'Themes' }}</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($tour->topics as $t)
                                        <span class="chip">{{ $t->name ?? $t->slug }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        @if ($tour->highlights && $tour->highlights->count())
                            <div class="tour-highlights card p-3">
                                <h3 class="mb-2">{{ __('landing.tours.highlights') ?? 'Tour Highlights' }}</h3>
                                <ul>
                                    @foreach ($tour->highlights as $h)
                                        <li><i class="bi bi-check-circle"></i> <span>{{ method_exists($h, 'item') ? $h->item() : $h->label ?? '' }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Itinerary --}}
            @if ($tour->itineraryDays && $tour->itineraryDays->count())
                <div class="tour-itinerary mt-5" data-aos="fade-up" data-aos-delay="200">
                    <h2>{{ __('landing.tours.itinerary') ?? 'Day-by-Day Itinerary' }}</h2>
                    <div class="itinerary-timeline">
                        @foreach ($tour->itineraryDays->sortBy('day_number') as $d)
                            @php
                                $title = $d->title ?? ($d->title_en ?? null);
                                $desc = $d->description ?? ($d->description_en ?? null);
                                $loc = $d->location ?? ($d->location_en ?? null);
                                $acc = $d->accommodation ?? ($d->accommodation_en ?? null);

                                // Nama kolom boolean bisa berbeda; siapkan fallback
                                $bf = $d->meal_breakfast ?? ($d->include_breakfast ?? false);
                                $lu = $d->meal_lunch ?? ($d->include_lunch ?? false);
                                $di = $d->meal_dinner ?? ($d->include_dinner ?? false);
                            @endphp
                            <div class="itinerary-item">
                                <div class="day-number">{{ __('landing.tours.day') ?? 'Day' }} {{ $d->day_number }}</div>
                                <div class="day-content">
                                    <h4>{{ $title }}</h4>
                                    @if ($desc)
                                        <p>{{ $desc }}</p>
                                    @endif
                                    <div class="day-details">
                                        @if ($loc)
                                            <span class="location"><i class="bi bi-geo-alt"></i> {{ $loc }}</span>
                                        @endif
                                        @if ($acc)
                                            <span class="accommodation"><i class="bi bi-building"></i> {{ $acc }}</span>
                                        @endif
                                        @if ($bf || $lu || $di)
                                            <span class="meals">
                                                <i class="bi bi-cup-hot"></i>
                                                {{ $bf ? 'B' : '—' }} / {{ $lu ? 'L' : '—' }} / {{ $di ? 'D' : '—' }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Booking (CTA sederhana; silakan sambungkan ke form Anda) --}}
            <div id="booking" class="booking-section mt-5" data-aos="fade-up" data-aos-delay="250">
                <div class="booking-card card p-4">
                    <h2 class="mb-3">{{ __('landing.tours.book_this') ?? 'Book This Tour' }}</h2>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if ($displayPrice)
                            <span class="chip">{{ __('landing.tours.starting_from') ?? 'Starting from' }} {{ $displayPrice }}</span>
                        @endif
                        <span class="chip"><i class="bi bi-clock"></i> {{ $durationText }}</span>
                        @if ($tour->group_max)
                            <span class="chip"><i class="bi bi-people"></i> {{ __('landing.tours.max') ?? 'Max' }} {{ $tour->group_max }}</span>
                        @endif
                    </div>

                    {{-- Ganti action ke rute/form Anda; di sini hanya contoh link WA --}}
                    <a class="btn btn-primary" href="https://wa.me/6281234567890?text={{ rawurlencode('Halo, saya tertarik dengan paket: ' . $tour->title . ' (' . $durationText . ')') }}" target="_blank">
                        <i class="bi bi-whatsapp"></i> {{ __('landing.tours.chat_whatsapp') ?? 'Chat via WhatsApp' }}
                    </a>
                </div>
            </div>

            {{-- (Opsional) Gallery sederhana: jika Anda punya relasi images, ganti di sini --}}
            @if (false)
                <div class="tour-gallery mt-5" data-aos="fade-up" data-aos-delay="300">
                    <h2>{{ __('landing.tours.gallery') ?? 'Photo Gallery' }}</h2>
                    <div class="gallery-grid">
                        @foreach ($tour->images as $img)
                            <div class="gallery-item">
                                <a href="{{ $img->url }}" class="glightbox"><img src="{{ $img->url }}" class="img-fluid" loading="lazy"></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@section('_scripts')
    {{-- Inisialisasi glightbox bila Anda pakai galeri --}}
    @if (false)
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script>
            const lightbox = GLightbox({
                selector: '.glightbox'
            });
        </script>
    @endif
@endsection
