<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case MENUNGGU = 'menunggu';
    case DITERIMA = 'diterima'; // <--- UBAH SEPERTI INI
    case DITOLAK = 'ditolak';
}