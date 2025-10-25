@extends('layouts.landing.master')

@section('_styles')
    <style>
        .attraction-tile {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 14px
        }

        /* Override: judul attraction jadi putih & tebal */
        .attraction-info h4 {
            margin: 0 0 4px;
            color: #fff;
            /* putih */
            font-weight: 800;
            /* tebal */
        }


        .attraction-tile .tile-image img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            display: block
        }

        .attraction-tile .overlay-content {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, .65) 100%);
            padding: 18px;
            color: #fff;
            transition: transform .35s ease
        }

        .attraction-tile:hover .overlay-content {
            transform: translateY(-6px)
        }

        .badge-chip {
            display: inline-block;
            font-size: .72rem;
            font-weight: 600;
            padding: .25rem .55rem;
            border-radius: 999px;
            background: #fff;
            color: #111;
            margin-right: .35rem;
            margin-bottom: .35rem
        }

        .attraction-info h4 {
            margin: 0 0 4px
        }

        .meta-line {
            display: flex;
            justify-content: space-between;
            gap: .75rem;
            font-size: .9rem;
            opacity: .9
        }

        .rating-stars {
            letter-spacing: 1px
        }

        .price {
            font-weight: 800
        }
    </style>
@endsection

@section('content')
    {{-- Page Title --}}
    <div class="page-title dark-background" data-aos="fade" style="background-image:url({{ asset('tour/img/travel/showcase-8.webp') }});">
        <div class="container position-relative">
            <h1>Attractions</h1>
            <p>Find the must-visit attractions and photo spots across West Sumatra.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Attractions</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2>Popular Attractions</h2>
                    <p class="mb-5">Curated highlights, cultural icons, and scenic points — ready for your itinerary.</p>
                </div>
            </div>

            @php
                $locale = app()->getLocale();
                $nameKey = in_array($locale, ['id', 'en', 'zh']) ? "name_{$locale}" : 'name_id';
                $subtitleKey = in_array($locale, ['id', 'en', 'zh']) ? "subtitle_{$locale}" : 'subtitle_id';
                $cityKey = in_array($locale, ['id', 'en', 'zh']) ? "city_{$locale}" : 'city_id';
                $locKey = in_array($locale, ['id', 'en', 'zh']) ? "location_label_{$locale}" : 'location_label_id';
            @endphp

            <div class="row gy-4 mb-5">
                @forelse ($attractions as $a)
                    @php
                        $title = $a->{$nameKey} ?: $a->name_id;
                        $img = $a->image_main ?: $a->image_thumb ?: asset('tour/img/travel/destination-3.webp');
                        $labelCity = $a->{$locKey} ?: $a->{$cityKey};

                        $price = $a->starting_price ? ($a->currency_code === 'IDR' ? 'Rp ' . number_format($a->starting_price, 0, ',', '.') : number_format($a->starting_price / 100, 2) . ' ' . $a->currency_code) : null;

                        $href = route('attractions.show', $a->slug);
                    @endphp

                    <div class="col-lg-4 col-md-6">
                        <a href="{{ $href }}" class="attraction-tile position-relative">
                            <div class="tile-image">
                                <img src="{{ $img }}" alt="{{ $title }}" class="img-fluid" loading="lazy">
                                <div class="overlay-content">
                                    <div class="attraction-info w-100">
                                        {{-- Chips/Badges --}}
                                        <div class="mb-1">
                                            @if ($a->badge_label_id)
                                                <span class="badge-chip">{{ $a->badge_label_id }}</span>
                                            @endif
                                            @if ($a->is_popular_choice)
                                                <span class="badge-chip">Popular</span>
                                            @endif
                                            @if ($a->is_best_value)
                                                <span class="badge-chip">Best Value</span>
                                            @endif
                                            @if ($a->is_limited_spots)
                                                <span class="badge-chip">Limited</span>
                                            @endif
                                            @if ($labelCity)
                                                <span class="badge-chip">{{ $labelCity }}</span>
                                            @endif
                                        </div>

                                        {{-- Judul putih & tebal --}}
                                        <h4 class="mb-1">{{ $title }}</h4>

                                        {{-- meta: rating & price --}}
                                        {{-- <div class="meta-line">
                                            <div class="rating-stars">
                                                @if ($a->rating)
                                                    @php $stars = floor($a->rating); @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="{{ $i <= $stars ? 'text-warning' : 'text-light' }}">★</span>
                                                    @endfor
                                                    <small>{{ number_format($a->rating, 1) }}</small>
                                                    @if ($a->rating_count)
                                                        <small>({{ number_format($a->rating_count) }})</small>
                                                    @endif
                                                @else
                                                    <small class="opacity-75">Unrated</small>
                                                @endif
                                            </div>
                                            <div>
                                                @if ($price)
                                                    <span class="price">{{ $price }}</span>
                                                @else
                                                    <small class="opacity-75">—</small>
                                                @endif
                                            </div>
                                        </div> --}}

                                        {{-- Tidak ada deskripsi panjang di sini --}}
                                    </div>
                                </div>
                            </div>
                            <span class="stretched-link" aria-hidden="true"></span>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center">Belum ada attraction aktif.</div>
                    </div>
                @endforelse
            </div>


            {{-- Pagination --}}
            @if ($attractions instanceof \Illuminate\Pagination\LengthAwarePaginator && $attractions->hasPages())
                <section id="pagination-2" class="pagination-2 section pt-0">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <ul class="list-unstyled d-flex align-items-center gap-2 m-0">

                                @php
                                    $current = $attractions->currentPage();
                                    $last = $attractions->lastPage();

                                    // Halaman yang akan ditampilkan: 1, (current-1), current, (current+1), last
                                    $pages = collect([1, $current - 1, $current, $current + 1, $last])
                                        ->filter(fn($p) => $p >= 1 && $p <= $last)
                                        ->unique()
                                        ->sort()
                                        ->values()
                                        ->all();
                                @endphp

                                {{-- Prev --}}
                                <li class="{{ $attractions->onFirstPage() ? 'disabled' : '' }}">
                                    @if ($attractions->onFirstPage())
                                        <span><i class="bi bi-chevron-left"></i></span>
                                    @else
                                        <a href="{{ $attractions->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
                                    @endif
                                </li>

                                {{-- Pages with ellipsis --}}
                                @foreach ($pages as $i => $page)
                                    @if ($i > 0 && $page - $pages[$i - 1] > 1)
                                        <li>…</li>
                                    @endif

                                    @if ($page == $current)
                                        <li><a href="#" class="active">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $attractions->url($page) }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Next --}}
                                <li class="{{ $current == $last ? 'disabled' : '' }}">
                                    @if ($current == $last)
                                        <span><i class="bi bi-chevron-right"></i></span>
                                    @else
                                        <a href="{{ $attractions->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            @endif


        </div>
    </section>
@endsection

@section('_scripts')
    {{-- Tidak perlu Isotope/filters, jadi tanpa JS tambahan --}}
@endsection
