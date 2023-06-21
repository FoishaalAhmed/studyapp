@extends('backend.layouts.app')

@section('title', __('Resource Buy'))
@section('css')
    <!-- third party css -->
    <link href="{{ asset('public/assets/backend/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/backend/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="type" class="form-label">{{ __('Type') }}</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="mcq">{{ __('MCQ') }}</option>
                                        <option value="ebook">{{ __('Ebook') }}</option>
                                        <option value="sheet">{{ __('Lecture Sheet') }}</option>
                                        <option value="exam">{{ __('Exam') }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light mt-3 float-start"><i class="fe-search"></i> {{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{ __('Resource Buy') }}</h4>

                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table dt-responsive nowrap w-100', 'width' => '100%', 'cellspacing' => '0']) !!}
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection

@section('js')
    <!-- third party js -->
    <script src="{{ asset('public/assets/backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <!-- Datatables init -->
    <script src="{{ asset('public/assets/backend/js/pages/datatables.init.js') }}"></script>

    {!! $dataTable->scripts() !!}
@endsection