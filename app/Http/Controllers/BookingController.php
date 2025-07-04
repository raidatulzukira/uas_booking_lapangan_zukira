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

    $newBooking = ZukiraBooking::create([
        'user_id' => Auth::id(),
        'lapangan_id' => $request->lapangan_id,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'status' => 'pending',
    ]);

    return redirect()->route('booking.show', ['id' => $newBooking->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 1. Ambil data booking spesifik berdasarkan ID
        $booking = ZukiraBooking::with(['user', 'lapangan'])->findOrFail($id);

        // 2. (PENTING) Otorisasi untuk keamanan
        // Pastikan hanya user yang membuat booking yang bisa melihat detailnya.
        if (Auth::id() !== $booking->user_id) {
            abort(403, 'AKSES DITOLAK'); // Tampilkan halaman larangan akses
        }

          $jamMulai = \Carbon\Carbon::parse($booking->jam_mulai);
    $jamSelesai = \Carbon\Carbon::parse($booking->jam_selesai);

    // Jika jam selesai lebih kecil dari jam mulai (lewat tengah malam)
    if ($jamSelesai->lt($jamMulai)) {
        $jamSelesai->addDay(); // Tambah 1 hari ke jam selesai
    }

    $durasiMenit = $jamSelesai->diffInMinutes($jamMulai);
    $durasiJam = round($durasiMenit / 60, 2); // Bulatkan ke 2 desimal
    
    // 2. Ambil harga per jam
    $hargaPerJam = $booking->lapangan->harga_per_jam;

    // 3. Hitung subtotal
    $subtotal = $durasiJam * $hargaPerJam;

    // 4. Tentukan biaya lainnya
    $biayaAdmin = 2500;
    $persenPPN = 11; // 11%

    // 5. Hitung PPN dari subtotal
    $ppn = ($subtotal * $persenPPN) / 100;

    // 6. Hitung Total Pembayaran
    $totalPembayaran = $subtotal + $biayaAdmin + $ppn;

    // --- AKHIR LOGIKA KALKULASI ---

    return view('booking.detail', [
        'booking' => $booking,
        'durasiJam' => $durasiJam,
        'subtotal' => $subtotal,
        'biayaAdmin' => $biayaAdmin,
        'ppn' => $ppn,
        'totalPembayaran' => $totalPembayaran
    ]);
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

    // Customer melihat riwayat booking miliknya
    public function index()
    {
        $bookings = ZukiraBooking::with('lapangan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('booking.index', compact('bookings'));
    }
}
