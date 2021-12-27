<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginService $loginService)
    {
        if (Auth::attempt($request->all(), true)) {
            $request->session()->regenerate();
            return response(['status'=>true, 'userId'=>Auth::id()]);
        }
        return back()->withErrors(['email' => 'Account with this email not found']);
    }
    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return response(['status'=>true]);
    }
}
