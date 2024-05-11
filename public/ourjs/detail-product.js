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
    

    let selectedVariations = [];
    for (i = 0; i <= variation.length; i++) {
        const variationItem = document.querySelectorAll('.variation-item-' + variation[i].id);
        variationItem.forEach(item => {
            item.addEventListener('click', function () {
                variationItem.forEach(b => b.classList.remove('active-var-item'));
                item.classList.add('active-var-item');
                let variationId = item.dataset.variationId;
                let varOptionId = item.dataset.varOptionId;

            })
        })
    }
  
});
