<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ZukiraLapangan;
use App\Models\ZukiraBooking;
use App\Models\ZukiraReview;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lapangans = ZukiraLapangan::all();
        $bookings = ZukiraBooking::with('lapangan')->where('user_id', Auth::id())->get();
        $reviews = ZukiraReview::with('lapangan')->where('user_id', Auth::id())->get();

        return view('dashboard.index', compact('lapangans', 'bookings', 'reviews'));
}


// public function index()
// {
//     $lapangans = ZukiraLapangan::all();
//     $bookings = ZukiraBooking::where('user_id', auth()->id())->get();
//     $reviews = ZukiraReview::where('user_id', auth()->id())->get();

//     return view('dashboard.home', compact('lapangans', 'bookings', 'reviews'));
// }
}
