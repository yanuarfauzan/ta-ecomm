document.addEventListener('DOMContentLoaded', function () {

    var mySwiper = new Swiper('.swiper-container', {
        // Konfigurasi Swiper di sini
        slidesPerView: 'auto', // Jumlah slide yang ditampilkan per view
        spaceBetween: 10, // Jarak antara setiap slide
        loop: true, // Mengaktifkan mode loop
        navigation: {
            nextEl: '.swiper-button-next', // Selector untuk tombol geser ke kanan
            prevEl: '.swiper-button-prev', // Selector untuk tombol geser ke kiri
        },
        pagination: {
            el: ".swiper-pagination",
        },
        mousewheel: false,
        keyboard: false,
        grabCursor: false,
        allowTouchMove: false
    });

    const variationFirst = document.querySelectorAll('.variation-first');
    variationFirst.forEach(item => {
        item.addEventListener('click', function () {
            variationFirst.forEach(b => b.classList.remove('active-var-item'));
            item.classList.add('active-var-item');
        })
    })

    const variationScnd = document.querySelectorAll('.variation-scnd');
    variationScnd.forEach(item => {
        item.addEventListener('click', function () {
            variationScnd.forEach(b => b.classList.remove('active-var-item'));
            item.classList.add('active-var-item');
        })
    })

    const collapseVariation = document.getElementById('collapseVariation');
    const toggelButtonVariation = document.getElementById('toggelButtonVariation');
    document.addEventListener('click', function (event) {
        if (!collapseVariation.contains(event.target) && event.target !== toggelButtonVariation) {
            // Jika ya, tutup collapse
            collapseVariation.classList.remove('show');
        }
    })

    var long = 2;
    for (let i = 1; i <= long; i++) {
        const checkProduct = document.querySelector('.check-product-' + i);
        const cardProduct = document.getElementById('card-product-' + i);

        if (checkProduct && cardProduct) {  // Memastikan bahwa kedua elemen tersebut ditemukan
            checkProduct.addEventListener('change', function () {
                if (checkProduct.checked) {
                    cardProduct.classList.remove('card-product');
                    cardProduct.classList.add('card-product-active');
                } else {
                    cardProduct.classList.remove('card-product-active');
                    cardProduct.classList.add('card-product');
                }
            });
        }
    }

    const allCheck = document.getElementById('all-check');
    const allCheckProduct = document.querySelectorAll('.all-check');
    const allCheckCardProduct = document.querySelectorAll('.card-all-check');
    allCheck.addEventListener('change', function () {
        allCheckProduct.forEach(check => {
            console.log(check);
            check.checked = allCheck.checked;  // Menetapkan status checked berdasarkan master checkbox
            allCheckCardProduct.forEach(cardProduct => {
                if (check.checked) {
                    cardProduct.classList.remove('card-product');
                    cardProduct.classList.add('card-product-active');
                } else {
                    cardProduct.classList.remove('card-product-active');
                    cardProduct.classList.add('card-product');
                }
            })
        });
    });

    allCheckProduct.forEach(function(check) {
        check.addEventListener('change', function() {
            // Periksa apakah semua checkbox individual dicentang
            let allChecked = true;
            allCheckProduct.forEach(function(individualCheck) {
                if (!individualCheck.checked) {
                    allChecked = false;
                }
            });

            // Update status master checkbox
            allCheck.checked = allChecked;
        });
    });

});