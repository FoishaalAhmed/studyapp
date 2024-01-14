<!-- ========== Menu ========== -->
    <div class="app-menu">

        <!-- Brand Logo -->
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

                    <li class="menu-item {{ request()->is('admin/mcqs') || request()->is('admin/mcqs/*') || request()->is('admin/questions') || request()->is('admin/questions/*') || request()->is('admin/exam-types') || request()->is('admin/exams/*') || request()->is('admin/exams') || request()->is('admin/exam-questions/*') || request()->is('admin/exam-questions') || request()->is('admin/quizzes/*') || request()->is('admin/quizzes') || request()->is('admin/quiz-questions/*') || request()->is('admin/quiz-questions') || request()->is('admin/lecture-sheets/*') || request()->is('admin/lecture-sheets') || request()->is('admin/ebooks/*') || request()->is('admin/ebooks')? 'menuitem-active' : '' }}">
                        <a href="#resource" data-bs-toggle="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mdi mdi-share-variant"></i></span>
                            <span class="menu-text"> {{ __('Resources') }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('admin/mcqs') || request()->is('admin/mcqs/*') || request()->is('admin/questions') || request()->is('admin/questions/*') || request()->is('admin/exam-types') || request()->is('admin/exams/*') || request()->is('admin/exams') || request()->is('admin/exam-questions/*') || request()->is('admin/exam-questions') || request()->is('admin/lecture-sheets/*') || request()->is('admin/lecture-sheets') || request()->is('admin/ebooks/*') || request()->is('admin/ebooks') || request()->is('admin/quizzes/*') || request()->is('admin/quizzes') || request()->is('admin/quiz-questions/*') || request()->is('admin/quiz-questions') ? 'show' : '' }}" id="resource">
                            <ul class="sub-menu">
                                <li class="menu-item {{ request()->is('admin/mcqs/*') || request()->is('admin/mcqs') || request()->is('admin/questions') || request()->is('admin/questions/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.mcqs.index') }}" class="menu-link {{ request()->is('admin/mcqs/*') || request()->is('admin/mcqs') || request()->is('admin/questions') || request()->is('admin/questions/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Model Test') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('admin/exam-types') || request()->is('admin/exams/*') || request()->is('admin/exams') || request()->is('admin/exam-questions/*') || request()->is('admin/exam-questions') ? 'menuitem-active' : '' }}">
                                    <a href="#exam" data-bs-toggle="collapse" class="menu-link">
                                        <span class="menu-text"> {{ __('Exam') }} </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse {{ request()->is('admin/exam-types') || request()->is('admin/exams/*') || request()->is('admin/exams') || request()->is('admin/exam-questions/*') || request()->is('admin/exam-questions') ? 'show' : '' }}" id="exam">
                                        <ul class="sub-menu">
                                            <li class="menu-item {{ request()->is('admin/exam-types') ? 'menuitem-active' : '' }}">
                                                <a href="{{ route('admin.exam-types.index') }}" class="menu-link">
                                                    <span class="menu-text">{{ __('Type') }}</span>
                                                </a>
                                            </li>
                                            <li class="menu-item {{ request()->is('admin/exams/*') || request()->is('admin/exams') || request()->is('admin/exam-questions/*') || request()->is('admin/exam-questions') ? 'menuitem-active' : '' }}">
                                                <a href="{{ route('admin.exams.index') }}" class="menu-link">
                                                    <span class="menu-text">{{ __('Exam') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @if (module('LectureSheet') && isActive('LectureSheet'))
                                <li class="menu-item {{ request()->is('admin/lecture-sheets/*') || request()->is('admin/lecture-sheets') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lecture_sheets.index') }}" class="menu-link {{ request()->is('admin/lecture-sheets/*') || request()->is('admin/lecture-sheets') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Lecture Sheets') }}</span>
                                    </a>
                                </li>
                                @endif
                                @if (module('Ebook') && isActive('Ebook'))
                                <li class="menu-item {{ request()->is('admin/ebooks/*') || request()->is('admin/ebooks') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.ebooks.index') }}" class="menu-link {{ request()->is('admin/ebooks/*') || request()->is('admin/ebooks') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Ebooks') }}</span>
                                    </a>
                                </li>
                                @endif
                                @if (module('Quiz') && isActive('Quiz'))
                                <li class="menu-item {{ request()->is('admin/quizzes/*') || request()->is('admin/quizzes') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.quizzes.index') }}" class="menu-link {{ request()->is('admin/quizzes/*') || request()->is('admin/quizzes') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Quizzes') }}</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>

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

                    <li class="menu-item {{ request()->is('admin/subjects/*') || request()->is('admin/subjects') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.subjects.index') }}" class="menu-link {{ request()->is('admin/subjects/*') || request()->is('admin/subjects') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-book"></i></span>
                            <span class="menu-text"> {{ __('Subjects') }} </span>
                        </a>
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
                        <li class="menu-item {{ request()->is('admin/writer-logs') || request()->is('admin/user-logs') || request()->is('admin/writer-history') || request()->is('admin/accesses') || request()->is('admin/accesses/*') ? 'menuitem-active' : '' }}">
                            <a href="#menuUserAccess" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="fe-unlock"></i></span>
                                <span class="menu-text"> {{ __('User Access') }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/accesses') || request()->is('admin/accesses/*') || request()->is('admin/writer-logs') || request()->is('admin/writer-history') || request()->is('admin/user-logs') ? 'show' : '' }}" id="menuUserAccess">
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
                                    <li class="menu-item {{ request()->is('admin/writer-history') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.writer.history') }}" class="menu-link {{ request()->is('admin/writer-history') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Writer History') }}</span>
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

                    @if (
                        (module('Page') && isActive('Page')) || 
                        (module('Content') && isActive('Content')) ||
                        (module('Blog') && isActive('Blog')) ||
                        (module('Testimonial') && isActive('Testimonial')) ||
                        (module('Faq') && isActive('Faq'))

                    )
                        <li class="menu-item {{ request()->is('admin/pages/*') || request()->is('admin/pages') || request()->is('admin/contents') || request()->is('admin/blogs') || request()->is('admin/testimonials') || request()->is('admin/faqs') ? 'menuitem-active' : '' }}">
                            <a href="#menuContents" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-text-box-multiple-outline"></i></span>
                                <span class="menu-text"> {{ __('Site Contents') }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/pages/*') || request()->is('admin/pages') || request()->is('admin/contents') || request()->is('admin/blogs') || request()->is('admin/testimonials') || request()->is('admin/faqs') ? 'show' : '' }}" id="menuContents">
                                <ul class="sub-menu">
                                    @if (module('Page') && isActive('Page'))
                                        <li class="menu-item {{ request()->is('admin/pages/*') || request()->is('admin/pages') ? 'menuitem-active' : '' }}">
                                            <a href="{{ route('admin.pages.index') }}" class="menu-link {{ request()->is('admin/pages/*') || request()->is('admin/pages') ? 'active' : '' }}">
                                                <span class="menu-text">{{ __('Pages') }}</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li class="menu-item {{ request()->is('admin/contents') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.contents.index') }}" class="menu-link {{ request()->is('admin/contents') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Contents') }}</span>
                                        </a>
                                    </li>

                                    @if (module('Blog') && isActive('Blog'))
                                        <li class="menu-item {{ request()->is('admin/blogs') ? 'menuitem-active' : '' }}">
                                            <a href="{{ route('admin.blogs.index') }}" class="menu-link {{ request()->is('admin/blogs') ? 'active' : '' }}">
                                                <span class="menu-text">{{ __('Blogs') }}</span>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="menu-item {{ request()->is('admin/testimonials') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.testimonials.index') }}" class="menu-link {{ request()->is('admin/testimonials') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Testimonials') }}</span>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item {{ request()->is('admin/faqs') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('admin.faqs.index') }}" class="menu-link {{ request()->is('admin/faqs') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Faqs') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    
                    <li class="menu-item {{ request()->is('admin/contacts') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.contacts.index') }}" class="menu-link {{ request()->is('admin/contacts') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-map"></i></span>
                            <span class="menu-text"> {{ __('Contact') }} </span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/resource-buys') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.buys.index') }}" class="menu-link {{ request()->is('admin/resource-buys') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-dollar-sign"></i></span>
                            <span class="menu-text"> {{ __('Resource Sell') }} </span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/db-backups') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.backups.index') }}" class="menu-link {{ request()->is('admin/db-backups') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-download"></i></span>
                            <span class="menu-text"> {{ __('DB Backup') }} </span>
                        </a>
                    </li>

                    <li class="menu-title">{{ __('App') }}</li>

                    <li class="menu-item {{ request()->is('admin/app-home') || request()->is('admin/app-home/*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.app-home.index') }}" class="menu-link {{ request()->is('admin/app-home') || request()->is('admin/app-home/*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-compass"></i></span>
                            <span class="menu-text"> {{ __('Home Common Category') }} </span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/app-home-category') || request()->is('admin/app-home-category/*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.app-home-category.index') }}" class="menu-link {{ request()->is('admin/app-home-category') || request()->is('admin/app-home-category/*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-compass"></i></span>
                            <span class="menu-text"> {{ __('Home Next Category') }} </span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->is('admin/app-user-categories') || request()->is('admin/app-user-categories/*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.app-user-categories.index') }}" class="menu-link {{ request()->is('admin/app-user-categories') || request()->is('admin/app-user-categories/*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-compass"></i></span>
                            <span class="menu-text"> {{ __('App User Category') }} </span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/app-user-child-categories') || request()->is('admin/app-user-child-categories/*') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('admin.app-user-child-categories.index') }}" class="menu-link {{ request()->is('admin/app-user-child-categories') || request()->is('admin/app-user-child-categories/*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="fe-compass"></i></span>
                            <span class="menu-text"> {{ __('App User Category') }} </span>
                        </a>
                    </li>

                @endif

                @if (auth()->user()->hasRole('Writer'))

                    <li class="menu-item {{ request()->is('writer/mcqs') || request()->is('writer/mcqs/*') || request()->is('writer/mcq-questions') || request()->is('writer/mcq-questions/*') || request()->is('writer/exams/*') || request()->is('writer/exams') || request()->is('writer/exam-questions/*') || request()->is('writer/exam-questions') || request()->is('writer/lecture-sheets/*') || request()->is('writer/lecture-sheets') || request()->is('writer/ebooks/*') || request()->is('writer/ebooks')? 'menuitem-active' : '' }}">
                        <a href="#resource" data-bs-toggle="collapse" class="menu-link">
                            <span class="menu-icon"><i class="mdi mdi-share-variant"></i></span>
                            <span class="menu-text"> {{ __('Resources') }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('writer/mcqs') || request()->is('writer/mcqs/*') || request()->is('writer/mcq-questions') || request()->is('writer/mcq-questions/*') || request()->is('writer/exams/*') || request()->is('writer/exams') || request()->is('writer/exam-questions/*') || request()->is('writer/exam-questions') || request()->is('writer/lecture-sheets/*') || request()->is('writer/lecture-sheets') || request()->is('writer/ebooks/*') || request()->is('writer/ebooks') ? 'show' : '' }}" id="resource">
                            <ul class="sub-menu">

                                <li class="menu-item {{ request()->is('writer/exams/*') || request()->is('writer/exams') || request()->is('writer/exam-questions/*') || request()->is('writer/exam-questions') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('writer.exams.index') }}" class="menu-link {{ request()->is('writer/exams/*') || request()->is('writer/exams') || request()->is('writer/exam-questions/*') || request()->is('writer/exam-questions') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Exams') }}</span>
                                    </a>
                                </li>

                                @if (module('LectureSheet') && isActive('LectureSheet'))
                                <li class="menu-item {{ request()->is('writer/lecture-sheets/*') || request()->is('writer/lecture-sheets') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('writer.lecture-sheets.index') }}" class="menu-link {{ request()->is('writer/lecture-sheets/*') || request()->is('writer/lecture-sheets') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Lecture Sheets') }}</span>
                                    </a>
                                </li>
                                @endif
                                @if (module('Ebook') && isActive('Ebook'))
                                <li class="menu-item {{ request()->is('writer/ebooks/*') || request()->is('writer/ebooks') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('writer.ebooks.index') }}" class="menu-link {{ request()->is('writer/ebooks/*') || request()->is('writer/ebooks') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Ebooks') }}</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    <li class="menu-item {{ request()->is('writer/sub-categories') || request()->is('writer/sub-categories/*') || request()->is('writer/child-categories') || request()->is('writer/child-categories/*') ? 'menuitem-active' : '' }}">
                        <a href="#menuCategories" data-bs-toggle="collapse" class="menu-link">
                            <span class="menu-icon"><i class="fe-book"></i></span>
                            <span class="menu-text"> {{ __('Categories') }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse {{ request()->is('writer/sub-categories/*') || request()->is('writer/sub-categories') || request()->is('writer/child-categories') || request()->is('writer/child-categories/*') ? 'show' : '' }}" id="menuCategories">
                            <ul class="sub-menu">
                                <li class="menu-item {{ request()->is('writer/sub-categories') || request()->is('writer/sub-categories/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('writer.sub-categories.index') }}" class="menu-link {{ request()->is('writer/sub-categories') || request()->is('writer/sub-categories/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Sub Category') }}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->is('writer/child-categories') || request()->is('writer/child-categories/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('writer.child-categories.index') }}" class="menu-link {{ request()->is('writer/child-categories') || request()->is('writer/child-categories/*') ? 'active' : '' }}">
                                        <span class="menu-text">{{ __('Child Category') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if (module('Job') && isActive('Job'))
                        <li class="menu-item {{ request()->is('writer/jobs') || request()->is('writer/jobs/*') || request()->is('writer/job-categories') || request()->is('writer/job-users') || request()->is('writer/job-users/*') ? 'menuitem-active' : '' }}">
                            <a href="#menuJob" data-bs-toggle="collapse" class="menu-link">
                                <span class="menu-icon"><i class="fe-unlock"></i></span>
                                <span class="menu-text"> {{ __('Jobs') }} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->is('writer/jobs') || request()->is('writer/jobs/*') || request()->is('writer/job-categories') || request()->is('writer/job-users') || request()->is('writer/job-users/*') ? 'show' : '' }}" id="menuJob">
                                <ul class="sub-menu">
                                    <li class="menu-item {{ request()->is('writer/job-categories') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('writer.job-categories.index') }}" class="menu-link {{ request()->is('writer/job-categories') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Job Category') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('writer/jobs') || request()->is('writer/jobs/*') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('writer.jobs.index') }}" class="menu-link {{ request()->is('writer/jobs') || request()->is('writer/jobs/*') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Jobs') }}</span>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('writer/job-users') || request()->is('writer/job-users/*') ? 'menuitem-active' : '' }}">
                                        <a href="{{ route('writer.jobs.users.index') }}" class="menu-link {{ request()->is('writer/job-users') || request()->is('writer/job-users/*') ? 'active' : '' }}">
                                            <span class="menu-text">{{ __('Job Applied') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (module('Faq') && isActive('Faq'))
                        <li class="menu-item {{ request()->is('writer/faqs') || request()->is('writer/faqs/*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('writer.faqs.index') }}" class="menu-link {{ request()->is('writer/faqs') || request()->is('writer/faqs/*') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="mdi mdi-account-question"></i></span>
                                <span class="menu-text"> {{ __('Faq') }} </span>
                            </a>
                        </li>
                    @endif

                    @if (module('Blog') && isActive('Blog'))
                        <li class="menu-item {{ request()->is('writer/blogs') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('writer.blogs.index') }}" class="menu-link {{ request()->is('writer/blogs') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fe-book"></i></span>
                                <span class="menu-text"> {{ __('Blog') }} </span>
                            </a>
                        </li>
                    @endif
                    @if (module('Testimonial') && isActive('Testimonial'))
                        <li class="menu-item {{ request()->is('writer/testimonials') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('writer.testimonials.index') }}" class="menu-link {{ request()->is('writer/testimonials') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="fe-user-check"></i></span>
                                <span class="menu-text"> {{ __('Testimonial') }} </span>
                            </a>
                        </li>
                    @endif
                @endif

                @if (auth()->user()->hasRole('User'))
                    <li class="menu-item {{ request()->is('user/ranks') ? 'menuitem-active' : '' }}">
                        <a href="{{ route('user.ranks') }}" class="menu-link {{ request()->is('user/ranks') ? 'active' : '' }}">
                            <span class="menu-icon fs-3">
                                <i class="mdi mdi-crown-outline"></i>
                            </span>
                            <span class="menu-text"> {{ __('Top Ranking') }} </span>
                        </a>
                    </li>
                @endif


            </ul>
            <!--- End Menu -->
            <div class="clearfix"></div>
        </div>
    </div>
<!-- ========== Left menu End ========== -->