<!DOCTYPE html>
<html lang="{{ __('landing.html_lang') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('landing.title') }}</title>
    <meta name="description" content="{{ __('landing.meta_description') }}" />
    <meta property="og:title" content="{{ __('landing.og_title') }}" />
    <meta property="og:description" content="{{ __('landing.og_description') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://images.unsplash.com/photo-1548013146-72479768bada?q=80&w=1600&auto=format&fit=crop" />
    <meta name="theme-color" content="#0ea5e9">

    <!-- Tailwind Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a'
                        },
                        accent: '#f59e0b'
                    },
                    boxShadow: {
                        soft: '0 10px 30px rgba(2, 6, 23, 0.08)'
                    }
                }
            }
        }
    </script>
    <style>
        .container-pad {
            padding-left: clamp(1rem, 6vw, 4rem);
            padding-right: clamp(1rem, 6vw, 4rem)
        }

        .glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.66)
        }
    </style>
</head>

<body class="text-slate-800 antialiased">
    <!-- NAVBAR -->
    <header class="fixed w-full z-30">
        <div class="container-pad">
            <nav class="flex items-center justify-between py-4">
                <a href="{{ route('landing', ['lang' => app()->getLocale()]) }}" class="flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-brand-600 text-white font-bold shadow-soft">RG</span>
                    <span class="font-semibold text-slate-900">{{ __('landing.brand') }}</span>
                </a>
                <ul class="hidden md:flex items-center gap-8 text-sm">
                    <li><a href="#layanan" class="hover:text-brand-600">{{ __('landing.nav.services') }}</a></li>
                    <li><a href="#destinasi" class="hover:text-brand-600">{{ __('landing.nav.destinations') }}</a></li>
                    <li><a href="#tentang" class="hover:text-brand-600">{{ __('landing.nav.about') }}</a></li>
                    <li><a href="#testimoni" class="hover:text-brand-600">{{ __('landing.nav.testimonials') }}</a></li>
                    <li><a href="#faq" class="hover:text-brand-600">{{ __('landing.nav.faq') }}</a></li>
                </ul>
                <div class="hidden md:flex items-center gap-3">
                    <a href="#kontak" class="px-4 py-2 rounded-xl border border-brand-600 text-brand-700 hover:bg-brand-50">{{ __('landing.nav.contact') }}</a>
                    <a href="https://wa.me/{{ $wa_number }}" target="_blank" class="px-4 py-2 rounded-xl bg-brand-600 text-white hover:bg-brand-700">{{ __('landing.nav.whatsapp') }}</a>
                </div>
                <div class="md:flex items-center gap-2 hidden">
                    <span class="text-xs text-slate-500">{{ __('landing.locale_switch') }}:</span>
                    <a class="text-xs hover:text-brand-600" href="{{ route('set-locale', ['locale' => 'id']) }}">ID</a>
                    <a class="text-xs hover:text-brand-600" href="{{ route('set-locale', ['locale' => 'en']) }}">EN</a>
                    <a class="text-xs hover:text-brand-600" href="{{ route('set-locale', ['locale' => 'cn']) }}">中文</a>
                </div>
                <button id="menuBtn" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/80 shadow-soft" aria-label="Open menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden hidden glass container-pad py-4">
                <ul class="grid gap-3 text-sm">
                    <li><a href="#layanan" class="block py-2">{{ __('landing.nav.services') }}</a></li>
                    <li><a href="#destinasi" class="block py-2">{{ __('landing.nav.destinations') }}</a></li>
                    <li><a href="#tentang" class="block py-2">{{ __('landing.nav.about') }}</a></li>
                    <li><a href="#testimoni" class="block py-2">{{ __('landing.nav.testimonials') }}</a></li>
                    <li><a href="#faq" class="block py-2">{{ __('landing.nav.faq') }}</a></li>
                    <li class="pt-2 flex gap-2">
                        <a href="#kontak" class="flex-1 text-center px-4 py-2 rounded-xl border border-brand-600 text-brand-700">{{ __('landing.nav.contact') }}</a>
                        <a href="https://wa.me/{{ $wa_number }}" target="_blank" class="flex-1 text-center px-4 py-2 rounded-xl bg-brand-600 text-white">{{ __('landing.nav.whatsapp') }}</a>
                    </li>
                    <li class="pt-2 flex gap-2 text-xs">
                        <span class="text-slate-500">{{ __('landing.locale_switch') }}:</span>
                        <a class="hover:text-brand-600" href="{{ route('set-locale', ['locale' => 'id']) }}">ID</a>
                        <a class="hover:text-brand-600" href="{{ route('set-locale', ['locale' => 'en']) }}">EN</a>
                        <a class="hover:text-brand-600" href="{{ route('set-locale', ['locale' => 'cn']) }}">中文</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="relative min-h-[90vh] grid place-items-center bg-slate-900 text-white">
        <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?q=80&w=2000&auto=format&fit=crop" alt="{{ __('landing.hero.bg_alt') }}" class="absolute inset-0 w-full h-full object-cover opacity-60" />
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/70 via-slate-900/40 to-slate-900/80"></div>
        <div class="relative container-pad text-center">
            <span class="inline-block px-3 py-1 rounded-full bg-white/10 ring-1 ring-white/30 text-xs tracking-wider">{{ __('landing.hero.badge') }}</span>
            <h1 class="mt-6 text-4xl md:text-6xl font-extrabold leading-tight">
                {!! str_replace(':accent', '<span class="text-accent">' . __('landing.hero.accent') . '</span>', __('landing.hero.headline')) !!}
            </h1>
            <p class="mt-4 md:mt-6 text-base md:text-lg text-slate-200 max-w-3xl mx-auto">{{ __('landing.hero.sub') }}</p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="#paket" class="px-6 py-3 rounded-2xl bg-accent text-slate-900 font-semibold hover:opacity-90 shadow-soft">{{ __('landing.hero.cta_primary') }}</a>
                <a href="#kontak" class="px-6 py-3 rounded-2xl bg-white/10 ring-1 ring-white/40 hover:bg-white/20">{{ __('landing.hero.cta_secondary') }}</a>
            </div>
            <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto text-left">
                @foreach (__('landing.hero.stats') as $s)
                    <div class="glass rounded-2xl p-4">
                        <p class="text-3xl font-bold">{{ $s['value'] }}</p>
                        <p class="text-sm text-slate-100/90">{{ $s['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="layanan" class="py-16 md:py-24 bg-white">
        <div class="container-pad max-w-7xl mx-auto">
            <div class="md:flex items-end justify-between gap-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.services.title') }}</h2>
                    <p class="mt-2 text-slate-600">{{ __('landing.services.desc') }}</p>
                </div>
                <div class="mt-4 md:mt-0 text-sm text-slate-500">{{ __('landing.services.langs') }}</div>
            </div>
            <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach (__('landing.services.cards') as $i => $card)
                    <article class="rounded-2xl border border-slate-200 p-6 hover:shadow-soft transition">
                        <div class="h-12 w-12 rounded-xl bg-brand-50 text-brand-700 grid place-items-center font-bold">{{ $i + 1 }}</div>
                        <h3 class="mt-4 font-semibold text-lg">{{ $card['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $card['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- DESTINATIONS -->
    <section id="destinasi" class="py-16 md:py-24 bg-slate-50">
        <div class="container-pad max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.dest.title') }}</h2>
            <p class="mt-2 text-slate-600">{{ __('landing.dest.desc') }}</p>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $images = ['https://images.unsplash.com/photo-1576330383202-36b571bc12e1?q=80&w=1600&auto=format&fit=crop', 'https://images.unsplash.com/photo-1565106430482-8e9e8fdc427c?q=80&w=1600&auto=format&fit=crop', 'https://images.unsplash.com/photo-1547394765-185e1e68f34e?q=80&w=1600&auto=format&fit=crop', 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=1600&auto=format&fit=crop', 'https://images.unsplash.com/photo-1533556305149-93a4f30a8d0a?q=80&w=1600&auto=format&fit=crop', 'https://images.unsplash.com/photo-1533848057-9c8c046b266a?q=80&w=1600&auto=format&fit=crop'];
                @endphp
                @foreach (__('landing.dest.items') as $i => $d)
                    <div class="group rounded-2xl overflow-hidden bg-white border border-slate-200 hover:shadow-soft">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $images[$i] }}" alt="{{ $d['alt'] }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                        </div>
                        <div class="p-5">
                            <h3 class="font-semibold text-lg">{{ $d['title'] }}</h3>
                            <p class="text-sm text-slate-600 mt-1">{{ $d['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="tentang" class="py-16 md:py-24 bg-white">
        <div class="container-pad max-w-5xl mx-auto grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.about.title') }}</h2>
                <p class="mt-4 text-slate-600">{{ __('landing.about.p1') }}</p>
                <div class="mt-6 grid gap-4">
                    <div class="p-5 rounded-2xl border border-slate-200">
                        <h3 class="font-semibold">{{ __('landing.about.vision_title') }}</h3>
                        <p class="text-sm text-slate-600 mt-1">{{ __('landing.about.vision') }}</p>
                    </div>
                    <div class="p-5 rounded-2xl border border-slate-200">
                        <h3 class="font-semibold">{{ __('landing.about.mission_title') }}</h3>
                        <ul class="mt-2 text-sm text-slate-600 list-disc pl-5 space-y-1">
                            @foreach (__('landing.about.missions') as $m)
                                <li>{{ $m }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1578496781985-790ba21a3d95?q=80&w=1600&auto=format&fit=crop" alt="{{ __('landing.about.rg_alt') }}" class="rounded-3xl shadow-soft w-full h-[420px] object-cover" />
                <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-4 shadow-soft border border-slate-200">
                    <p class="text-sm text-slate-600">{{ __('landing.about.badge') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PACKAGES -->
    <section id="paket" class="py-16 md:py-24 bg-slate-900 text-white">
        <div class="container-pad max-w-7xl mx-auto">
            <div class="md:flex items-end justify-between gap-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.packages.title') }}</h2>
                    <p class="mt-2 text-slate-300">{{ __('landing.packages.desc') }}</p>
                </div>
                <a href="#kontak" class="mt-4 md:mt-0 inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-accent text-slate-900 font-semibold hover:opacity-90">
                    {{ __('landing.packages.cta') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <div class="mt-10 grid lg:grid-cols-3 gap-6">
                @foreach (__('landing.packages.cards') as $card)
                    <div class="rounded-2xl bg-white text-slate-800 p-6 border border-slate-200">
                        <h3 class="font-semibold text-lg">{{ $card['title'] }}</h3>
                        <ul class="mt-3 text-sm text-slate-600 space-y-2 list-disc pl-5">
                            @foreach ($card['bullets'] as $b)
                                <li>{{ $b }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-5 flex items-center justify-between">
                            <span class="text-brand-700 font-semibold">{{ $card['price'] }}</span>
                            <a href="#kontak" class="px-4 py-2 rounded-xl bg-brand-600 text-white hover:bg-brand-700">{{ $card['ask'] }}</a>
                        </div>
                        @if (!empty($card['note']))
                            <p class="mt-2 text-[12px] text-slate-500">{{ $card['note'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-sm text-slate-300">{{ __('landing.packages.market') }}</div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimoni" class="py-16 md:py-24 bg-white">
        <div class="container-pad max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.testi.title') }}</h2>
            <div class="mt-8 grid md:grid-cols-3 gap-6">
                @foreach (__('landing.testi.items') as $t)
                    <figure class="rounded-2xl border border-slate-200 p-6">
                        <blockquote class="text-slate-700">{{ $t['quote'] }}</blockquote>
                        <figcaption class="mt-4 text-sm text-slate-500">{{ $t['by'] }}</figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-16 md:py-24 bg-slate-50">
        <div class="container-pad max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.faq.title') }}</h2>
            <div class="mt-8 grid gap-4">
                @foreach (__('landing.faq.items') as $i => $f)
                    <details class="rounded-2xl bg-white border border-slate-200 p-5" @if ($i === 0) open @endif>
                        <summary class="font-semibold cursor-pointer">{{ $f['q'] }}</summary>
                        <p class="mt-2 text-sm text-slate-600">{{ $f['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="kontak" class="py-16 md:py-24 bg-white">
        <div class="container-pad max-w-5xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-10">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold">{{ __('landing.contact.title') }}</h2>
                    <p class="mt-2 text-slate-600">{{ __('landing.contact.desc') }}</p>
                    <div class="mt-6 space-y-3 text-sm">
                        <p><strong>{{ __('landing.contact.email_label') }}</strong>: <a class="text-brand-700 hover:underline" href="mailto:{{ $email }}">{{ $email }}</a></p>
                        <p><strong>{{ __('landing.contact.wa_label') }}</strong>: <a class="text-brand-700 hover:underline" href="https://wa.me/{{ $wa_number }}" target="_blank">+{{ $wa_number }}</a></p>
                        <p><strong>{{ __('landing.contact.hours') }}</strong></p>
                    </div>
                </div>
                <form class="rounded-3xl border border-slate-200 p-6 shadow-soft bg-white" onsubmit="event.preventDefault(); alert('{{ __('landing.contact.form.thanks') }}'); this.reset();">
                    <div class="grid gap-4">
                        <div>
                            <label class="text-sm text-slate-600">{{ __('landing.contact.form.name') }}</label>
                            <input required type="text" class="mt-1 w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-400" placeholder="{{ __('landing.contact.form.name') }}" />
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm text-slate-600">{{ __('landing.contact.form.email') }}</label>
                                <input required type="email" class="mt-1 w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-400" placeholder="email@domain.com" />
                            </div>
                            <div>
                                <label class="text-sm text-slate-600">{{ __('landing.contact.form.phone') }}</label>
                                <input type="tel" class="mt-1 w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-400" placeholder="62xxxxxxxxxx" />
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-slate-600">{{ __('landing.contact.form.interest') }}</label>
                            <select class="mt-1 w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-400">
                                <option>{{ __('landing.contact.form.interest_placeholder') }}</option>
                                @foreach (__('landing.dest.items') as $d)
                                    <option>{{ $d['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-sm text-slate-600">{{ __('landing.contact.form.message') }}</label>
                            <textarea rows="4" class="mt-1 w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-brand-400" placeholder="{{ __('landing.contact.form.message_ph') }}"></textarea>
                        </div>
                        <button class="px-6 py-3 rounded-2xl bg-brand-600 text-white font-semibold hover:bg-brand-700">{{ __('landing.contact.form.send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-300">
        <div class="container-pad max-w-7xl mx-auto py-12 grid md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-brand-600 text-white font-bold">RG</span>
                    <span class="font-semibold text-white">{{ __('landing.brand') }}</span>
                </div>
                <p class="mt-4 text-sm">{{ __('landing.meta_description') }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-white">{{ __('landing.footer.services') }}</h4>
                <ul class="mt-3 text-sm space-y-2">
                    @foreach (__('landing.services.cards') as $c)
                        <li>{{ $c['title'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white">{{ __('landing.footer.contact') }}</h4>
                <ul class="mt-3 text-sm space-y-2">
                    <li><a class="hover:underline" href="mailto:{{ $email }}">{{ $email }}</a></li>
                    <li><a class="hover:underline" href="https://wa.me/{{ $wa_number }}" target="_blank">+{{ $wa_number }}</a></li>
                    <li>{{ __('landing.footer.location') }}</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="container-pad max-w-7xl mx-auto py-6 text-xs text-slate-400 flex flex-wrap items-center justify-between gap-2">
                <p>© <span id="year"></span> {{ __('landing.brand') }}. {{ __('landing.footer.rights') }}</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-white">{{ __('landing.footer.privacy') }}</a>
                    <a href="#" class="hover:text-white">{{ __('landing.footer.terms') }}</a>
                </div>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/{{ $wa_number }}" target="_blank" class="fixed bottom-5 right-5 inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-emerald-500 text-white shadow-soft hover:bg-emerald-600">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5" fill="currentColor">
            <path d="M19.11 17.29c-.27-.14-1.61-.8-1.86-.89-.25-.09-.43-.14-.61.14-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.14-1.13-.42-2.16-1.34-.8-.72-1.35-1.61-1.51-1.88-.16-.27-.02-.41.12-.54.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.46-.16 0-.34-.02-.52-.02s-.48.07-.73.34c-.25.27-.96.94-.96 2.29 0 1.35.98 2.66 1.12 2.84.14.18 1.93 2.94 4.67 4.12.65.28 1.16.45 1.56.58.65.21 1.24.18 1.7.11.52-.08 1.61-.66 1.84-1.31.23-.64.23-1.19.16-1.31-.07-.12-.25-.2-.52-.34z" />
            <path d="M26.35 5.65C23.47 2.77 19.84 1.2 16 1.2 8.15 1.2 1.94 7.42 1.94 15.26c0 2.37.62 4.68 1.81 6.72L1.2 30.8l8.99-2.49c1.97 1.07 4.2 1.64 6.47 1.64h.01c7.85 0 14.06-6.22 14.06-14.06 0-3.75-1.46-7.28-4.34-10.16zm-10.34 22.4h-.01c-2.02 0-4-.54-5.72-1.57l-.41-.24-5.34 1.48 1.43-5.2-.26-.43c-1.15-1.9-1.76-4.09-1.76-6.33 0-6.77 5.51-12.28 12.28-12.28 3.28 0 6.37 1.28 8.7 3.61 2.33 2.33 3.61 5.42 3.61 8.7 0 6.77-5.51 12.28-12.27 12.28z" />
        </svg>
        {{ __('landing.nav.whatsapp') }}
    </a>

    <script>
        // year in footer
        document.getElementById('year').textContent = new Date().getFullYear();
        // mobile menu toggle
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        if (btn && menu) {
            btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        }
    </script>
</body>

</html>
