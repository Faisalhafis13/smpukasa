<header class="admin-navbar">

    <div class="admin-navbar-left">

        <button
            type="button"
            class="admin-sidebar-toggle"
            id="adminSidebarToggle"
            aria-label="Buka menu">

            ☰

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
                A
            </div>

            <div class="admin-user-info">
                <strong>Administrator</strong>
                <span>Admin</span>
            </div>

        </div>

    </div>

</header>