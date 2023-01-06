<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $is_auth = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);

        if(!$is_auth) return back()->with('error', 'Admin Not Found');

        return redirect()->intended(url('/admin'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin');
    }
}
