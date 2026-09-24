<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Website resmi SMP Unggulan Karangsawo"
    >

    <title>
        @yield('title', 'SMP Unggulan Karangsawo')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    @include('public.layouts.navbar')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('public.layouts.footer')

    @stack('scripts')

</body>

</html>