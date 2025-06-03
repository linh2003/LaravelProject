<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogin extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }
    public function auth(AuthRequest $req){
        $credential = [
            'email' => $req->input('log'),
            'password' => $req->input('pwd')
        ];
        if (Auth::attempt($credential)) {
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('admin.login')->with('error', 'Email hoặc mật khẩu không đúng!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
