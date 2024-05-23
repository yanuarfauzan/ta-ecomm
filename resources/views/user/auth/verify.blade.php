@extends('partial.user.secondary.main')
@section('container')
    <div class="d-flex justify-content-center align-items-center bg-main-color"
        style="width: 100%; height: 600px; margin-top: 80px;">
        <div class="container d-flex justify-content-center" style="width: 70%; height: 500px;">
            <div class="bg-white" style="width: 40%">
                <div class="d-flex flex-column align-items-center m-4 gap-2">
                    <span>
                        <h4>Masukan kode OTP</h4>
                    </span>
                    <span>
                        <img src="{{ asset('/oursvg/email_sent.svg') }}" alt="" style="width: 200px;">
                    </span>
                    <span>
                        kode telah di kirimkan ke email :
                    </span>
                    <span>
                        <strong>{{ $user['email'] }}</strong>
                    </span>
                    <form action="{{ route('user-register-act') }}" method="POST" class="d-flex flex-column gap-2"
                        style="width: 100%;">
                        @csrf
                        <div class="d-flex flex-column align-items-center gap-1" style="height: 50px;">
                            <div class="d-flex justify-content-center align-items-center gap-1 input-group mt-3">
                                <input type="text" class="form-control rounded-0 otp-input" maxlength="1"
                                    style="box-shadow: none; height: 40px; text-align: center;" name="first" value="{{ old('first') }}">
                                <input type="text" class="form-control rounded-0 otp-input" maxlength="1"
                                    style="box-shadow: none; height: 40px; text-align: center;" name="second" value="{{ old('second') }}">
                                <input type="text" class="form-control rounded-0 otp-input" maxlength="1"
                                    style="box-shadow: none; height: 40px; text-align: center;" name="third" value="{{ old('third') }}">
                                <input type="text" class="form-control rounded-0 otp-input" maxlength="1"
                                    style="box-shadow: none; height: 40px; text-align: center;" name="fourth" value="{{ old('fourth') }}">
                                <input type="text" class="form-control rounded-0 otp-input" maxlength="1"
                                    style="box-shadow: none; height: 40px; text-align: center;" name="fivth" value="{{ old('fivth') }}">
                                <input type="text" class="form-control rounded-0 otp-input" maxlength="1"
                                    style="box-shadow: none; height: 40px; text-align: center;" name="sixth" value="{{ old('sixth') }}">
                            </div>
                            @if (session('message'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ session('message') }}</span>
                            @endif
                            @if ($errors->has('first'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('first') }}</span>
                            @endif
                        </div>
                        <div class="input-group mt-4">
                            <button type="submit" class="rounded-0 bg-main-color text-white border-0"
                                style="box-shadow: none; width: 100%; height: 40px;">kirim</button>
                        </div>
                        <span>tidak menerima email? <a href="">kirim ulang</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/ourjs/verify.js') }}"></script>
