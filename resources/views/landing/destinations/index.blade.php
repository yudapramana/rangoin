@extends('layouts.landing.master')

@section('_styles')
    {{-- Tambahan style ringan untuk tile --}}
    <style>
        .destination-tile {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 14px;
        }

        .destination-tile .tile-image img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block;
        }

        .destination-tile .overlay-content {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, .65) 100%);
            padding: 18px;
            color: #fff;
            transition: transform .35s ease;
        }

        .destination-tile:hover .overlay-content {
            transform: translateY(-6px);
        }

        .destination-info h4 {
            margin: 0 0 4px;
        }

        .destination-tag {
            display: inline-block;
            font-size: .75rem;
            padding: .2rem .5rem;
            border-radius: 999px;
            background: #fff;
            color: #111;
            margin-bottom: .35rem;
        }

        .destination-filters {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            justify-content: center;
        }

        .destination-filters li {
            list-style: none;
            padding: .45rem .9rem;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            cursor: pointer;
            user-select: none;
        }

        .destination-filters .filter-active {
            background: #111;
            color: #fff;
            border-color: #111;
        }
    </style>
@endsection

@section('content')
    {{-- Page Title --}}
    <div class="page-title dark-background" data-aos="fade" style="background-image:url({{ asset('tour/img/travel/showcase-8.webp') }});">
        <div class="container position-relative">
            <h1>{{ $title }}</h1>
            <p>{{ $lead }}</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Destinations Grid --}}
    <section id="travel-destinations" class="travel-destinations section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2>{{ $subtitle }}</h2>
                    <p class="mb-5">{{ $lead }}</p>
                </div>
            </div>

            {{-- FILTERS --}}
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                <ul class="destination-filters isotope-filters" data-aos="fade-up" data-aos-delay="200" id="filterList">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach ($filters as $f)
                        <li data-filter=".filter-{{ Str::slug($f) }}">{{ ucfirst($f) }}</li>
                    @endforeach
                    {{-- Bonus filter tipe administratif --}}
                    <li data-filter=".filter-kabupaten">Kabupaten</li>
                    <li data-filter=".filter-kota">Kota</li>
                </ul>

                {{-- GRID --}}
                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">
                    @php
                        $locale = app()->getLocale();
                        $nameKey = in_array($locale, ['id', 'en', 'zh']) ? "name_{$locale}" : 'name_id';
                    @endphp

                    @forelse ($destinations as $d)
                        @php
                            $name = $d->{$nameKey} ?: $d->name_id;
                            $img = $d->image_url ?: asset('tour/img/travel/destination-12.webp');
                            $filterClass = 'filter-' . Str::slug($d->filter ?: 'all');
                            $typeClass = 'filter-' . Str::slug($d->type); // kabupaten/kota
                        @endphp

                        <div class="col-lg-4 col-md-6 destination-item isotope-item {{ $filterClass }} {{ $typeClass }}">
                            <a href="{{ route('landing.destinations.show', $d->slug) }}" class="destination-tile">
                                <div class="tile-image">
                                    <img src="{{ $img }}" alt="{{ $name }}" class="img-fluid" loading="lazy">
                                    <div class="overlay-content">
                                        <div class="destination-info w-100">
                                            <span class="destination-tag">{{ ucfirst($d->type) }}</span>
                                            <h4>{{ $name }}</h4>
                                            @if ($d->lat && $d->lng)
                                                <p class="mb-1 opacity-75" style="font-size: .92rem;">
                                                    <i class="bi bi-geo-alt"></i> {{ number_format($d->lat, 4) }}, {{ number_format($d->lng, 4) }}
                                                </p>
                                            @endif
                                            <div class="d-flex justify-content-between small opacity-75">
                                                <span><i class="bi bi-bookmark-check"></i> {{ strtoupper($d->filter ?? 'general') }}</span>
                                                <span class="text-uppercase">{{ $d->slug }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-light border text-center">Belum ada destinasi aktif.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- CTA --}}
            <div class="row mt-5">
                <div class="col-lg-10 mx-auto text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="p-4 p-md-5 rounded-4 border">
                        <h3 class="mb-2">Need help picking the right place?</h3>
                        <p class="mb-4">Our travel advisors can curate a bespoke itinerary tailored to your preferences.</p>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <a href="{{ url('/contact') }}" class="btn btn-primary">Free Consultation</a>
                            <a href="{{ url('/tours') }}" class="btn btn-outline">Explore All Tours</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('_scripts')
    {{-- Jika master layout belum memuat plugin berikut, aktifkan CDN ini --}}
    <script src="https://cdn.jsdelivr.net/npm/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const grid = document.querySelector('.isotope-container');
            if (!grid) return;

            // init Isotope after images loaded
            imagesLoaded(grid, function() {
                const iso = new Isotope(grid, {
                    itemSelector: '.isotope-item',
                    layoutMode: 'masonry',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });

                // filter buttons
                const filters = document.querySelectorAll('#filterList li');
                filters.forEach(btn => {
                    btn.addEventListener('click', function() {
                        filters.forEach(b => b.classList.remove('filter-active'));
                        this.classList.add('filter-active');
                        const filter = this.getAttribute('data-filter');
                        iso.arrange({
                            filter
                        });
                    });
                });
            });
        });
    </script>
@endsection
