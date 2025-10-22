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
