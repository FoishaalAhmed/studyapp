<footer class="edu-footer footer-lighten bg-image footer-style-1">
    <div class="footer-top">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="edu-footer-widget">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img class="logo-light"
                                    src="{{ asset('public/frontend/images/logo/logo-dark.png') }}"
                                    alt="Corporate Logo">
                                <img class="logo-dark"
                                    src="{{ asset('public/frontend/images/logo/logo-white.png') }}"
                                    alt="Corporate Logo">
                            </a>
                        </div>
                        <p class="description">
                            {{ __('Lorem ipsum dolor amet consecto adi pisicing elit sed eiusm tempor incidid unt labore dolore.') }}
                        </p>
                        <div class="widget-information">
                            <ul class="information-list">
                                <li><span>{{ __('Add') }}:</span>70-80 Upper St Norwich NR2</li>
                                <li><span>{{ __('Call') }}:</span><a href="tel:+011235641231">+01 123 5641
                                        231</a></li>
                                <li><span>{{ __('Email') }}:</span><a href="mailto:info@edublink.com"
                                        target="_blank">info@edublink.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="edu-footer-widget explore-widget">
                        <h4 class="widget-title">{{ __('Online Platform') }}</h4>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                <li><a href="">{{ __('About') }}</a></li>
                                <li><a href="">{{ __('MCQ') }}</a></li>
                                <li><a href="">{{ __('Exams') }}</a></li>
                                <li><a href="">{{ __('Ebooks') }}</a></li>
                                <li><a href="">{{ __('Lecture Sheets') }}</a></li>
                                <li><a href="">{{ __('Jobs') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="edu-footer-widget quick-link-widget">
                        <h4 class="widget-title">{{ __('Links') }}</h4>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                <li><a href="">{{ __('Forum') }}</a></li>
                                <li><a href="">{{ __('Blog') }}</a></li>
                                <li><a href="">{{ __('Contact Us') }}</a></li>
                                <li><a href="">{{ __('FAQ\'s') }}</a></li>
                                <li><a href="">{{ __('Sign In') }}</a></li>
                                <li><a href="">{{ __('Registration') }}</a></li>
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
                                <button class="edu-btn btn-medium" type="button">{{ __('Subscribe') }} <i
                                        class="icon-4"></i></button>
                            </div>
                            <ul class="social-share icon-transparent">
                                <li><a href="{{ $contact->facebook }}" class="color-fb"><i
                                            class="icon-facebook"></i></a></li>
                                <li><a href="{{ $contact->instagram }}" class="color-ig"><i
                                            class="icon-instagram"></i></a></li>
                                <li><a href="{{ $contact->twitter }}" class="color-twitter"><i
                                            class="icon-twitter"></i></a></li>
                                <li><a href="{{ $contact->linkedin }}" class="color-linkd"><i
                                            class="icon-linkedin2"></i></a>
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
                        <p>{{ __('Copyright') }} {{ date('Y') }} <a href="{{ url('/') }}"
                                target="_blank">{{ __('EduBlink') }}</a>. {{ __('All Rights Reserved') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>