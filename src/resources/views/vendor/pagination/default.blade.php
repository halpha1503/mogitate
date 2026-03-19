@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
            <span class="pagination__arrow pagination__arrow--disabled">&lsaquo;</span>
        @else
            <a class="pagination__arrow" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination__item pagination__item--dots">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__item pagination__item--active">{{ $page }}</span>
                    @else
                        <a class="pagination__item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
            <a class="pagination__arrow" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
        @else
            <span class="pagination__arrow pagination__arrow--disabled">&rsaquo;</span>
        @endif
    </nav>
@endif
