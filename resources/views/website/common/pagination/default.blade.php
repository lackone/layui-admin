@if ($paginator->hasPages())
    <div class="pagination-wrapper centred">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled"><i class="fas fa-angle-left"></i></li>
            @else
                <li class=""><a class="" href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span class="">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class=""><a href="#" class="active">{{ $page }}</a></li>
                        @else
                            <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class=""><a class="" href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
            @else
                <li class="disabled"><i class="fas fa-angle-right"></i></li>
            @endif
        </ul>
    </div>
@else
    <div class="pagination-wrapper centred">
        <span class="pagination-info">
            本页显示第 {{ (($paginator->currentPage() - 1) * $paginator->perPage()) + 1 }} -
            @if ($paginator->currentPage() == $paginator->lastPage())
                {{ $paginator->total() }}
            @else
                {{ ($paginator->currentPage()) * $paginator->perPage() }}
            @endif
                ，总共 {{ $paginator->total() }} 条记录
        </span>
    </div>
@endif
