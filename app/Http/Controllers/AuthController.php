<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
    public function registerPage()
    {
        return view('user.auth.register');
    }
    public function verifyPage()
    {
        $user = Session::get('pre-regis');
        return view('user.auth.verify', compact('user'));
    }
    public function loginPage()
    {
        return view('user.auth.login');
    }
    public function forgotPasswordPage()
    {
        return view('user.auth.forgot_password');
    }
    public function resetPasswordPage($token)
    {
        return view('user.auth.reset_password', compact('token'));
    }   
    public function preRegister(RegisterRequest $request)
    {
        $user = $request->all();
        $user['otp'] = $this->generateOTP();
        $user['expired_at'] = now()->addMinutes(30);
        Session::put('pre-regis', $user);
        try {
            Mail::send('content_email.send_otp_email', ['user' => $user], function ($message) use ($user) {
                $message->to($user['email']);
                $message->subject('OTP VERIFIKASI EMAIL');
            });
        } catch (\Exception $e) {
            return Log::error($e->getMessage());
        }
        return redirect()->route('user-verify');
    }
    public function register(OtpRequest $request)
    {
        $user = Session::get('pre-regis');
        if (now()->lessThan($user['expired_at'])) {
            $user['is_verified'] = 1;
            $user['role'] = 'user';
            $otp = $request->first . $request->second . $request->third . $request->fourth . $request->fivth . $request->sixth;
            if ($user['otp'] == $otp) {
                User::create($user);
                Session::forget('pre-regis');
                return redirect()->route('user-login');
            } else {
                return back()->with(['message' => 'Kode OTP salah, email gagal di verifikasi']);
            }
        } else {
            Session::forget('pre-regis');
            return back()->with(['message' => 'Waktu OTP telah habis']);
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
                return back()->with(['message' => 'email atau username belum terdaftar']);
            }
        } else {
            $user = User::where('username', $login)->first();
            if ($user) {
                return $this->checkCredential($user, $request->all());
            } else {
                return back()->with(['message' => 'email atau username belum terdaftar']);
            }
        }
    }
    public function checkCredential($user, $data)
    {
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()->with(['message' => 'email, username atau password salah']);
        }
        try {
            Auth::loginUsingId($user->id);
            $data->session->regenerate();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->route('user-home');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('user-login');
    }
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->update([
            'token_reset' => Str::random(36),
        ]);
        Session::put('token-expired-at', now()->addMinutes(30));
        try {
            Mail::send('content_email.send_token_reset', ['user' => $user, 'appUrl' => env('APP_URL')], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('RESET PASSWORD');
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return back()->with(['message' => 'Berhasil mengirim email, silahkan cek email anda']);
    }
    public function resetPassword($token, ResetPasswordRequest $request)
    {
        if (now()->lessThan(Session::get('token-expired-at'))) {
            $user = User::where('token_reset', $token)->first();
            if ($user) {
                $user->update([
                    'password' => $request->new_password
                ]);
            } else {
                return back()->route('user-login');
            }

            return redirect()->route('user-login');
        } else {
            return redirect()->route('user-login');
        }

    }
    public function generateOTP()
    {
        $length = 6;

        $characters = '0123456789';

        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $otp;
    }
}
