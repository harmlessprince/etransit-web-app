@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"
                    style="background:white;color: rgb(52,63,95); border : 1px solid rgb(52,63,95);margin:10px;  padding: 10px; border-radius: 5px;" >
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li style="background:lightgrey;color: white;
                          border: 1px solid lightgrey;
                          margin:10px;
                          padding: 15px;
                          border-radius: 5px;" >
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true" style="background:rgb(52,63,95);color: white;
                     border: 1px solid rgb(52,63,95);
                     margin:10px;
                      padding: 15px;
                      border-radius: 5px;" ><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page" style="background:rgb(52,63,95);color: white; border: 1px solid rgb(52,63,95); margin:10px; padding: 15px; border-radius: 5px;" ><span>{{ $page }}</span></li>
                        @else
                            <li style="background:white;color: rgb(52,63,95); border : 1px solid rgb(52,63,95);margin:10px;  padding: 15px; border-radius: 5px;" ><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="background:white;color: rgb(52,63,95); border : 1px solid rgb(52,63,95);margin:10px;  padding: 10px; border-radius: 5px;" >
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')"
                    style="background:lightgrey;color: white;
                          border: 1px solid lightgrey;
                          margin:10px;
                          padding: 15px;
                          border-radius: 5px;"

                >
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
