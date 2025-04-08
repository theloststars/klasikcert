<!-- footer begin -->
<footer class="section-dark">
    <div class="container">
        <div class="row gx-5">
           
            <div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget">
                            <h5>Quick Links</h5>
                            <ul>
                                <li><a href="{{ route('landingpage') }}"><i class="far fa-arrow-right"></i> Home</a></li>
                                <li><a href="{{ route('check.certificate') }}"><i class="far fa-arrow-right"></i>Certificate Checking</a></li>
                                <li><a href="#contact-us"><i class="far fa-arrow-right"></i>Contact-us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-6">
                        <div class="widget">
                            <h5>Our Services</h5>
                            <ul>
                                <x-navbar.services />
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 order-lg-2 order-sm-1">
                <div class="widget">
                    <div class="fw-bold text-white"><i class="icofont-wall-clock me-2 id-color-2"></i>We're Open</div>
                    <x-navbar.phonenumber />

                    <div class="spacer-20"></div>

                    <div class="fw-bold text-white"><i class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                    <x-navbar.address />

                    <div class="spacer-20"></div>

                    <div class="fw-bold text-white"><i class="icofont-envelope me-2 id-color-2"></i>Send a Message</div>
                    <x-navbar.officeemail />
                </div>
            </div>
            {{-- logo section --}}
            <x-navbar.footerlogos />
            
        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="de-flex">
                        <div class="de-flex-col">
                        Copyright &copy;2025 - KLASIK CERTIFICATION
                        </div>
                        {{-- <ul class="menu-simple">
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>