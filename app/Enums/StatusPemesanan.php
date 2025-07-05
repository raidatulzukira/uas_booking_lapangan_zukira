<?php

namespace App\Enums;

enum StatusPemesanan: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case DITOLAK = 'ditolak';
}