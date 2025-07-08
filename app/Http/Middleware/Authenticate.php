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
    if ($request->expectsJson()) {
        // Jika request adalah AJAX/expectsJson, JANGAN redirect.
        // Biarkan exception handler yang menangani dan mengirim response 401.
        return null;
    }
    
    // Jika bukan request AJAX, redirect ke halaman login seperti biasa.
    return route('login');
}
}
