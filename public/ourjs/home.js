document.addEventListener('DOMContentLoaded', function () {
    const btnLoadMore = document.getElementById('load-more')
    const moreProduct = document.getElementById('more-product')
    const loaderProduct = document.getElementById('loader-product')
    const moreProductContainer = document.getElementById('more-product-container')
    btnLoadMore.addEventListener('click', function () {
        moreProductContainer.style.display = 'block'
        loaderProduct.style.display = 'block'
        var startIndex = this.getAttribute('data-start-index')
        var moreProductUrl = this.getAttribute('data-next-page-url') + '?loadMoreProduct=true&startIndex=' + startIndex;
        setTimeout(function () {
            fetch(moreProductUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    loaderProduct.style.display = 'none'
                    const products = data.data;
                    products.forEach(product => {
                        // Iterasi untuk setiap produk dalam response
                        moreProduct.innerHTML += `<a href="${product.name}" style="text-decoration: none">
                    <div class="col mt-4">
                        <div class="card border-0 position-relative shadow" id="card-product"
                            style="width: 18rem; height: auto; cursor: pointer;">
                            <div style="overflow: hidden;">
                            <img src="/storage/product_pictures/${product.product_image}"
                                class="card-img-top" alt="..." id="image-product">
                            </div>
                            ${product.stock == 0 ? `<div class="rounded-circle bg-secondary text-white position-absolute d-flex align-items-center justify-content-center opacity-25"
                            style="top: 40px; left: 45px; width:200px; height:200px; ">
                            <div class="d-flex flex-column align-items-center gap-2">
                                <img src="/icons-png/out-of-stock.png" class=""
                                    style="width: 70px;" alt="">
                                <span>
                                    <h4>Out Of Stock</h4>
                                </span>
                            </div>
                        </div>` : ''}
                            ${product.discount ? `<span class="text-dark bg-light position-absolute border border-secondary text-center"
                            style="top: 262px; width: 70px;">Discount</span>
                        <span
                            class="text-dark bg-secondary position-absolute border border-secondary text-center"
                            style="top: 262px; left: 70px; width: 40px;"><i
                                class="text-white">${Math.floor(product.discount)}%</i></span>` : ''} 
                                
                            <div class="card-body pb-2">
                                <div class="d-flex justify-content-between">
                                    <strong>${product.name}</strong>
                                    <p>Stock ${product.stock}</p>
                                </div>
                                ${product.discount ? `<div class="d-flex gap-2">
                                <h5><strong>
                                ${new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }).format(product.price - product.price * (product.discount / 100))}</strong>
                                </h5>
                                <p class="text-decoration-line-through">
                                    <i> ${new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }).format(product.price)}</i>
                                </p>
                            </div>` : `<div class="d-flex gap-2 mb-2">
                            <h5><strong>
                            ${new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        }).format(product.price)}</strong>
                            </h5>
                        </div>`}
                                <div class="d-flex align-items-center gap-2">
                                    <span>
                                        <i class="bi bi-star-fill" style="color: #ffd900"></i>
                                    </span>
                                    <span>
                                        ${product.rate}
                                    </span>
                                    <div class="low-divider-black"></div>
                                    <span>
                                        10 Terjual
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>`;
                    });
                    // Perbarui URL halaman berikutnya
                    btnLoadMore.setAttribute('data-next-page-url', moreProductUrl);
                    btnLoadMore.setAttribute('data-start-index', data.startIndex);
                })
                .catch(error => {
                    loaderProduct.style.display = none;
                    console.error('Error fetching products:', error);
                });
        })
    }, 3000)

})