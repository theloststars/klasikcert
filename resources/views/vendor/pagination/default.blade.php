@if ($paginator->hasPages())
    <nav>
        <ul class="pagination d-flex justify-content-center pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="pagination__page pagination__icon pagination__page--next" aria-disabled="true"
                    aria-label="@lang('pagination.previous')">
                    <span aria-hidden="ui-arrow-left"></span>
                </li> --}}
            @else
                {{-- <li class="pagination__page pagination__icon pagination__page--next">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="ui-arrow-left"></a>
                </li> --}}
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="pagination__page pagination__icon pagination__page--next"><i class="ui-arrow-left"></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__page pagination__page--current" aria-current="page">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li><a href="{{ $url }}" class="pagination__page">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="pagination__page pagination__icon pagination__page--next"><i class="ui-arrow-right"></i></a>
            @else
                {{-- <li class="pagination__page pagination__icon pagination__page--next" aria-disabled="true"
                    aria-label="@lang('pagination.previous')">
                    <span aria-hidden="ui-arrow-right"></span>
                </li> --}}
            @endif
        </ul>
    </nav>
@endif
