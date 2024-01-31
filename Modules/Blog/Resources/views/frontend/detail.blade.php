@extends('layouts.app')

@section('title', "$blog->title")
@section('content')
    <!--=Breadcrumb Area Start=-->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ $blog->title }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">{{ __('Blogs') }}</a></li>
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
                    <div class="blog-details-content">
                        <div class="entry-content">
                            
                            <h3 class="title">{{ $blog->title }}</h3>
                            <ul class="blog-meta">
                                <li><i class="icon-27"></i>{{ date('M d, Y', strtotime($blog->date)) }}</li>
                                <li><i class="icon-76"></i>{{ $blog->view }}</li>
                            </ul>
                            <div class="thumbnail">
                                <img src="{{ file_exists($blog->photo) ? asset($blog->photo) : asset('public/images/dummy/blog.jpg') }}" >
                            </div>
                        </div>
                        
                        {!! $blog->content !!}
                        
                        <div class="blog-share-area">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <div class="blog-tags">
                                        <h6 class="title">{{ __('Tags') }}:</h6>
                                        <div class="tag-list">
                                            <?php $tagArray = explode(',', $blog->tag); ?>
                                                @foreach ($tagArray as $tag)
                                                    <a href="{{ route('blogs.tag', ['tag' => $tag]) }}">{{ $tag }}</a>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="blog-share">
                                        <h6 class="title">{{ __('Share on') }}:</h6>
                                        <ul class="social-share icon-transparent">
                                            <li>
                                                <a href="#"><i class="icon-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-pagination">
                        <div class="row g-5">
                            <div class="col-lg-6">
                                <div class="blog-pagination-list prev-post">
                                    @if ($previous)
                                        <a href="{{ route('blogs.detail', ['blog' => base64_encode($previous->id), 'title' => $previous->slug]) }}">
                                            <i class="icon-west"></i>
                                            <span>{{ $previous->title }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="blog-pagination-list next-post">
                                    @if ($next)
                                        <a href="{{ route('blogs.detail', ['blog' => base64_encode($next->id), 'title' => $next->slug]) }}">
                                            <span>{{ $next->title }}</span>
                                            <i class="icon-east"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

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
                        @if ($blogs->isnotEmpty())
                            <!-- Start Single Widget  -->
                            <div class="edu-blog-widget widget-latest-post">
                                <div class="inner">
                                    <h4 class="widget-title">{{ __('Latest Content') }}</h4>
                                    <div class="content latest-post-list">
                                        @foreach ($blogs as $item)
                                            <div class="latest-post">
                                                <div class="thumbnail">
                                                    <a href="{{ route('blogs.detail', ['blog' => base64_encode($item->id), 'title' => $item->slug]) }}">
                                                        <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/blog.jpg') }}" style="width: 80px; height: 80px;">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <h6 class="title">
                                                        <a href="{{ route('blogs.detail', ['blog' => base64_encode($item->id), 'title' => $item->slug]) }}">{{ $item->title }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif


                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-action">
                            <div class="inner">
                                <h4 class="title">{{ __('Get Online Courses From') }} <span>{{ settings('name') }}</span></h4>
                                <span class="shape-line"><i class="icon-19"></i></span>
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
