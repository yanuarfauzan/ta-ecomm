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

    var countUserCart = userCarts.length;
    for (let i = 0; i < countUserCart; i++) {
        const checkProduct = document.querySelector('.check-product-' + userCarts[i].id);
        const cardProduct = document.getElementById('card-product-' + userCarts[i].id);

        if (checkProduct && cardProduct) {  // Memastikan bahwa kedua elemen tersebut ditemukan
            checkProduct.addEventListener('change', function () {
                if (checkProduct.checked) {
                    cardProduct.classList.remove('card-product');
                    cardProduct.classList.add('card-product-active');
                    Livewire.dispatchTo('product', 'toggleChecked', { 'userCartId' :  userCarts[i].id })
                } else {
                    cardProduct.classList.remove('card-product-active');
                    cardProduct.classList.add('card-product');
                    Livewire.dispatchTo('product', 'toggleChecked', { 'userCartId' :  userCarts[i].id })
                }
            });
        }
    }

    const allCheck = document.getElementById('all-check');
    const allCheckProduct = document.querySelectorAll('.all-check');
    const allCheckCardProduct = document.querySelectorAll('.card-all-check');
    allCheck.addEventListener('change', function () {
        allCheckProduct.forEach(check => {
            if (allCheck.checked) {
                check.checked = allCheck.checked;  // Menetapkan status checked berdasarkan master checkbox
                Livewire.dispatchTo('product', 'toggleAllChecked')
            } else {
                check.checked = allCheck.checked;  // Menetapkan status checked berdasarkan master checkbox
                Livewire.dispatchTo('product', 'toggleAllUnCheck')
            }
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

    allCheckProduct.forEach(function (check) {
        check.addEventListener('change', function () {
            // Periksa apakah semua checkbox individual dicentang
            let allChecked = true;
            allCheckProduct.forEach(function (individualCheck) {
                if (!individualCheck.checked) {
                    allChecked = false;
                }
            });

            // Update status master checkbox
            allCheck.checked = allChecked;
        });
    });


    var countUserCart = userCarts.length;
    for (let i = 0; i <= countUserCart; i++) {
        const collapseVariation = document.querySelector('.collapse-variation-' + i);
        const toggelButtonVariation = document.querySelector('.toggle-button-variation-' + i);
        document.addEventListener('click', function (event) {
            if (!collapseVariation.contains(event.target) && event.target !== toggelButtonVariation) {
                collapseVariation.classList.remove('show');
            }
        })
    }

    let selectedVariations = [];
    for (i = 0; i <= variation.length; i++) {
        const variationItem = document.querySelectorAll('.variation-item-' + variation[i].id);
        // console.log(variationItem);
        variationItem.forEach(item => {
            item.addEventListener('click', function () {
                variationItem.forEach(b => b.classList.remove('active-var-item'));
                item.classList.add('active-var-item');
                let variationId = item.dataset.variationId;
                let varOptionId = item.dataset.varOptionId;
                const index = selectedVariations.findIndex(v => v.variationId === variationId && v.varOptionId === varOptionId);
                if (index === -1) {
                    selectedVariations.push({ variationId, varOptionId });
                } else {
                    selectedVariations.splice(index, 1);
                }
                Livewire.dispatchTo('variation', 'updateVariationAndVarOptionId', { 'selectedVariations': selectedVariations });
            })
        })
    }

});