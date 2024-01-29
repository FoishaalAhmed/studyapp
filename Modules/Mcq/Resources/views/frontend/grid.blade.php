@extends('layouts.app')

@section('title', __('MCQ'))
@section('content')

    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('MCQ') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('MCQ') }}</li>
                </ul>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1"><span></span></li>
            <li class="shape-2 scene">
                <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape">
            </li>
            <li class="shape-3 scene">
                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}" alt="shape">
            </li>
            <li class="shape-4"><span></span></li>
            <li class="shape-5 scene">
                <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-07.png') }}" alt="shape">
            </li>
        </ul>
    </div>

    <!--=========== Courses Area Start ===========-->
    <div class="edu-course-area course-area-1 gap-tb-text">
        <div class="container">


            <div class="edu-sorting-area">
                <div class="sorting-left">
                    <h6 class="showing-text">{{ __('We found') }} <span>{{ $mcq->total() }}</span>
                        {{ __('content available for you') }}</h6>
                </div>
                <div class="sorting-right">
                    <div class="layout-switcher">
                        <label>{{ __('Grid') }}</label>
                        <ul class="switcher-btn">
                            <li><a href="javascript:;" class="active"><i class="icon-53"></i></a></li>

                            @if (request()->is('mcq/category'))
                                <li><a href="{{ route('mcq.category', ['category' => request()->category, 'name' => request()->name, 'view' => 'list']) }}"><i class="icon-54"></i></a></li>
                            @elseif (request()->has('search'))
                                <li><a href="{{ route('mcq.search', ['search' => request()->search, 'view' => 'list']) }}"><i class="icon-54"></i></a></li>
                            @else
                                <li><a href="{{ route('mcq.list', ['category' => request()->category, 'name' => request()->name]) }}"><i class="icon-54"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                @php
                    $delay = 100;
                @endphp
                <!-- Start Single Course  -->
                <div class="col-lg-9 col-pr--35 order-lg-1">
                    <div class="row g-5">
                        @foreach ($mcq as $item)
                            <div class="col-md-6 col-lg-4 col-xl-4" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                                data-sal-duration="800">
                                <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">
                                                <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/mcq.jpg')}}" alt="Course Meta" style="height: 230px">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <span class="course-level">{{ $item->type }}</span>
                                            <h6 class="title">
                                                <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                            </h6>
                                            <div class="course-price">{{ $item->type != 'Free' ? '৳' . $item->price : '' }}
                                            </div>
                                            <ul class="course-meta">
                                                <li><i class="icon-24"></i>{{ $item->questions_count }} {{ __('Questions') }}</li>
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
                <!-- End Single Course  -->

                <div class="col-lg-3 order-lg-2">
                    <div class="course-sidebar-2">

                        <div class="edu-course-widget widget-category">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Search MCQ') }}</h5>
                                <div class="content">
                                    <ul class="header-action">
                                        <li class="search-bar">
                                            <form action="{{ route('mcq.search') }}">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('MCQ Search') }}" name="search">
                                                    <input type="hidden" name="view" value="grid">
                                                    <button class="search-btn" type="submit"><i
                                                            class="icon-2"></i></button>
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
                                    @foreach ($categories as $category)
                                        <div class="edu-form-check">
                                            <a href="{{ route('mcq.category', ['view' => 'grid', 'category' => $category->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $category->name))]) }}">{{ $category->name }}
                                                <span>({{ $category->models_count }})</span> 
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ $mcq->appends(['search' => request()->search, 'category' => request()->category, 'name' => request()->name])->links('frontend.pagination') }}
        </div>
    </div>
    <!-- End Course Area -->
@endsection
