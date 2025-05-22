document.addEventListener("DOMContentLoaded", function () {
    if (typeof Swiper === 'undefined') {
        console.warn("Swiper n'est pas chargé.");
        return;
    }

    new Swiper('.mySwiper', {
        loop: true,
        spaceBetween: 20, // espace entre les slides (ajustable)
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        slidesPerView: 1, // fallback
        breakpoints: {
            800: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            }
        }
    });
});


