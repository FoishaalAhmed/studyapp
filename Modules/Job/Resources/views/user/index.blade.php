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
                            <div class="col-xl-4">
                                <div class="card mb-2">
                                    <div class="card-body border-info">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <h4 class="mt-0 mb-2 font-16">{{ str()->limit($job->title, 50) }}</h4>
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="{{ route('user.jobs.detail', [$job->id, strtolower(str_replace([' ', '_', '/'], '-', $job->title))]) }}" class="badge font-14 bg-soft-info text-info p-1"><i class="fe-list"></i></a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="d-flex align-items-start">
                                                    <img class="d-flex align-self-center me-3 rounded-circle" src="{{ file_exists($job->photo) ? asset($job->photo) : asset('public/images/dummy/job.jpg') }}" alt="Generic placeholder image" height="40">
                                                    <div class="w-100">
                                                        <p class="mb-1"><i class="mdi mdi-domain me-1"></i> {{ str()->limit($job->company, 25) }}</p>
                                                        <p class="mb-0"><i class=" fe-map-pin  me-1"></i> {{ $job->location }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="align-items-center">
                                                    <p class="mb-1 mt-sm-0"><i class="fe-dollar-sign me-1"></i> {{ $job->salary != 0 ? '৳ ' . $job->salary . ' ' . __('BDT') : __('Negotiable') }}</p>
                                                    <p class="mb-0 text-danger"><i class="fe-watch me-1"></i> 
                                                        <?php
                                                            $date = date('Y-m-d');
                                                            $diff = date_diff(date_create($date), date_create($job->end_date));
                                                            
                                                            $retVal = $job->end_date > $date ? $diff->format('%a days left') : 'Already Expaired' ;

                                                            echo $retVal;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-->
                            </div>
                        @endforeach
                    </div>
                    {{ $jobs->links('backend.pagination') }}
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection