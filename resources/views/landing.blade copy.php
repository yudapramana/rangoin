<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pandan View Mandeh - Pesona Mandeh</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('sailor/img/favicon_io/favicon-32x32.png') }}" rel="icon">
  <link href="{{ asset('sailor/img/apple-touch-icon.png') }}" rel="'apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{  asset('sailor/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{  asset('sailor/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{  asset('sailor/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{  asset('sailor/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{  asset('sailor/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{  asset('sailor/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{  asset('sailor/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{  asset('sailor/css/style.css') }}" rel="stylesheet">


  <link rel="stylesheet" href="{{  asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">

  <!-- our project just needs Font Awesome Solid + Brands -->
  <link href="{{  asset('font-awesome-6.4.0/css/fontawesome.css') }}" rel="stylesheet">
  <link href="{{  asset('font-awesome-6.4.0/css/brands.css') }}" rel="stylesheet">
  <link href="{{  asset('font-awesome-6.4.0/css/solid.css') }}  " rel="stylesheet">
  <!-- <script src="https://kit.fontawesome.com/061189203a.js" crossorigin="anonymous"></script> -->

  <!-- =======================================================
  * Template Name: Sailor
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


  <style>
    .carousel-caption {
      right: 3%;
    }

    .fa.rounded-circle,
    .fa.rounded,
    .fa.rounded-0,
    .fa.rounded-leaf,
    .fa.img-thumbnail,
    .fa.shadow {
      display: inline-block;
      vertical-align: middle;
      text-align: center;
      width: 2.7rem;
      height: 2.7rem;
      line-height: 2.7rem;
      background-color: #f8f9fa;
    }

    .s_share .s_share_facebook,
    .s_share .s_share_facebook:hover,
    .s_share .s_share_facebook:focus {
      color: #3b5998;
    }

    .s_share .s_share_twitter,
    .s_share .s_share_twitter:hover,
    .s_share .s_share_twitter:focus {
      color: #1da1f2;
    }

    .s_share .s_share_tiktok,
    .s_share .s_share_tiktok:hover,
    .s_share .s_share_tiktok:focus {
      color: #ffffff;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo me-auto"><a href="index.html">Sailor</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" class="logo me-auto"><img src="{{ asset('sailor/img/logo.png') }}" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>

          <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="about.html">About</a></li>
              <li><a href="team.html">Team</a></li>
              <li><a href="testimonials.html">Testimonials</a></li>

              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li><a href="blog.html">Blog</a></li>

          <li><a href="contact.html">Contact</a></li>
          <!-- <li><a href="index.html" class="getstarted">Get Started</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(sailor/img/slide/pv-1.jpg)">
          <div class="carousel-container">
            <div class="container">

              <h2>Pandan View <span>Mandeh</span></h2>
              <p>Tempat Wisata, Penginapan, Restoran dan Cafe.</p>
              <a href="#about" class="btn-get-started scrollto">Selengkapnya</a>

              <div class="carousel-caption text-end">
                <div class="s_share text-end">

                  <a href="https://web.facebook.com/{{$accountfb}}" class="s_share_facebook" target="_blank" data-original-title="" title="" aria-describedby="tooltip278388">
                    <i class="coba-fb fa fa-brands fa-facebook rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip702620"></i>
                  </a>&nbsp;
                  <a href="https://twitter.com/{{$account}}" class="s_share_twitter" target="_blank">
                    <i class="fa fa-1x fa-brands fa-twitter rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip560917"></i>
                  </a>&nbsp;
                  <a href="https://www.instagram.com/{{$account}}" class="s_share_linkedin" target="_blank">
                    <span class="fa fa-1x fa-brands fa-instagram rounded shadow-sm" style="color: rgb(255, 0, 0);" data-original-title="" title="" aria-describedby="tooltip780758"></span>
                  </a>&nbsp;
                  <a href="https://www.youtube.com/channel/{{$channel}}" class="s_share_google" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-youtube rounded shadow-sm" style="" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>&nbsp;
                  <a href="https://www.tiktok.com/@pandan_view_mandeh" style="color:black !important;" class="s_share_tiktok" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-tiktok rounded shadow-sm" style="color:black !important;" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>
                  <a href="mailto:?body=https%3A%2F%2Fcijaluresorts.com%2F&amp;subject=Home%20%7C%20Cijalu%20Resort" class="s_share_email" data-original-title="" title="" aria-describedby="tooltip910272">
                  </a>
                </div>

                <div class="pb16 pt16 s_btn text-right pt-2" data-name="Buttons">
                  <a href="https://wa.me/6281210003536" class="flat btn btn-secondary flat" data-original-title="" title="" aria-describedby="tooltip695437" style="font-size:small!important;">&nbsp;Book now</a>
                  <a href="/contactus" class="btn btn-success flat flat contact-cijalu" data-original-title="" title="" aria-describedby="tooltip296367" style="font-size:small!important;">Contact us</a>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(sailor/img/slide/pv-3.jpg)">
          <div class="carousel-container">
            <div class="container">

              <h2>Pandan View <span>Mandeh</span></h2>
              <p>Tempat Wisata, Penginapan, Restoran dan Cafe.</p>
              <a href="#about" class="btn-get-started scrollto">Selengkapnya</a>

              <div class="carousel-caption text-end">
                <div class="s_share text-end">

                  <a href="https://web.facebook.com/{{$accountfb}}" class="s_share_facebook" target="_blank" data-original-title="" title="" aria-describedby="tooltip278388">
                    <i class="coba-fb fa fa-brands fa-facebook rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip702620"></i>
                  </a>&nbsp;
                  <a href="https://twitter.com/{{$account}}" class="s_share_twitter" target="_blank">
                    <i class="fa fa-1x fa-brands fa-twitter rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip560917"></i>
                  </a>&nbsp;
                  <a href="https://www.instagram.com/{{$account}}" class="s_share_linkedin" target="_blank">
                    <span class="fa fa-1x fa-brands fa-instagram rounded shadow-sm" style="color: rgb(255, 0, 0);" data-original-title="" title="" aria-describedby="tooltip780758"></span>
                  </a>&nbsp;
                  <a href="https://www.youtube.com/channel/{{$channel}}" class="s_share_google" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-youtube rounded shadow-sm" style="" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>&nbsp;
                  <a href="https://www.tiktok.com/@pandan_view_mandeh" style="color:black !important;" class="s_share_tiktok" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-tiktok rounded shadow-sm" style="color:black !important;" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>
                  <a href="mailto:?body=https%3A%2F%2Fcijaluresorts.com%2F&amp;subject=Home%20%7C%20Cijalu%20Resort" class="s_share_email" data-original-title="" title="" aria-describedby="tooltip910272">
                  </a>
                </div>

                <div class="pb16 pt16 s_btn text-right pt-2" data-name="Buttons">
                  <a href="https://wa.me/6281210003536" class="flat btn btn-secondary flat" data-original-title="" title="" aria-describedby="tooltip695437" style="font-size:small!important;">&nbsp;Book now</a>
                  <a href="/contactus" class="btn btn-success flat flat contact-cijalu" data-original-title="" title="" aria-describedby="tooltip296367" style="font-size:small!important;">Contact us</a>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(sailor/img/slide/pv-4.jpg)">
          <div class="carousel-container">
            <div class="container">

              <h2>Pandan View <span>Mandeh</span></h2>
              <p>Tempat Wisata, Penginapan, Restoran dan Cafe.</p>
              <a href="#about" class="btn-get-started scrollto">Selengkapnya</a>

              <div class="carousel-caption text-end">
                <div class="s_share text-end">

                  <a href="https://web.facebook.com/{{$accountfb}}" class="s_share_facebook" target="_blank" data-original-title="" title="" aria-describedby="tooltip278388">
                    <i class="coba-fb fa fa-brands fa-facebook rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip702620"></i>
                  </a>&nbsp;
                  <a href="https://twitter.com/{{$account}}" class="s_share_twitter" target="_blank">
                    <i class="fa fa-1x fa-brands fa-twitter rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip560917"></i>
                  </a>&nbsp;
                  <a href="https://www.instagram.com/{{$account}}" class="s_share_linkedin" target="_blank">
                    <span class="fa fa-1x fa-brands fa-instagram rounded shadow-sm" style="color: rgb(255, 0, 0);" data-original-title="" title="" aria-describedby="tooltip780758"></span>
                  </a>&nbsp;
                  <a href="https://www.youtube.com/channel/{{$channel}}" class="s_share_google" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-youtube rounded shadow-sm" style="" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>&nbsp;
                  <a href="https://www.tiktok.com/@pandan_view_mandeh" style="color:black !important;" class="s_share_tiktok" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-tiktok rounded shadow-sm" style="color:black !important;" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>
                  <a href="mailto:?body=https%3A%2F%2Fcijaluresorts.com%2F&amp;subject=Home%20%7C%20Cijalu%20Resort" class="s_share_email" data-original-title="" title="" aria-describedby="tooltip910272">
                  </a>
                </div>

                <div class="pb16 pt16 s_btn text-right pt-2" data-name="Buttons">
                  <a href="https://wa.me/6281210003536" class="flat btn btn-secondary flat" data-original-title="" title="" aria-describedby="tooltip695437" style="font-size:small!important;">&nbsp;Book now</a>
                  <a href="/contactus" class="btn btn-success flat flat contact-cijalu" data-original-title="" title="" aria-describedby="tooltip296367" style="font-size:small!important;">Contact us</a>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item" style="background-image: url(sailor/img/slide/pv-6.jpg)">
          <div class="carousel-container">
            <div class="container">

              <h2>Pandan View <span>Mandeh</span></h2>
              <p>Tempat Wisata, Penginapan, Restoran dan Cafe.</p>
              <a href="#about" class="btn-get-started scrollto">Selengkapnya</a>

              <div class="carousel-caption text-end">
                <div class="s_share text-end">

                  <a href="https://web.facebook.com/{{$accountfb}}" class="s_share_facebook" target="_blank" data-original-title="" title="" aria-describedby="tooltip278388">
                    <i class="coba-fb fa fa-brands fa-facebook rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip702620"></i>
                  </a>&nbsp;
                  <a href="https://twitter.com/{{$account}}" class="s_share_twitter" target="_blank">
                    <i class="fa fa-1x fa-brands fa-twitter rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip560917"></i>
                  </a>&nbsp;
                  <a href="https://www.instagram.com/{{$account}}" class="s_share_linkedin" target="_blank">
                    <span class="fa fa-1x fa-brands fa-instagram rounded shadow-sm" style="color: rgb(255, 0, 0);" data-original-title="" title="" aria-describedby="tooltip780758"></span>
                  </a>&nbsp;
                  <a href="https://www.youtube.com/channel/{{$channel}}" class="s_share_google" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-youtube rounded shadow-sm" style="" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>&nbsp;
                  <a href="https://www.tiktok.com/@pandan_view_mandeh" style="color:black !important;" class="s_share_tiktok" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-tiktok rounded shadow-sm" style="color:black !important;" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>
                  <a href="mailto:?body=https%3A%2F%2Fcijaluresorts.com%2F&amp;subject=Home%20%7C%20Cijalu%20Resort" class="s_share_email" data-original-title="" title="" aria-describedby="tooltip910272">
                  </a>
                </div>

                <div class="pb16 pt16 s_btn text-right pt-2" data-name="Buttons">
                  <a href="https://wa.me/6281210003536" class="flat btn btn-secondary flat" data-original-title="" title="" aria-describedby="tooltip695437" style="font-size:small!important;">&nbsp;Book now</a>
                  <a href="/contactus" class="btn btn-success flat flat contact-cijalu" data-original-title="" title="" aria-describedby="tooltip296367" style="font-size:small!important;">Contact us</a>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 5 -->
        <div class="carousel-item" style="background-image: url(sailor/img/slide/pv-7.jpg)">
          <div class="carousel-container">
            <div class="container">

              <h2>Pandan View <span>Mandeh</span></h2>
              <p>Tempat Wisata, Penginapan, Restoran dan Cafe.</p>
              <a href="#about" class="btn-get-started scrollto">Selengkapnya</a>

              <div class="carousel-caption text-end">
                <div class="s_share text-end">

                  <a href="https://web.facebook.com/{{$accountfb}}" class="s_share_facebook" target="_blank" data-original-title="" title="" aria-describedby="tooltip278388">
                    <i class="coba-fb fa fa-brands fa-facebook rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip702620"></i>
                  </a>&nbsp;
                  <a href="https://twitter.com/{{$account}}" class="s_share_twitter" target="_blank">
                    <i class="fa fa-1x fa-brands fa-twitter rounded shadow-sm" data-original-title="" title="" aria-describedby="tooltip560917"></i>
                  </a>&nbsp;
                  <a href="https://www.instagram.com/{{$account}}" class="s_share_linkedin" target="_blank">
                    <span class="fa fa-1x fa-brands fa-instagram rounded shadow-sm" style="color: rgb(255, 0, 0);" data-original-title="" title="" aria-describedby="tooltip780758"></span>
                  </a>&nbsp;
                  <a href="https://www.youtube.com/channel/{{$channel}}" class="s_share_google" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-youtube rounded shadow-sm" style="" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>&nbsp;
                  <a href="https://www.tiktok.com/@pandan_view_mandeh" style="color:black !important;" class="s_share_tiktok" target="_blank" data-original-title="" title="" aria-describedby="tooltip37995">
                    <span class="fa fa-1x fa-brands fa-tiktok rounded shadow-sm" style="color:black !important;" data-original-title="" title="" aria-describedby="tooltip294870"></span>
                  </a>
                  <a href="mailto:?body=https%3A%2F%2Fcijaluresorts.com%2F&amp;subject=Home%20%7C%20Cijalu%20Resort" class="s_share_email" data-original-title="" title="" aria-describedby="tooltip910272">
                  </a>
                </div>

                <div class="pb16 pt16 s_btn text-right pt-2" data-name="Buttons">
                  <a href="https://wa.me/6281210003536" class="flat btn btn-secondary flat" data-original-title="" title="" aria-describedby="tooltip695437" style="font-size:small!important;">&nbsp;Book now</a>
                  <a href="/contactus" class="btn btn-success flat flat contact-cijalu" data-original-title="" title="" aria-describedby="tooltip296367" style="font-size:small!important;">Contact us</a>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6">
            <h2>Eum ipsam laborum deleniti velitena</h2>
            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assum perenda sruen jonee trave</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequa</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li>
            </ul>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('sailor/img/clients/client-1.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('sailor/img/clients/client-2.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('sailor/img/clients/client-3.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('sailor/img/clients/client-4.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('sailor/img/clients/client-5.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('sailor/img/clients/client-6.png')}}" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="row">
          <div class="col-md-6">
            <div class="icon-box">
              <i class="bi bi-briefcase"></i>
              <h4><a href="#">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="bi bi-card-checklist"></i>
              <h4><a href="#">Dolor Sitema</a></h4>
              <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="bi bi-bar-chart"></i>
              <h4><a href="#">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="bi bi-binoculars"></i>
              <h4><a href="#">Nemo Enim</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="bi bi-brightness-high"></i>
              <h4><a href="#">Magni Dolore</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="bi bi-calendar4-week"></i>
              <h4><a href="#">Eiusmod Tempor</a></h4>
              <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-1.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 1</h4>
                <p>App</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-1.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-2.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-2.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-3.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 2</h4>
                <p>App</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-3.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-4.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 2</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-4.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-5.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 2</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-5.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-6.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 3</h4>
                <p>App</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-6.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-7.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 1</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-7.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-8.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 3</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-8.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="{{ asset('sailor/img/portfolio/portfolio-9.jpg') }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="{{ asset('sailor/img/portfolio/portfolio-9.jpg') }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="portfolio-details-lightbox" data-glightbox="type: external" title="Portfolio Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-5 col-md-6">
            <div class="footer-info">
              <h4>Our Brands</h4>
              <h3>
                <img src="{{ asset('sailor/img/logo.png') }}" alt="" class="img-fluid" width="200">
              </h3>
              <p>
                Jln. Mandeh, Ampang Pulai <br>
                Koto XI Tarusan, Kabupaten Pesisir Selatan, <br>
                Sumatera Barat 25654 <br> <br>

              </p>

            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Navigation</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Contact Us</h4>
            <strong>Phone:</strong> +62811-660-358<br>
            <strong>Email:</strong> pandanviewmandeh@gmail.com<br>

            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Sailor</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/sailor-free-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('sailor/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('sailor/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('sailor/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('sailor/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('sailor/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('sailor/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('sailor/js/main.js') }}"></script>

</body>

</html>