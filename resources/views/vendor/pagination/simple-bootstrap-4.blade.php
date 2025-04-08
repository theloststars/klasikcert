@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center" style="column-gap: 10px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link btn">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link btn btn-danger text-white" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link btn btn-danger text-white" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link btn">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

