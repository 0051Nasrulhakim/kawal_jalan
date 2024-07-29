<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelurahan extends Model
{
    protected $table            = 'kelurahan';
    protected $primaryKey       = 'id_kelurahan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    =
    [
        'id_kelurahan',
        'id_wilayah',
        'nama_kelurahan',
    ];
}
