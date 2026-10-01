@php($perPage = $paginator->perPage())

<form method="GET" action="{{ request()->url() }}" class="admin-page-size-bar">
    @foreach (request()->query() as $key => $value)
        @if ($key !== 'page' && $key !== 'per_page' && is_scalar($value))
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach

    <label for="admin-per-page">Tampilkan</label>
    <select id="admin-per-page" name="per_page" onchange="this.form.requestSubmit()">
        @foreach ([10, 25, 50, 100] as $option)
            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
        @endforeach
    </select>
    <span>per halaman</span>
</form>