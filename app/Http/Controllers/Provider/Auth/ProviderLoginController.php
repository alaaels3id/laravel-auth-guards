<?php

namespace App\Http\Controllers\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::PROVIDER;

    public function __construct()
    {
        $this->middleware('guest:provider')->except('providerLogout');
    }

    public function showProviderLoginForm()
    {
        return view('provider.auth.login');
    }

    public function providerLogin(Request $request)
    {
        $is_auth = Auth::guard('provider')->attempt(['email' => $request->email, 'password' => $request->password]);

        if(!$is_auth) return back()->with('error', 'Provider Not Found');

        return redirect()->intended(url('/provider'));
    }

    public function providerLogout(Request $request)
    {
        Auth::guard('provider')->logout();

        return redirect('/provider');
    }
}
