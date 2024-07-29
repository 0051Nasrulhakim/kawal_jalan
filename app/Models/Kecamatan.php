<?php

namespace App\Models;

use CodeIgniter\Model;

class Kecamatan extends Model
{
    protected $table            = 'kecamatan';
    protected $primaryKey       = 'id_wilayah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    =
    [
        'id_wilayah',
        'nama_kecamatan',
    ];
}
