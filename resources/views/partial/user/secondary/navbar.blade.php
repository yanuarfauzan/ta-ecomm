@if (
    !in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), [
        'login',
        'register',
        'verify',
        'forgot-password',
        $token ?? null,
    ]))
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
                <div class="dropdown-toggle dropdown-toggle-profile d-flex justify-content-start align-items-center"
                    data-bs-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                    <a href="#" style="font-size: 12px; text-decoration: none;" aria-haspopup="false" aria-expanded="false"
                        class="text-center d-flex gap-1 align-items-center text-white">
                        <img src="{{ Storage::url(auth()->user()->profile_image) }}"
                            style="width: 20px;" alt="" class="rounded-circle">
                        {{ auth()->user()->username }}
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="dropdown-menu dropdown-menu-profile dropdown-menu-end profile-dropdown position-fixed rounded-0"
        style="right: 115px; top: 28px; z-index: 1041;">
        <!-- item-->
        <a href="" class="dropdown-item notify-item ">
            <i class="fe-user"></i>
            <span><strong>Selamat Datang!</strong></span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('user-profile') }}" class="dropdown-item notify-item ">
            <i class="fe-user"></i>
            <span>Akun saya</span>
        </a>
        <div class="dropdown-divider"></div>
        <!-- item-->
        <a class="dropdown-item notify-item  text-danger" href="{{ route('user-logout-act') }}">
            <i class="fe-log-out"></i>
            <span>Logout</span>
        </a>
    </div>
@endif
<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-light shadow"
    style="height: 80px; {{ in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), ['login', 'register', 'verify', 'forgot-password', $token ?? null]) ? '' : 'margin-top: 36px' }}">
    <div class="container-fluid mx-4" style="width: 84%">
        <div class="d-flex align-items-center justify-content-start" style="width: 20%;">
            <a class="navbar-brand font-main-color" href="{{ route('user-home') }}"><strong>E-COMM</strong></a>
            <div class="divider" style="background-color: #6777ef"></div>
            <a href="#categoryCollapse" class="font-main-color ms-2" style="text-decoration: none;"
                data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="categoryCollapse"
                id="categoryCollapseToggle">
                @if(request()->path() == 'user/cart')
                    {{ 'Keranjang Belanja' }}
                @elseif (request()->path() == 'user/product/buy-now' || request()->path() == 'user/product/order'  )
                    {{ 'Pesanan' }}
                @elseif (request()->path() == 'user/profile' )
                    {{ 'Profile' }}
                @endif
            </a>
        </div>
        @if (
            !in_array(substr(url()->current(), strrpos(url()->current(), '/') + 1), [
                'login',
                'register',
                'verify',
                'forgot-password',
                'buy-now',
                'order',
                'profile',
                $token ?? null,
            ]))
            @livewire('SearchCartProduct')
        @endif
    </div>
</nav>
<script src="{{ asset('/ourjs/navbar.js') }}" data-navigate-track></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
