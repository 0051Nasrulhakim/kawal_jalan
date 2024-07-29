<?php

namespace App\Models;

use CodeIgniter\Model;

class AduanModels extends Model
{
    protected $table            = 'aduan';
    protected $primaryKey       = 'id_tiket_aduan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    =
    [
        'id_tiket_aduan',
        'id_user',
        'kecamatan',
        'desa',
        'detail_lokasi',
        'gambar',
        'tanggal_aduan',
        'lat',
        'lon',
        'is_anonymous',
        'is_in_location',
        'status'
    ];
}
