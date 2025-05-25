
<link rel="stylesheet" href="{{ asset('css/interw.css') }}" />
@if ($paginator->hasPages())
<ul class="pagination">

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="disabled"><span><img src="{{ asset('style/paginationLeft.svg') }}" alt="Arrow"></span></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><img src="{{ asset('style/paginationLeftDisabled.svg') }}" alt="Arrow"></a></li>
    @endif

    {{-- Calculate sliding window --}}
    @php
        $total = $paginator->lastPage();
        $current = $paginator->currentPage();
        $start = max($current - 1, 1);
        $end = min($current + 3, $total);
    @endphp

    {{-- Always show first page --}}
    @if ($start > 1)
        <li><a style = 'color: #6C6C6C;' href="{{ $paginator->url(1) }}">1</a></li>
        @if ($start > 2)
            <li class="disabled"><span style = 'color: #274F73;'>...</span></li>
        @endif
    @endif

    {{-- Show sliding pages --}}
    @for ($i = $start; $i <= $end; $i++)
        @if ($i == $current)
            <li class="active"><span>{{ $i }}</span></li>
        @else
            <li><a style = 'color: #6C6C6C;' href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
    @endfor

    {{-- Show last page --}}
    @if ($end < $total)
        @if ($end < $total - 1)
            <li class="disabled"><span style = 'color: #274F73;'>...</span></li>
        @endif
        <li><a href="{{ $paginator->url($total) }}">{{ $total }}</a></li>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><img src="{{ asset('style/paginationRight.svg') }}" alt="Arrow"></a></li>
    @else
        <li class="disabled"><span><img src="{{ asset('style/paginationRightDisabled.svg') }}" alt="Arrow"></span></li>
    @endif

</ul>
@endif
