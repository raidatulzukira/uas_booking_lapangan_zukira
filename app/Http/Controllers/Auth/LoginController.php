<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
{
    // Jika request datang dari AJAX (seperti popup kita)
    if ($request->expectsJson()) {
        // Tentukan URL redirect berdasarkan role
        $redirectUrl = $user->role === 'admin' ? '/admin' : '/dashboard';
        return response()->json(['redirect_url' => $redirectUrl]);
    }

    // Jika login dari halaman biasa (bukan AJAX), lakukan redirect seperti biasa
    if ($user->role === 'admin') {
        return redirect('/admin')->with('success', 'Anda berhasil Login, ' . $user->name . '!');
    }
    return redirect('/dashboard')->with('success', 'Anda berhasil Login, ' . $user->name . '!');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logout', 'Anda berhasil logout!');
    }
}
