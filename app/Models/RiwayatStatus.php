<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatStatus extends Model
{
    protected $table            = 'riwayat_status';
    protected $primaryKey       = 'id_riwayat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = 
    [
        'id_riwyat',
        'id_tiket_aduan',
        'status',
        'keterangan',
        'bukti',
        'tanggal_diubah',
    ];

}
