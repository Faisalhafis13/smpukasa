@php
    $firstItem = $paginator->firstItem() ?? 0;
    $lastItem = $paginator->lastItem() ?? 0;
    $currentPage = $paginator->currentPage();
    $lastPage = max($paginator->lastPage(), 1);
    $startPage = max(1, min($currentPage - 2, $lastPage - 4));
    $endPage = min($lastPage, $startPage + 4);
@endphp

<div class="admin-pagination">
    <div class="admin-pagination-summary">
        Menampilkan <strong>{{ $firstItem }}–{{ $lastItem }}</strong> dari <strong>{{ $paginator->total() }}</strong> data
    </div>

    <nav class="admin-page-controls" aria-label="Navigasi halaman data">
        @if ($paginator->onFirstPage())
            <span class="admin-page-control is-disabled" aria-disabled="true">Previous</span>
        @else
            <a class="admin-page-control" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif

        @for ($page = $startPage; $page <= $endPage; $page++)
            @if ($page === $currentPage)
                <span class="admin-page-number is-current" aria-current="page">{{ $page }}</span>
            @else
                <a class="admin-page-number" href="{{ $paginator->url($page) }}">{{ $page }}</a>
            @endif
        @endfor

        @if ($paginator->hasMorePages())
            <a class="admin-page-control" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
        @else
            <span class="admin-page-control is-disabled" aria-disabled="true">Next</span>
        @endif
    </nav>
</div>
