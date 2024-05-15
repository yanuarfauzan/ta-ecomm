<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-main-color shadow"
    style="height: 125px;">
    <div class="container-fluid mx-4" style="width: 84%">
        <div class="d-flex align-items-center justify-content-evenly" style="width: 17%;">
            <a class="navbar-brand text-white" href="#">E-COMM</a>
            <a href="#categoryCollapse" class="text-white" style="text-decoration: none;" data-bs-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="categoryCollapse"
                id="categoryCollapseToggle">Category</a>
        </div>
        <div class="d-flex flex-column gap-2 mt-2">
            <div class="d-flex gap-2 me-1 justify-content-end align-items-center">
                <a href="#" style="font-size: 12px; text-decoration: none;"
                    class=" text-center d-flex gap-1 align-items-center text-white">Ikuti kami di <i
                        class="bi bi-facebook"></i> <i class="bi bi-instagram"></i></a>
                <div class="low-divider"></div>
                <a href="#" style="font-size: 12px; text-decoration: none;"
                    class=" text-center d-flex gap-1 align-items-center text-white"><i
                        class="bi bi-question-circle"></i> Bantuan</a>
            </div>
            <form class="d-flex" role="search">
                <div class="input-group">
                    <input type="text" class="form-control rounded-0" id="search-home" placeholder="Search..."
                        style="box-shadow: none; width: 720px;">
                    <div class="input-group-append" style="height : 80%;">
                        <button class="btn btn-light input-group-text rounded-0 border-2 text-white bg-main-color"
                            style="width: 60x">
                            <i class="bi bi-search" style="font-size: 25px; color: "></i>
                        </button>
                    </div>
                </div>
            </form>
            {{-- TODO (menampilkan produk yang total jualnya tinggi), produk relasi order --}}
            <div class="d-flex gap-2 ms-1" style="height: 22px">
                @if (isset($products))
                    @foreach ($products->slice(0, 4) as $product)
                        <a href="#" style="font-size: 12px; text-decoration: none;"
                            class=" text-white">{{ $product?->name }}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-between gap-2 me-2" style="width: 17%;">
            <a href="{{ route('user-cart') }}" class=" text-white" style="text-decoration: none">
                <span role="button">
                    <i class="bi bi-cart" style="font-size: 25px"></i>
                </span>
            </a>

            <a href="" class=" text-white" style="text-decoration: none">
                <span role="button">
                    <i class="bi bi-bell" style="font-size: 25px"></i>
                </span>
            </a>

            <div class="d-flex justify-content-between align-items-center">
                <div class="dropdown-toggle d-flex justify-content-start align-items-center" data-bs-toggle="dropdown"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <a href="" class="" style="text-decoration: none" data-bs-toggle="dropdown"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span role="button" class="position-relative">
                            <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1713402631~exp=1713403231~hmac=0479d616f3678fd9ef2e1f0e048d648ade1cdd2178660fb31ea7d613b5c46692"
                                class="rounded-circle" style="width : 27px;" alt="">
                            {{-- BADGE NOTIFIKASI --}}
                            {{-- <span
                                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span> --}}
                        </span>
                    </a>
                    <div class="pro-user-name text-dark ms-1 text-white">
                        Rahul Sentoyo
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="dropdown-menu dropdown-menu-end profile-dropdown position-fixed rounded-0"
    style="right: 133px; top: 75px; z-index: 1041;">
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
    <a class="dropdown-item notify-item  text-danger" href="{{ route('user-logout-act') }}">
        <i class="fe-log-out"></i>
        <span>Logout</span>
    </a>
</div>
<div class="collapse position-fixed rounded-0" id="categoryCollapse"
    style="width: 85%; top: 125px; z-index: 1040; height : 50%; left: 115px;">
    <!-- Konten collapse di sini -->
    <div class="card card-body text-danger rounded-0 border-0 d-flex pb-4 bg-light shadow-lg"
        style="height : 100%; width: 100%;">
        <div class="swiper-container swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($categories->chunk(7) as $chunkedCategories)
                    <div class="swiper-slide">
                        <div class="row row-cols-8 ms-0">
                            @foreach ($chunkedCategories as $category)
                                <a href="{{ $category->id }}" style="text-decoration: none" class="col mt-3">
                                    <div>
                                        <div class="card rounded-0 border-0 shadow"
                                            style="width: 145px; cursor: pointer; height: auto">
                                            <img src="{{ Storage::url('public/icon_category/' . $category->icon) }}"
                                                class="card-img-top rounded-0" alt="..." style="width: 100%">
                                            <div class="card-body">
                                                <p class="card-text text-center"><strong>{{ $category->name }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="mt-5">
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="swiper-button-next text-light"><i class="bi bi-chevron-right"></i></div>
    <div class="swiper-button-prev text-light"><i class="bi bi-chevron-left"></i></div>
</div>
<script src="{{ asset('/ourjs/navbar.js') }}" data-navigate-track></script>
