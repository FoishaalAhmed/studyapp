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
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="type" class="form-label">{{ __('Type') }}</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="mcq" {{ $type == 'mcq' ? 'selected' : '' }}>{{ __('MCQ') }}</option>
                                        <option value="ebook" {{ $type == 'ebook' ? 'selected' : '' }}>{{ __('Ebook') }}</option>
                                        <option value="sheet" {{ $type == 'sheet' ? 'selected' : '' }}>{{ __('Lecture Sheet') }}</option>
                                        <option value="exam" {{ $type == 'exam' ? 'selected' : '' }}>{{ __('Exam') }}</option>
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
                        <h4 class="header-title">{{ __('Resource Buy') }}</h4>
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('SL') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Resource') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resources as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ ucfirst($item->type) }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->resource }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
@endsection