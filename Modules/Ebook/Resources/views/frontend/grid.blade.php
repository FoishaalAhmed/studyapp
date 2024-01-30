@extends('layouts.app')
@section('title', __('Ebooks'))

@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('Ebooks') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Ebooks') }}</li>
                </ul>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1">
                <span></span>
            </li>
            <li class="shape-2 scene">
                <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape">
                </li>
            <li class="shape-3 scene">
                <img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}" alt="shape">
            </li>
            <li class="shape-4">
                <span></span>
            </li>
            <li class="shape-5 scene">
                <img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-07.png') }}" alt="shape">
            </li>
        </ul>
    </div>

    <!-- Blog Area Start -->
    <section class="section-gap-equal">
        <div class="container">
            <div class="edu-sorting-area">
                <div class="sorting-left">
                    <h6 class="showing-text">{{ __('We found') }} <span>{{ $ebooks->total() }}</span> {{ __('ebooks available for you') }}</h6>
                </div>
                <div class="sorting-right">
                    <div class="layout-switcher">
                        <label>{{ __('Grid') }}</label>
                        <ul class="switcher-btn">
                            <li><a href="javascript:;" class="active"><i class="icon-53"></i></a></li>

                            @if (request()->is('ebooks/categories'))
                                <li>
                                    <a href="{{ route('ebooks.category', ['category' => request()->category, 'name' => request()->name, 'view' => 'list']) }}" class=""><i class="icon-54"></i></a>
                                </li>
                            @elseif (request()->is('ebooks/subject'))
                                <li>
                                    <a href="{{ route('ebooks.subject', ['subject' => request()->subject, 'name' => request()->name, 'view' => 'list']) }}" class=""><i class="icon-54"></i></a>
                                </li>
                            @elseif (request()->has('search'))
                                <li>
                                    <a href="{{ route('ebooks.search', ['search' => request()->search, 'view' => 'list']) }}"
                                        class=""><i class="icon-54"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('ebooks.list', ['category' => request()->category, 'name' => request()->name]) }}" class=""><i class="icon-54"></i></a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row g-5" id="masonry-gallery">
                        <!-- Start Blog Grid  -->
                        @php
                            $delay = 100;
                        @endphp
                        @foreach ($ebooks as $item)
                            <div class="col-lg-6 col-md-6 col-12 masonry-item" data-sal-delay="<?= $delay ?>"
                                data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-blog blog-style-5">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}">
                                                <img src="{{ file_exists($item->thumb) ? asset($item->thumb) : asset('public/images/dummy/ebook.png') }}" style="height: 370px">
                                            </a>
                                        </div>
                                        <div class="content position-top">
                                            <div class="read-more-btn">
                                                <a class="btn-icon-round" href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}"><i class="icon-4"></i></a>
                                            </div>
                                            <div class="category-wrap">
                                                <a href="#" class="blog-category">{{ optional($item->subject)->name }}</a>
                                            </div>
                                            <h5 class="title">
                                                <a href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                            </h5>
                                            <ul class="blog-meta">
                                                <li><i class="icon-28"></i>{{ $item->buys_count }} {{ __('Buys') }}
                                                </li>
                                            </ul>
                                            {!! Str::limit($item->description, 200) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End Blog Grid  -->
                    </div>
                </div>
                <div class="col-lg-3 order-lg-2">
                    <div class="course-sidebar-2">
                        <div class="edu-course-widget widget-category">
                            <div class="inner">
                                <h5 class="widget-title widget-toggle">{{ __('Search Ebook') }}</h5>
                                <div class="content">
                                    <ul class="header-action">
                                        <li class="search-bar">
                                            <form action="{{ route('ebooks.search') }}">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="{{ __('Ebook Search') }}" name="search">
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
                                    @foreach ($categories as $category)
                                        <div class="edu-form-check">
                                            <a href="{{ route('ebooks.category', ['view' => 'grid', 'category' => $category->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $category->name))]) }}">{{ $category->name }}
                                                <span>({{ $category->ebooks_count }})</span> 
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
                                            <a href="{{ route('ebooks.subject', ['view' => 'grid', 'subject' => $subject->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $subject->name))]) }}">{{ $subject->name }}
                                                <span>({{ $subject->ebooks_count }})</span> 
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ $ebooks->appends(['search' => request()->search, 'category' => request()->category, 'name' => request()->name])->links('frontend.pagination') }}
    </section>

    <!-- Start Ad Banner Area  -->
    <div class="edu-cta-banner-area home-one-cta-wrapper bg-image">
        <div class="container">
            <div class="edu-cta-banner">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up"
                            data-sal-duration="800">
                            <h2 class="title">{{ __('Get Your Quality Skills') }} <span class="color-secondary">{{ __('Certificate') }}</span>
                                {{ __('Through :x', ['x' => settings('name')]) }} </h2>
                            <a href="{{ route('register') }}" class="edu-btn">{{ __('Get started now') }} <i class="icon-4"></i></a>
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
    <!-- End Ad Banner Area  -->
@endsection
