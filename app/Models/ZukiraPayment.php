<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZukiraPayment extends Model
{
    protected $table = 'zukira_payments';
    
    protected $fillable = [
        'booking_id',
        'harga',
        'bukti_transfer',
        'status_verifikasi',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the booking that owns the payment
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(ZukiraBooking::class, 'booking_id');
    }

    /**
     * Get bukti transfer URL
     */
    public function getBuktiTransferUrlAttribute()
    {
        return $this->bukti_transfer ? asset('storage/' . $this->bukti_transfer) : null;
    }

    /**
     * Get status badge color for Filament
     */
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status_verifikasi) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'gray'
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status_verifikasi) {
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui'
        };
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_verifikasi', $status);
    }

    /**
     * Scope for recent payments
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}