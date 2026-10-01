<header class="admin-navbar">

    <div class="admin-navbar-left">

        <button
            type="button"
            class="admin-sidebar-toggle"
            id="adminSidebarToggle"
            aria-label="Buka menu">

            Menu

        </button>

        <div>
            <div class="admin-navbar-title">
                @yield('page-title', 'Dashboard')
            </div>

            <div class="admin-navbar-subtitle">
                SMP Unggulan Karangsawo
            </div>
        </div>

    </div>


    <div class="admin-navbar-right">

        <div class="admin-user">

            <div class="admin-user-avatar">
                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="admin-user-info">
                <strong>{{ auth()->user()->name }}</strong>
                <span>{{ auth()->user()->email }}</span>
            </div>

        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="admin-logout-button">
                Keluar
            </button>
        </form>

    </div>

</header>