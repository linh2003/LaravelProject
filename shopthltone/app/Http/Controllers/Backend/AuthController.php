<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {

    }
    public function index(){
        return view('backend.auth.login');
    }
    public function login(AuthRequest $req){
        $log = $req->input('log');
        $pwd = $req->input('pwd');
        $credentials = [
            'email'     => $log,
            'password'  => $pwd,
        ];
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success','Đăng nhập thành công');
        }
        // return back()->withErrors([
        //     'log' => 'The provided credentials do not match our records.'
        // ])->onlyInput('log');
        return redirect()->route('auth.admin')->with('error','Email hoặc Mật khẩu không chính xác!');
    }
    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}
