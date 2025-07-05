<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan; // Pastikan model Anda di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    /**
     * Menampilkan detail dari sebuah pemesanan.
     */
    public function show($id)
    {
        // 1. Ambil data pemesanan berdasarkan ID, beserta relasi ke user dan kendaraan.
        // Gagal jika tidak ditemukan (akan menampilkan halaman 404 Not Found).
        $pemesanan = Pemesanan::with(['user', 'kendaraan'])->findOrFail($id);

        // 2. (PENTING) Otorisasi: Pastikan user yang login hanya bisa melihat pesanannya sendiri.
        // Admin bisa dibuatkan logic terpisah jika diperlukan.
        if (Auth::id() !== $pemesanan->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        // 3. Kirim data pemesanan ke view 'pemesanan.detail'
        return view('pemesanan.detail', compact('pemesanan'));
    }
}