<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Acara Admin Panel')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('acaraAdminPanel/xhtml/vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('acaraAdminPanel/xhtml/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('acaraAdminPanel/xhtml/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('acaraAdminPanel/xhtml/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('acaraAdminPanel/xhtml/css/style.css') }}" rel="stylesheet">
    <link
        href="{{ asset('acaraAdminPanel/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap') }}"
        rel="stylesheet">
    @yield('heads')
    <style>
        input {
            color: #656773 !important;
        }
    </style>
</head>

<body>
    <x-acara.preloader />
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="{{ route('landingpage') }}" class="brand-logo">
                <img class="logo-compact" src="{{asset('fenzy/assets/images/KCIlogo.png')}}"
                    alt="">
                <img class="brand-title" src="{{asset('fenzy/assets/images/KCIlogo.png')}}"
                    alt="">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <x-acara.chatbox />
        <x-acara.navbar />
        <x-acara.sidebar />
        <div class="content-body">
            {{-- row --}}
            @yield('content')
        </div>
        <x-acara.footer />
    </div>
    <form action="{{ route('logout') }}" method="post" id="logoutForm">
        @csrf
    </form>
    <!-- Required vendors -->
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/js/custom.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/js/deznav-init.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/owl-carousel/owl.carousel.js') }}"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/peity/jquery.peity.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/apexchart/apexchart.js') }}"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('acaraAdminPanel/xhtml/js/dashboard/dashboard-1.js') }}"></script>

    @yield('scripts')

</body>

</html>
