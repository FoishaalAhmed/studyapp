<footer class="edu-footer footer-lighten bg-image footer-style-1">
    <div class="footer-top">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="edu-footer-widget">
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
                        <div class="widget-information">
                            <ul class="information-list">
                                <li><span>{{ __('Add') }}:</span>{{ $contact->address }}</li>
                                <li><span>{{ __('Call') }}:</span><a href="tel:+011235641231">{{ $contact->phone }}</a></li>
                                <li><span>{{ __('Email') }}:</span><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="edu-footer-widget explore-widget">
                        <h4 class="widget-title">{{ __('Online Platform') }}</h4>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                @if (module('Page') && isActive('Page'))
                                    <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                                @endif

                                <li><a href="{{ route('mcq.grid') }}">{{ __('MCQ') }}</a></li>
                                <li><a href="{{ route('exams.grid') }}">{{ __('Exams') }}</a></li>

                                @if (module('Ebook') && isActive('Ebook'))
                                    <li><a href="{{ route('ebooks.grid') }}">{{ __('Ebooks') }}</a></li>
                                @endif

                                @if (module('LectureSheet') && isActive('LectureSheet'))
                                    <li><a href="{{ route('sheets.grid') }}">{{ __('Lecture Sheets') }}</a></li>
                                @endif

                                @if (module('Job') && isActive('Job'))
                                    <li><a href="{{ route('jobs.grid') }}">{{ __('Jobs') }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="edu-footer-widget quick-link-widget">
                        <h4 class="widget-title">{{ __('Links') }}</h4>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                @if (module('Blog') && isActive('Blog'))
                                    <li><a href="{{ route('blogs.index') }}">{{ __('Blog') }}</a></li>
                                @endif
                                <li><a href="{{ route('contact') }}">{{ __('Contact Us') }}</a></li>
                                <li><a href="{{ route('faqs') }}">{{ __('FAQ\'s') }}</a></li>
                                <li><a href="{{ route('login') }}">{{ __('Sign In') }}</a></li>
                                <li><a href="{{ route('register') }}">{{ __('Registration') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="edu-footer-widget">
                        <h4 class="widget-title">{{ __('Contacts') }}</h4>
                        <div class="inner">
                            <p class="description">
                                {{ __('Enter your email address to register to our newsletter subscription') }}
                            </p>
                            <div class="input-group footer-subscription-form">
                                <input type="email" class="form-control" placeholder="Your email">
                                <button class="edu-btn btn-medium" type="button">{{ __('Subscribe') }} <i class="icon-4"></i></button>
                            </div>
                            <ul class="social-share icon-transparent">
                                <li><a href="{{ $contact->facebook }}" class="color-fb"><i class="icon-facebook"></i></a></li>
                                <li><a href="{{ $contact->instagram }}" class="color-ig"><i class="icon-instagram"></i></a></li>
                                <li><a href="{{ $contact->twitter }}" class="color-twitter"><i class="icon-twitter"></i></a></li>
                                <li><a href="{{ $contact->linkedin }}" class="color-linkd"><i class="icon-linkedin2"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <p>{{ __('Copyright') }} {{ date('Y') }} 
                            <a href="{{ url('/') }}" target="_blank">{{ settings('name') }}</a>
                            . {{ __('All Rights Reserved') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>