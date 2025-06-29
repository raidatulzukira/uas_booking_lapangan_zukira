<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth; 

// class CheckRole
// {
//     // public function handle(Request $request, Closure $next, $role): Response
//     // {
//     //     if (Auth::check() && Auth::user()->role === $role) {
//     //         return $next($request);
//     //     }

//     //     abort(403, 'Unauthorized access.');
//     // }

//     // public function handle(Request $request, Closure $next, $role)
//     // {
//     //     if (Auth::check() && Auth::user()->role == $role) {
//     //         return $next($request);
//     //     }
//     //     abort(403);
//     // }

//     public function handle($request, Closure $next, $role)
//     {
//         if (Auth::check() && Auth::user()->role === $role) {
//             return $next($request);
//         }

//         abort(403, 'Unauthorized');
//     }
// }

// // namespace App\Http\Middleware;

// // use Closure;
// // use Illuminate\Http\Request;
// // use Symfony\Component\HttpFoundation\Response;

// // class CheckRole
// // {
// //     public function handle(Request $request, Closure $next, $role): Response
// //     {
// //         if (auth()->check() && auth()->user()->role == $role) {
// //             return $next($request);
// //         }

// //         abort(403);
// //     }
// // } -->
