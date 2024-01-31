@extends('layouts.app')

@section('title', __('Blogs'))
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('Blogs') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item"><a href="#">{{ __('Blogs') }}</a></li>
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

    <!-- Blog Area Start -->
    <section class="section-gap-equal">
        <div class="container">
            <div class="row row--30">
                <div class="col-lg-8">
                    @php
                        $delay = 150;
                    @endphp

                    @foreach ($blogs as $item)
                        <div class="edu-blog blog-style-list" data-sal-delay="<?= $delay ?>" data-sal="slide-up"
                            data-sal-duration="800">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="{{ route('blogs.detail', ['blog' => base64_encode($item->id), 'title' => $item->slug]) }}">
                                        <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/blog.jpg') }}" alt="Blog Images" style="width: 300px; height: 230px;">
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="title">
                                        <a href="{{ route('blogs.detail', ['blog' => base64_encode($item->id), 'title' => $item->slug]) }}">{{ $item->title }}</a>
                                    </h5>
                                    <ul class="blog-meta">
                                        <li><i class="icon-27"></i>{{ date('M d, Y', strtotime($item->date)) }}</li>
                                        <li><i class="icon-76"></i>{{ $item->view }}</li>
                                    </ul>
                                    {!! Str::limit($item->content, 100) !!}
                                    <div class="read-more-btn">
                                        <a class="edu-btn btn-border btn-medium"
                                            href="{{ route('blogs.detail', ['blog' => base64_encode($item->id), 'title' => $item->slug]) }}">{{ __('Learn More') }} <i class="icon-4"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $delay += 50; ?>
                    @endforeach

                    {{ $blogs->appends(['search' => request()->search, 'tag' => request()->tag])->links('frontend.pagination') }}
                </div>
                <div class="col-lg-4">
                    <div class="edu-blog-sidebar">
                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-search">
                            <div class="inner">
                                <h4 class="widget-title">{{ __('Search') }}</h4>
                                <div class="content">
                                    <form class="blog-search" action="{{ route('blogs.search') }}">
                                        @csrf
                                        <input type="text" placeholder="{{ __('Search') }}" name="search" required>
                                        <button type="submit" class="search-button"><i class="icon-2"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-latest-post">
                            <div class="inner">
                                <h4 class="widget-title">{{ __('Latest Content') }}</h4>
                                <div class="content latest-post-list">
                                    @foreach ($mcq as $item)
                                        <div class="latest-post">
                                            <div class="thumbnail">
                                                <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">
                                                    <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/mcq.jpg') }}" style="width: 80px; height: 80px;">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h6 class="title">
                                                    <a href="{{ route('mcq.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'mcq' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($exams as $item)
                                        <div class="latest-post">
                                            <div class="thumbnail">
                                                <a href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">
                                                    <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/exam.webp') }}" style="width: 80px; height: 80px;">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h6 class="title">
                                                    <a href="{{ route('exams.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'exam' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if (module('Ebook') && isActive('Ebook'))
                                        @foreach ($ebooks as $item)
                                            <div class="latest-post">
                                                <div class="thumbnail">
                                                    <a href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}">
                                                        <img src="{{ file_exists($item->thumb) ? asset($item->thumb) : asset('public/images/dummy/ebook.png')}}" style="width: 80px; height: 80px;">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h6 class="title">
                                                        <a href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-action">
                            <div class="inner">
                                <h4 class="title">{{ __('Get Online Courses From') }} <span>{{ settings('name') }}</span></h4>
                                <span class="shape-line"><i class="icon-19"></i></span>
                                <p>{{ __('Nostrud exer ciation laboris aliqup') }}</p>
                                <a href="{{ route('login') }}" class="edu-btn btn-medium">{{ __('Start Now') }} <i class="icon-4"></i></a>
                            </div>
                        </div>
                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-tags">
                            <div class="inner">
                                <h4 class="widget-title">{{ __('Tags') }}</h4>
                                <div class="content">
                                    <div class="tag-list">
                                        @foreach ($tags as $item)
                                            @if (str_contains($item->tag, ','))
                                                <?php $tagArray = explode(',', $item->tag); ?>
                                                @foreach ($tagArray as $tag)
                                                    <a href="{{ route('blogs.tag', ['tag' => $tag]) }}">{{ $tag }}</a>
                                                @endforeach
                                            @else
                                                <a href="{{ route('blogs.tag', ['tag' => $item->tag]) }}">{{ $item->tag }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Widget  -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
