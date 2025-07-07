<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika request BUKAN dari API...
        if (! $request->expectsJson()) {
            
            // Aturan baru:
            // 1. Buat sebuah pesan error di session.
            // 2. Arahkan pengguna kembali ke halaman landing.
            session()->flash('error', 'Anda harus login terlebih dahulu untuk melanjutkan.');
            return route('landing');
        }

        return null;
    }
}
