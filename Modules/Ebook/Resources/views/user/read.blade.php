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
                <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?php echo url($ebook->book); ?>#toolbar=0&scrollbar=0" frameBorder="0" scrolling="auto" height="800px" width="100%"></iframe>
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection