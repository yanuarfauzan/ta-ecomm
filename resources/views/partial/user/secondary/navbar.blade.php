<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-main-color shadow"
    style="height: 35px;">
    <div class="container-fluid mx-4" style="width: 84%">
        <div class="d-flex gap-2 me-1 justify-content-end align-items-center">
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white">Ikuti kami di <i
                    class="bi bi-facebook"></i> <i class="bi bi-instagram"></i></a>
            <div class="low-divider"></div>
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white"><i
                    class="bi bi-question-circle"></i> Bantuan</a>
        </div>
        <div class="d-flex gap-2 me-1 justify-content-end align-items-center">
            <a href="#" style="font-size: 12px; text-decoration: none;"
                class=" text-center d-flex gap-1 align-items-center text-white"><i
                    class="bi bi-bell"></i> Notifikasi</i></a>
            <div class="low-divider"></div>
            <div class="dropdown-toggle d-flex justify-content-start align-items-center" data-bs-toggle="dropdown"
            role="button" aria-haspopup="false" aria-expanded="false">
                <a href="#" style="font-size: 12px; text-decoration: none;" role="button" data-bs-toggle="dropdown"
                role="button" aria-haspopup="false" aria-expanded="false"
                    class=" text-center d-flex gap-1 align-items-center text-white">
                    <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1713402631~exp=1713403231~hmac=0479d616f3678fd9ef2e1f0e048d648ade1cdd2178660fb31ea7d613b5c46692" style="width : 20px;" alt="" class="rounded-circle"> 
                    Rahul Sentoyo
                </a>
            </div>
        </div>
    </div>
</nav>
<div class="dropdown-menu dropdown-menu-end profile-dropdown position-fixed rounded-0"
    style="right: 115px; top: 28px; z-index: 1041;">
    <!-- item-->
    <a href="" class="dropdown-item notify-item ">
        <i class="fe-user"></i>
        <span><strong>Selamat Datang!</strong></span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="" class="dropdown-item notify-item ">
        <i class="fe-user"></i>
        <span>Akun saya</span>
    </a>
    <div class="dropdown-divider"></div>
    <!-- item-->
    <a href="" class="dropdown-item notify-item ">
        <i class="fe-user"></i>
        <span>Pesanan saya</span>
    </a>
    <div class="dropdown-divider"></div>
    <!-- item-->
    <a class="dropdown-item notify-item  text-danger" href=""
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fe-log-out"></i>
        <span>Logout</span>
    </a>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-light shadow"
    style="height: 80px; margin-top: 36px">
    <div class="container-fluid mx-4" style="width: 84%">
        <div class="d-flex align-items-center justify-content-between" style="width: 20%;">
            <a class="navbar-brand font-main-color" href="{{ route('user-home') }}" wire:navigate ><strong>E-COMM</strong></a>
            <div class="divider" style="background-color: #6777ef"></div>
            <a href="#categoryCollapse" class="font-main-color ms-2" style="text-decoration: none;" data-bs-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="categoryCollapse"
                id="categoryCollapseToggle">Keranjang Belanja</a>
        </div>
        @livewire('SearchCartProduct')
    </div>
</nav>
<script src="{{ asset('/ourjs/navbar.js') }}"></script>

