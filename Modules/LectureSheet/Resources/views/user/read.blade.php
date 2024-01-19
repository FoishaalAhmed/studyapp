@extends('backend.layouts.app')

@section('title', __('Lecture Sheet'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> <span style="font-weight: bolder; background: #7875FC; width: 15px; display: inline-block; color: #7875FC; border-radius: 4px; margin-right: 10px; line-height: 25px;">|</span> {{ __('Lecture Sheet') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

             <div class="row">
                <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?php echo url($sheet->file); ?>#toolbar=0&scrollbar=0" frameBorder="0" scrolling="auto" height="800px" width="100%"></iframe>
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection