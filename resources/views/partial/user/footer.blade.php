<footer class=" {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', 'reset-password']) ? "" : "mt-4 bg-main-color text-white" }}">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <h5><strong>E-COMM</strong></h5>
                <p>E-Commerce paling terpercaya</p>
            </div>
            <div class="col-md-3">
                <h5>Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', 'reset-password']) ? "text-dark" : "text-white" }}">Link 1</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', 'reset-password']) ? "text-dark" : "text-white" }}">Link 2</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', 'reset-password']) ? "text-dark" : "text-white" }}">Link 3</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Contact</h5>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', 'reset-password']) ? "text-dark" : "text-white" }}">Email</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-0 {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', 'reset-password']) ? "text-dark" : "text-white" }}">Phone</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>