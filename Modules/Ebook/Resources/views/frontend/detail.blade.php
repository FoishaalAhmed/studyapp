@extends('layouts.app')

@section('title', __('Ebooks'))
@section('content')
    <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
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
    </div>
    <!-- Blog Details Area Start -->
    <div class="blog-details-area section-gap-equal">
        <div class="container">
            <div class="row row--30">
                <div class="col-lg-8">
                    <div class="blog-details-content">
                        <div class="entry-content">
                            <span class="category">{{ optional($ebook->subject)->name }}</span>
                            <h3 class="title">{{ $ebook->title }}</h3>
                            <ul class="blog-meta">
                                <li><i class="icon-27"></i>{{ date('M d, Y', strtotime($ebook->created_at)) }}</li>
                            </ul>
                            <div class="thumbnail">
                                <img src="{{ file_exists($ebook->thumb) ? asset($ebook->thumb) : asset('public/images/dummy/ebook.png') }}">
                            </div>
                        </div>
                        {!! $ebook->description !!}
                        <div class="blog-share-area">
                            <div class="row align-items-center">
                                <div class="col-md-7">

                                </div>
                                <div class="col-md-5">
                                    <div class="blog-share">
                                        <h6 class="title">{{ __('Share on:') }}</h6>
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

                    <!-- Start Comment Area  -->
                    <div class="comment-area">
                        <h3 class="heading-title">{{ __('Comments') }}</h3>
                        <div class="comment-list-wrapper">
                            <!-- Start Single Comment  -->
                            <div class="comment">
                                <div class="thumbnail">
                                    <img src="{{ asset('public/assets/frontend/images/blog/comment-01.jpg') }}"
                                        alt="Comment Images">
                                </div>
                                <div class="comment-content">
                                    <h5 class="title">Haley Bennet</h5>
                                    <span class="date">Oct 10, 2021</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
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
                                    <h6 class="title">Richard Gere</h6>
                                    <span class="date">Oct 10, 2021</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <!-- End Single Comment  -->
                        </div>
                    </div>
                    <!-- End Comment Area  -->
                </div>
                <div class="col-lg-4">
                    <div class="edu-blog-sidebar">
                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-latest-post">
                            <div class="inner">
                                <h4 class="widget-title">{{ __('Latest Ebook') }}</h4>
                                <div class="content latest-post-list">
                                    @foreach ($ebooks as $item)
                                        <div class="latest-post">
                                            <div class="thumbnail">
                                                <a href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}">
                                                    <img src="{{ file_exists($item->thumb) ? asset($item->thumb) : asset('public/images/dummy/ebook.png') }}" style="width: 80px; height: 80px;">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h6 class="title">
                                                    <a href="{{ route('ebooks.detail', ['title' => strtolower(str_replace([' ', '&', '_', '(', ')'], '-', $item->title)), 'ebook' => base64_encode($item->id)]) }}">{{ $item->title }}</a>
                                                </h6>
                                                <ul class="blog-meta">
                                                    <li><i class="icon-59"></i>{{ optional($item->category)->name }}</li>
                                                    <li><i class="icon-64"></i>{{ optional($item->subject)->name }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- End Single Widget  -->
                        <!-- Start Single Widget  -->
                        <div class="edu-blog-widget widget-tags">
                            <div class="inner">
                                <h4 class="widget-title">{{ __('Subjects') }}</h4>
                                <div class="content">
                                    <div class="tag-list">
                                        @foreach ($subjects as $subject)
                                            <a href="{{ route('ebooks.subject', ['view' => 'grid', 'subject' => $subject->id, 'name' => strtolower(str_replace([' ', '&', '_'], '-', $subject->name))]) }}">{{ $subject->name }} ({{ $subject->ebooks_count }}) </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
