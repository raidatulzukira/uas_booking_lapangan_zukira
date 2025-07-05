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
    // app/Models/ZukiraBooking.php
protected $fillable = [
    'user_id',
    'zukira_lapangan_id',
    'waktu_mulai',
    'waktu_selesai',
    'total_harga',
    'status', // <-- TAMBAHKAN INI
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