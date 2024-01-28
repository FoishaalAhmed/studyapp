<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(getFavIcon()) }}">
    <!-- CSS -->
    @include('layouts.partials.css')

</head>

<body class="sticky-header">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <div id="main-wrapper" class="main-wrapper">

        <!--=        Header Area Start       	=-->
        <header class="edu-header header-style-1 header-fullwidth">
            <div class="header-top-bar">
                <div class="container-fluid">
                    <div class="header-top">
                        <div class="header-top-left">
                            <div class="header-notify">
                                {{ __('First 20 students get 50% discount.') }} <a
                                    href="#">{{ __('Hurry up!') }}</a>
                            </div>
                        </div>
                        <div class="header-top-right">
                            <ul class="header-info">
                                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                <li><a href="#"><i class="icon-phone"></i>{{ __('Call') }}:
                                        {{ $contact->phone }}</a></li>
                                <li><a href="mailto:{{ $contact->phone }}" target="_blank"><i
                                            class="icon-envelope"></i>{{ __('Email') }}: {{ $contact->phone }}</a>
                                </li>
                                <li class="social-icon">
                                    <a href="{{ $contact->facebook }}"><i class="icon-facebook"></i></a>
                                    <a href="{{ $contact->instagram }}"><i class="icon-instagram"></i></a>
                                    <a href="{{ $contact->twitter }}"><i class="icon-twitter"></i></a>
                                    <a href="{{ $contact->linkedin }}"><i class="icon-linkedin2"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="edu-sticky-placeholder"></div>
            <div class="header-mainmenu">
                <div class="container-fluid">
                    <div class="header-navbar">
                        <div class="header-brand">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img class="logo-light"
                                        src="{{ asset(darkLogo()) }}"
                                        alt="Corporate Logo">
                                    <img class="logo-dark"
                                        src="{{ asset(lightLogo()) }}"
                                        alt="Corporate Logo">
                                </a>
                            </div>
                        </div>
                        <div class="header-mainnav">
                            @include('layouts.partials.web-menu')
                        </div>
                        <div class="header-right">
                            <ul class="header-action">
                                <li class="search-bar">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <button class="search-btn" type="button"><i class="icon-2"></i></button>
                                    </div>
                                </li>
                                <li class="icon search-icon">
                                    <a href="javascript:void(0)" class="search-trigger">
                                        <i class="icon-2"></i>
                                    </a>
                                </li>
                                {{-- <li class="icon cart-icon">
                                    <a href="#" class="cart-icon">
                                        <i class="icon-3"></i>
                                        <span class="count">0</span>
                                    </a>
                                </li> --}}
                                <li class="mobile-menu-bar d-block d-xl-none">
                                    <button class="hamberger-button">
                                        <i class="icon-54"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup-mobile-menu">
                <div class="inner">
                    <div class="header-top">
                        <div class="logo">
                            <a href="index.html">
                                <img class="logo-light"
                                    src="{{ asset(darkLogo()) }}"
                                    alt="Corporate Logo">
                                <img class="logo-dark"
                                    src="{{ asset(lightLogo()) }}"
                                    alt="Corporate Logo">
                            </a>
                        </div>
                        <div class="close-menu">
                            <button class="close-button">
                                <i class="icon-73"></i>
                            </button>
                        </div>
                    </div>
                    @include('layouts.partials.mobile-menu')
                </div>
            </div>
            <!-- Start Search Popup  -->
            <div class="edu-search-popup">
                <div class="content-wrap">
                    <div class="site-logo">
                        <img class="logo-light" src="{{ asset(darkLogo()) }}"
                            alt="Corporate Logo">
                        <img class="logo-dark" src="{{ asset(lightLogo()) }}"
                            alt="Corporate Logo">
                    </div>
                    <div class="close-button">
                        <button class="close-trigger"><i class="icon-73"></i></button>
                    </div>
                    <div class="inner">
                        <form class="search-form" action="#">
                            <input type="text" class="edublink-search-popup-field" placeholder="Search Here...">
                            <button class="submit-button"><i class="icon-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Search Popup  -->
        </header>

        @yield('content')

        <!--= Footer Area =-->
        @include('layouts.partials.footer')
        <!-- End Footer Area  -->

    </div>

    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    @include('layouts.partials.script')

</body>

</html>
