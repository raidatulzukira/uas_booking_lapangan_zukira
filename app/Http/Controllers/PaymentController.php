<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($booking_id)
    {
        $booking = \App\Models\ZukiraBooking::findOrFail($booking_id);
        return view('payment.create', compact('booking'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:zukira_bookings,id',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric'
        ]);

        $file = $request->file('bukti_transfer');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $filename);

        \App\Models\ZukiraPayment::create([
            'booking_id' => $request->booking_id,
            'bukti_transfer' => $filename,
            'status_verifikasi' => 'menunggu',
            'harga' => $request->harga,
        ]);

        return redirect('/home')->with('success', 'Bukti transfer berhasil diunggah.');
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

    public function adminIndex()
    {
        $payments = \App\Models\ZukiraPayment::with('booking')->latest()->get();
        return view('payment.index', compact('payments'));
    }

    public function verifikasi($id)
    {
        $payment = \App\Models\ZukiraPayment::findOrFail($id);
        $payment->update(['status_verifikasi' => 'valid']);
        return back()->with('success', 'Pembayaran telah divalidasi.');
    }

}
