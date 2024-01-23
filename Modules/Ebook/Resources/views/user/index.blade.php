@extends('backend.layouts.app')

@section('title', __('Ebook'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> <span class="span">|</span> {{ __('Ebook') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                @foreach ($ebooks as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-box">
                            <div class="card-body">
                                <div class="bg-light">
                                    <img src="{{ file_exists($item->thumb) ? asset($item->thumb) : asset('public/images/dummy/ebook.png') }}" class="img-fluid" width="333px"/>
                                </div>

                                <div class="product-info">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="font-16 mt-0 sp-line-1">{{ $item->title }}</h5>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="font-16 mt-0 sp-line-1">{{ $item->type }}</h5>
                                        </div>
                                    </div> <!-- end row -->
                                </div> <!-- end product info-->
                                <a href="{{ route('user.ebooks.download', $item->id) }}" class="btn btn-primary waves-effect waves-light"><i class="fe-download"></i> {{ __('Download') }}</a>
                                <a href="{{ route('user.ebooks.read', [$item->id, strtolower(str_replace([' ', '_', '&'], '-', $item->title))]) }}" class="btn btn-primary waves-effect waves-light float-end"> <i class="fe-book"></i> {{ __('Read Online') }}</a>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                @endforeach
            </div>
            <!-- end row-->
            {{ $ebooks->appends(['category_id' => request()->category_id, 'name' => request()->name])->links('backend.pagination') }}

        </div> <!-- container -->

    </div> <!-- content -->
@endsection