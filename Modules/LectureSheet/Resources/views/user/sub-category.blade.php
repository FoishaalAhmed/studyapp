@extends('backend.layouts.app')

@section('title', __('Lecture Sheet Categories'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> <span class="span">|</span> {{ __('Lecture Sheet Category') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @foreach ($sheetCategories as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-box">
                            <div class="card-body">
                                <div class="bg-light">
                                    <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/sheet.png') }}" class="img-fluid" width="333px"/>
                                </div>

                                <div class="product-info">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="font-16 mt-0 sp-line-1"><a href="{{ route('user.sheets.categories', [$item->id, strtolower(str_replace([' ', '_', '&'], '-', $item->name))]) }}" class="text-dark">{{ $item->name }}</a> </h5>
                                        </div>
                                    </div> <!-- end row -->
                                </div> <!-- end product info-->
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                @endforeach
            </div>
            <!-- end row-->
            {{ $sheetCategories->links('backend.pagination') }}

        </div> <!-- container -->

    </div> <!-- content -->
@endsection