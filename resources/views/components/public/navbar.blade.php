<header class="header-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <!-- logo begin -->
                        <div id="logo">
                            <a href="{{ route('landingpage')}}">
                                <img class="logo-main" src="{{asset('uclean/images/KCI_logo.png')}}" alt="" >
                                <img class="logo-scroll" src="{{asset('uclean/images/KCIlogo.png')}}" alt="" >
                                <img class="logo-mobile" src="{{asset('uclean/images/KCIlogo.png')}}" alt="" >
                            </a>
                        </div>
                        <!-- logo close -->
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li><a class="menu-item" href="{{ route('landingpage')}}"> Home</a></li>
                            </li>
                            <li><a class="menu-item" href="#">Services</a>
                                <ul>
                                    <x-navbar.services />
                                </ul>
                            </li>
                            <li><a class="menu-item" href="#">About</a>
                                <ul>
                                    <x-navbar.abouts />
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">Check Certificate</a>
                                <ul>
                                    <li><a class="menu-item" href="{{ route('check.certificate') }}">  ISO Certificate</a></li>
                                <li><a class="menu-item" href="{{ route('check.training')}}">Training Certificate</a></li>
                                </ul>
                            </li>
                            {{-- <li><a class="menu-item" href="contact.html">Contact</a></li> --}}
                        </ul>
                    </div>
                    <div class="de-flex-col">
                        <div class="menu_side_area">
                            <div class="h-phone xs-hide">
                                {{-- <span>Need Help?</span> --}}
                                <h5>
                                    <x-navbar.phonenumber />
                                </h5>
                            </div>
                            <a href="#contact-us" class="btn-main">Contact Us Now</a>
                            <span id="menu-btn"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>