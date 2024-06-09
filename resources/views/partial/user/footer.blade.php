<footer class=" {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? "" : "mt-4 bg-main-color text-white" }}">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <h5><strong>E-COMM</strong></h5>
                <p>E-Commerce paling terpercaya</p>
            </div>
            <div class="col-md-3">
                <h5>Hubungi Kami</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? "text-dark" : "text-white" }}">Telp : 085797227164</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? "text-dark" : "text-white" }}">Email : ecomm@gmail.com</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? "text-dark" : "text-white" }}">Jalan gang Madukoro No.3, RT.06/RW.35, dusun Ngalarang, Wedomartani, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55282</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Ikuti Kami</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? "text-dark" : "text-white" }}"><i class="bi bi-instagram"></i> @ecommm</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? "text-dark" : "text-white" }}"><i class="bi bi-facebook"></i> e_comm</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>