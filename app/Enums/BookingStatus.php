<?php

namespace App\Enums;

enum BookingStatus: string
{
    case MENUNGGU = 'menunggu';
    case DITERIMA = 'diterima';
    case DITOLAK = 'ditolak';
}