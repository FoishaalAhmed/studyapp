@extends('layouts.app')

@section('title', __('Online Education Platform'))
@section('content')
    <!-- Hero Banner Area Start -->
    <div class="hero-banner hero-style-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content">
                        <h1 class="title" data-sal-delay="100" data-sal="slide-up" data-sal-duration="1000">Get <span
                                class="color-secondary">{{ $exams + $sheet + $mcq + $ebook }}+</span> <br>Best Online Courses From EduBlink</h1>
                        <p data-sal-delay="200" data-sal="slide-up" data-sal-duration="1000">Engineering-Medical-Varsity-BCS or Bank Job- Whatever the goal, here is the way to achieve it.</p>
                        <div class="banner-btn" data-sal-delay="400" data-sal="slide-up" data-sal-duration="1000">
                            <a href="{{ route('mcq.grid') }}" class="edu-btn">Find courses <i class="icon-4"></i></a>
                        </div>
                        <ul class="shape-group">
                            <li class="shape-1 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="Shape">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-thumbnail">
                        <div class="thumbnail" data-sal-delay="500" data-sal="slide-left" data-sal-duration="1000">
                            <img src="{{ asset('public/assets/frontend/images/banner/girl-1.png') }}" alt="Girl Image">
                        </div>
                        
                        <ul class="shape-group">
                            <li class="shape-1" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <img data-depth="1.5" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}" alt="Shape">
                            </li>
                            <li class="shape-2 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <img data-depth="-1.5" src="{{ asset('public/assets/frontend/images/about/shape-16.png') }}" alt="Shape">
                            </li>
                            <li class="shape-3 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <span data-depth="3" class="circle-shape"></span>
                            </li>
                            <li class="shape-4" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <img data-depth="-1" src="{{ asset('public/assets/frontend/images/counterup/shape-02.png') }}" alt="Shape">
                            </li>
                            <li class="shape-5 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <img data-depth="1.5" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="Shape">
                            </li>
                            <li class="shape-6 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-18.png') }}" alt="Shape">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-7">
            <img src="{{ asset('public/assets/frontend/images/about/h-1-shape-01.png') }}" alt="Shape">
        </div>
    </div>

    <!--========= Start Categories Area  ========= -->
    <div class="features-area-2">
        <div class="container">
            <div class="features-grid-wrap">
                <div class="features-box features-style-2 edublink-svg-animate">
                    <div class="icon">
                        <img class="svgInject"
                            src="{{ asset('public/assets/frontend/images/animated-svg-icons/online-class.svg') }}"
                            alt="animated icon">
                    </div>
                    <div class="content">
                        <h5 class="title"><span>{{ $question }} + </span> {{ __('MCQ Question') }}</h5>
                    </div>
                </div>
                <div class="features-box features-style-2 edublink-svg-animate">
                    <div class="icon">
                        <img class="svgInject"
                            src="{{ asset('public/assets/frontend/images/animated-svg-icons/instructor.svg') }}"
                            alt="animated icon">
                    </div>
                    <div class="content">
                        <h5 class="title"><span>{{ $job }} + </span>{{ __('Total Jobs') }}</h5>
                    </div>
                </div>
                <div class="features-box features-style-2 edublink-svg-animate">
                    <div class="icon certificate">
                        <img class="svgInject"
                            src="{{ asset('public/assets/frontend/images/animated-svg-icons/certificate.svg') }}"
                            alt="animated icon">
                    </div>
                    <div class="content">
                        <h5 class="title"><span>{{ $exam }} +
                            </span>{{ __('Exam Questions') }}</h5>
                    </div>
                </div>
                <div class="features-box features-style-2 edublink-svg-animate">
                    <div class="icon">
                        <img class="svgInject" src="{{ asset('public/assets/frontend/images/animated-svg-icons/user.svg') }}"
                            alt="animated icon">
                    </div>
                    <div class="content">
                        <h5 class="title"><span>{{ $student }} + </span>{{ __('Students') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--========== Categories Area Start ============-->
    <div class="edu-categorie-area categorie-area-2 edu-section-gap">
        <div class="container">
            <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <h2 class="title">{{ __('Top MCQ Categories') }}</h2>
                <span class="shape-line"><i class="icon-19"></i></span>
                <p>{{ __('Go to the section of your choice to learn anything') }}</p>
            </div>

            <div class="row g-5">
                @foreach ($categories as $item)
                    <div class="col-lg-4 col-md-6" data-sal-delay="50" data-sal="slide-up" data-sal-duration="800">
                        <div class="categorie-grid categorie-style-2 {{ $loop->odd ? 'color-primary-style' : 'color-extra04-style' }} edublink-svg-animate">
                            <div class="icon">
                                <i class="icon-<?= $loop->odd ? '11' : '13' ?>"></i>
                            </div>
                            <div class="content">
                                <a href="{{ route('mcq.category', ['view' => 'grid', 'category' =>  $item->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $item->name))]) }}">
                                    <h5 class="title">{{ $item->name }}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if ($jobs)
        <!-- Job Area Start -->
        <div class="edu-categorie-area categorie-area-2 edu-section-gap">
            <div class="container">
                <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <h2 class="title">{{ __('Latest Jobs') }}</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                    <p>{{ __('Find your suitable jobs in our jobs section') }}</p>
                </div>

                <div class="row g-5">
                    @php
                        $delay = 100;
                    @endphp
                    @foreach ($jobs as $item)
                        <div class="col-lg-4 col-md-6" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                            data-sal-duration="800">
                            <div class="edu-event event-style-1">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <a href="{{ route('jobs.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'job' => base64_encode($item->id)]) }}">
                                            <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/job.jpg')}}" alt="Course Meta" style="height: 225px">
                                        </a>
                                        <div class="event-time">
                                            <span><i class="icon-33"></i>
                                                <?php
                                                    $date = date('Y-m-d');
                                                    
                                                    $diff = date_diff(date_create($date), date_create($item->end_date));
                                                    $dayLeftText = __('days left');
                                                    
                                                    $dateDiff = $item->end_date > $date ? $diff->format("%a $dayLeftText") : __('Already Expaired');
                                                    
                                                    echo $dateDiff;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="{{ route('jobs.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'job' => base64_encode($item->id)]) }}">{{ $item->title }}</a></h5>
                                        {!! Str::limit(strip_tags($item->description), 150) !!}
                                        <ul class="event-meta">
                                            <li><i class="icon-60"></i>{{ $item->salary != 0 ? '৳ ' . $item->salary . ' ' . __('BDT') : __('Negotiable') }}
                                            </li>
                                            <li><i class="icon-40"></i>{{ $item->location }}</li>
                                        </ul>
                                        <div class="read-more-btn">
                                            <a class="edu-btn btn-small btn-secondary"
                                                href="">{{ __('Learn More') }} <i class="icon-4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="course-view-all" data-sal-delay="150" data-sal="slide-up" data-sal-duration="1200">
                        <a href="{{ route('jobs.grid') }}" class="edu-btn">{{ __('View All') }} <i class="icon-4"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- CounterUp Area Start -->
    <div class="counterup-area-2">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="counterup-box-wrap">
                        <div class="counterup-box">
                            <div class="edu-counterup counterup-style-2">
                                <h2 class="counter-item count-number primary-color">
                                    <span class="odometer" data-odometer-final="<?= $exam ?>">.</span>
                                </h2>
                                <h6 class="title">{{ __('Exam Question Sets') }}</h6>
                            </div>
                            <div class="edu-counterup counterup-style-2">
                                <h2 class="counter-item count-number secondary-color">
                                    <span class="odometer" data-odometer-final="<?= $mcq ?>">.</span>
                                </h2>
                                <h6 class="title">{{ __('MCQ Sets') }}</h6>
                            </div>
                            @if (isActive('Ebook'))
                                <div class="edu-counterup counterup-style-2">
                                    <h2 class="counter-item count-number extra05-color">
                                        <span class="odometer" data-odometer-final="<?= $ebook ?>">.</span>
                                    </h2>
                                    <h6 class="title">{{ __('Ebooks') }}</h6>
                                </div>
                            @endif
                            @if (isActive('LectureSheet'))
                                <div class="edu-counterup counterup-style-2">
                                    <h2 class="counter-item count-number extra02-color">
                                        <span class="odometer" data-odometer-final="<?= $sheet ?>">.</span>
                                    </h2>
                                    <h6 class="title">{{ __('Lecture Sheets') }}</h6>
                                </div>
                            @endif

                        </div>
                        <ul class="shape-group">
                            <li class="shape-1 scene">
                                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}"
                                    alt="Shape">
                            </li>
                            <li class="shape-2">
                                <img class="rotateit" src="{{ asset('public/assets/frontend/images/counterup/shape-02.png') }}"
                                    alt="Shape">
                            </li>
                            <li class="shape-3 scene">
                                <img data-depth="1.6" src="{{ asset('public/assets/frontend/images/counterup/shape-04.png') }}"
                                    alt="Shape">
                            </li>
                            <li class="shape-4 scene">
                                <img data-depth="-1.6" src="{{ asset('public/assets/frontend/images/counterup/shape-05.png') }}"
                                    alt="Shape">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Area Start -->
    <div class="edu-blog-area blog-area-1 edu-section-gap">
        <div class="container">
            <div class="section-title section-center" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                <span class="pre-title">Latest MCQ</span>
                <span class="shape-line"><i class="icon-19"></i></span>
            </div>
            <div class="row g-5">
                @php
                    $delay = 100;
                @endphp
                @foreach ($mcqs as $item)
                    <div class="col-md-6 col-lg-4 col-xl-4" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                        data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">
                                        <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/mcq.jpg') }}" style="height: 230px">
                                    </a>
                                </div>
                                <div class="content">
                                    <span
                                        class="course-level">{{ $item->type }}</span>
                                    <h6 class="title">
                                        <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                    </h6>
                                    
                                    <div class="course-price">{{ $item->type == "Premium" ? '৳' . $item->price : '' }}
                                    </div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>{{ $item->questions_count }}
                                            {{ __('Questions') }}</li>
                                        <li><i class="icon-25"></i>{{ $item->mark_count }} {{ __('Students') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $delay += 50; ?>
                @endforeach
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1 scene">
                <img data-depth="-1.4" src="{{ asset('public/assets/frontend/images/about/shape-02.png') }}" alt="Shape">
            </li>
            <li class="shape-2 scene">
                <span data-depth="2.5"></span>
            </li>
            <li class="shape-3 scene">
                <img data-depth="-2.3" src="{{ asset('public/assets/frontend/images/counterup/shape-05.png') }}" alt="Shape">
            </li>
        </ul>
    </div>
     <!--========== CTA Banner Area Start ===========-->
    <div class="edu-cta-banner-area home-one-cta-wrapper bg-image">
        <div class="container">
            <div class="edu-cta-banner">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up"
                            data-sal-duration="800">
                            <h2 class="title">Get Your Quality Skills <span class="color-secondary">Certificate</span>
                                Through EduBlink</h2>
                            <a href="" class="edu-btn">Get started now <i class="icon-4"></i></a>
                        </div>
                    </div>
                </div>
                <ul class="shape-group">
                    <li class="shape-01 scene">
                        <img data-depth="2.5" src="{{ asset('public/assets/frontend/images/cta/shape-10.png') }}" alt="shape">
                    </li>
                    <li class="shape-02 scene">
                        <img data-depth="-2.5" src="{{ asset('public/assets/frontend/images/cta/shape-09.png') }}" alt="shape">
                    </li>
                    <li class="shape-03 scene">
                        <img data-depth="-2" src="{{ asset('public/assets/frontend/images/cta/shape-08.png') }}" alt="shape">
                    </li>
                    <li class="shape-04 scene">
                        <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape">
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
