<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZukiraBooking extends Model
{
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function lapangan() { return $this->belongsTo(ZukiraLapangan::class); }
    public function payment() { return $this->hasOne(ZukiraPayment::class); }

}
