<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect setelah login
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated($request, $user)
    {
        if ($user->status == 'banned') {

            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Akun Anda telah diblokir oleh admin.'
                ]);
        }
    }
}