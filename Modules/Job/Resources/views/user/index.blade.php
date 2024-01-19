@extends('backend.layouts.app')

@section('title', __('Jobs'))

@section('css')
    <link href="{{ asset('Modules/Job/Resources/assets/css/jobs.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ __('Jobs') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 order-xl-1 order-2">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <form class="d-flex flex-wrap align-items-center">
                                        <label for="status-select" class="me-2">{{ __('Sort By') }}</label>
                                        <div class="me-sm-3">
                                            <select class="form-select my-1 my-md-0" id="status-select" name="sort">
                                                <option value="all" >{{ __('All') }}</option>
                                                <option value="active" {{ $type == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                                <option value="expired" {{ $type == 'expired' ? 'selected' : '' }}>{{ __('Expired') }}</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger waves-effect waves-light"><i class="fe-search me-1"></i> {{ __('Search') }} </button>
                                    </form>
                                </div>
                            </div> <!-- end row -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                    
                    <div class="row">
                        @foreach ($jobs as $job)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ file_exists($job->photo) ? asset($job->photo) : asset('public/images/dummy/job.jpg') }}" alt="logo" class="avatar-xl rounded-circle mb-1">
                                            <h4 class="mb-1 font-18">{{ $job->title }}</h4>
                                            <h5 class="mb-1 font-16">{{ $job->company }}</h5>
                                            <p class="text-muted  font-14">{{ $job->location }}</p>
                                        </div>

                                        <div class="text-center">
                                            <a href="{{ route('user.jobs.detail', [$job->id, strtolower(str_replace([' ', '_', '/'], '-', $job->title))]) }}" class="btn btn-sm btn-light">{{ __('View more info') }}</a>
                                        </div>

                                        <div class="row mt-2 text-center">
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">{{ __('Salary') }} (BDT)</h5>
                                                <h4>{{ $job->salary != 0 ? $job->salary : __('Negotiable') }}</h4>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="fw-normal text-muted">{{ __('Time left') }}</h5>
                                                <?php
                                                    $date = date('Y-m-d');
                                                    $diff = date_diff(date_create($date), date_create($job->end_date));
                                                    
                                                    $timeLeft = $job->end_date > $date ? $diff->format('%a days') : 'Already Expaired' ;
                                                ?>
                                                <h4 class="{{ $job->end_date > $date ? 'text-success' : 'text-danger' }}">
                                                    {{ $timeLeft }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        @endforeach
                    </div>
                    {{ $jobs->links('backend.pagination') }}
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection