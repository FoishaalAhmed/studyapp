@extends('layouts.app')

@section('title', __('MCQ'))
@section('content')
    <!--=========== Breadcrumb Area Start =============-->


    <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--21"
        style="background-image: url({{ asset('public/assets/frontend/images/bg/bg-image-21.jpg') }});">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ $model->title }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    @if (isset($model->category))
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li class="breadcrumb-item"><a href="{{ route('mcq.category', ['view' => 'grid', 'category' => optional($model->category)->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', optional($model->category)->name))]) }}">{{ optional($model->category)->name }}</a>
                        </li>
                    @endif
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $model->title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!--========== Courses Details Area Start ===========-->
    <section class="edu-section-gap course-details-area">
        <div class="container">
            <div class="row row--30">
                <div class="col-lg-8">
                    <div class="course-details-content course-details-3">
                        <div class="entry-content">
                            <h2 class="title">{{ $model->title }}</h2>
                            <ul class="course-meta">
                                @if (isset($model->category))
                                    <li><i class="icon-59"></i>{{ optional($model->category)->name }}</li>
                                @endif
                            </ul>
                            <div class="thumbnail">
                                <img src="{{ file_exists($model->photo) ? asset($model->photo) : asset('public/images/dummy/mcq.jpg') }}" alt="Course Meta">
                            </div>
                        </div>
                        <div class="course-enroll-box">
                            <div class="single-item">
                                <h6 class="title">{{ __('Content Type') }}</h6>
                                <span class="enroll-status">{{ $model->type }}</span>
                            </div>
                            <div class="single-item course-price">
                                <h6 class="title">{{ __('Price') }}</h6>
                                <span class="price">{{ $model->type == 'Premium' ? '৳' . $model->price : '৳0' }}</span>
                            </div>
                            <div class="single-item">
                                <h6 class="title">{{ __('Get Started') }}</h6>
                                <a href="{{ route('login') }}" class="edu-btn btn-medium enroll-btn">{{ __('Take This') }} </a>
                            </div>
                        </div>

                        <div class="nav-tab-wrap">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                               @if (!is_null($model->description))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ !is_null($model->description) ? 'active' : '' }}" id="overview-tab" data-bs-toggle="tab"
                                        data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                        aria-selected="true">{{ __('Detail') }}</button>
                                </li>
                                @endif

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ is_null($model->description) ? 'active' : '' }}" id="carriculam-tab" data-bs-toggle="tab"
                                        data-bs-target="#carriculam" type="button" role="tab"
                                        aria-controls="carriculam" aria-selected="false">{{ __('Reviews') }}</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade {{ !is_null($model->description) ? 'show active' : '' }}" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                                    <div class="course-tab-content">
                                        <div class="course-overview">
                                            <h3 class="heading-title">{{ __('Description') }}</h3>

                                            {!! $model->description !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade {{ is_null($model->description) ? 'show active' : '' }}" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                                    <div class="course-tab-content">
                                        <div class="course-review">
                                            <h3 class="heading-title">{{ __('Rating') }}</h3>
                                            <p>{{ __('5.00 average rating based on 7 rating') }}</p>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-sm-4">
                                                    <div class="rating-box">
                                                        <div class="rating-number">{{ __('5.0') }}</div>
                                                        <div class="rating">
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                        </div>
                                                        <span>({{ __('7 Review') }})</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="review-wrapper">

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                {{ __('5') }} <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: 100%" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">{{ __('7') }}</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                {{ __('4') }} <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">{{ __('0') }}</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                {{ __('3') }} <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">{{ __('0') }}</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                {{ __('2') }} <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">{{ __('0') }}</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                {{ __('1') }} <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">{{ __('0') }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Start Comment Area  -->
                                            <div class="comment-area">
                                                <h3 class="heading-title">{{ __('Reviews') }}</h3>
                                                <div class="comment-list-wrapper">
                                                    <!-- Start Single Comment  -->
                                                    <div class="comment">
                                                        <div class="thumbnail">
                                                            <img src="{{ asset('public/assets/frontend/images/blog/comment-01.jpg') }}"
                                                                alt="Comment Images">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="rating">
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                            </div>
                                                            <h5 class="title">{{ __('Haley Bennet') }}</h5>
                                                            <span class="date">{{ __('Oct 10, 2023') }}</span>
                                                            <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Comment  -->
                                                    <!-- Start Single Comment  -->
                                                    <div class="comment">
                                                        <div class="thumbnail">
                                                            <img src="{{ asset('public/assets/frontend/images/blog/comment-02.jpg') }}" alt="Comment Images">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="rating">
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                            </div>
                                                            <h5 class="title">{{ __('Simon Baker') }}</h5>
                                                            <span class="date">{{ __('Oct 10, 2023') }}</span>
                                                            <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit sed incididunt ut labore et dolore magna aliqua.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Comment  -->
                                                    <!-- Start Single Comment  -->
                                                    <div class="comment">
                                                        <div class="thumbnail">
                                                            <img src="{{ asset('public/assets/frontend/images/blog/comment-03.jpg') }}"
                                                                alt="Comment Images">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="rating">
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                            </div>
                                                            <h6 class="title">{{ __('Richard Gere') }}</h6>
                                                            <span class="date">{{ __('Oct 10, 2023') }}</span>
                                                            <p>{{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Comment  -->
                                                </div>
                                            </div>
                                            <!-- End Comment Area  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar-3">
                        <div class="edu-course-widget widget-course-summery">
                            <div class="inner">
                                <div class="content">
                                    <h4 class="widget-title">{{ __('Course Includes:') }}</h4>
                                    <ul class="course-item">
                                        <li>
                                            <span class="label"><i class="icon-64"></i>{{ __('Model Type') }}:</span>
                                            <span class="value">{{ $model->type }}</span>
                                        </li>

                                        <li>
                                            <span class="label"><i class="icon-60"></i>{{ __('Price') }}:</span>
                                            <span class="value price">{{ $model->type == 'Premium' ? '৳' . $model->price : '৳0' }}</span>
                                        </li>

                                        <li>
                                            <span class="label"><i class="icon-62"></i>{{ __('Total Student') }}:</span>
                                            <span class="value">{{ $model->mark_count }}</span>
                                        </li>

                                        <li>
                                            <span class="label"><img class="svgInject" src="{{ asset('public/assets/frontend/images/svg-icons/books.svg') }}" alt="book icon">{{ __('Total Question') }}:</span>
                                            <span class="value">{{ $model->questions_count }}</span>
                                        </li>
                                        <li>
                                            <span class="label"><i class="icon-61"></i>{{ __('Duration') }}:</span>
                                            <span class="value">{{ $model->time }} {{ __('Minutes') }}</span>
                                        </li>
                                        @if (isset($model->category))
                                            <li>
                                                <span class="label"><i class="icon-59"></i>{{ __('Category') }}:</span>
                                                <span class="value">{{ optional($model->category)->name }}</span>
                                            </li>
                                        @endif

                                        @if (isset($model->subject))
                                            <li>
                                                <span class="label"><i class="icon-63"></i>{{ __('Subject') }}:</span>
                                                <span class="value">{{ optional($model->subject)->name }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="read-more-btn">
                                        <a href="{{ route('login') }}" class="edu-btn">{{ __('Start Now') }} <i class="icon-4"></i></a>
                                    </div>
                                    <div class="share-area">
                                        <h4 class="title">{{ __('Share On') }}:</h4>
                                        <ul class="social-share">
                                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                                            <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                            <li><a href="#"><i class="icon-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=========== More Courses Area Start ===========-->
    <!-- Start Course Area  -->
    <div class="gap-bottom-equal">
        <div class="container">
            <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <h3 class="title">{{ __('More similar content for You') }}</h3>
            </div>
            <div class="row g-5">
                @php
                    $delay = 150;
                @endphp
                <!-- Start Single Course  -->
                @foreach ($models as $item)
                    <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                        data-sal-duration="800">
                        <div class="edu-course course-style-5 inline"
                            data-tipped-options="inline: 'inline-tooltip-<?= $loop->index + 1 ?>'">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">
                                      
                                        <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/mcq.jpg') }}" alt="Course Meta"
                                                >
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="course-price price-round">{{ $item->type == 'Premium' ? '৳' . $item->price : '' }}</div>
                                    <span class="course-level">{{ $item->type }}</span>
                                    <h5 class="title">
                                        <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                    </h5>
                                    
                                    {!! $item->description !!}
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
                <!-- End Single Course  -->
            </div>
        </div>
    </div>
    <!-- End Course Area -->
@endsection
