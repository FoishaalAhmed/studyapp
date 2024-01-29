@if ($paginator->hasPages())
    <ul class="edu-pagination ">
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="javascript:;" aria-label="{{ __('Previous') }}"><i class="icon-west"></i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" aria-label="{{ __('Previous') }}"><i
                        class="icon-west"></i></a></li>
        @endif

        @foreach ($elements as $element)
            
            @if (is_string($element))
                <li><a href="javascript:;">{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="javascript:;">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif

        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" aria-label="{{ __('Next') }}"><i class="icon-east"></i></a>
            </li>
        @else
            <li><a href="javascript:;" aria-label="{{ __('Next') }}"><i class="icon-east"></i></a></li>
        @endif
    </ul>
@endif
