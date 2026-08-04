@if ($paginator->hasPages())

<style>
.pagination{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:6px;
    margin:25px 0;
    flex-wrap:wrap;
}

.pagination a,
.pagination span{
    width:42px;
    height:42px;
    display:flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    border:1px solid rgb(57,166,255);
    background:#111;
    color:rgb(57,255,136);
    border-radius:6px;
    font-weight:bold;
    transition:.3s;
    box-sizing:border-box;
}

.pagination a:hover{
    background:rgb(57,255,136);
    color:#000;
}

.pagination .active{
    background:rgb(57,255,136);
    color:#000;
    border-color:rgb(57,255,136);
}

.pagination .disabled{
    opacity:.4;
    cursor:not-allowed;
}
</style>

<nav class="pagination">

    {{-- Botón anterior --}}
    @if ($paginator->onFirstPage())
        <span class="disabled">&laquo;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" aria-label="Anterior">
            &laquo;
        </a>
    @endif

    {{-- Números de página --}}
    @foreach ($elements as $element)

        {{-- Separador (...) --}}
        @if (is_string($element))
            <span>{{ $element }}</span>
        @endif

        {{-- Páginas --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)

                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif

            @endforeach
        @endif

    @endforeach

    {{-- Botón siguiente --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" aria-label="Siguiente">
            &raquo;
        </a>
    @else
        <span class="disabled">&raquo;</span>
    @endif

</nav>

@endif