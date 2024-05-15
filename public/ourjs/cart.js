document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('number-counter').addEventListener('input', function (event) {
        this.value = this.value.replace(/\D/g, '');
    });

    const checkboxesRelatedProducts = document.querySelectorAll('.btn-check-outlined');

    checkboxesRelatedProducts.forEach(checkbox => {
        checkbox.addEventListener('click', function () {
            checkboxesRelatedProducts.forEach(cb => {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
        });
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
                    Livewire.dispatchTo('cart', 'toggleChecked', { 'userCartId': userCarts[i].id })
                } else {
                    cardProduct.classList.remove('card-product-active');
                    cardProduct.classList.add('card-product');
                    Livewire.dispatchTo('cart', 'toggleChecked', { 'userCartId': userCarts[i].id })
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
                Livewire.dispatchTo('cart', 'toggleAllChecked')
            } else {
                check.checked = allCheck.checked;  // Menetapkan status checked berdasarkan master checkbox
                Livewire.dispatchTo('cart', 'toggleAllUnCheck')
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

});