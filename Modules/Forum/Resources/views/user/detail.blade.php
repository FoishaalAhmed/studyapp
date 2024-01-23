@extends('backend.layouts.app')

@section('title', __('Forum Detail'))

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
                        
                        <h4 class="page-title">{{ __('Forum Detail') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-1 order-lg-1 order-xl-1">

                </div> <!-- end col -->

                <div class="col-10 order-lg-2 order-xl-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <img class="me-2 avatar-sm rounded-circle" src="{{ file_exists($forum->user?->photo) ? asset($forum->user?->photo) : asset('public/images/dummy/user.png') }}"
                                >
                                <div class="w-100 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-0"><a href="javascript:;" class="text-reset">{{ $forum->user?->name }}</a></h5>
                                        <p class="text-muted"><small>{{ $forum->created_at->diffForHumans() }}</small></p>
                                    </div>
                                    <div>
                                        <h5 class="m-0">{{ $forum->title }}</h5>
                                    </div>
                                    <div>
                                        <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted ps-0"><i class="fe-eye text-danger"></i> {{ $forum->view }}</a>
                                        <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class="mdi mdi-comment-multiple-outline text-danger"></i> {{ count($forum->comments) }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="font-16 text-center fst-italic text-dark">
                                <i class="mdi mdi-format-quote-open font-20"></i> {{ $forum->description }}
                            </div>

                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                @if ($forum->comment)
                                    <p class="btn btn-sm btn-link text-muted ps-0 fw-bold"> {{ $forum->comment?->user?->name }} {{ __('replied') }} {{ $forum->comment?->created_at?->diffForHumans() }} </p>
                                @endif

                                <div class="float-left">
                                    @foreach ($forum->comments as $comment)
                                        @break($loop->index == 3)
                                        <img src="{{ file_exists($comment->user?->photo) ? asset($comment->user?->photo) : asset('public/images/dummy/user.png') }}" class="rounded-circle mln-10" height="42">
                                    @endforeach
                                    @if (count($forum->comments) > 3)
                                        <img src="" alt="{{ '+' . count($forum->comments) - 3 }}" class="rounded-circle mln-10 bg-primary p4 fs-3 text-white" height="42">
                                    @endif
                                </div>
                            </div>

                            @foreach ($comments as $item)
                                <div class="post-user-comment-box mt-2">
                                    <div class="d-flex align-items-start">
                                        <img class="me-2 avatar-sm rounded-circle" src="{{ file_exists($item->user?->photo) ? asset($item->user?->photo) : asset('public/images/dummy/user.png') }}">
                                        <div class="w-100">
                                            <h5 class="mt-0"><a href="#" class="text-reset">{{ optional($item->user)->name }}</a> <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small></h5>
                                            {{ $item->comment }}

                                            <br>
                                            @if (file_exists($item->photo))
                                            <img src="{{ asset($item->photo) }}" alt="post-img" class="rounded me-1" height="100">
                                            @endif

                                            @foreach ($item->replies as $reply)
                                                <div class="d-flex align-items-start mt-3">
                                                    <a class="pe-2" href="#">
                                                        <img src="{{ file_exists($reply->user?->photo) ? asset($reply->user?->photo) : asset('public/images/dummy/user.png') }}" class="avatar-sm rounded">
                                                    </a>
                                                    <div class="w-100">
                                                        <h5 class="mt-0"><a href="#" class="text-reset">{{ optional($reply->user)->name }}</a> <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small></h5>
                                                        {{ $reply->reply }}
                                                        <br>
                                                        @if (file_exists($reply->photo))
                                                        <img src="{{ asset($reply->photo) }}" alt="post-img" class="rounded me-1" height="100">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex align-items-start mt-2">
                                                <a class="pe-2" href="#">
                                                    <img src="{{ file_exists(auth()->user()->photo) ? asset(auth()->user()->photo) : asset('public/images/dummy/user.png') }}" class="rounded" height="31">
                                                </a>
                                                <div class="w-100">
                                                    <input type="text" class="form-control border-0 form-control-sm" data-bs-toggle="modal" data-bs-target="#reply-modal" placeholder="{{ __('Write a relpy') }}" data-id="{{ $item->id }}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                </div>
                            @endforeach
                            <div id="new-comment-item"></div>
                            <div class="d-flex align-items-start mt-3">
                                <img src="{{ file_exists(auth()->user()->photo) ? asset(auth()->user()->photo) : asset('public/images/dummy/user.png') }}" height="32" class="align-self-start rounded me-2">
                                <div class="w-100">
                                    <input type="text" class="form-control form-control-light border-0 form-control-sm" data-bs-toggle="modal" data-bs-target="#comment-modal" data-id="{{ $forum->id }}" placeholder="{{ __('Write a comment') }}">
                                </div> <!-- end medi-body -->
                            </div>
                        </div>
                    </div>
                    

                    <!-- loader -->
                    <div class="text-center mb-3">
                        <button class="btn btn-outline-primary waves-effect waves-light" id="load-more-comment" data-paginate="2"> {{ __('Load more') }} </button>
                        <p class="invisible text-center">{{ __('No more forum post') }}</p>
                    </div>
                </div>
            </div>
        </div> <!-- container -->

    </div> <!-- content -->

    <!--  Modal content for the Large example -->
    <div class="modal fade" id="comment-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{ __('Write A Comment') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="comment-message"></span>
                    <form action="" method="post" enctype="multipart/form-data" id="comment-form">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="comment" class="form-label">{{ __('Comment') }}</label>
                                <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                                <input type="hidden" name="forum_id" id="forum-id">
                                
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

    <!--  Modal content for the Large example -->
    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{ __('Write A Reply') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="reply-message"></span>
                    <form action="" method="post" enctype="multipart/form-data" id="reply-form">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="reply" class="form-label">{{ __('Reply') }}</label>
                                <textarea name="reply" class="form-control" id="reply" rows="3"></textarea>
                                <input type="hidden" name="forum_comment_id" id="forum-comment-id">
                                
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
        var forumId = '{{ $forum->id }}';
        var loadingText = "{{ __('Loading...') }}";
        var loadMoreText = "{{ __('Load More') }}";
        var commentLoadUrl = '{{ route("user.forums.load.comment") }}';
        var commentStoreUrl = "{{ route('user.forums.store.comment') }}";
        var replyStoreUrl = "{{ route('user.forums.store.reply') }}";
    </script>
    <script src="{{ asset('Modules\Forum\Resources\assets\js\forum.js') }}"></script>
@endsection