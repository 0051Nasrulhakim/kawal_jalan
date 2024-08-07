<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $register = [
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama harus diisi',
            ]
        ],
        'nik' => [
            'rules' => 'required|is_unique[user.nik]|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'NIK harus diisi',
                'is_unique' => 'NIK sudah terdaftar',
                'min_length' => 'NIK minimal 16 karakter',
                'max_length' => 'NIK maksimal 16 karakter',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[user.email]',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
                'is_unique' => 'Email sudah terdaftar',
            ]
        ],
        'username' => [
            'rules' => 'required|is_unique[user.username]|min_length[5]|max_length[20]',
            'errors' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username minimal 5 karakter',
                'max_length' => 'Username maksimal 20 karakter',
                'is_unique' => 'Username sudah terdaftar',
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[5]|max_length[20]',
            'errors' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 5 karakter',
                'max_length' => 'Password maksimal 20 karakter',
            ]
        ]
    ];

    public $insert_aduan_validate = [
        'kecamatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kecamatan harus diisi',
            ]
        ],
        'desa'      => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Desa harus diisi',
            ]
        ],
        'detail_lokasi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Detail Lokasi harus diisi',
            ]
        ],
        'lat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Silahkan Pilih Lokasi',
            ]
        ],
        'lon' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Silahkan Pilih Lokasi',
            ]
        ],
        'identitas' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Silahkan Pilih Apakah Anda Ingin Menyembunyikan Identitas',
            ]
        ],
        // 'flexRadioDefault-tkp' => [
        //     'rules' => 'required',
        //     'errors' => [
        //         'required' => 'Silahkan Pilih Apakah Anda Di TKP',
        //     ]
        // ],
        

    ];

    public $ubahProfile = [
        'username' => [
            'rules' => 'required|min_length[5]|max_length[20]',
            'errors' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username minimal 5 karakter',
                'max_length' => 'Username maksimal 20 karakter',
            ]
        ],
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama harus diisi',
            ]
        ],
        'nik' => [
            'rules' => 'required|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'NIK harus diisi',
                'min_length' => 'NIK minimal 16 karakter',
                'max_length' => 'NIK maksimal 16 karakter',
            ]
        ],
        'tempat_tinggal' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Tinggal harus diisi',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
            ]
        ],
    ];
    public $ubahProfilePassword = [
        'username' => [
            'rules' => 'required|min_length[5]|max_length[20]',
            'errors' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username minimal 5 karakter',
                'max_length' => 'Username maksimal 20 karakter',
            ]
        ],
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama harus diisi',
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[5]|max_length[20]',
            'errors' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 5 karakter',
                'max_length' => 'Password maksimal 20 karakter',
            ]
        ],
        'nik' => [
            'rules' => 'required|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'NIK harus diisi',
                'min_length' => 'NIK minimal 16 karakter',
                'max_length' => 'NIK maksimal 16 karakter',
            ]
        ],
        'tempat_tinggal' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Tinggal harus diisi',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid',
            ]
        ],
    ];
}
