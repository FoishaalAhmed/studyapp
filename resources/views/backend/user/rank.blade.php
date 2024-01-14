@extends('backend.layouts.app')

@section('title', __('Top 100 Ranking'))
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
                        <h4 class="header-title">{{ __('Top 100 Ranking') }}</h4>
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('Rank') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Badge') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ranks as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="table-user">
                                                <img src="{{ file_exists(optional($item->user)->photo) ? asset(optional($item->user)->photo) : asset('public/images/dummy/user.png') }}" alt="table-user" class="me-2 rounded-circle">
                                                <a href="javascript:void(0);" class="text-body fw-semibold">{{ optional($item->user)->name }}</a>
                                            </td>
                                            <td>
                                                @if ($loop->index == 0)
                                                    <img src="{{ asset('public/images/dummy/badge1.png') }}" alt="table-user" class="me-2 rounded-circle">
                                                @elseif ($loop->index == 1)
                                                    <img src="{{ asset('public/images/dummy/badge2.png') }}" alt="table-user" class="me-2 rounded-circle">
                                                @elseif ($loop->index == 2)
                                                    <img src="{{ asset('public/images/dummy/badge3.png') }}" alt="table-user" class="me-2 rounded-circle">
                                                @endif
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
    <!-- Datatables init -->
    <script src="{{ asset('public/assets/backend/js/pages/datatables.init.js') }}"></script>
@endsection