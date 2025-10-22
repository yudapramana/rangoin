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

<style>
    /* Hilangkan padding default section agar benar-benar full-bleed */
    .travel-hero.section {
        padding: 0;
        position: relative;
        min-height: 100vh;
        /* fallback jika utilitas tidak ter-load */
    }

    /* Wrapper background video */
    .hero-background {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 0;
    }

    /* Video 100% tinggi layar + cover */
    .hero-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        display: block;
    }

    /* Overlay agar teks kontras (bisa disesuaikan) */
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0.45) 0%,
                rgba(0, 0, 0, 0.35) 40%,
                rgba(0, 0, 0, 0.55) 100%);
        z-index: 1;
    }

    /* Pastikan konten di atas video */
    #travel-hero .container {
        position: relative;
        z-index: 2;
    }

    /* Aksesibilitas & preferensi user: kurangi gerak bila diminta */
    @media (prefers-reduced-motion: reduce) {
        .hero-video {
            animation: none !important;
        }

        .hero-video[autoplay] {
            /* hentikan autoplay untuk user yang pilih reduce motion */
            /* Tidak bisa diubah via CSS, tapi kita bisa nonaktifkan loop efek visual */
        }
    }

    /* Perangkat kecil: beri sedikit padding agar teks tidak terlalu mepet */
    @media (max-width: 575.98px) {
        #travel-hero .container {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }
</style>
