<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->user = new \App\Models\User();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('login/login');
    }

    public function adminIndex()
    {
        return view('login/adminIndex');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $cek = $this->user->where('username', $username)->where('jenis_akun', 'publik')->first();

        if($cek){

            if($cek['status_akun'] == 'aktiv'){

                if(password_verify($password, $cek['password'])){
                    $data = [
                        'id_user'       => $cek['id_user'],
                        'username'      => $cek['username'],
                        'password'      => $cek['password'],
                        'logged_in'     => TRUE,
                        'nama'          => $cek['nama'],
                        'nik'           => $cek['nik'],
                        'foto_profile'  => $cek['foto_profile'],
                        'hakAkses'      => 'publik'
                    ];

                    $this->session->set($data);
                    $res = [
                        'status' => 'success',
                        'message' => 'Login Berhasil',
                        'data' => $data
                    ];
                    response()->setJSON($res);
                    return response();

                }else{

                    $res = [
                        'status' => 'error',
                        'password' => 'Password Salah'
                    ];
                    response()->setJSON($res);
                    return response();
                }

            }else if($cek['status_akun'] == 'belum_aktiv'){
                $res = [
                    'status' => '301',
                    'data' => 'Akun anda belum aktiv menunggu aktivasi dari admin'
                ];
                response()->setJSON($res);
                return response();
            }else{ 
                $res = [
                    'status' => '301',
                    'data' => 'Akun Anda Tidak Aktiv'
                ];
                response()->setJSON($res);
                return response();

            }

        }else{
            $res = [
                'status' => 'error',
                'username' => 'Username Tidak Ditemukan'
            ];
            response()->setJSON($res);
            return response();
        }
    }
    
    public function loginAdmin()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $cek = $this->user->where('username', $username)->where('jenis_akun', 'admin')->first();

        if($cek){

            if($cek['status_akun'] == 'aktiv'){

                if(password_verify($password, $cek['password'])){
                    $data = [
                        'id_user'       => $cek['id_user'],
                        'username'      => $cek['username'],
                        'password'      => $cek['password'],
                        'logged_in'     => TRUE,
                        'nama'          => $cek['nama'],
                        'nik'           => $cek['nik'],
                        'hakAkses'      => 'admin'
                    ];

                    $this->session->set($data);
                    $res = [
                        'status' => 'success',
                        'message' => 'Login Berhasil',
                        'data' => $data
                    ];
                    response()->setJSON($res);
                    return response();

                }else{

                    $res = [
                        'status' => 'error',
                        'password' => 'Password Salah'
                    ];
                    response()->setJSON($res);
                    return response();
                }

            }else{ 

                $res = [
                    'status' => 'akun tidak aktiv',
                    'data' => 'Akun Anda Tidak Aktiv'
                ];
                response()->setJSON($res);
                return response();

            }

        }else{
            $res = [
                'status' => 'error',
                'username' => 'Username Tidak Ditemukan'
            ];
            response()->setJSON($res);
            return response();
        }
    }

    public function register()
    {
        $nama           = $this->request->getPost('nama_register');
        $nik            = $this->request->getPost('nik_register');
        $email          = $this->request->getPost('email_register');
        $username       = $this->request->getPost('username_register');
        $password       = $this->request->getPost('password_register');

        $data = [
            'nama'          => $nama,
            'nik'           => $nik,
            'email'         => $email,
            'username'      => $username,
            'password'      => $password
        ];

        $this->validation->run($data, 'register');
        $errors = $this->validation->getErrors();
        if($errors){
            $res = [
                'status' => 'error',
                'errors' => $errors
            ];
        }else{
            $res = [
                'status' => 'success',
                'message' => 'Registrasi Berhasil Silahkan Login',
                'data' => $data
            ];
            $data = [
                'nama'          => $nama,
                'nik'           => $nik,
                'email'         => $email,
                'username'      => $username,
                'status_akun'   => 'aktiv',
                'jenis_akun'    => 'publik',
                'password'      => password_hash($password, PASSWORD_DEFAULT),
    
            ];
            $this->user->insert($data); 
        }

        response()->setJSON($res);
        return response();
    }

    public function logOut()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
