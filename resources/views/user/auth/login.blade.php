@extends('partial.user.secondary.main')
@section('container')
    <div class="d-flex justify-content-center align-items-center bg-main-color"
        style="width: 100%; height: 600px; margin-top: 80px;">
        <div class="container d-flex justify-content-between" style="width: 70%; height: 500px;">
            <div class="d-flex align-items-center" style="width: 40%">
                <img src="{{ asset('/oursvg/login_page.svg') }}" alt="" style="width: 500px;">
            </div>
            <div class="bg-white" style="width: 40%">
                <div class="d-flex flex-column align-items-start m-4 gap-4">
                    <span>
                        <h4>Login</h4>
                    </span>
                    <form action="{{ route('user-login-act') }}" method="POST" class="d-flex flex-column gap-4"
                        style="width: 100%;">
                        @csrf
                        <div class="input-group">
                            <label for="username">email / username</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username" name="login"
                                value="{{ old('login') }}" style="box-shadow: none; width: 100%; height: 50px;">
                            @if ($errors->has('login'))
                                <span class="text-danger">{{ $errors->first('login') }}</span>
                            @endif
                            @if (session('message'))
                                <span class="text-danger">{{ session('message') }}</span>
                            @endif
                        </div>
                        <div class="d-flex flex-column input-group">
                            <label for="password">password</label>
                            <div class="d-flex justify-content-start position-relative">
                                <input type="password" class="form-control rounded-0 mt-2" id="password" name="password"
                                    style="box-shadow: none; width: 100%; height: 50px;">
                                <span class="position-absolute" style="height: 50px; top: 40%; right: 20px;">
                                    <i class="bi bi-eye-slash opacity-50" style="font-size: 20px; cursor: pointer;"
                                        id="togglePassword"></i>
                                </span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="input-group mt-4">
                            <button type="submit" class="rounded-0 bg-main-color text-white border-0"
                                style="box-shadow: none; width: 100%; height: 50px;">login</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between align-items-center" style="width: 100%">
                        <span><a href="{{ route('user-forgot-password') }}" class="font-main-color">lupa password</a></span>
                        <span><a href="{{ route('user-register') }}" class="font-main-color">daftar</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/ourjs/login.js') }}"></script>
