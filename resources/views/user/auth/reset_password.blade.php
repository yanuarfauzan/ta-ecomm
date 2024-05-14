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
                    <form action="" class="d-flex flex-column gap-2" style="width: 100%;">
                        <div class="input-group">
                            <label for="username">password baru</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                            style="box-shadow: none; width: 100%; height: 50px;">
                        </div>
                        <div class="input-group">
                            <label for="username">konfirmasi password</label>
                            <input type="text" class="form-control rounded-0 mt-2" id="username"
                            style="box-shadow: none; width: 100%; height: 50px;">
                        </div>
                        <div class="input-group mt-4">
                            <button type="submit" class="rounded-0 bg-main-color text-white border-0"
                                style="box-shadow: none; width: 100%; height: 40px;">kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('/ourjs/verify.js') }}"></script>
