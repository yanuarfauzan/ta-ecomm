@extends('partial.user.secondary.main')
@section('container')
    <div class="d-flex justify-content-center align-items-center bg-main-color"
        style="width: 100%; height: 600px; margin-top: 80px;">
        <div class="container d-flex justify-content-center" style="width: 70%; height: 500px;">
            <div class="bg-white" style="width: 40%">
                <div class="d-flex flex-column align-items-center m-5 gap-2">
                    <span>
                        <h4>Lupa Password</h4>
                    </span>
                    <span>
                        <img src="{{ asset('/oursvg/forgot_password.svg') }}" alt="" style="width: 200px;">
                    </span>
                    <span class="text-success" style="font-size: 0.8em;">{{ session('message') ? session('message') : '' }}</span>
                    <form action="{{ route('user-forgot-password-act') }}" method="POST"
                        class="d-flex flex-column gap-2 mt-2" style="width: 100%;">
                        @csrf
                        <div class="input-group" style="height: 100px;">
                            <label for="email">email</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="email" name="email"
                                value="{{ old('email') }}" style="box-shadow: none; width: 100%; height: 50px;">
                            @if ($errors->has('email'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="input-group mt-4">
                            <button type="submit" class="rounded-0 bg-main-color text-white border-0"
                                style="box-shadow: none; width: 100%; height: 40px;">Kirim</button>
                        </div>
                        <span>tidak menerima email? <a href="">kirim ulang</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/ourjs/verify.js') }}"></script>
