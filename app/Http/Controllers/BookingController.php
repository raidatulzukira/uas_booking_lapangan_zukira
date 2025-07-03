<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZukiraBooking;
use App\Models\ZukiraLapangan;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Admin melihat semua booking
    public function adminIndex()
    {
        $bookings = ZukiraBooking::with(['user', 'lapangan'])->latest()->get();
        return view('booking.index_admin', compact('bookings'));
    }

    public function konfirmasi($id)
    {
        $booking = ZukiraBooking::findOrFail($id);
        $booking->update(['status' => 'dikonfirmasi']);
        return back()->with('success', 'Booking dikonfirmasi.');
    }


    /**
     * Show the form for creating a new resource.
     */
    // Form Booking untuk customer
    public function create(Request $request)
{
    $lapangan = ZukiraLapangan::findOrFail($request->lapangan_id);
    return view('booking.create', compact('lapangan'));
}



    /**
     * Store a newly created resource in storage.
     */
    // Simpan Booking
    public function store(Request $request)
{
    $request->validate([
        'lapangan_id' => 'required|exists:zukira_lapangans,id',
        'tanggal' => 'required|date|after_or_equal:today',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required|after:jam_mulai',
    ]);

    ZukiraBooking::create([
        'user_id' => Auth::id(),
        'lapangan_id' => $request->lapangan_id,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'status' => 'pending',
    ]);

    return redirect()->route('dashboard')->with('success', 'Booking berhasil, menunggu konfirmasi.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // // Admin konfirmasi booking
    // public function konfirmasi($id)
    // {
    //     $booking = ZukiraBooking::findOrFail($id);
    //     $booking->update(['status' => 'dikonfirmasi']);
    //     return back()->with('success', 'Booking telah dikonfirmasi.');
    // }

}
