<div>
    @if ($paginator->hasPages())
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="pagination">
                <ul class="page-list">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li><a class="prev disabled" disabled="">Anterior</a></li>
                    @else
                        <li><a wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" class="prev">Anterior</a></li>
                    @endif
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li><a wire:click="gotoPage({{$page}})" class="current ">{{$element}}</a></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
{{--                                {{dd($element)}}--}}
                                @if ($page == $paginator->currentPage())
                                    <li ><a class="current disabled" >{{ $page }}</a></li>
                                @else
                                    <li   ><a  wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                    <li><a  wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="next">Siguiente</a></li>
                    @else
                    <li><a  class="next">Siguiente</a></li>
                    @endif
                </ul>
            </div>
        </div>
    @endif
</div>
