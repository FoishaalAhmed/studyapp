<!-- ========== Menu ========== -->
    <div class="app-menu">

        <!-- Brand Logo -->
        <div class="logo-box">
            <!-- Brand Logo Light -->
            <a href="{{ url('/') }}" class="logo-light">
                <img src="{{ asset('public/assets/backend/images/logo-light.png') }}" alt="logo" class="logo-lg">
                <img src="{{ asset('public/assets/backend/images/logo-sm.png') }}" alt="small logo" class="logo-sm">
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ url('/') }}" class="logo-dark">
                <img src="{{ asset('public/assets/backend/images/logo-dark.png') }}" alt="dark logo" class="logo-lg">
                <img src="{{ asset('public/assets/backend/images/logo-sm.png') }}" alt="small logo" class="logo-sm">
            </a>
        </div>

        <!-- menu-left -->
        <div class="scrollbar">

            <!--- Menu -->
            <ul class="menu">

                <li class="menu-title">{{ __('Navigation') }}</li>

                <li class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
                        <span class="menu-text"> {{ __('Dashboard') }} </span>
                    </a>
                </li>

                <li class="menu-title">{{ __('Web') }}</li>

                @if (auth()->user()->hasRole('Admin'))
                    <li class="menu-item {{ request()->is('admin/users/*') || request()->is('admin/users') || request()->is('admin/writers/*') || request()->is('admin/writers') || request()->is('admin/admins/*') || request()->is('admin/admins') ? 'menuitem-active' : '' }}">
                        <a href="#menuUsers" data-bs-toggle="collapse" class="menu-link">
                            <span class="menu-icon"><i class="fe-users "></i></span>
                            <span class="menu-text"> {{ __('Users') }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('admin/users/*') || request()->is('admin/users') || request()->is('admin/writers/*') || request()->is('admin/writers') || request()->is('admin/admins/*') || request()->is('admin/admins') ? 'show' : '' }}" id="menuUsers">
                            <ul class="sub-menu">
                                <li class="menu-item {{ request()->is('admin/users/*') || request()->is('admin/users') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.users.index') }}" class="menu-link {{ request()->is('admin/users/*') || request()->is('admin/users') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Users') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/writers/*') || request()->is('admin/writers') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.writers.index') }}" class="menu-link {{ request()->is('admin/writers/*') || request()->is('admin/writers') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Writers') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/admins/*') || request()->is('admin/admins') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.admins.index') }}" class="menu-link {{ request()->is('admin/admins/*') || request()->is('admin/admins') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Admins') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if (module('Page') && isActive('Page'))
                        <li class="menu-item {{ request()->is('admin/pages/*') || request()->is('admin/pages') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.pages.index') }}" class="menu-link {{ request()->is('admin/pages/*') || request()->is('admin/pages') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="mdi mdi-text-box-multiple-outline"></i></span>
                                <span class="menu-text"> {{ __('Pages') }} </span>
                            </a>
                        </li>
                    @endif
                    
                @endif


            </ul>
            <!--- End Menu -->
            <div class="clearfix"></div>
        </div>
    </div>
<!-- ========== Left menu End ========== -->