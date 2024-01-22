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

            <div class="mt-2 d-flex justify-content-between align-items-center">
                @if ($item->comment)
                    <a href="{{ route('user.forums.detail', [$item->id, strtolower(str_replace([' ', '_', '/'], '-', $item->title))]) }}" class="btn btn-sm btn-link text-muted ps-0 fw-bold"> {{ $item->comment?->user?->name }} {{ __('replied') }} {{ $item->comment?->created_at?->diffForHumans() }} </a>
                @endif

                <div class="float-left">
                    @foreach ($item->comments as $comment)
                        @break($loop->index == 3)
                        <img src="{{ file_exists($comment->user?->photo) ? asset($comment->user?->photo) : asset('public/images/dummy/user.png') }}" class="rounded-circle mln-10" height="42">
                    @endforeach
                    @if (count($item->comments) > 3)
                        <img src="" alt="{{ '+' . count($item->comments) - 3 }}" class="rounded-circle mln-10 bg-primary p4 fs-3 text-white" height="42">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach