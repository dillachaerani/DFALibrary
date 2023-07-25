@if ($paginator->lastPage() > 1)
    <div class="paginating-container pagination-solid" style="justify-content: right">
        <ul class="pagination">
            @if (!$paginator->onFirstPage())
                <li>
                    <a href="{{ ($paginator->onFirstPage()) ? 'javascript:void(0);' : $paginator->url($paginator->path()) }}">
                        @lang('First')
                    </a>
                </li>
            @endif
            @php
                $start = $paginator->currentPage();
                if($start > 1)
                    $start = $start-1;
                $end = (($paginator->currentPage()+1) > $paginator->lastPage()) ? $paginator->lastPage() : ($paginator->currentPage()+1);
            @endphp
            @foreach ($paginator->getUrlRange($start,$end) as $item)
                <li class="{{ ($start == $paginator->currentPage()) ? 'active' : '' }}"><a href="{{ ($start == $paginator->currentPage()) ? 'javascript:void(0);' : $paginator->url($start) }}">{{ $start++ }}</a></li>
            @endforeach
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ ($paginator->hasMorePages()) ? $paginator->url($paginator->lastPage()) : 'javascript:void(0);' }}">
                        @lang('Last')
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
@if ($paginator->firstItem())
    <small>@lang('notes_lang.pagination', ['first'=>$paginator->firstItem(), 'last'=>$paginator->lastItem(), 'total'=>$paginator->total(), 'curren_page'=>$paginator->currentPage(), 'last_page'=>$paginator->lastPage()])</small>
@endif