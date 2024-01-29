@extends('layouts.app')

@section('title', __('Exams'))
@section('content')
    <!-- Breadcrumb Area Start -->

    <style>
        .count {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }

        .count .countdown-section {
            margin-right: 10px;
            text-align: center;
        }

        .count .countdown-section:last-child {
            margin-right: 0;
        }

        .count .countdown-number {
            font-size: 20px;
            font-weight: var(--p-semi-bold);
            line-height: 1;
            margin-bottom: 10px;
            height: 60px;
            width: 60px;
            line-height: 60px;
            text-align: center;
            border-radius: 50%
        }

        .count .countdown-number.day {
            background-color: rgba(26, 182, 157, .1);
            color: var(--color-primary);
        }

        .count .countdown-number.hour {
            background-color: rgba(238, 74, 98, .1);
            color: var(--color-secondary);
        }

        .count .countdown-number.minute {
            background-color: rgba(142, 86, 255, .1);
            color: var(--color-extra02);
        }

        .count .countdown-number.second {
            background-color: rgba(248, 148, 31, .1);
            color: var(--color-extra05);
        }

        .count .countdown-unit {
            line-height: 1;
            font-size: 15px;
            font-weight: var(--p-medium);
            color: var(--color-body);
        }
    </style>

    @php
        $myDateTime = date('Y-m-d H:i:s', strtotime($exam->start_date . $exam->start_time));
    @endphp

    <div class="edu-breadcrumb-area breadcrumb-style-4">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <span class="pre-title">{{ optional($exam->examType)->name }}</span>
                    <h1 class="title">{{ $exam->title }}</h1>
                </div>
                <ul class="course-meta">
                    <li><i class="icon-27"></i>{{ date('M d, Y', strtotime($exam->start_date)) }}</li>
                    <li><i class="icon-33"></i>{{ date('h:i A', strtotime($exam->start_time)) }}</li>
                </ul>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1">
                <span></span>
            </li>
            <li class="shape-2 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}"
                    alt="shape"></li>
            <li class="shape-3 scene"><img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}"
                    alt="shape"></li>
            <li class="shape-4">
                <span></span>
            </li>
            <li class="shape-5 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-07.png') }}"
                    alt="shape"></li>
        </ul>
    </div>

    <!--========= Event Area Start ===========-->
    <section class="event-details-area edu-section-gap">
        <div class="container">
            <div class="event-details">
                <div class="main-thumbnail">
                    <img src="{{ file_exists($exam->photo) ? asset($exam->photo) : asset('public/images/dummy/exam.webp') }}" alt="Course Meta">
                </div>
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="details-content">
                            <h3>{{ __('About The Exam') }}</h3>
                            {!! $exam->description !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-sidebar-3">
                            <div class="edu-course-widget widget-course-summery">
                                <div class="inner">
                                    <div class="content">
                                        <h4 class="widget-title">{{ __('Exam Info') }}</h4>
                                        <ul class="course-item">
                                            <li>
                                                <span class="label"><i class="icon-64"></i>{{ __('Exam Type') }}</span>
                                                <span class="value">{{ optional($exam->examType)->name }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-59"></i>{{ __('Category') }}</span>
                                                <span class="value">{{ optional($exam->category)->name }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-64"></i>{{ __('Type') }}</span>
                                                <span class="value">{{ $exam->type }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-60"></i>{{ __('Cost') }}</span>
                                                <span class="value price">{{ $exam->type == 'Premium' ? '৳' . $exam->price : '৳0' }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><img class="svgInject" src="{{ asset('public/assets/frontend/images/svg-icons/books.svg') }}" alt="book icon">{{ __('Total Question') }}</span>
                                                <span class="value">{{ $exam->questions_count }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-70"></i>{{ __('Total Student') }}</span>
                                                <span class="value">{{ $exam->exam_users_count }}</span>
                                            </li>
                                        </ul>
                                        <div class="read-more-btn">
                                            <a href="{{ route('login') }}" class="edu-btn">{{ __('Book Now') }} <i class="icon-4"></i></a>
                                        </div>
                                        <span id="demo"></span>
                                        <div class="count" style="display: flex">
                                            <div class="countdown-section">
                                                <div>
                                                    <div class="countdown-number day" id="day"></div>
                                                    <div class="countdown-unit">{{ __('Days') }}</div>
                                                </div>
                                            </div>
                                            <div class="countdown-section">
                                                <div>
                                                    <div class="countdown-number hour" id="hour"></div>
                                                    <div class="countdown-unit">{{ __('Hrs') }}</div>
                                                </div>
                                            </div>
                                            <div class="countdown-section">
                                                <div>
                                                    <div class="countdown-number minute" id="minute"></div>
                                                    <div class="countdown-unit">{{ __('Mins') }}</div>
                                                </div>
                                            </div>
                                            <div class="countdown-section">
                                                <div>
                                                    <div class="countdown-number second" id="second"></div>
                                                    <div class="countdown-unit">{{ __('Secs') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- More Courses Area Start -->
            <!-- Start Course Area  -->
            <div class="gap-bottom-equal">
                <div class="container">
                    <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up"
                        data-sal-duration="800">
                        <h3 class="title">{{ __('More similar content for You') }}</h3>
                    </div>
                    <div class="row g-5">
                        @php
                            $delay = 150;
                        @endphp
                        <!-- Start Single Course  -->
                        @foreach ($exams as $item)
                            <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="<?= $delay ?>"
                                data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-course course-style-5 inline"
                                    data-tipped-options="inline: 'inline-tooltip-<?= $loop->index + 1 ?>'">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">
                                                <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/exam.webp') }}" alt="Course Meta">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="course-price price-round">
                                                {{ $item->type == 'Premium' ? '৳' . $item->price : '৳0' }}</div>
                                            <span
                                                class="course-level">{{ $item->type }}</span>
                                            <h5 class="title">
                                                <a href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                            </h5>
                                            
                                            {!! $item->description !!}

                                            <ul class="course-meta">
                                                <li><i class="icon-24"></i>{{ $item->questions_count }}
                                                    {{ __('Questions') }}</li>
                                                <li><i class="icon-25"></i>{{ $item->exam_users_count }} {{ __('Students') }}
                                                </li>
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
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{ $myDateTime }}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"

            document.getElementById("day").innerHTML = days;
            document.getElementById("hour").innerHTML = hours;
            document.getElementById("minute").innerHTML = minutes;
            document.getElementById("second").innerHTML = seconds;

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("day").innerHTML = "End";
                document.getElementById("hour").innerHTML = "End";
                document.getElementById("minute").innerHTML = "End";
                document.getElementById("second").innerHTML = "End";
            }
        }, 1000);
    </script>
@endsection
