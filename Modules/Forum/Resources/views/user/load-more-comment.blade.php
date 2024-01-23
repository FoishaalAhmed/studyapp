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