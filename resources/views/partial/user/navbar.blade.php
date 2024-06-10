<nav class="navbar navbar-expand-lg fixed-top d-flex justify-content-center text-white bg-main-color shadow"
    style="height: 125px;">
    <div class="container-fluid mx-4 d-flex align-items-center" style="width: 84%">
        <div class="d-flex align-items-center justify-content-evenly" style="width: 17%;">
            <a class="navbar-brand text-white" href="{{ route('user-home') }}"><strong>E-COMM</strong></a>
            <a href="#categoryCollapse" class="text-white" style="text-decoration: none;" data-bs-toggle="collapse"
                role="button" aria-expanded="false" aria-controls="categoryCollapse"
                id="categoryCollapseToggle">Category</a>
        </div>
        <form action="{{ route('user-home') }}" class="d-flex" role="search" method="GET">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control rounded-0" id="search-home" placeholder="Search..."
                    name="keyword" style="box-shadow: none; width: 720px;">
                <div class="input-group-append" style="height : 80%;">
                    <button type="submit"
                        class="btn-search btn-light input-group-text rounded-0 border-2 text-white bg-main-color"
                        style="width: 60x">
                        <i class="bi bi-search" style="font-size: 25px; color: "></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-start align-items-center gap-2 me-2" style="width: 17%;">
            <a href="{{ route('user-cart') }}" class=" text-white" style="text-decoration: none">
                <span role="button">
                    <i class="bi bi-cart" style="font-size: 25px"></i>
                </span>
            </a>
            <div iv class="position-relative">
                <a href="#" class="text-white position-relative" id="notificationButton"
                    style="text-decoration: none;">
                    <i class="bi bi-bell" style="font-size: 25px;"></i>
                    {{-- <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-0 rounded-circle"
                        style="width: 15px; height: 15px;">
                        <span class="position-absolute top-50 start-50 translate-middle"
                            style="color: white; font-size: 12px;">
                            
                        </span>
                    </span> --}}
                </a>
                <ul class="dropdown-menu-notif dropdown-menu dropdown-menu-end" aria-labelledby="notificationButton">
                    <li class="ms-4 me-4">
                        <span id="list-notif"></span>
                    </li>
                </ul>
            </div>
            @if (auth()->user())
                <div class="d-flex justify-content-between align-items-center">
                    <div class="dropdown-toggle dropdown-toggle-profile d-flex justify-content-start align-items-center"
                        data-bs-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                        <a href="" class="" style="text-decoration: none" data-bs-toggle="dropdown"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span role="button" class="position-relative">
                                <img src="{{ Storage::url(auth()->user()->profile_image) }}" class="rounded-circle"
                                    style="width : 27px;" alt="">
                                {{-- BADGE NOTIFIKASI --}}
                            </span>
                        </a>
                        <div class="pro-user-name text-dark ms-1 text-white">
                            {{ auth()->user()->username }}
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <a href="{{ route('user-login') }}" type="button" id="checkout" class="btn rounded-0 text-white"
                        style="border: solid 2px white"><strong>masuk</strong></a>
                    <a href="{{ route('user-register') }}" type="button" id="checkout"
                        class="btn rounded-0 text-white" style="border: solid 2px white"><strong>daftar</strong></a>
                </div>
            @endif
        </div>
    </div>
</nav>
<div class="dropdown-menu dropdown-menu-profile dropdown-menu-end profile-dropdown position-fixed rounded-0"
    style="right: 133px; top: 75px; z-index: 1041;">
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
                                <a href="{{ route('user-home') . '?category=' . $category->id }}"
                                    style="text-decoration: none" class="col mt-3">
                                    <div>
                                        <div class="card rounded-0 border-0 shadow-sm"
                                            style="width: 145px; cursor: pointer; height: auto">
                                            <img src="{{ Storage::url($category->icon) }}"
                                                class="card-img-top rounded-0" alt="..." style="width: 100%">
                                            <div class="card-body">
                                                <p class="card-text text-center">
                                                    <strong>{{ $category->name }}</strong>
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
<div id="userId" data-user-id="{{ auth()->user() ? auth()->user()->id : '' }}" class="d-none"></div>
<script src="{{ asset('/ourjs/navbar.js') }}" data-navigate-track></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            forceTLS: false
        });
        let userId = document.getElementById('userId').getAttribute('data-user-id');
        var channel = pusher.subscribe('payment-success-' + userId);
        channel.bind('payment-success', function(data) {
            var message = data.message;
            console.log(message);
            var newNotification = document.createElement('li');

            // Create span element with margin
            var listElement = document.getElementById('list-notif');
            listElement.innerHTML = message;
            var dropdownNotification = document.querySelector('.dropdown-menu');
            dropdownNotification.classList.add('show');
        });
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var notificationButton = document.getElementById('notificationButton');
        var dropdownNotification = document.querySelector('.dropdown-menu');

        notificationButton.addEventListener('click', function(event) {
            event.preventDefault();
            dropdownNotification.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var isClickInside = notificationButton.contains(event.target);
            if (!isClickInside) {
                dropdownNotification.classList.remove('show');
            }
        });
    });
</script>
