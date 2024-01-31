@extends('layouts.app')

@section('title', __('About Us'))
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area breadcrumb-style-5">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{  __('About Us') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- About Us Area Start -->
    <div class="edu-section-gap edu-about-area about-style-8">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up"
                            data-sal-duration="800">
                            <span class="pre-title">{{ __('About Us') }}</span>
                            <h2 class="title">{{ __('We Provide Best') }} <span class="color-secondary">{{ __('Education') }}</span> {{ __('Services For
                                You.') }}</h2>
                            <span class="shape-line"><i class="icon-19"></i></span>
                            {!! $about->content !!}
                        </div>
                        <div class="about-mission">
                            <div class="single-item" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="icon color-extra02"><i class="icon-51"></i></div>
                                <div class="content">
                                    <h4 class="title">{{ __('Our Mission') }}</h4>
                                    {!! $mission->content !!}
                                </div>
                            </div>
                            <div class="single-item" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="icon color-extra06"><i class="icon-52"></i></div>
                                <div class="content">
                                    <h4 class="title">{{ __('Our Vision') }}</h4>
                                    {!! $vision->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image-gallery">
                        <div class="row g-5" id="masonry-gallery">
                            <div class="col-6 masonry-item">
                                <div class="thumbnail thumbnail-1" data-sal-delay="50" data-sal="slide-down"
                                    data-sal-duration="1000">
                                    <img src="{{ asset('public/assets/frontend/images/about/about-13.jpg') }}" alt="About Images">
                                </div>
                            </div>
                            <div class="col-6 masonry-item">
                                <div class="thumbnail thumbnail-2" data-sal-delay="50" data-sal="slide-down"
                                    data-sal-duration="1000">
                                    <img src="{{ asset('public/assets/frontend/images/about/about-14.jpg') }}" alt="About Images">
                                </div>
                            </div>
                            <div class="col-6 masonry-item">
                                <div class="thumbnail thumbnail-3" data-sal-delay="50" data-sal="slide-up"
                                    data-sal-duration="1000">
                                    <img src="{{ asset('public/assets/frontend/images/about/about-16.jpg') }}" alt="About Images">
                                </div>
                            </div>
                            <div class="col-6 masonry-item">
                                <div class="thumbnail thumbnail-4" data-sal-delay="50" data-sal="slide-up"
                                    data-sal-duration="1000">
                                    <img src="{{ asset('public/assets/frontend/images/about/about-15.jpg') }}" alt="About Images">
                                </div>
                            </div>
                        </div>
                        <ul class="shape-group">
                            <li class="shape-1 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                                <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-33.png') }}" alt="Shape Images">
                            </li>
                            <li class="shape-2 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-25.png') }}" alt="Shape Images">
                            </li>
                            <li class="shape-3 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="Shape Images">
                            </li>
                            <li class="shape-4 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                                <span data-depth=".8"></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CounterUp Area Start -->
    <div class="counterup-area-9">
        <div class="container edublink-animated-shape">
            <div class="row g-5">
                <div class="col-lg-3 col-sm-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-counterup counterup-style-4">
                        <div class="icon primary-color">
                            <i class="icon-64"></i>
                        </div>
                        <h2 class="counter-item count-number">
                            <span class="odometer" data-odometer-final="<?= $exam ?>">.</span>
                        </h2>
                        <h6 class="title">{{ __('Exam Question Sets') }}</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-counterup counterup-style-4">
                        <div class="icon secondary-color">
                            <i class="icon-65"></i>
                        </div>
                        <h2 class="counter-item count-number">
                            <span class="odometer" data-odometer-final="<?= $mcq ?>">.</span>
                        </h2>
                        <h6 class="title">{{ __('MCQ Sets') }}</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-counterup counterup-style-4">
                        <div class="icon extra08-color">
                            <i class="icon-82"></i>
                        </div>
                        <h2 class="counter-item count-number">
                            <span class="odometer" data-odometer-final="<?= $ebook ?>">.</span>
                        </h2>
                        <h6 class="title">{{ __('Ebooks') }}</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-counterup counterup-style-4">
                        <div class="icon extra05-color">
                            <i class="icon-81"></i>
                        </div>
                        <h2 class="counter-item count-number">
                            <span class="odometer" data-odometer-final="<?= $sheet ?>">.</span>
                        </h2>
                        <h6 class="title">{{ __('Lecture Sheets') }}</h6>
                    </div>
                </div>
            </div>

            <ul class="shape-group">
                <li class="shape-1 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                    <img data-depth="-1.8" src="{{ asset('public/assets/frontend/images/others/shape-27.png') }}" alt="Shape Images">
                </li>
            </ul>
        </div>
    </div>
    <!-- Why Choose Area Start -->
    <section class="why-choose-area-4 edu-section-gap">
        <div class="container edublink-animated-shape">
            <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <span class="pre-title">{{ __('Why choose edublink') }}</span>
                <h2 class="title">{{ __('The Best') }} <span class="color-secondary">{{ __('Beneficial') }}</span> {{ __('Side') }} <br> {{ __('of EduBlink') }}</h2>
                <span class="shape-line"><i class="icon-19"></i></span>
            </div>
            <div class="row g-5">
                <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="why-choose-box-3 features-box color-primary-style">
                        <div class="thumbnail">
                            <img src="{{ asset($course->photo) }}" alt="">
                        </div>
                        <div class="content">
                            <div class="icon">
                                <i class="icon-45"></i>
                            </div>
                            <h4 class="title">{{ $course->title }}</h4>
                            {!! $course->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="why-choose-box-3 features-box color-secondary-style">
                        <div class="thumbnail">
                            <img src="{{ asset($access->photo) }}" alt="">
                        </div>
                        <div class="content">
                            <div class="icon">
                                <i class="icon-46"></i>
                            </div>
                            <h4 class="title">{{ $access->title }}</h4>
                            {!! $access->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <div class="why-choose-box-3 features-box color-extra08-style">
                        <div class="thumbnail">
                            <img src="{{ asset($expert->photo) }}" alt="">
                        </div>
                        <div class="content">
                            <div class="icon">
                                <i class="icon-47"></i>
                            </div>
                            <h4 class="title">{{ $expert->title }}</h4>
                            {!! $expert->content !!}
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                    <img class="rotateit" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape">
                </li>
                <li class="shape-2 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                    <span data-depth="0.85"></span>
                </li>
            </ul>
        </div>
    </section>
    <!-- CTA Area Start -->
    <div class="cta-area-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="home-four-cta edu-cta-box cta-style-3 bg-image bg-image--16">
                        <div class="inner">
                            <div class="content text-end">
                                <span class="subtitle">{{ __('Get In Touch:') }}</span>
                                <h3 class="title"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></h3>
                            </div>
                            <div class="sparator">
                                <span>{{ __('or') }}</span>
                            </div>
                            <div class="content">
                                <span class="subtitle">{{ __('Call Us Via:') }}</span>
                                <h3 class="title"><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></h3>
                            </div>
                        </div>
                        <ul class="shape-group">
                            <li class="shape-01 scene">
                                <img data-depth="2" src="{{ asset('public/assets/frontend/images/cta/shape-06.png') }}" alt="shape">
                            </li>
                            <li class="shape-02 scene">
                                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/cta/shape-12.png') }}" alt="shape">
                            </li>
                            <li class="shape-03 scene">
                                <img data-depth="-3" src="{{ asset('public/assets/frontend/images/cta/shape-04.png') }}" alt="shape">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area Start -->
    <section class="testimonial-area-6 gap-bottom-equal">
        <div class="container edublink-animated-shape">
            <div class="row row--40">
                <div class="col-lg-6">
                    <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up"
                        data-sal-duration="800">
                        <span class="pre-title">{{ __('Testimonials') }}</span>
                        <h2 class="title">{{ __('What Our Students') }} <br> {{ __('Have To Say') }}</h2>
                        <span class="shape-line"><i class="icon-19"></i></span>
                    </div>
                    <div class="testimonial-activation-5 swiper ">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $item)
                                <div class="swiper-slide">
                                    <div class="testimonial-slide testimonial-style-3">
                                        <div class="content">
                                            <div class="rating-icon">
                                                @for ($i = 0; $i < $item->star; $i++)
                                                    <i class="icon-23"></i>
                                                @endfor
                                            </div>
                                            <p>“{{ $item->message }}”</p>
                                            <div class="author-info">
                                                <div class="thumb">
                                                    <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/assets/frontend/images/testimonial/testimonial-01.png') }}" alt="Testimonial">
                                                </div>
                                                <div class="info">
                                                    <h5 class="title">{{ $item->name }}</h5>
                                                    <span class="subtitle">{{ $item->position }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="video-gallery video-gallery-5" data-sal-delay="150" data-sal="slide-left"
                        data-sal-duration="800">
                        <div class="thumbnail">
                            <img src="{{ asset('public/assets/frontend/images/others/video-03.jpg') }}" alt="Thumb">
                            <a href="https://www.youtube.com/watch?v=PICj5tr9hcc"
                                class="video-play-btn video-popup-activation">
                                <i class="icon-18"></i>
                            </a>
                        </div>
                        <div class="content">
                            <h4 class="title">{{ __('Take a Video Tour to Learn Intro of Campus') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-2 scene" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                    <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-25.png') }}" alt="Shape">
                </li>
                <li class="shape-3 scene" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                    <span data-depth="-1"></span>
                </li>
            </ul>
        </div>
        <ul class="shape-group">
            <li class="shape-1" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                <img class="rotateit" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="Shape">
            </li>
        </ul>
    </section>
@endsection
