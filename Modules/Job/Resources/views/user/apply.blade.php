@extends('backend.layouts.app')

@section('title', __('Apply For Job'))

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('public/assets/backend/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/backend/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Apply For Job') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('user.jobs.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Job') }}</a>
                        </p>
                        
                        <form action="{{ route('user.jobs.store', $job->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 d-flex justify-content-center align-items-center">
                                <div class="col-lg-8 mb-3">
                                    <label class="form-label">{{ __('Document Title') }}</label>
                                    <input type="text" name="title[]" id="title" class="form-control" placeholder="{{ __('Document Title') }}" required="" value="{{ old('title') }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="form-label">{{ __('Document') }}</label>
                                    <div class="card card-border">
                                        <img class="card-img-top" id="job-apply-photo-1" src="{{ asset('public/images/dummy/job.jpg') }}" alt="{{ __('Job Image') }}" height="100px">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control file-upload" data-count="1" id="job-apply-photo-input-1" onchange="readPictureJobApply(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="new-row"></div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('user.jobs.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                                    <button type="button" id="new-document-button" class="btn btn-outline-info waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Add New Document') }}</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection

@section('js')
    <!-- Plugins js -->
    <script src="{{ asset('public/assets/backend/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/dropify/js/dropify.min.js') }}"></script>
    <!-- Init js-->
    <script src="{{ asset('public/assets/backend/js/pages/form-fileuploads.init.js') }}"></script>

    <script>
        'use strict';
        let documentTitleText= "{{ __('Document Title') }}";
        let documentText = "{{ __('Document') }}";
        let defaultPhoto = "{{ asset('public/images/dummy/job.jpg') }}";
    </script>

    <script src="{{ asset('Modules/Job/Resources/assets/js/job.js') }}"></script>
@endsection