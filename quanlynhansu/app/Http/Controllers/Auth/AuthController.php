<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // code...
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
            $req->session()->regenerate();
            return redirect()->route('dashboard')->with('sucess','Đăng nhập thành công');
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
