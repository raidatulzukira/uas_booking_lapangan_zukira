<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZukiraReview extends Model
{
    protected $fillable = ['user_id', 'lapangan_id', 'rating', 'komentar'];

    public function bookings()
{
    return $this->hasMany(ZukiraBooking::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
{
    return $this->belongsTo(ZukiraLapangan::class, 'lapangan_id');
}


}
