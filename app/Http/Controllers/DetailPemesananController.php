<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Pastikan nama model Anda adalah Booking
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetailPemesananController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // 1. Ambil data booking, beserta data User dan Lapangan terkait
        $booking = Booking::with(['user', 'lapangan'])->findOrFail($id);

        // 2. Hitung durasi sewa dalam jam
        $waktuMulai = Carbon::parse($booking->waktu_mulai);
        $waktuSelesai = Carbon::parse($booking->waktu_selesai);
        $durasiJam = $waktuSelesai->diffInHours($waktuMulai);

        // 3. Hitung rincian pembayaran berdasarkan data dari lapangan
        $hargaSewaPerJam = $booking->lapangan->harga_sewa; // Pastikan nama kolom 'harga_sewa'
        $subtotalSewa = $durasiJam * $hargaSewaPerJam;
        $biayaAdmin = 2500;
        $ppn = $subtotalSewa * 0.11;
        $totalPembayaran = $subtotalSewa + $biayaAdmin + $ppn;

        // Siapkan dalam bentuk array agar rapi
        $pembayaran = [
            'subtotal' => $subtotalSewa,
            'admin' => $biayaAdmin,
            'ppn' => $ppn,
            'total' => $totalPembayaran,
        ];

        // 4. Kirim semua data ke view 'detail-pemesanan'
        return view('detail-pemesanan', [
            'booking' => $booking,
            'durasi' => $durasiJam,
            'pembayaran' => $pembayaran,
        ]);
    }
}