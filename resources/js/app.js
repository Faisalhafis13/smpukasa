document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Public Mobile Menu
    |--------------------------------------------------------------------------
    */

    const mobileMenuButton =
        document.getElementById('mobileMenuButton');

    if (mobileMenuButton) {

        mobileMenuButton.addEventListener('click', () => {

            const mobileMenu =
                document.getElementById('mobileMenu');

            if (mobileMenu) {
                mobileMenu.classList.toggle('active');
            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Admin Sidebar
    |--------------------------------------------------------------------------
    */

    const adminSidebarToggle =
        document.getElementById('adminSidebarToggle');

    if (adminSidebarToggle) {

        adminSidebarToggle.addEventListener('click', () => {

            const adminSidebar =
                document.getElementById('adminSidebar');

            if (adminSidebar) {
                adminSidebar.classList.toggle('show-mobile');
            }

        });

    }

});