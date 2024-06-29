@extends('partial.user.secondary.main')
@section('container')
    <div class="d-flex justify-content-center align-items-center bg-main-color"
        style="width: 100%; height: 600px; margin-top: 80px;">
        <div class="container d-flex justify-content-center" style="width: 70%; height: 500px;">
            <div class="bg-white" style="width: 40%">
                <div class="d-flex flex-column align-items-center m-4 gap-2">
                    <span>
                        <h4>Reset password</h4>
                    </span>
                    <span>
                        <img src="{{ asset('/oursvg/reset_password.svg') }}" alt="" style="width: 200px;">
                    </span>
                    <form action="{{ route('user-reset-password-act', ['token' => $token]) }}" method="POST"
                        class="d-flex flex-column gap-2" style="width: 100%;">
                        @csrf
                        @method('PUT')
                        <div class="input-group" style="height: 100px">
                            <label for="password">password baru</label>
                            <input type="password" class="form-control rounded-0 mt-2" id="password" name="new_password"
                                style="box-shadow: none; width: 100%; height: 50px;">
                            @if ($errors->has('new_password'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ $errors->first('new_password') }}</span>
                            @endif
                            @if (session('message'))
                                <span class="text-danger" style="font-size: 0.8em;">{{ session('message') }}</span>
                            @endif
                        </div>
                        <div class="input-group">
                            <label for="password_confirmation">konfirmasi password</label>
                            <input type="password" class="form-control rounded-0 mt-2" id="password_confirmation"
                                name="new_password_confirmation" style="box-shadow: none; width: 100%; height: 50px;">
                        </div>
                        <div class="input-group mt-4">
                            <button type="submit" class="rounded-0 bg-main-color text-white border-0"
                                style="box-shadow: none; width: 100%; height: 40px;">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/ourjs/verify.js') }}"></script>
