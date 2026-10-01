<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk Admin - SMP Unggulan Karangsawo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-auth-body">
    <main class="admin-auth-shell">
        <!-- <a class="admin-auth-brand" href="{{ route('home') }}">
            <span class="admin-auth-brand-logo">SK</span>
            <span>
                <strong>SMP Unggulan</strong>
                <small>Karangsawo</small>
            </span>
        </a>
 -->
        <section class="admin-auth-panel" aria-labelledby="login-title">
            <span class="admin-eyebrow">AREA ADMINISTRATOR</span>
            <h1 id="login-title">Masuk ke panel</h1>
            <p class="admin-auth-description">Gunakan akun administrator untuk mengelola konten sekolah.</p>

            @if ($errors->any())
                <div class="admin-auth-error" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" class="admin-auth-form">
                @csrf

                <div class="admin-auth-field">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="admin-auth-field">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <label class="admin-auth-remember" for="remember">
                    <input id="remember" name="remember" type="checkbox" value="1">
                    <span>Ingat saya</span>
                </label>

                <button type="submit" class="admin-auth-submit">Masuk</button>
            </form>

            <a class="admin-auth-back" href="{{ route('home') }}">Kembali ke website</a>
        </section>
    </main>
</body>

</html>