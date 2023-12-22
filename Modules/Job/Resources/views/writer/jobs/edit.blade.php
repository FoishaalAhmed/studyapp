@extends('backend.layouts.app')

@section('title', __('Update Job'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Update Job') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.jobs.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Job') }}</a>
                        </p>
                        
                        <form action="{{ route('writer.jobs.update', $job->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Category') }}</label>
                                            <select class="form-control" name="job_category_id" id="job_category_id" data-toggle="select2" data-width="100%" required="">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $job->job_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('job_category_id')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ $job->title }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Company') }}</label>
                                            <input type="text" name="company" id="company" class="form-control" placeholder="{{ __('Company') }}" required="" value="{{ $job->company }}">
                                            @error('company')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Salary') }}</label>
                                            <input type="text" name="salary" id="salary" class="form-control" placeholder="{{ __('Salary') }}" required="" value="{{ $job->salary }}">
                                            @error('salary')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Location') }}</label>
                                            <input type="text" name="location" id="location" class="form-control" placeholder="{{ __('Location') }}" required="" value="{{ $job->location }}">
                                            @error('location')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('End Date') }}</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="{{ __('End Date') }}" data-provide="datepicker" value="{{ $job->end_date }}" required="">
                                            @error('end_date')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea class="form-control" id="editor" name="description" placeholder="{{ __('Description') }}">{{ $job->description }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="links" class="form-label">{{ __('Links') }}</label>
                                            @foreach ($job->links as $link)
                                                <input type="text" name="links[]" id="links" class="form-control mb-2" value="{{ $link->link }}" placeholder="{{ __('Links') }}">
                                            @endforeach
                                            <input type="text" name="links[]" id="links" class="form-control" placeholder="{{ __('Links') }}">
                                            <div id="new-row"></div>
                                            @error('links')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="job-photo" src="{{ file_exists($job->photo) ? asset($job->photo) : asset('public/images/dummy/job.jpg') }}" alt="{{ __('Job Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="job-photo-input">
                                            @error('photo')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('writer.jobs.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                                    <button type="button" id="new-link-button" class="btn btn-outline-info waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Add New Link') }}</button>
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
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-pickers.init.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
    <script>
        'use strict';
        let LinkPlaceholder = "{{ __('Links') }}";
    </script>

    <script src="{{ asset('Modules/Job/Resources/assets/js/job.js') }}"></script>
@endsection