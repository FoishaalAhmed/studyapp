@extends('backend.layouts.app')

@section('title', __('App User Child Category'))
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
                        <h4 class="header-title">{{ __('App User Child Category') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.app-user-child-categories.create') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-plus-square"></i> {{ __('New Data') }}</a>
                        </p>

                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">{{ __('SL') }}</th>
                                        <th style="width: 15%">{{ __('Category') }}</th>
                                        <th style="width: 20%">{{ __('Title') }}</th>
                                        <th style="width: 10%">{{ __('Type') }}</th>
                                        <th style="width: 40%">{{ __('Categories') }}</th>
                                        <th style="width: 10%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item['category'] }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>{{ $item['type'] }}</td>
                                            <td>
                                                @foreach ($item['categories'] as $key => $category)

                                                    @if ($key != 0) &nbsp @endif
                                                    @if ($key != 0 && $key % 2 == 0) <br/> @endif
                                                    {{ $key + 1 }}.  {{ $category->name }}

                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.app-user-child-categories.edit', $item['id']) }}" class="btn btn-outline-success waves-effect waves-light"><i class="fe-edit"></i></a>
                                            </td>
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
    <script src="{{ asset('public/assets/backend/js/pages/datatables.init.js') }}"></script>
@endsection