@extends('backend.layouts.app')

@section('title', __('Profile'))

@section('css')
    <link href="{{ asset('public/assets/backend/css/custom/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ __('Profile') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Simple card -->
                <div class="card">
                    <img class="card-img-top h-200" src="{{ asset('public/images/dummy/cover.jpg') }}" alt="Card image cap">
                    <div class="card-user-image">
                        <img class="rounded-circle user-image" src="{{ file_exists(auth()->user()->photo) ? asset(auth()->user()->photo) : asset('public/images/dummy/user.png') }}" alt="User Avatar" id="user-photo">
                    </div>
                    <hr>
                    <div class="card-body">
                        <h3 class="card-title">{{ auth()->user()->name }}</h3>
                        <h5>{{ __('Age') . ' : ' .auth()->user()->age }} | {{ __('Gender') . ' : ' .auth()->user()->gender }}</h5>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h3 class="card-title"><i class="fe-bar-chart-line"></i> {{ __('My ranking') }}</h3>
                        <h4><i class="fe-bar-chart-line v-none"></i>{{ $rank ? $rank + 1 : 0 }} {{ __('Rank') }}</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h3 class="card-title"><i class="fe-bar-chart-line"></i> {{ __('Complete Model Question') }}</h3>
                        <h5>{{ round($totalModelComplete) }}% {{ __('Complete') }}</h5>
                        <div class="progress mb-0">
                            <div class="progress-bar" role="progressbar" style="width: {{ round($totalModelComplete) }}%;" aria-valuenow="{{ round($totalModelComplete) }}" aria-valuemin="0" aria-valuemax="100">{{ round($totalModelComplete) }}%</div>
                        </div>
                        <br>
                        <h3 class="card-title"><i class="fe-bar-chart-line"></i> {{ __('Complete Exam Question') }}</h3>
                        <h5>{{ round($totalExamComplete) }}% {{ __('Complete') }}</h5>
                        <div class="progress mb-0">
                            <div class="progress-bar" role="progressbar" style="width: {{ round($totalExamComplete) }}%;" aria-valuenow="{{ round($totalExamComplete) }}" aria-valuemin="0" aria-valuemax="100">{{ round($totalExamComplete) }}%</div>
                        </div>
                        <br>
                        <a href="{{ route('profile') }}" class="btn btn-outline-primary waves-effect waves-light float-end"> {{ __('Update Profile') }}</a>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->
@endsection

@section('js')
    <script src="{{ asset('public/assets/backend/js/custom/profile.js') }}"></script>
@endsection


