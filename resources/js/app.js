document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Public Mobile Menu
    |--------------------------------------------------------------------------
    */

    const mobileMenuButton =
        document.getElementById('mobileMenuButton');
    const mobileMenu =
        document.getElementById('mobileMenu');

    if (mobileMenuButton && mobileMenu) {

        mobileMenuButton.addEventListener('click', () => {

            const isOpen = mobileMenu.classList.toggle('active');
            mobileMenuButton.setAttribute('aria-expanded', String(isOpen));
            mobileMenuButton.setAttribute(
                'aria-label',
                isOpen ? 'Tutup menu' : 'Buka menu'
            );

        });

        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                mobileMenuButton.setAttribute('aria-label', 'Buka menu');
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                mobileMenuButton.setAttribute('aria-label', 'Buka menu');
                mobileMenuButton.focus();
            }

        });

    }

    document.querySelectorAll('.dropdown-button').forEach((button) => {
        button.addEventListener('click', () => {
            const dropdown = button.closest('.nav-dropdown');

            if (!dropdown) {
                return;
            }

            const isOpen = !dropdown.classList.contains('is-open');

            document.querySelectorAll('.nav-dropdown.is-open').forEach((openDropdown) => {
                if (openDropdown === dropdown) {
                    return;
                }

                openDropdown.classList.remove('is-open');
                openDropdown.querySelector('.dropdown-button')
                    ?.setAttribute('aria-expanded', 'false');
            });

            dropdown.classList.toggle('is-open', isOpen);
            button.setAttribute('aria-expanded', String(isOpen));
        });
    });


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


    const revealSections = document.querySelectorAll('[data-scroll-reveal]');

    if (!revealSections.length) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        revealSections.forEach((section) => {
            section.classList.add('is-visible');
        });

        return;
    }

    document.documentElement.classList.add('has-scroll-reveal');

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    revealSections.forEach((section) => {
        revealObserver.observe(section);
    });

});



document.addEventListener('DOMContentLoaded', function () {

    const gallery = document.getElementById('homeGalleryCarousel');

    if (!gallery) {
        return;
    }


    const slides = gallery.querySelectorAll('.home-gallery-slide');
    const thumbnails = gallery.querySelectorAll('.home-gallery-thumbnail');
    const prevButton = gallery.querySelector('.home-gallery-prev');
    const nextButton = gallery.querySelector('.home-gallery-next');


    if (slides.length <= 1) {
        return;
    }


    let currentIndex = 0;
    let autoSlide;


    function showSlide(index) {

        if (index < 0) {
            index = slides.length - 1;
        }

        if (index >= slides.length) {
            index = 0;
        }


        currentIndex = index;


        slides.forEach(function (slide, slideIndex) {

            slide.classList.toggle(
                'active',
                slideIndex === currentIndex
            );

        });


        thumbnails.forEach(function (thumbnail, thumbnailIndex) {

            thumbnail.classList.toggle(
                'active',
                thumbnailIndex === currentIndex
            );

        });


    }


    function nextSlide() {
        showSlide(currentIndex + 1);
    }


    function prevSlide() {
        showSlide(currentIndex - 1);
    }


    function startAutoSlide() {

        clearInterval(autoSlide);

        autoSlide = setInterval(function () {
            nextSlide();
        }, 5000);

    }


    function stopAutoSlide() {

        clearInterval(autoSlide);

    }


    if (nextButton) {

        nextButton.addEventListener('click', function () {

            nextSlide();
            startAutoSlide();

        });

    }


    if (prevButton) {

        prevButton.addEventListener('click', function () {

            prevSlide();
            startAutoSlide();

        });

    }


    thumbnails.forEach(function (thumbnail, index) {

        thumbnail.addEventListener('click', function () {

            showSlide(index);
            startAutoSlide();

        });

    });


    gallery.addEventListener('mouseenter', function () {
        stopAutoSlide();
    });


    gallery.addEventListener('mouseleave', function () {
        startAutoSlide();
    });


    /* Dukungan swipe pada perangkat mobile */

    let touchStartX = 0;
    let touchEndX = 0;


    gallery.addEventListener('touchstart', function (event) {

        touchStartX = event.changedTouches[0].screenX;

    }, { passive: true });


    gallery.addEventListener('touchend', function (event) {

        touchEndX = event.changedTouches[0].screenX;

        const difference = touchStartX - touchEndX;


        if (Math.abs(difference) < 50) {
            return;
        }


        if (difference > 0) {

            nextSlide();

        } else {

            prevSlide();

        }


        startAutoSlide();

    }, { passive: true });


    showSlide(0);
    startAutoSlide();

});



document.addEventListener('DOMContentLoaded', function () {

    const slides = document.querySelectorAll(
        '.home-hero-slide'
    );


    /*
    |--------------------------------------------------------------------------
    | Tidak ada foto atau hanya satu foto
    |--------------------------------------------------------------------------
    */

    if (slides.length <= 1) {
        return;
    }


    let currentIndex = 0;


    /*
    |--------------------------------------------------------------------------
    | Tampilkan slide
    |--------------------------------------------------------------------------
    */

    function showSlide(index) {

        slides.forEach(function (slide, slideIndex) {

            if (slideIndex === index) {

                slide.classList.add('is-active');

            } else {

                slide.classList.remove('is-active');

            }

        });

        currentIndex = index;
    }


    /*
    |--------------------------------------------------------------------------
    | FOTO PERTAMA
    |--------------------------------------------------------------------------
    */

    showSlide(0);


    /*
    |--------------------------------------------------------------------------
    | SLIDESHOW
    |--------------------------------------------------------------------------
    |
    | Foto 1
    |   ↓ 5 detik
    | Foto 2
    |   ↓ 5 detik
    | Foto 3
    |   ↓ 5 detik
    | Foto terakhir
    |   ↓ 5 detik
    | Kembali ke foto pertama
    |
    |--------------------------------------------------------------------------
    */

    function nextHeroSlide() {

        const nextIndex = (currentIndex + 1) % slides.length;

        showSlide(nextIndex);


        /*
        |--------------------------------------------------------------------------
        | Lanjut ke foto berikutnya
        |--------------------------------------------------------------------------
        */

        setTimeout(nextHeroSlide, 5000);
    }


    /*
    |--------------------------------------------------------------------------
    | Mulai setelah 5 detik
    |--------------------------------------------------------------------------
    */

    setTimeout(nextHeroSlide, 5000);

});


(() => {
    if (!document.body.classList.contains('admin-body')) {
        return;
    }

    let activeRequest;
    let navigationId = 0;

    function setLoading(isLoading) {
        document.body.classList.toggle('admin-is-loading', isLoading);
        document.querySelector('.admin-content')?.setAttribute('aria-busy', String(isLoading));
        const progress = document.querySelector('.admin-ajax-progress');
        progress?.setAttribute('aria-hidden', String(!isLoading));
        const status = document.querySelector('.admin-ajax-status');
        if (status) {
            status.textContent = isLoading ? 'Memuat halaman...' : '';
        }
    }

    async function runPageScripts(pageDocument) {
        const scripts = [...pageDocument.body.querySelectorAll(':scope > script')];

        for (const sourceScript of scripts) {
            if (sourceScript.src) {
                const alreadyLoaded = [...document.scripts].some((script) => script.src === sourceScript.src);

                if (alreadyLoaded) {
                    continue;
                }

                await new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.src = sourceScript.src;
                    script.onload = resolve;
                    script.onerror = reject;
                    document.body.append(script);
                });

                continue;
            }

            const scriptSource = sourceScript.textContent.trim();

            if (!scriptSource) {
                continue;
            }

            const functionNames = [...scriptSource.matchAll(/^(?:async[\t ]+)?function[\t ]+([A-Za-z_$][\w$]*)[\t ]*\(/gm)]
                .map((match) => match[1]);
            const exports = [...new Set(functionNames)]
                .map((name) => `window[${JSON.stringify(name)}] = ${name};`)
                .join('\n');
            const script = document.createElement('script');

            script.textContent = `(function () {\n${scriptSource}\n${exports}\n})();`;
            document.body.append(script);
            script.remove();
        }
    }

    async function loadPage(url, options = {}) {
        const targetUrl = new URL(url, window.location.href);

        if (targetUrl.origin !== window.location.origin) {
            window.location.assign(targetUrl.href);
            return;
        }

        activeRequest?.abort();
        activeRequest = new AbortController();
        const currentNavigationId = ++navigationId;
        setLoading(true);

        try {
            const response = await fetch(targetUrl.href, {
                method: options.method ?? 'GET',
                body: options.body ?? null,
                credentials: 'same-origin',
                headers: {
                    'Accept': 'text/html',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(options.body ? { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '' } : {})
                },
                signal: activeRequest.signal
            });
            const responseUrl = new URL(response.url);

            if (responseUrl.pathname === '/admin/login') {
                window.location.assign(responseUrl.href);
                return;
            }

            if (!response.ok || !response.headers.get('content-type')?.includes('text/html')) {
                throw new Error('Halaman tidak dapat dimuat.');
            }

            const pageDocument = new DOMParser().parseFromString(await response.text(), 'text/html');
            const nextContent = pageDocument.querySelector('.admin-content');
            const nextSidebarMenu = pageDocument.querySelector('.admin-sidebar-menu');
            const currentContent = document.querySelector('.admin-content');
            const currentSidebarMenu = document.querySelector('.admin-sidebar-menu');

            if (!nextContent || !currentContent) {
                throw new Error('Konten halaman tidak ditemukan.');
            }

            currentContent.innerHTML = nextContent.innerHTML;

            if (nextSidebarMenu && currentSidebarMenu) {
                currentSidebarMenu.innerHTML = nextSidebarMenu.innerHTML;
            }

            const nextPageTitle = pageDocument.querySelector('.admin-navbar-title');
            const currentPageTitle = document.querySelector('.admin-navbar-title');

            if (nextPageTitle && currentPageTitle) {
                currentPageTitle.textContent = nextPageTitle.textContent;
            }

            document.title = pageDocument.title;
            document.querySelector('#adminSidebar')?.classList.remove('show-mobile');

            if (options.history === 'push') {
                window.history.pushState({}, '', responseUrl.href);
            } else if (responseUrl.href !== window.location.href) {
                window.history.replaceState({}, '', responseUrl.href);
            }

            await runPageScripts(pageDocument);
            window.scrollTo(0, 0);
        } catch (error) {
            if (error.name === 'AbortError' || currentNavigationId !== navigationId) {
                return;
            }

            const content = document.querySelector('.admin-content');
            const notice = document.createElement('div');
            notice.className = 'admin-notice admin-notice-error';
            notice.setAttribute('role', 'alert');
            notice.textContent = error.message || 'Halaman tidak dapat dimuat. Periksa koneksi lalu coba lagi.';
            content?.prepend(notice);
        } finally {
            if (currentNavigationId === navigationId) {
                setLoading(false);
            }
        }
    }

    window.AdminAjax = {
        refresh: () => loadPage(window.location.href, { history: 'replace' })
    };

    document.addEventListener('click', (event) => {
        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
        }

        const link = event.target.closest('a[href]');

        if (!link || !link.closest('.admin-wrapper') || link.target === '_blank' || link.hasAttribute('download')) {
            return;
        }

        const targetUrl = new URL(link.href, window.location.href);

        if (targetUrl.origin !== window.location.origin || !targetUrl.pathname.startsWith('/admin/')) {
            return;
        }

        event.preventDefault();
        loadPage(targetUrl.href, { history: 'push' });
    });

    document.addEventListener('submit', (event) => {
        const form = event.target.closest('.admin-content form');

        if (!form || event.defaultPrevented) {
            return;
        }

        event.preventDefault();
        const method = (form.method || 'GET').toUpperCase();
        const targetUrl = new URL(form.action, window.location.href);

        if (method === 'GET') {
            const parameters = new URLSearchParams(new FormData(form));
            targetUrl.search = parameters.toString();
            loadPage(targetUrl.href, { history: 'push' });
            return;
        }

        loadPage(targetUrl.href, {
            method,
            body: new FormData(form),
            history: 'replace'
        });
    });

    window.addEventListener('popstate', () => {
        loadPage(window.location.href, { history: 'replace' });
    });
})();
