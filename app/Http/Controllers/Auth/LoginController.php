<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // default, bisa diabaikan

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override redirect setelah login berhasil
     */
    protected function authenticated(Request $request, $user)
    {
    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'petugas' => redirect()->route('sarana.dashboard'),
        default   => redirect()->route('divisi.dashboard'),
    };

    }
}
