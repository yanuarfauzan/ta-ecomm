<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class AuthController extends Controller
{
    public function preRegister(RegisterRequest $request)
    {
        $user = $request->all();
        $user['otp'] = $this->generateOTP();
        Session::put('pre-regis', $user);
        try {
            Mail::send('content_email.send_otp_email', ['user' => $user], function ($message) use ($user) {
                $message->to($user['email']);
                $message->subject('OTP VERIFIKASI EMAIL');
            });
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
        return response()->json(['message' => 'Kode OTP berhasil dikirim, silahkan cek email']);
    }
    public function register(OtpRequest $request)
    {
        $user = Session::get('pre-regis');
        $user['is_verified'] = 1;
        $user['role'] = 'user';
        $otp = $request->first . $request->second . $request->third . $request->fourth . $request->fivth . $request->sixth;
        if ($user['otp'] == $otp) {
            User::create($user);
            return response()->json(['message' => 'Kode OTP benar, email berhasil di verifikasi']);
        } else {
            return response()->json(['message' => 'Kode OTP salah, email gagal di verifikasi']);
        }
    }
    public function login(LoginRequest $request)
    {
        $login = $request->login;
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $login)->first();
            if ($user) {
                return $this->checkCredential($user, $request->all());
            } else {
                return response()->json(['message' => 'email atau username belum terverifikasi'], 400);
            }
        } else {
            $user = User::where('username', $login)->first();
            if ($user) {
                return $this->checkCredential($user, $request->all());
            } else {
                return response()->json(['message' => 'email atau username belum terverifikasi'], 400);
            }
        }
    }
    public function checkCredential($user, $data)
    {
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['status' => false, 'message' => 'email, username atau password salah']);
        }
        try {
            Auth::guard('users')->login($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return response()->json(['message' => 'User berhasil login', 'data' => Auth::guard('users')->user()]);
    }
    public function logout()
    {
        Auth::logout();
    }
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->update([
            'token_reset' => Str::random(36),
        ]);
        try {
            Mail::send('content_email.send_token_reset', ['user' => $user, 'appUrl' => env('APP_URL')], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('RESET PASSWORD');
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return response()->json(['message' => 'Silahkan cek email']);
    }
    public function resetPassword($token, ResetPasswordRequest $request)
    {
        $user = User::where('token_reset', $token)->first();
        if ($user) {
            $user->update([
                'password' => $request->password
            ]);
        } else {
            return response()->json(['message' => 'Token tidak valid'], 401);
        }

        return response()->json(['message' => 'Berhasil merubah password']);
    }
    public function generateOTP()
    {
        // Panjang kode OTP
        $length = 6;

        // Daftar karakter yang akan digunakan untuk membuat kode OTP
        $characters = '0123456789';

        // Mengacak karakter untuk membuat kode OTP
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $otp;
    }
}
