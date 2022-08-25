@if ($paginator->hasPages())
{{--    <div style="display: none">--}}
{{--        <nav class="d-flex justify-items-center justify-content-between">--}}
{{--            <div class="d-flex justify-content-between flex-fill d-sm-none">--}}
{{--                <ul class="pagination">--}}
{{--                    --}}{{-- Previous Page Link --}}
{{--                    @if ($paginator->onFirstPage())--}}
{{--                        <li class="page-item disabled" aria-disabled="true">--}}
{{--                            <span class="page-link">@lang('pagination.previous')</span>--}}
{{--                        </li>--}}
{{--                    @else--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    --}}{{-- Next Page Link --}}
{{--                    @if ($paginator->hasMorePages())--}}
{{--                        <li class="page-item">--}}
{{--                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>--}}
{{--                        </li>--}}
{{--                    @else--}}
{{--                        <li class="page-item disabled" aria-disabled="true">--}}
{{--                            <span class="page-link">@lang('pagination.next')</span>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--            <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">--}}
{{--                <div>--}}
{{--                    <p class="small text-muted">--}}
{{--                        {!! __('Showing') !!}--}}
{{--                        <span class="fw-semibold">{{ $paginator->firstItem() }}</span>--}}
{{--                        {!! __('to') !!}--}}
{{--                        <span class="fw-semibold">{{ $paginator->lastItem() }}</span>--}}
{{--                        {!! __('of') !!}--}}
{{--                        <span class="fw-semibold">{{ $paginator->total() }}</span>--}}
{{--                        {!! __('results') !!}--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <ul class="pagination">--}}
{{--                        --}}{{-- Previous Page Link --}}
{{--                        @if ($paginator->onFirstPage())--}}
{{--                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                                <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
{{--                            </li>--}}
{{--                        @else--}}
{{--                            <li class="page-item">--}}
{{--                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}

{{--                        --}}{{-- Pagination Elements --}}
{{--                        @foreach ($elements as $element)--}}
{{--                            --}}{{-- "Three Dots" Separator --}}
{{--                            @if (is_string($element))--}}
{{--                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>--}}
{{--                            @endif--}}

{{--                            --}}{{-- Array Of Links --}}
{{--                            @if (is_array($element))--}}
{{--                                @foreach ($element as $page => $url)--}}
{{--                                    @if ($page == $paginator->currentPage())--}}
{{--                                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
{{--                                    @else--}}
{{--                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        @endforeach--}}

{{--                        --}}{{-- Next Page Link --}}
{{--                        @if ($paginator->hasMorePages())--}}
{{--                            <li class="page-item">--}}
{{--                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--                            </li>--}}
{{--                        @else--}}
{{--                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                                <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--    </div>--}}

    @if ($paginator->onFirstPage())
        <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
            <li class="page-item">
                <a class="page-link ps-0 pe-4 border-end" href="#">
                    <i class="fe fe-arrow-left me-1"></i> Prev
                </a>
            </li>
        </ul>
    @else
        <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
            <li class="page-item">
                <a class="page-link ps-0 pe-4 border-end" onclick="window.location.href='{{ $paginator->previousPageUrl() }}'" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fe fe-arrow-left me-1"></i> Prev
                </a>
            </li>
        </ul>
{{--        <li class="page-item">--}}
{{--            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--        </li>--}}
    @endif


    <!-- Pagination -->
    <ul class="list-pagination pagination pagination-tabs card-pagination">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
{{--                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>--}}
                <li class="disabled"><a class="page" href="#" >{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
{{--                        @dd($paginator)--}}
{{--                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
                        <li class="active"><a class="page" href="#" data-i="{{ $page }}" >{{ $page }}</a></li>
                    @else
{{--                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
                        <li class=""><a class="page" href="{{ $url }}" onclick="window.location.href='{{ $url }}'" data-i="{{ $page }}" >{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

    </ul>
    @if ($paginator->hasMorePages())
        <!-- Pagination (next) -->
        <ul class="list-pagination-next pagination pagination-tabs card-pagination">
            <li class="page-item">
                <a class="page-link ps-4 pe-0 border-start" onclick="window.location.href='{{ $paginator->nextPageUrl() }}'" href="{{ $paginator->nextPageUrl() }}">
                    Next <i class="fe fe-arrow-right ms-1"></i>
                </a>
            </li>
        </ul>
    @else
    <!-- Pagination (next) -->
    <ul class="list-pagination-next pagination pagination-tabs card-pagination">
        <li class="page-item">
            <a class="page-link ps-4 pe-0 border-start" href="#">
                Next <i class="fe fe-arrow-right ms-1"></i>
            </a>
        </li>
    </ul>
    @endif
@endif
