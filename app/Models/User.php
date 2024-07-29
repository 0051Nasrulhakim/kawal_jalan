<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = 
    [
        'id_user',
        'username',
        'password',
        'status_akun',
        'jenis_akun',
        // 'nama_depan',
        // 'nama_belakang',
        'nama',
        'nik',
        'tempat_tinggal',
        'nomor_hp',
        'email',
        'foto_profile'
    ];
}
