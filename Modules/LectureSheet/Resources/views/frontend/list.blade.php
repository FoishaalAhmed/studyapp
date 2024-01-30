@extends('layouts.app')

@section('title', __('Sheets'))
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('Sheets') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Sheets') }}</li>
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
    <div class="edu-event-area event-area-1 section-gap-equal">
        <div class="container">
            <div class="edu-sorting-area">
                <div class="sorting-left">
                    <h6 class="showing-text">{{ __('We found') }} <span>{{ $sheets->total() }}</span>
                        {{ __('lecture sheets available for you') }}</h6>
                </div>
                <div class="sorting-right">
                    <div class="layout-switcher">
                        <label>{{ __('List') }}</label>
                        <ul class="switcher-btn">
                            @if (request()->is('sheets/categories'))
                                <li>
                                    <a href="{{ route('sheets.category', ['category' => request()->category, 'name' => request()->name, 'view' => 'grid']) }}" class=""><i class="icon-53"></i></a>
                                </li>
                            @elseif (request()->is('sheets/subject'))
                                <li>
                                    <a href="{{ route('sheets.subject', ['subject' => request()->subject, 'name' => request()->name, 'view' => 'grid']) }}" class=""><i class="icon-53"></i></a>
                                </li>
                            @elseif (request()->has('search'))
                                <li>
                                    <a href="{{ route('sheets.search', ['search' => request()->search, 'view' => 'grid']) }}"
                                        class=""><i class="icon-53"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('sheets.grid', ['category' => request()->category, 'name' => request()->name]) }}"
                                        class=""><i class="icon-53"></i></a>
                                </li>
                            @endif

                            <li><a href="javascript:;" class="active"><i class="icon-54"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row g-5">

                <div class="col-lg-9 order-lg-1 col-pr--35">
                    <div class="row g-5">
                        @php
                            $delay = 150;
                        @endphp
                        @foreach ($sheets as $item)
                            <div class="col-12" data-sal-delay="<?= $delay ?>" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-event-list event-list-2">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="{{ route('sheets.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->chapter)), 'sheet' => base64_encode($item->id)]) }}">
                                                <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/sheet.png') }}" alt="Course Meta" style="width: 320px;">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                <a href="{{ route('sheets.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->chapter)), 'sheet' => base64_encode($item->id)]) }}">{{ $item->chapter }}</a>
                                            </h4>
                                            <span class="event-location"><i class="icon-24"></i>{{ $item->buys_count }} {{ __('Buys') }}</span>
                                            {!! Str::limit($item->description, 200) !!}
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn-medium btn-border" href="{{ route('sheets.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->chapter)), 'sheet' => base64_encode($item->id)]) }}">{{ __('Learn More') }}
                                                    <i class="icon-4"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $delay += 50; ?>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 order-lg-2">
                    <div class="course-sidebar-2">
                        <div class="edu-course-widget widget-category">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Search Lecture Sheet') }}</h5>
                                <div class="content">
                                    <ul class="header-action">
                                        <li class="search-bar">
                                            <form action="{{ route('sheets.search') }}">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="{{ __('Lecture Sheet Search') }}" name="search">
                                                    <input type="hidden" name="view" value="list">
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
                                    @foreach ($categories as $category)
                                        <div class="edu-form-check">
                                            <a href="{{ route('sheets.category', ['view' => 'list', 'category' => $category->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $category->name))]) }}">{{ $category->name }}
                                                <span>({{ $category->sheets_count }})</span> 
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="edu-course-widget widget-instructor">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Subjects') }}</h5>
                                <div class="content">
                                    @foreach ($subjects as $subject)
                                        <div class="edu-form-check">
                                            <a href="{{ route('sheets.subject', ['view' => 'list', 'subject' => $subject->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $subject->name))]) }}">{{ $subject->name }}
                                                <span>({{ $subject->sheets_count }})</span> 
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ $sheets->appends(['search' => request()->search, 'category' => request()->category, 'name' => request()->name])->links('frontend.pagination') }}
        </div>
    </div>
@endsection
