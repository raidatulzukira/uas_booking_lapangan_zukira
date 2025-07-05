<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZukiraBooking;
use App\Models\ZukiraLapangan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    
    public function index()
    {
        // PERBAIKAN: Menggunakan nama relasi 'lapangan' yang baru dan lebih standar.
        $bookings = ZukiraBooking::with('lapangan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('booking.index', compact('bookings'));
    }

    /**
     * Menampilkan semua booking untuk dilihat oleh Admin.
     */
    public function adminIndex()
    {
        // PERBAIKAN: Menggunakan nama relasi 'lapangan' yang baru.
        $bookings = ZukiraBooking::with(['user', 'lapangan'])->latest()->get();
        return view('booking.index_admin', compact('bookings'));
    }

    /**
     * Menampilkan form untuk membuat booking baru.
     */
    public function create(Request $request)
    {
        $lapangan = ZukiraLapangan::findOrFail($request->lapangan_id);
        return view('booking.create', compact('lapangan'));
    }

    /**
     * Menyimpan booking baru ke database.
     */
    public function store(Request $request)
    {
        // --- PERBAIKAN VALIDASI ---
        // Menambahkan validasi format jam untuk memastikan data selalu benar.
        $request->validate([
            'lapangan_id' => 'required|exists:zukira_lapangans,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i', // Memastikan format jam adalah HH:MM (e.g., 20:00)
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Memastikan format benar & setelah jam mulai
        ]);
        
        // Kode pembuatan booking ini sudah benar dan tidak perlu diubah.
        $newBooking = ZukiraBooking::create([
            'user_id' => Auth::id(),
            'lapangan_id' => $request->lapangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => Carbon::parse($request->tanggal . ' ' . $request->jam_mulai),
            'jam_selesai' => Carbon::parse($request->tanggal . ' ' . $request->jam_selesai),
            'status' => 'pending',
        ]);

        // Redirect ini juga sudah benar.
        return redirect()->route('booking.detail', ['id' => $newBooking->id])
                         ->with('success', 'Booking berhasil dibuat! Mohon tunggu konfirmasi admin.');
    }

    
    public function detail($id)
    {
        // Controller hanya perlu mengambil data. Semua perhitungan ada di Model.
        $booking = ZukiraBooking::with(['user', 'lapangan'])->findOrFail($id);

        // Langsung kirim object $booking ke view.
        return view('booking.detail', [
            'booking' => $booking,
        ]);
    }

    
    /**
     * Mengubah status booking menjadi 'dikonfirmasi' oleh Admin.
     */
    public function konfirmasi($id)
    {
        $booking = ZukiraBooking::findOrFail($id);
        $booking->update(['status' => 'dikonfirmasi']);
        return back()->with('success', 'Booking telah dikonfirmasi.');
    }
}
