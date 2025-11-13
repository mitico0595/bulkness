@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Paginación">
  <div class="pager-info">
    Mostrando {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} de {{ $paginator->total() }}
  </div>

  <ul class="pager-list">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
      <li class="disabled"><span aria-hidden="true">‹</span></li>
    @else
      <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Anterior">‹</a></li>
    @endif

    {{-- Números / puntos --}}
    @foreach ($elements as $element)
      @if (is_string($element))
        <li class="dots"><span>{{ $element }}</span></li>
      @endif

      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="active"><span aria-current="page">{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Siguiente">›</a></li>
    @else
      <li class="disabled"><span aria-hidden="true">›</span></li>
    @endif
  </ul>
</nav>
@endif
