@extends('layouts.app')

@section('title', $page->name)
@section('content')
    <!-- Breadcrumb Area Start -->

    <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ $page->name }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Blog Details Area Start -->
    <div class="blog-details-area section-gap-equal">
        <div class="container">
            <div class="row row--30">
                <div class="col-lg-12">
                    <div class="blog-details-content">
                        <div class="entry-content">
                            <div class="thumbnail">
                                @if (file_exists($page->photo))
                                    <img src="{{ asset($page->photo) }}">
                                @endif
                            </div>
                        </div>
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
