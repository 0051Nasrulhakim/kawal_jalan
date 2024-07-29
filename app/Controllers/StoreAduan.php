<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StoreAduan extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->aduan            = new \App\Models\AduanModels();
        $this->riwayat_status   = new \App\Models\RiwayatStatus();
        $this->validation         = \Config\Services::validation();
        $this->user               = new \App\Models\User();
    }

    public function insert_aduan()
    {
        $timenoew = date('ymdHis');
        $newName = '';

        $image =  $this->request->getFile('image');
        $data = [
            'kecamatan'     => $this->request->getPost('kecamatan'),
            'desa'          => $this->request->getPost('desa'),
            'detail_lokasi' => $this->request->getPost('detail_lokasi'),
            'lat'           => $this->request->getPost('lat'),
            'lon'           => $this->request->getPost('lon'),
            'identitas'     => $this->request->getPost('identitas'),
            'flexRadioDefault-tkp' => $this->request->getPost('flexRadioDefault-tkp'),
        ];

        $this->validation->run($data, 'insert_aduan_validate');
        $errors = $this->validation->getErrors();
    
        if($errors){

            if ($image == null || $image->getError() == 4) {
                $errors['image'] = 'Silahkan Pilih Gambar';
            }

            $res = [
                'status' => 'error',
                'errors' => $errors,
            ];
        }else{

            if ($image !== null) {

                if ($image->isValid() && !$image->hasMoved()) {
                    // Generate new file name
                    $newName = $image->getRandomName();
    
                    // Move uploaded file to a directory
                    $image->move(ROOTPATH . 'public/gambar', $newName);
                }else{
                    $newName = 'default.png';
                }

                $save = [
                    'kecamatan'     => $data['kecamatan'],
                    'desa'          => $data['desa'],
                    'detail_lokasi' => $data['detail_lokasi'],
                    'lat'           => $data['lat'],
                    'lon'           => $data['lon'],
                    'is_anonymous'  => $data['identitas'],
                    'gambar'        => $newName,
                    // 'is_in_location'=> $data['flexRadioDefault-tkp'],
                    'is_in_location'=> true,
                    'id_user'       => session()->get('id_user'),
                    'status'        => '',
                    'tanggal_aduan' => date('Y-m-d H:i:s'),
                    'id_tiket_aduan'  => 'T' . $timenoew,
                ];
        
                $this->aduan->insert($save);
                $res = [
                    'status' => 'success',
                    'message' => 'Berhasil Membuat Aduan',
                    // 'data' => $data
                ];

            }else{
                $res = [
                    'status' => 'error',
                    'message' => 'Silahkan Upload Gambar',
                ];
            }

        }
        
        response()->setJSON($res);
        return response();
    }

    public function get_all_aduan()
    {
    }

    public function ubahStatus()
    {
        $newName = '';

        $data = [
            'id_tiket_aduan'    => $this->request->getPost('id_tiket_aduan'),
            'status'            => $this->request->getPost('status'),
            'keterangan'        => $this->request->getPost('keterangan'),

        ];

        if ($data['status'] == 'selesai') {
            $image =  $this->request->getFile('bukti');
            if ($image !== null) {
                if ($image->isValid() && !$image->hasMoved()) {
                    // Generate new file name
                    $newName = $image->getRandomName();
                    // Move uploaded file to a directory
                    $image->move(ROOTPATH . 'public/gambar', $newName);
                }
            }
        }

        $this->aduan->update($data['id_tiket_aduan'], [
            'status' => $data['status'],
        ]);

        $this->riwayat_status->insert([
            'id_tiket_aduan' => $data['id_tiket_aduan'],
            'status'         => $data['status'],
            'keterangan'     => $data['keterangan'],
            'bukti'          => $newName,
            'tanggal_diubah' => date('Y-m-d H:i:s'),
        ]);

        $res = [
            'status' => 'success',
            'message' => 'Berhasil Mengubah Status Aduan',
            // 'data' => $data
        ];

        response()->setJSON($res);
        return response();
    }

    public function findGambar()
    {
        $id_tiket_aduan = $this->request->getPost('id_tiket_aduan');

        $data = $this->riwayat_status->where('status', 'selesai')->where('id_tiket_aduan', $id_tiket_aduan)->first();

        if($data != null || $data['bukti'] != null){
            $res = [
                'status' => 'success',
                'gambar' => $data['bukti'],
                
            ];
        }else{
            $res = [
                'status' => 'failed',
            ];
        }

        response()->setJSON($res);
        return response();
    }

    public function ubahStatusAkun()
    {
        $data = [
            'status_akun' => $this->request->getPost('status'),
            'id_user' => $this->request->getPost('id_akun')
        ];

        $this->user->update($data['id_user'], [
            'status_akun' => $this->request->getPost('status'),
        ]);

        $res = [
            'status' => 'success',
            'message' => 'Berhasil Mengubah Status Akun',
            'data' => $data
        ];

        response()->setJSON($res);
        return response();
    }
}
