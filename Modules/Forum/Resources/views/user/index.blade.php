@extends('backend.layouts.app')

@section('title', __('Forum'))

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('public/assets/backend/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/backend/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        
                        <h4 class="page-title">{{ __('Forum') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-1 order-lg-1 order-xl-1">

                </div> <!-- end col -->

                <div class="col-10 order-lg-2 order-xl-1">
                    <!-- new post -->
                    <div class="card">
                        <div class="card-body p-0">
                            <ul class="nav nav-tabs nav-bordered"></ul>
                            <div class="tab-content pt-0">
                                <div class="tab-pane show active p-3" id="newpost">
                                    <!-- comment box -->
                                    <div class="border rounded">
                                        <textarea rows="4" class="form-control border-0 resize-none" placeholder="Write something...." data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"></textarea>
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="#" class="btn btn-sm px-2 font-16 btn-light" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-image-outline"></i></a>
                                                <a href="#" class="btn btn-sm px-2 font-16 btn-light" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-crosshairs-gps"></i></a>
                                                <a href="#" class="btn btn-sm px-2 font-16 btn-light" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-attachment"></i></a>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-success"><i class='mdi mdi-send-outline me-1' data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"></i>{{ __('Post') }}</button>
                                        </div>
                                    </div> <!-- end .border-->
                                    <!-- end comment box -->
                                </div> <!-- end preview-->
                            </div> <!-- end tab-content-->
                        </div>
                    </div>
                    <!-- end new post -->

                    <!-- Story Box-->
                    @foreach ($forums as $item)
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img class="me-2 avatar-sm rounded-circle" src="{{ file_exists($item->user?->photo) ? asset($item->user?->photo) : asset('public/images/dummy/user.png') }}"
                                        alt="Generic placeholder image">
                                    <div class="w-100 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="m-0"><a href="javascript:;" class="text-reset">{{ $item->user?->name }}</a></h5>
                                            <p class="text-muted"><small>{{ $item->created_at->diffForHumans() }}</small></p>
                                        </div>
                                        <div>
                                            <h5 class="m-0"><a href="{{ route('user.forums.detail', [$item->id, strtolower(str_replace([' ', '_', '/'], '-', $item->title))]) }}" class="text-reset">{{ $item->title }}</a></h5>
                                        </div>
                                        <div>
                                            <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted ps-0"><i class="fe-eye text-danger"></i> {{ $item->view }}</a>
                                            <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class="mdi mdi-comment-multiple-outline text-danger"></i> {{ count($item->comments) }}</a>
                                        </div>
                                    </div>
                                </div>
                                <p>{{ str()->limit($item->description, 370) }}</p>

                                <div class="mt-2">
                                    <a href="{{ route('user.forums.detail', [$item->id, strtolower(str_replace([' ', '_', '/'], '-', $item->title))]) }}" class="btn btn-sm btn-link text-muted ps-0 fw-bold"> {{ $item->comment?->user?->name }} {{ __('replied') }} {{ $item->comment?->created_at?->diffForHumans() }} </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div id="new-forum-item"></div>

                    <!-- loader -->
                    <div class="text-center mb-3">
                        <button class="btn btn-outline-primary waves-effect waves-light" id="load-more" data-paginate="2"> {{ __('Load more') }} </button>
                        <p class="invisible text-center">{{ __('No more forum post') }}</p>
                    </div>
                    <!-- end loader -->
                </div>
            </div> <!--end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    <!--  Modal content for the Large example -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{ __('New Forum Post') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="form-message"></span>
                    <form action="" method="post" enctype="multipart/form-data" id="forum-form">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title') }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="tags" class="form-label">{{ __('Tags') }}</label>
                                <input type="text" name="tags" id="tags" class="form-control" placeholder="{{ __('Tags') }}" required="" value="{{ old('tags') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                                
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="file" data-plugins="dropify" data-height="200" name="photo"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <a href="javascript:;" class="btn btn-outline-danger waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <!-- Plugins js -->
    <script src="{{ asset('public/assets/backend/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/libs/dropify/js/dropify.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('public/assets/backend/js/pages/form-fileuploads.init.js') }}"></script>
    <script>
        'use strict';
        var csrf = '{{ csrf_token() }}';
        var loadingText = "{{ __('Loading...') }}";
        var loadMoreText = "{{ __('Load More') }}";
        var url = '{{ route("user.forums.load.post") }}';
        var forumStoreUrl = "{{ route('user.forums.store') }}";
    </script>
    <script src="{{ asset('Modules\Forum\Resources\assets\js\forum.js') }}"></script>
@endsection