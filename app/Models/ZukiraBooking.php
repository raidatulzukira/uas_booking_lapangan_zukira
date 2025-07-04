<?php

namespace App\Models;

use App\Enums\BookingStatus; // <-- Impor Enum dari lokasi yang benar
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZukiraBooking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => BookingStatus::class, // <-- Mengubah status menjadi objek Enum
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function lapangan() { return $this->belongsTo(ZukiraLapangan::class); }
    public function payment() { return $this->hasOne(ZukiraPayment::class); }
}