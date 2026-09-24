<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Admin Panel - SMP Unggulan Karangsawo')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="admin-body">

    <div class="admin-wrapper">

        @include('admin.layouts.sidebar')

        <div class="admin-main">

            @include('admin.layouts.navbar')

            <main class="admin-content">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')

</body>

</html>