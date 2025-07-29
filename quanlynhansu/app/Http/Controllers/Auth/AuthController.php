<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        // code...
    }
    public function resetPassword(ResetPasswordRequest $request){
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
        ? redirect()->route('auth.admin')->with('success', 'Password is changed successfully!')
        : back()->withErrors(['email' => __($status)]);
    }
    public function sendResetLink(ForgotPasswordRequest $request){
        $status = Password::sendResetLink(
            $request->only('email')
        );
        // dd($status, Password::RESET_LINK_SENT);
        return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'The link has been successfully sent to the email')
        : back()->withErrors(['email' => __($status)]);
    }
    public function index()
    {
        return view('auth.login');
    }
    public function login(AuthRequest $req)
    {
        $credentials = [
            'email' => $req->input('email'),
            'password' => $req->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status == config('apps.general.unpublish')) {
                Auth::logout();
                $req->session()->invalidate();
                $req->session()->regenerateToken();
                return redirect()->route('auth.admin')->with('error','Tài khoản đã bị khóa!');
            }
            $req->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Đăng nhập thành công');
        }
        return back()->with('error','Email hoặc mật khẩu không đúng. Vui lòng thử lại!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('auth.admin');
    }
}
