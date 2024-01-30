@extends('layouts.app')

@section('title', __('Jobs'))

@section('css')
    <link href="{{ asset('Modules/Job/Resources/assets/css/job-detail.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Breadcrumb Area Start -->
    @php
        $myDateTime = date('Y-m-d H:i:s', strtotime($job->end_date));
    @endphp

    <div class="edu-breadcrumb-area breadcrumb-style-4">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <span class="pre-title">{{ optional($job->category)->name }}</span>
                    <h1 class="title">{{ $job->title }}</h1>
                </div>
                <ul class="course-meta">
                    <li><i class="icon-27"></i>{{ date('M d, Y', strtotime($job->end_date)) }}</li>
                </ul>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1">
                <span></span>
            </li>
            <li class="shape-2 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape"></li>
            <li class="shape-3 scene"><img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}" alt="shape"></li>
            <li class="shape-4">
                <span></span>
            </li>
            <li class="shape-5 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-07.png') }}" alt="shape"></li>
        </ul>
    </div>
    <!-- Event Area Start -->
    <section class="event-details-area edu-section-gap">
        <div class="container">
            <div class="event-details">
                <div class="main-thumbnail">
                    <img src="{{ file_exists($job->photo) ? asset($job->photo) : asset('public/images/dummy/job.jpg') }}" alt="Course Meta">
                </div>
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="details-content">
                            <h3>{{ __('About this job') }}</h3>
                            
                            {!! $job->description !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-sidebar-3">
                            <div class="edu-course-widget widget-course-summery">
                                <div class="inner">
                                    <div class="content">
                                        <h4 class="widget-title">{{ __('Job Info') }}</h4>
                                        <ul class="course-item">
                                            
                                            <li>
                                                <span class="label"><i class="icon-59"></i>{{ __('Category') }}</span>
                                                <span class="value">{{ optional($job->category)->name }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-70"></i>{{ __('Company') }}</span>
                                                <span class="value"><small>{{ $job->company }}</small></span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-40"></i>{{ __('Location') }}</span>
                                                <span class="value">{{ $job->location }}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-60"></i>{{ __('Salary') }}</span>
                                                <span class="value price">{{ $job->salary != 0 ? '৳ ' . $job->salary . ' ' . __('BDT') : __('Negotiable') }}</span>
                                            </li>
                                            
                                        </ul>
                                        <div class="read-more-btn"> </div>
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
                        @foreach ($jobs as $item)
                            <div class="col-lg-4 col-md-6" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                                data-sal-duration="800">
                                <div class="edu-event event-style-1">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="{{ route('jobs.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'job' => base64_encode($item->id)]) }}">
                                                <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/job.jpg') }}" style="height: 225px">
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
                                            <h5 class="title">
                                                <a href="{{ route('jobs.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'job' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                            </h5>
                                            {!! Str::limit(strip_tags($item->description), 100) !!}
                                            <ul class="event-meta">
                                                <li><i class="icon-60"></i>{{ $item->salary != 0 ? '৳ ' . $item->salary . ' ' . __('BDT') : __('Negotiable') }}
                                                </li>
                                                <li><i class="icon-40"></i>{{ $item->location }}</li>
                                            </ul>
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn-small btn-secondary"
                                                    href="{{ route('jobs.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'job' => base64_encode($item->id)]) }}">{{ __('Learn More') }} <i class="icon-4"></i></a>
                                            </div>
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
