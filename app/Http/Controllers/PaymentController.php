<?php

namespace App\Http\Controllers;

use App\Models\ZukiraBooking;
use Illuminate\Http\Request;
use App\Models\ZukiraPayment;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran.
     * Menggunakan Route Model Binding untuk otomatis mencari booking.
     */
    public function show(ZukiraBooking $booking)
    {
        // Otorisasi: Pastikan hanya pemilik booking yang bisa melihat.
        // $this->authorize('view', $booking);

        return view('payment.index', [
            'booking' => $booking,
            'payment' => $booking->payment // Mengambil payment lewat relasi
        ]);
    }

    /**
     * Mengunggah bukti transfer.
     * Menggunakan Route Model Binding dan kode yang lebih bersih.
     */
    public function upload(Request $request, ZukiraBooking $booking)
    {
        // Otorisasi: Pastikan hanya pemilik booking yang bisa upload.
        // $this->authorize('update', $booking);

        $request->validate([
            // Pastikan nama tabel di 'exists' sudah benar (contoh: zukira_bookings)
            'booking_id' => 'required|exists:zukira_bookings,id',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric',
        ]);

        try {
            $file = $request->file('bukti_transfer');
            $fileName = 'bukti_transfer_' . $booking->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('bukti_transfer', $fileName, 'public');

            // Hapus file lama jika ada, diambil dari relasi.
            if ($booking->payment?->bukti_transfer) {
                Storage::disk('public')->delete($booking->payment->bukti_transfer);
            }

            // Gunakan updateOrCreate untuk menyederhanakan logika if/else.
            // Metode ini akan meng-update jika ada, atau membuat baru jika tidak ada.
            $payment = ZukiraPayment::updateOrCreate(
                ['booking_id' => $booking->id], // Kondisi pencarian
                [
                    'harga' => $request->harga,
                    'bukti_transfer' => $filePath,
                    'status_verifikasi' => 'pending', // Otomatis set ke pending
                ]
            );
            
            return response()->json([
                'status' => 'success',
                'message' => 'Bukti pembayaran berhasil dikirim!',
                'payment_id' => $payment->id
            ]);
            
        } catch (\Exception $e) {
            // Jika terjadi error, hapus file yang baru saja diupload agar tidak menjadi sampah.
            if (isset($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim bukti pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memeriksa status pembayaran.
     */
    public function checkStatus(ZukiraBooking $booking)
    {
        // $this->authorize('view', $booking);

        $payment = $booking->payment; // Mengambil dari relasi, lebih efisien
        
        if (!$payment) {
            return response()->json(['status' => 'not_found', 'message' => 'Belum ada pembayaran.']);
        }
        
        return response()->json([
            'status' => $payment->status_verifikasi,
            'message' => $this->getStatusMessage($payment->status_verifikasi),
        ]);
    }

    /**
     * Mendapatkan pesan status yang user-friendly.
     */
    private function getStatusMessage(string $status): string
    {
        return match($status) {
            'pending' => 'Pembayaran Anda sedang dalam proses verifikasi.',
            'approved' => 'Pembayaran Anda telah diverifikasi dan disetujui.',
            'rejected' => 'Pembayaran Anda ditolak. Silakan hubungi customer service.',
            default => 'Status pembayaran tidak diketahui.'
        };
    }
}