<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // ✅ PERBAIKAN: Tambahkan use Auth

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * ✅ PERBAIKAN: Arahkan ke dashboard setelah registrasi berhasil.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5'], // 'confirmed' tidak diperlukan untuk AJAX
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * ✅ PERBAIKAN: Seluruh method ini diubah untuk handle auto-login dan AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Langsung login-kan user yang baru dibuat
        $this->guard()->login($user);

        // Jika request datang dari popup (AJAX)
        if ($request->wantsJson()) {
            return response()->json(['status' => 'success'], 201);
        }

        // Jika registrasi dari halaman biasa, redirect ke dashboard
        return redirect($this->redirectPath())->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}