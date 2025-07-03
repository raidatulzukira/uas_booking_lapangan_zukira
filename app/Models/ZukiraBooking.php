<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZukiraBooking extends Model
{
    public function user() { return $this->belongsTo(User::class); }
    public function lapangan() { return $this->belongsTo(ZukiraLapangan::class); }
    public function payment() { return $this->hasOne(ZukiraPayment::class); }

}
