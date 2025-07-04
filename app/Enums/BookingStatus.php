<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case DIKONFIRMASI = 'dikonfirmasi';
    case DITOLAK = 'ditolak';
}