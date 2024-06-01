<div class="container" style="width: 100%; height: 100%">
    <div class="card-product" class="d-flex flex-column" style="width: 100%; height: 100%;">
        <ul class="nav d-flex justify-content-evenly align-items-center">
            <li class="nav-item">
                <a class="nav-link font-main-color" href="#">Bio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Alamat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Notification</a>
            </li>
        </ul>
        <hr class="card-product mt-0">
        <div class="d-flex justify-content-center align-items-center gap-2 mx-4 mb-4">
            <div style="width: 50%; height: auto;">
                <div class="d-flex justify-content-between align-items-top gap-2">
                    <div class="d-flex flex-column justify-content-between align-items-center gap-2 ms-4 my-4" style="width: 50%;">
                        <div class="" style="width: 100%; height: 250px;">
                            <img src="https://placehold.co/700x600" alt="" style="width: 100%; height: 100%">
                        </div>
                        <div class="card-product d-flex justify-content-center align-items-center" style="cursor: pointer; width: 100%; height: 50px;">
                            <span style="cursor: pointer;"><h5 class="" >Change photo</h5></span>
                        </div>
                        <div class="" style="width: 100%; height: 50px;">
                            <span style="cursor: pointer;">
                                <button role="button" class="btn rounded-0 bg-main-color text-white"
                        style="width: 100%; cursor: default; height: 50px;"><strong>Change Password</strong></button>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-start align-items-center gap-2 me-4 my-4" style="width: 50%;">
                        <div class="input-group" style="height: 55px">
                            <label for="username">username</label>
                            <input type="text" class="form-control rounded-0" id="username" value="{{ old('username') }}"
                                name="username" style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group" style="height: 55px">
                            <label for="birth_of_date">tanggal lahir</label>
                            <input type="text" class="form-control rounded-0" id="email" value="{{ old('email') }}"
                                name="birth_of_date" style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center gap-4 align-items-center input-group" style="height: 55px">
                                <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                    <input class="form-check-input" type="radio" value="1"
                                        name="gender" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                    <input class="form-check-input" type="radio" value="0"
                                        name="gender" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group" style="height: 55px">
                            <label for="email">email</label>
                            <input type="email" class="form-control rounded-0" id="no_handphone"
                                style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group" style="height: 55px">
                            <label for="email">no hp</label>
                            <input type="email" class="form-control rounded-0" id="no_handphone"
                                style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-main-color" style="width: 50%; height: auto;">

            </div>
        </div>
    </div>
</div>
