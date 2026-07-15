<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect setelah login berhasil.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Field yang digunakan untuk login.
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Redirect setelah login berhasil.
     */
    protected function authenticated(Request $request, $user)
    {
    if ($user->isAdmin()) {
        return redirect()->route('dashboard');
    }

    return redirect('/');
    }
}