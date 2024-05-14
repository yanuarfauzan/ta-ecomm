@extends('partial.user.secondary.main')
@section('container')
    <div class="d-flex justify-content-center align-items-center bg-main-color"
        style="width: 100%; height: 600px; margin-top: 80px;">
        <div class="container d-flex justify-content-between" style="width: 70%; height: 500px;">
            <div class="d-flex align-items-center" style="width: 40%">
                <img src="{{ asset('/oursvg/register_page.svg') }}" alt="" style="width: 500px;">
            </div>
            <div class="bg-white" style="width: 40%">
                <div class="d-flex flex-column align-items-start m-4 gap-2">
                    <span>
                        <h4>Register</h4>
                    </span>
                    <form action="" class="d-flex flex-column gap-2" style="width: 100%;">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0" id="username" placeholder="username"
                                style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0 mt-2" id="email" placeholder="email"
                                style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0 mt-2" id="no_handphone"
                                placeholder="no handphone" style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-0 mt-2" id="password" placeholder="password"
                                style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-0 mt-2" id="konfirmasi_password"
                                placeholder="konfirmasi password" style="box-shadow: none; width: 100%; height: 40px;">
                        </div>
                        <div class="d-flex justify-content-center gap-4 mt-2 align-items-center input-group">
                            <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check d-flex justify-content-start gap-2 align-items-center">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="input-group mt-4">
                            <button type="submit" class="rounded-0 bg-main-color text-white border-0"
                                style="box-shadow: none; width: 100%; height: 40px;">daftar</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-start align-items-center" style="width: 100%">
                        <span>punya akun? <a href="#" class="font-main-color">login</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
