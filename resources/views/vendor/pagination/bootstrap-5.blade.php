@if ($paginator->hasPages())

<nav class="pagination-container">

    {{-- Anterior --}}
    @if ($paginator->onFirstPage())
        <span class="page disabled">&laquo;</span>
    @else
        <a class="page" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
    @endif

    {{-- Números --}}
    @foreach ($elements as $element)

        @if (is_string($element))
            <span class="page dots">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)

                @if ($page == $paginator->currentPage())
                    <span class="page active">{{ $page }}</span>
                @else
                    <a class="page" href="{{ $url }}">{{ $page }}</a>
                @endif

            @endforeach
        @endif

    @endforeach

    {{-- Siguiente --}}
    @if ($paginator->hasMorePages())
        <a class="page" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
    @else
        <span class="page disabled">&raquo;</span>
    @endif

</nav>

@endif
<style>
/* ===========================
   PAGINACIÓN
=========================== */

.pagination-container{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:6px;
    margin:25px 0;
    flex-wrap:wrap;
}

.page{
    width:42px;
    height:42px;
    display:flex;
    justify-content:center;
    align-items:center;

    text-decoration:none;

    background:#111;
    color:rgb(57,255,136);

    border:1px solid rgb(57,166,255);
    border-radius:6px;

    font-weight:bold;
    transition:.3s;
}

.page:hover{
    background:rgb(57,255,136);
    color:#000;
}

.page.active{
    background:rgb(57,255,136);
    color:#000;
    border-color:rgb(57,255,136);
}

.page.disabled{
    opacity:.35;
    pointer-events:none;
}

.page.dots{
    cursor:default;
}
</style>