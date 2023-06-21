<!-- ========== Menu ========== -->
    <div class="app-menu">

        <!-- Brand Logo -->
        <div class="logo-box">
            <!-- Brand Logo Light -->
            <a href="{{ url('/') }}" class="logo-light">
                <img src="{{ asset(largeLogo()) }}" alt="logo" class="logo-lg">
                <img src="{{ asset(smallLogo()) }}" alt="small logo" class="logo-sm">
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ url('/') }}" class="logo-dark">
                <img src="{{ asset(largeLogo()) }}" alt="dark logo" class="logo-lg">
                <img src="{{ asset(smallLogo()) }}" alt="small logo" class="logo-sm">
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
                            <span class="menu-icon"><i class="fe-users"></i></span>
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

                    <li class="menu-item {{ request()->is('admin/categories') || request()->is('admin/category-types') || request()->is('admin/sub-categories') || request()->is('admin/sub-categories/*') || request()->is('admin/child-categories') || request()->is('admin/child-categories/*') ? 'menuitem-active' : '' }}">
                        <a href="#menuCategories" data-bs-toggle="collapse" class="menu-link">
                            <span class="menu-icon"><i class="fe-book"></i></span>
                            <span class="menu-text"> {{ __('Categories') }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('admin/categories') || request()->is('admin/category-types') || request()->is('admin/sub-categories/*') || request()->is('admin/sub-categories') || request()->is('admin/child-categories') || request()->is('admin/child-categories/*') ? 'show' : '' }}" id="menuCategories">
                            <ul class="sub-menu">
                                <li class="menu-item {{ request()->is('admin/category-types') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.category-types.index') }}" class="menu-link {{request()->is('admin/category-types') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Category Type') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/categories') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.categories.index') }}" class="menu-link {{request()->is('admin/categories') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Main Category') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/sub-categories') || request()->is('admin/sub-categories/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.sub-categories.index') }}" class="menu-link {{ request()->is('admin/sub-categories') || request()->is('admin/sub-categories/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Sub Category') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/child-categories') || request()->is('admin/child-categories/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.child-categories.index') }}" class="menu-link {{ request()->is('admin/child-categories') || request()->is('admin/child-categories/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Child Category') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item {{ request()->is('admin/addons') || request()->is('admin/settings') ? 'menuitem-active' : '' }}">
                        <a href="#menuSetting" data-bs-toggle="collapse" class="menu-link">
                            <span class="menu-icon"><i class="fe-settings"></i></span>
                            <span class="menu-text"> {{ __('Settings') }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('admin/addons/*') || request()->is('admin/settings') ? 'show' : '' }}" id="menuSetting">
                            <ul class="sub-menu">
                                <li class="menu-item {{ request()->is('admin/addons/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.addons.index') }}" class="menu-link {{ request()->is('admin/addons/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Addons') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/settings') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.settings.create') }}" class="menu-link {{ request()->is('admin/settings/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Settings') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if (module('Forum') && isActive('Forum'))
                        <li class="menu-item {{ request()->is('admin/forums/*') || request()->is('admin/forums') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.forums.index') }}" class="menu-link {{ request()->is('admin/forums/*') || request()->is('admin/forums') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="mdi mdi-text-box-multiple-outline"></i></span>
                                <span class="menu-text"> {{ __('Forums') }} </span>
                            </a>
                        </li>
                    @endif

                    
                    @if (module('UserAccess') && isActive('UserAccess'))
                        <li class="menu-item {{ request()->is('admin/writer-logs') || request()->is('admin/user-logs') || request()->is('admin/accesses') || request()->is('admin/accesses/*') ? 'menuitem-active' : '' }}">
                            <a href="#menuUserAccess" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="fe-unlock"></i></span>
                                <span class="menu-text"> {{ __('User Access') }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/accesses') || request()->is('admin/accesses/*') || request()->is('admin/writer-logs') || request()->is('admin/user-logs') ? 'show' : '' }}" id="menuUserAccess">
                                <ul class="sub-menu">
                                    <li class="menu-item {{ request()->is('admin/accesses') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.accesses.index') }}" class="menu-link {{ request()->is('admin/accesses') | request()->is('admin/accesses/*') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('User Access') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('admin/quries') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.queries.index') }}" class="menu-link {{ request()->is('admin/quries') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('User Query') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('admin/user-logs') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.logs.user') }}" class="menu-link {{ request()->is('admin/user-logs') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('User Logs') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('admin/writer-logs') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.logs.writer') }}" class="menu-link {{ request()->is('admin/writer-logs') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Writer Logs') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (module('Job') && isActive('Job'))
                        <li class="menu-item {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') || request()->is('admin/job-categories') || request()->is('admin/job-users') || request()->is('admin/job-users/*') ? 'menuitem-active' : '' }}">
                            <a href="#menuJob" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="fe-unlock"></i></span>
                                <span class="menu-text"> {{ __('Jobs') }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') || request()->is('admin/job-categories') || request()->is('admin/job-users') || request()->is('admin/job-users/*') ? 'show' : '' }}" id="menuJob">
                                <ul class="sub-menu">
                                    <li class="menu-item {{ request()->is('admin/job-categories') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.job-categories.index') }}" class="menu-link {{ request()->is('admin/job-categories') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Job Category') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.jobs.index') }}" class="menu-link {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Jobs') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('admin/job-users') || request()->is('admin/job-users/*') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.jobs.users.index') }}" class="menu-link {{ request()->is('admin/job-users') || request()->is('admin/job-users/*') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Job Applied') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (module('Page') && isActive('Page'))
                        <li class="menu-item {{ request()->is('admin/pages/*') || request()->is('admin/pages') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.pages.index') }}" class="menu-link {{ request()->is('admin/pages/*') || request()->is('admin/pages') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="mdi mdi-text-box-multiple-outline"></i></span>
                                <span class="menu-text"> {{ __('Pages') }} </span>
                            </a>
                        </li>
                    @endif

                    @if (module('Blog') && isActive('Blog'))
                        <li class="menu-item {{ request()->is('admin/blogs') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.blogs.index') }}" class="menu-link {{ request()->is('admin/blogs') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fe-book"></i></span>
                                <span class="menu-text"> {{ __('Blog') }} </span>
                            </a>
                        </li>
                    @endif

                    @if (module('Testimonial') && isActive('Testimonial'))
                        <li class="menu-item {{ request()->is('admin/testimonials') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('admin.testimonials.index') }}" class="menu-link {{ request()->is('admin/testimonials') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fe-user-check"></i></span>
                                <span class="menu-text"> {{ __('Testimonial') }} </span>
                            </a>
                        </li>
                    @endif

                    <li class="menu-item {{ request()->is('admin/contacts') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.contacts.index') }}" class="menu-link {{ request()->is('admin/contacts') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-map"></i></span>
                            <span class="menu-text"> {{ __('Contact') }} </span>
                        </a>
                    </li>

                @endif


            </ul>
            <!--- End Menu -->
            <div class="clearfix"></div>
        </div>
    </div>
<!-- ========== Left menu End ========== -->