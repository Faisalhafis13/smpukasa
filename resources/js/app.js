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


        const activeThumbnail = thumbnails[currentIndex];

        if (activeThumbnail) {

            activeThumbnail.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });

        }

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
    |   ↓
    | STOP
    |
    |--------------------------------------------------------------------------
    */

    function nextHeroSlide() {

        const nextIndex = currentIndex + 1;


        /*
        |--------------------------------------------------------------------------
        | Kalau sudah sampai foto terakhir:
        | JANGAN melakukan apa-apa lagi.
        |--------------------------------------------------------------------------
        */

        if (nextIndex >= slides.length) {
            return;
        }


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
