<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZukiraLapangan extends Model
{
    protected $fillable = ['foto', 'nama', 'tipe', 'lokasi', 'harga','status'];
}