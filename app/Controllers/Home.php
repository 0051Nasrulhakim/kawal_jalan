<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->aduan = new \App\Models\AduanModels();
        $this->user = new \App\Models\User();
        $this->kelurahan = new \App\Models\Kelurahan();
        $this->kecamatan = new \App\Models\Kecamatan();
        $this->validation = \Config\Services::validation();
        // $pager = \Config\Services::pager();
    }

    public function dashboard()
    {
        $data = [
            'kecamatan' => $this->kecamatan->findAll(),
        ];
        return view('publik/page/dashboard', $data);
    }

    public function getKelurahan($id_wilayah){
        $kelurahan = $this->kelurahan->where('id_wilayah', $id_wilayah)->findAll();

        response()->setJSON($kelurahan);
        return response();
    }
    
    public function index()
    {
        return view('publik/page/landing_page');
    }
    public function aduan()
    {
        $perPage = 5;


        $data = [
            'params' => 'aduan',
            'profile'        => $this->user->where('id_user', session()->get('id_user'))->first(),
            'aduan'          => $this->aduan
                                ->join('user', 'aduan.id_user = user.id_user')
                                ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
                                ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
                                ->orderBy('tanggal_aduan', 'DESC')
                                ->paginate($perPage, 'aduan'),
            'jml_aduan_saya' => $this->aduan->where('id_user', session()->get('id_user'))->countAllResults(),
            'jml_aduan_saya_diproses' => $this->aduan->where('id_user', session()->get('id_user'))->where('status', 'diproses')->countAllResults(),
            'jml_aduan_saya_selesai' => $this->aduan->where('id_user', session()->get('id_user'))->where('status', 'selesai')->countAllResults(),
        ];
        // dd($data);
        $pager = $this->aduan->pager;
        $data['pager'] = $pager;

        return view('publik/page/aduan', $data);
    }

    public function aduanSaya()
    {
        $perPage = 5;

        $data = [
            'profile'        => $this->user->where('id_user', session()->get('id_user'))->first(),
            'data'           => $this->aduan
                                ->join('user', 'aduan.id_user = user.id_user')
                                ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
                                ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
                                ->where('aduan.id_user', session()->get('id_user'))
                                ->orderBy('tanggal_aduan', 'DESC')
                                ->paginate($perPage, 'aduan'),
            'params'         => 'aduan-saya',
            'jml_aduan_saya' => $this->aduan->where('id_user', session()->get('id_user'))->countAllResults(),
            'jml_aduan_saya_diproses' => $this->aduan->where('id_user', session()->get('id_user'))->where('status', 'diproses')->countAllResults(),
            'jml_aduan_saya_selesai' => $this->aduan->where('id_user', session()->get('id_user'))->where('status', 'selesai')->countAllResults(),
        ];

        $pager = $this->aduan->pager;
        $data['pager'] = $pager;
        // dd($data);

        return view('publik/page/aduan-saya', $data);
    }

    public function profile()
    {

        $data = [
            'params' => 'profile',
            'data'   => $this->user->where('id_user', session()->get('id_user'))->first(),
        ];
        // dd($data);
        return view('publik/page/profile', $data);
    }

    public function updateProfile()
    {
        $res;

        $data = [
            'id_user'   => session()->get('id_user'),
            'username'  => $this->request->getPost('username'),
            'password'  => $this->request->getPost('password'),
            'nama'      => $this->request->getPost('nama'),
            'nik'       => $this->request->getPost('nik'),
            'tempat_tinggal' => $this->request->getPost('tempat_tinggal'),
            'email'     => $this->request->getPost('email'),
        ];

        $isDataValid = $this->user->find('username', $data['username']);

        if ($isDataValid == null || $isDataValid['id_user'] == $data['id_user']) {
            $isDataValid = 'ok';
        } else {
            $isDataValid = 'tidak';
        }

        if ($data['password'] == null && $isDataValid == 'ok') {

            $this->validation->run($data, 'ubahProfile');
            $errors = $this->validation->getErrors();

            if ($errors) {

                $res = [
                    'status' => 'error',
                    'errors' => $errors,
                ];
            } else {

                $this->user->update(
                    $data['id_user'],
                    [
                        'username' => $data['username'],
                        'nama'     => $data['nama'],
                        'nik'      => $data['nik'],
                        'tempat_tinggal' => $data['tempat_tinggal'],
                        'email'    => $data['email'],
                    ]
                );

                $res = [
                    'status' => 'sucess',
                    'data'   => 'Berhasil Merubah Profile',
                ];
            }
        } else if ($data['password'] !== null && $isDataValid == 'ok') {

            $this->validation->run($data, 'ubahProfilePassword');
            $errors = $this->validation->getErrors();

            if ($errors) {

                $res = [
                    'status' => 'error',
                    'errors' => $errors,
                ];
            } else {

                $this->user->update(
                    $data['id_user'],

                    [
                        'username' => $data['username'],
                        'nama'     => $data['nama'],
                        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                        'nik'      => $data['nik'],
                        'tempat_tinggal' => $data['tempat_tinggal'],
                        'email'    => $data['email'],
                    ]
                );

                $res = [
                    'status' => 'sucess',
                    'data'   => 'Berhasil Merubah Profile',
                ];
            }
        } else {

            $res = [
                'status' => 'error',
                'data'   => 'USERNAME TELAH DIPAKAI ORANG LAIN',
            ];
        }

        response()->setJSON($res);
        return response();
    }
    public function ubahFoto()
    {
        $res;
        $image =  $this->request->getFile('fp');
        if ($image !== null) {

            if ($image->isValid() && !$image->hasMoved()) {
                // Generate new file name
                $newName = $image->getRandomName();
                // Move uploaded file to a directory
                $image->move(ROOTPATH . 'public/assets/profile', $newName);

                $this->user->update(
                    session()->get('id_user'),
                    [
                        'foto_profile' => $newName,
                    ]
                );

                $res = [
                    'status' => 'success',
                    'data'   => 'Berhasil Mengubah Foto',
                ];

            } else {
                $res = [
                    'status' => 'error',
                    'data'   => 'Silahkan Upload Gambar',
                ];
            }
        } else {
            $res = [
                'status' => 'error',
                'data'   => 'Silahkan Upload Gambar',
            ];
        }

        response()->setJSON($res);
        return response();
    }
}
