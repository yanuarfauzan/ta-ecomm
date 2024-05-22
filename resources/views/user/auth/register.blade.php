@extends('partial.user.secondary.main')
@section('container')
    <div class="d-flex justify-content-center align-items-center bg-main-color"
        style="width: 100%; height: 600px; margin-top: 80px;">
        <div class="container d-flex justify-content-between" style="width: 70%; height: 560px;">
            <div class="d-flex align-items-center" style="width: 40%">
                <img src="{{ asset('/oursvg/register_page.svg') }}" alt="" style="width: 500px;">
            </div>
            <div class="bg-white" style="width: 40%">
                <div class="d-flex flex-column align-items-start m-4 gap-1">
                    <span>
                        <h4>Register</h4>
                    </span>
                    <form action="{{ route('user-preRegister-act') }}" method="POST" class="d-flex flex-column gap-2"
                        style="width: 100%;">
                        @csrf
                        <div class="input-group" style="height: 55px">
                            <input type="text" class="form-control rounded-0" id="username" placeholder="username" value="{{ old('username') }}"
                                name="username" style="box-shadow: none; width: 100%; height: 40px;">
                            @if ($errors->has('username'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input type="text" class="form-control rounded-0" id="email" placeholder="email" value="{{ old('email') }}"
                                name="email" style="box-shadow: none; width: 100%; height: 40px;">
                            @if ($errors->has('email'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input type="number" class="form-control rounded-0" id="no_handphone" name="phone_number" value="{{ old('phone_number') }}"
                                placeholder="no handphone" style="box-shadow: none; width: 100%; height: 40px;">
                            @if ($errors->has('phone_number'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input type="password" class="form-control rounded-0" id="password" placeholder="password"
                                name="password" style="box-shadow: none; width: 100%; height: 40px;">
                            @if ($errors->has('password'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="input-group" style="height: 55px">
                            <input type="password" class="form-control rounded-0" id="konfirmasi_password"
                                name="password_confirmation" placeholder="konfirmasi password"
                                style="box-shadow: none; width: 100%; height: 40px;">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('password_confirmation') }}</span>
                            @endif
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
                                @if ($errors->has('gender'))
                                    <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="input-group mt-2">
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
