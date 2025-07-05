<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZukiraBooking;
use App\Models\ZukiraLapangan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan riwayat booking milik customer yang sedang login.
     */
    public function index()
    {
        $bookings = ZukiraBooking::with('zukiraLapangan') // Perbaikan: Menggunakan nama relasi yang benar
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
        $bookings = ZukiraBooking::with(['user', 'zukiraLapangan'])->latest()->get(); // Perbaikan: Menggunakan nama relasi yang benar
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
        $request->validate([
            'lapangan_id' => 'required|exists:zukira_lapangans,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        
        // Di sini terjadi error karena nama kolom di form dan di create berbeda
        // Seharusnya 'lapangan_id' menjadi 'zukira_lapangan_id' saat disimpan
        $newBooking = ZukiraBooking::create([
            'user_id' => Auth::id(),
            'zukira_lapangan_id' => $request->lapangan_id, // Perbaikan: Sesuaikan nama kolom
            'waktu_mulai' => Carbon::parse($request->tanggal . ' ' . $request->jam_mulai), // Digabung menjadi datetime
            'waktu_selesai' => Carbon::parse($request->tanggal . ' ' . $request->jam_selesai), // Digabung menjadi datetime
            'status' => 'pending',
        ]);

        // Perbaikan: Redirect ke rute 'booking.detail' yang benar
        return redirect()->route('booking.detail', ['id' => $newBooking->id])
                         ->with('success', 'Booking berhasil dibuat! Mohon tunggu konfirmasi admin.');
    }

    /**
     * Menampilkan halaman detail dari sebuah booking.
     * Nama method ini 'detail' agar sesuai dengan routes/web.php
     */
    public function detail($id)
    {
        // Memuat relasi 'user' dan 'zukiraLapangan' dengan benar
        $booking = ZukiraBooking::with(['user', 'zukiraLapangan'])->findOrFail($id);

        // Menghitung durasi sewa
        $waktuMulai = Carbon::parse($booking->waktu_mulai);
        $waktuSelesai = Carbon::parse($booking->waktu_selesai);
        $durasiJam = $waktuSelesai->diffInHours($waktuMulai);

        // Menghitung detail pembayaran dengan aman
        $subtotalSewa = 0;
        if ($booking->zukiraLapangan) {
            $hargaSewaPerJam = $booking->zukiraLapangan->harga_sewa;
            $subtotalSewa = $durasiJam * $hargaSewaPerJam;
        }
        
        $biayaAdmin = 2500;
        $ppn = $subtotalSewa * 0.11;
        $totalPembayaran = $subtotalSewa + $biayaAdmin + $ppn;

        $pembayaran = [
            'subtotal' => $subtotalSewa,
            'admin' => $biayaAdmin,
            'ppn' => $ppn,
            'total' => $totalPembayaran,
        ];

        return view('booking.detail', [
            'booking' => $booking,
            'durasi' => $durasiJam,
            'pembayaran' => $pembayaran,
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