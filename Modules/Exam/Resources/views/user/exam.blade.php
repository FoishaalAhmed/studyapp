@extends('backend.layouts.app')

@section('title', $title)
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- Live Exam -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> <span class="span">|</span> {{ $title }}</h4>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($exams as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-box">
                            <div class="card-body">
                                <div class="bg-light">
                                    <img src="{{ file_exists($item->photo) ? asset($item->photo) : asset('public/images/dummy/exam.webp') }}" class="img-fluid" width="333px"/>
                                </div>

                                <div class="product-info">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="font-16 mt-0 sp-line-1">
                                                <a href="{{ route('user.exams.detail', [$item->id, strtolower(str_replace([' ', '_', '&'], '-', $item->title))]) }}"> {{ $item->title }}</a>
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="font-16 mt-0 sp-line-1">{{ date('d M, Y h:i A', strtotime($item->start_date.$item->start_time)) }}</h5>
                                        </div>
                                    </div> <!-- end row -->
                                </div> <!-- end product info-->
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                @endforeach
            </div>

            <!-- end row-->
            {{ $exams->links('backend.pagination') }}
        </div> 
    </div>
@endsection