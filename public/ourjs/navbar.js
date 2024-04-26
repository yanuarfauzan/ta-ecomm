document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('mouseenter', function () {
        dropdownMenu.style.display = 'block';
    });

    dropdownToggle.addEventListener('mouseleave', function () {
        dropdownMenu.style.display = 'none';
    });

    dropdownMenu.addEventListener('mouseenter', function () {
        dropdownMenu.style.display = 'block';
    });

    dropdownMenu.addEventListener('mouseleave', function () {
        dropdownMenu.style.display = 'none';
    });

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
    });

    // Ambil elemen collapse dan tombol yang digunakan untuk membuka/collapse
    const collapseElement = document.getElementById('categoryCollapse');
    const toggleButton = document.getElementById('categoryCollapseToggle');

    // Tambahkan event listener ke elemen dokumen
    document.addEventListener('click', function (event) {
        // Periksa apakah klik terjadi di luar collapse dan button toggle
        if (!collapseElement.contains(event.target) && event.target !== toggleButton) {
            // Jika ya, tutup collapse
            collapseElement.classList.remove('show');
        }
    });

});