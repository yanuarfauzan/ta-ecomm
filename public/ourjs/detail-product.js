document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper(".mySwiperImageProduct2", {
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var swiperThumbs = new Swiper(".mySwiperImageProduct", {
        loop: true,
        spaceBetween: 5,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
});
