<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;

class LoginResellerController extends DefaultLoginController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/reseller/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('reseller');
    }
    public function showLoginForm()
    {
        return view('reseller.login');
    }
}
