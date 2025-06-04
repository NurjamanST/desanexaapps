<?php

namespace App\Enums;

enum UserRole : string
{
    case Adminapps = 'adminapps';
    case Kepdesa = 'kepdesa';
    case Staffdesa = 'staffdesa';
    case Rukunwarga = 'rukunwarga';
    case Penduduk = 'penduduk';
}
