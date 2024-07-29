<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->aduan = new \App\Models\AduanModels();
        $this->riwayat_status = new \App\Models\RiwayatStatus();
        $this->user = new \App\Models\User();
        $this->kecamatan = new \App\Models\Kecamatan();
        $this->kelurahan = new \App\Models\Kelurahan();
    }

    public function index()
    {
        $data = [
            // hitung jumlah laporan masuk
            'jumlah_laporan_masuk'  => $this->aduan->countAllResults(),
            'jumlah_laporan_belum_direspon' => $this->aduan->where('status', null)->orWhere('status', '')->countAllResults(),
            'jumlah_laporan_selesai' => $this->aduan->where('status', 'selesai')->countAllResults(),
            'jumlah_laporan_diproses' => $this->aduan->where('status', 'diproses')->countAllResults(),
            'jumlah_laporan_tidak_valid' => $this->aduan->where('status', 'tidak_valid')->countAllResults(),
            'parameter' => 'Dashboard'
        ];
        // dd($data);
        return view('admin/content/dashboard', $data);
    }

    public function laporanMasuk()
    {

        $data = [
            'parameter' => 'Laporan Masuk',
            'lokasi'    => 'laporanmasuk',
            'data'      => $this->aduan
                ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
                ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
                ->where('status', '')
                ->orderBy('tanggal_aduan', 'DESC')->findAll(),

        ];

        // dd($data);
        return view('admin/content/laporan_masuk', $data);
    }

    public function detail($id)
    {
        $dataAduan = $this->aduan
            ->join('user', 'aduan.id_user = user.id_user')
            ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
            ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
            ->find($id);
        $data = [
            'data'      => $dataAduan,
            'parameter' => 'Laporan Masuk',
            'riwayat'   => $this->riwayat_status->where('id_tiket_aduan', $id)->findAll(),
            'identitas' => $this->user
                ->select('nama')
                ->where('id_user', $dataAduan['id_user'])->first(),
        ];
        // dd($data);
        return view('admin/content/detail', $data);
    }

    public function laporanDiproses()
    {
        $data = [
            'parameter' => 'Laporan Diproses',
            'lokasi'    => 'laporandiproses',
            'data'      => $this->aduan
                ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
                ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
                ->where('status', 'diproses')->orderBy('tanggal_aduan', 'DESC')->findAll(),
        ];
        return view('admin/content/laporan_diproses', $data);
    }

    public function laporanSelesai()
    {
        $data = [
            'parameter' => 'Laporan Selesai',
            'lokasi'    => 'laporanselesai',
            'data'      => $this->aduan
                ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
                ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
                ->where('status', 'selesai')->orderBy('tanggal_aduan', 'DESC')->findAll(),
        ];
        return view('admin/content/laporan_selesai', $data);
    }

    public function laporanTidakValid()
    {
        $data = [
            'parameter' => 'Laporan Tidak Valid',
            'lokasi'    => 'laporantidakvalid',
            'data'      => $this->aduan
                ->join('kecamatan', 'kecamatan.id_wilayah = aduan.kecamatan')
                ->join('kelurahan', 'kelurahan.id_kelurahan = aduan.desa')
                ->where('status', 'tidak_valid')->orderBy('tanggal_aduan', 'DESC')->findAll(),
        ];
        return view('admin/content/laporan_tidak_valid', $data);
    }

    public function kelolaAkun()
    {
        $data = [
            'parameter' => 'Kelola Akun',
            'lokasi'    => 'kelolaakun',
            'data'      => $this->user->where('jenis_akun', 'publik')->findAll(),
        ];
        // dd($data);
        return view('admin/content/kelola_akun', $data);
    }
}
