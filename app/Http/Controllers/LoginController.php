<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\ActivityService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request, ActivityService $activityService)
    {
        if (Auth::attempt($request->all(), true)) {
            $request->session()->regenerate();
            $activityService->changeLastActivity(Auth::id());
            return response(['status'=>true, 'userId'=>Auth::id()]);
        }
        return back()->withErrors(['email' => 'Account with this email not found']);
    }
    public function logout(ActivityService $activityService){
        $activityService->changeActive(Auth::id(),now()->subMinutes(15));
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('users.index');
    }
}
