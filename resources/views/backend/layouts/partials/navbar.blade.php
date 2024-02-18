<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-1">
            <!-- Topbar Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="{{ url('/') }}" class="logo-light">
                    <img src="{{ asset(lightLogo()) }}" alt="logo" class="logo-lg">
                    <img src="{{ asset(smallLogo()) }}" alt="small logo" class="logo-sm">
                </a>

                <!-- Brand Logo Dark -->
                <a href="{{ url('/') }}" class="logo-dark">
                    <img src="{{ asset(darkLogo()) }}" alt="dark logo" class="logo-lg">
                    <img src="{{ asset(smallLogo()) }}" alt="small logo" class="logo-sm">
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <ul class="topbar-menu d-flex align-items-center">
            
            <!-- Fullscreen Button -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link waves-effect waves-light" href="#" data-toggle="fullscreen">
                    <i class="fe-maximize font-22"></i>
                </a>
            </li>

            <!-- Light/Dark Mode Toggle Button -->
            <li class="d-none d-sm-inline-block">
                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>

            <!-- User Dropdown -->
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if (file_exists(auth()->user()->photo))
                        <img src="{{ asset(auth()->user()->photo) }}" alt="user-image" class="rounded-circle">
                    @else
                        <img src="{{ asset('public/images/dummy/user.png') }}" alt="user-image" class="rounded-circle">
                    @endif
                    <span class="ms-1 d-none d-md-inline-block">
                        {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    @if (auth()->user()->hasRole('User'))
                        <a href="{{ route('user.profile') }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item" id="logout-button">
                        <i class="fe-log-out"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->