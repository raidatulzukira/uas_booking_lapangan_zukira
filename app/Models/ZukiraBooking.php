<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Models\ZukiraPayment;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ZukiraBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     * Ini memastikan atribut virtual kita selalu ada saat model diubah jadi array/JSON.
     * @var array
     */
    protected $appends = [
        'duration_in_hours', 
        'total_price', 
        'admin_fee', 
        'tax', 
        'final_total'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan(): BelongsTo
    {
        return $this->belongsTo(ZukiraLapangan::class, 'lapangan_id');
    }

    // --- LOGIKA PERHITUNGAN TERPUSAT YANG PALING AMAN ---

    public function getDurationInHoursAttribute()
    {
        if (!$this->jam_mulai || !$this->jam_selesai) {
            return 0;
        }
        
        try {
            $start = Carbon::parse($this->jam_mulai);
            $end = Carbon::parse($this->jam_selesai);
            
            // PERBAIKAN: Menggunakan abs() untuk memastikan durasi selalu positif.
            return round(abs($end->diffInMinutes($start)) / 60, 2);
        } catch (\Exception $e) {
            return 0; // Jika format waktu salah, kembalikan 0.
        }
    }

    public function getTotalPriceAttribute()
    {
        // PERBAIKAN: Memeriksa relasi 'lapangan' yang sudah di-load dari controller.
        // Ini sangat efisien karena tidak melakukan query database baru.
        if ($this->lapangan && $this->lapangan->harga > 0) {
            return $this->lapangan->harga * $this->duration_in_hours;
        }
        
        return 0; // Kembalikan 0 jika harga tidak ada.
    }

    public function getAdminFeeAttribute()
    {
        return 2500;
    }

    public function getTaxAttribute()
    {
        return $this->total_price * 0.11;
    }

    public function getFinalTotalAttribute()
    {
        return $this->total_price + $this->admin_fee + $this->tax;
    }

    public function payment()
{
    return $this->hasOne(ZukiraPayment::class, 'booking_id');
}

    
}
