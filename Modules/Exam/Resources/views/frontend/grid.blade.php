@extends('layouts.app')

@section('title', __('Exams'))
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('Exams') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Exams') }}</li>
                </ul>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1"><span></span> </li>
            <li class="shape-2 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape"></li>
            <li class="shape-3 scene"><img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}" alt="shape"></li>
            <li class="shape-4"><span></span></li>
            <li class="shape-5 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-07.png') }}" alt="shape"></li>
        </ul>
    </div>

    <!-- Event Area Start -->
    <div class="edu-event-area event-area-1 section-gap-equal">
        <div class="container">
            <div class="edu-sorting-area">
                <div class="sorting-left">
                    <h6 class="showing-text">{{ __('We found') }} <span>{{ $exams->total() }}</span>
                        {{ __('exams available for you') }}</h6>
                </div>
                <div class="sorting-right">
                    <div class="layout-switcher">
                        <label>{{ __('Grid') }}</label>
                        <ul class="switcher-btn">
                            <li><a href="javascript:;" class="active"><i class="icon-53"></i></a></li>

                            @if (request()->is('exams/category'))
                                <li><a href="{{ route('exams.category', ['type' => request()->type, 'name' => request()->name, 'view' => 'list']) }}"><i class="icon-54"></i></a></li>
                            @elseif (request()->has('search'))
                                <li><a href="{{ route('exams.search', ['search' => request()->search, 'view' => 'list']) }}"><i class="icon-54"></i></a></li>
                            @else
                                <li><a href="{{ route('exams.list', ['category' => request()->category, 'name' => request()->name]) }}"><i class="icon-54"></i></a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-md-9">
                    <div class="row g-5">
                        @php
                            $delay = 100;
                        @endphp
                        <!-- Start Event Grid  -->
                        @foreach ($exams as $item)
                            <div class="col-lg-4 col-md-6" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                                data-sal-duration="800">
                                <div class="edu-event event-style-1">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">
                                                <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/exam.webp')}}" alt="Course Meta">
                                            </a>
                                            <div class="event-time">
                                                <span><i class="icon-33"></i>{{ date('h:i A', strtotime($item->start_time)) }}</span>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="event-date">
                                                <span class="day">{{ date('d', strtotime($item->start_date)) }}</span>
                                                <span class="month">{{ date('M', strtotime($item->start_date)) }}</span>
                                            </div>

                                            <h5 class="title"><a href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">{{ $item->title }}</a></h5>

                                            {!! $item->description !!}

                                            <ul class="event-meta">
                                                <li><i class="icon-24"></i>{{ $item->questions_count }}
                                                    {{ __('Questions') }}</li>
                                                <li><i class="icon-25"></i>{{ $item->exam_users_count }} {{ __('Students') }}</li>
                                            </ul>
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn-small btn-secondary" href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">
                                                {{ __('Learn More') }}
                                                    <i class="icon-4"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $delay += 50; ?>
                        @endforeach

                        <!-- End Event Grid  -->
                    </div>
                </div>
                <div class="col-lg-3 order-lg-2">
                    <div class="course-sidebar-2">
                        <div class="edu-course-widget widget-category">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Search Exam') }}</h5>
                                <div class="content">
                                    <ul class="header-action">
                                        <li class="search-bar">
                                            <form action="{{ route('exams.search') }}">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Exam Search') }}" name="search">
                                                    <input type="hidden" name="view" value="grid">
                                                    <button class="search-btn" type="submit"><i class="icon-2"></i></button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="edu-course-widget widget-category">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Categories') }}</h5>
                                <div class="content">
                                    @foreach ($examCategories as $category)
                                        <div class="edu-form-check">
                                            <a href="{{ route('exams.grid', ['view' => 'grid', 'category' => $category['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $category['name']))]) }}">{{ $category['name'] }}
                                                <span>({{ $category['exams_count'] }})</span> 
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="edu-course-widget widget-instructor">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Types') }}</h5>
                                <div class="content">
                                    @foreach ($types as $type)
                                        <div class="edu-form-check">
                                            <a href="{{ route('exams.category', ['view' => 'grid', 'type' => $type->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $type->name))]) }}">{{ $type->name }}
                                                <span>({{ $type->exams_count }})</span> 
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ $exams->appends(['search' => request()->search, 'category' => request()->category, 'name' => request()->name])->links('frontend.pagination') }}

        </div>
    </div>
@endsection
