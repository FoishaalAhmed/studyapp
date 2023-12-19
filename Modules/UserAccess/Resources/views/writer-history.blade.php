@extends('backend.layouts.app')

@section('title', __('Writer History'))

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
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Writer History') }}</h4>
                        
                        <form action="{{ route('admin.writer.history') }}" method="get">
                            <div class="row mb-3">
                                <div class="col-lg-4 mb-3">
                                    <label class="form-label">{{ __('Writer') }}</label>
                                    <select class="form-control" name="user_id" id="user_id" data-toggle="select2" data-width="100%" required="">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ isset($userId) && $userId == $user->id ? 'selected' : '' }} >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="col-lg-3 mb-3">
                                    <label class="form-label">{{ __('Start Date') }}</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="{{ __('Start Date') }}" data-provide="datepicker" value="{{ isset($startDate) ? $startDate : '' }}">
                                </div>
                                
                                <div class="col-lg-3 mb-3">
                                    <label class="form-label">{{ __('End Date') }}</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="{{ __('Result Date') }}" data-provide="datepicker" value="{{ isset($endDate) ? $endDate : '' }}">
                                </div>
                                <div class="col-lg-2 mb-3">
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light mt-3"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>

                        @if (isset($examQuestionCount) || isset($questionCount) || isset($subCategoryCount) || isset($childCategoryCount) || isset($examCount) || isset($mcqCount))
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <tbody>
                                        @isset($mcqCount)
                                            <tr>
                                                <td>{{ __('Total Model Test') }}</td>
                                                <td class="text-end">{{ $mcqCount }}</td>
                                            </tr>
                                        @endisset

                                        @isset($examCount)
                                            <tr>
                                                <td>{{ __('Total Exam') }}</td>
                                                <td class="text-end">{{ $examCount }}</td>
                                            </tr>
                                        @endisset

                                        @isset($examQuestionCount)
                                            <tr>
                                                <td>{{ __('Total Exam Question') }}</td>
                                                <td class="text-end">{{ $examQuestionCount }}</td>
                                            </tr>
                                        @endisset

                                        @isset($questionCount)
                                            <tr>
                                                <td>{{ __('Total MCQ Question') }}</td>
                                                <td class="text-end">{{ $questionCount }}</td>
                                            </tr>
                                        @endisset

                                        @isset($subCategoryCount)
                                            <tr>
                                                <td>{{ __('Total Category') }}</td>
                                                <td class="text-end">{{ $subCategoryCount }}</td>
                                            </tr>
                                        @endisset

                                        @isset($childCategoryCount)
                                            <tr>
                                                <td>{{ __('Total Sub Category') }}</td>
                                                <td class="text-end">{{ $childCategoryCount }}</td>
                                            </tr>
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        @endif

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
@endsection