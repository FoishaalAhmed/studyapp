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
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">{{ __('Suggested For You') }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('Jobs') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 order-xl-1 order-2">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <img class="card-img-top h-200" src="{{ asset('public/images/dummy/cover.jpg') }}" alt="Card image cap">
                                <div class="card-user-image">
                                    <img class="rounded-circle user-image" src="{{ file_exists($job->photo) ? asset($job->photo) : asset('public/images/dummy/job.jpg') }}" alt="User Avatar" id="user-photo">
                                </div>
                                <hr>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $job->title }}</h3>
                                    <h5>{{ $job->company }}</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="card-body border-info">
                                            <div class="row">
                                                <div class="col-md-3 job-info">
                                                    <p>{{ __('Job Category') }}</p>
                                                    <p><strong
                                                            style="font-size: 20px;">{{ optional($job->category)->name }}</strong>
                                                    </p>
                                                </div>
                                                <div class="col-md-3 job-info">
                                                    <p>Salary</p>
                                                    <p><strong
                                                            style="font-size: 20px;">{{ $job->salary != 0 ? '৳ ' . $job->salary . ' ' . __('BDT') : __('Negotiable') }}</strong>
                                                    </p>
                                                </div>
                                                <div class="col-md-3 job-info">
                                                    <p>{{ __('Location') }}</p>
                                                    <p><strong style="font-size: 20px;">{{ $job->location }}</strong></p>
                                                </div>
                                                <div class="col-md-3" style="text-align: center">
                                                    <p>{{ __('Days left') }}</p>
                                                    <p><strong style="font-size: 20px;">
                                                            <?php
                                                            $date = date('Y-m-d');
                                                            $date1 = date_create($date);
                                                            $date2 = date_create($job->end_date);
                                                            
                                                            $diff = date_diff($date1, $date2);
                                                            
                                                            $retVal = $job->end_date > $date ? $diff->format('%a') : 'Already Expaired';
                                                            
                                                            echo $retVal;
                                                            ?></strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="card-body">
                                    <p>{!! $job->description !!}</p>
                                </div>
                                @if ($retVal != 'Already Expaired')
                                    <hr>
                                    <a href="{{ route('user.jobs.apply', $job->id) }}" class="btn btn-outline-primary waves-effect waves-light float-end mb-2"> {{ __('Apply') }}</a>
                                    
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-xl-4">
                            @foreach ($jobs as $job)
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
                                                    <p class="mb-0"><i class="fe-watch me-1"></i> 
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
                            @endforeach
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection