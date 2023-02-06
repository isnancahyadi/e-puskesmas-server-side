<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AntrianModel;
use App\Models\DokterModel;
use App\Models\PoliModel;

class Pasien extends BaseController
{
    function __construct()
    {
        helper(['restclient']);
        date_default_timezone_set('Asia/Jakarta');

        $this->antri = new AntrianModel();
        $this->dok = new DokterModel();
        $this->poli = new PoliModel();
    }

    public function index()
    {
        //
    }

    public function tampil()
    {
        $url = site_url('restapi/pasien');
        $data = [];
        $response['pasien'] = akses_restapi('GET', $url, $data);

        return view('pasien/index', (array)$response);
    }

    public function add()
    {
        return view('pasien/new');
    }

    public function store()
    {
        $validate = $this->validate([
            'nik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong!'
                ],
            ],
            'nama_depan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama depan tidak boleh kosong!'
                ],
            ],
            'jenis_kelamin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin tidak boleh kosong!'
                ],
            ],
            'tempat_lahir' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tempat lahir tidak boleh kosong!'
                ],
            ],
            'tanggal_lahir' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir tidak boleh kosong!'
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong!'
                ],
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $fileKTPForWeb = $this->request->getFile('foto_ktp_web');

        // if (!$fileKTPForWeb->isValid()) {
        //     $namaKTP = 'default.png';
        // } else {
        //     $namaKTP = 'valid';
        // }

        if (!$fileKTPForWeb->isValid()) {
            $namaKTP = 'default.jpeg';
        } else {
            $namaKTP = rand() . $this->request->getVar('nik') . ".jpeg";
            $fileKTPForWeb->move('img/ktp', $namaKTP);
        }

        $data = [
            'nik'           => $this->request->getVar('nik'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat'        => $this->request->getVar('alamat'),
            'foto_ktp_web'  => $namaKTP,
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_tengah'   => $this->request->getVar('nama_tengah'),
            'nama_belakang' => $this->request->getVar('nama_belakang')
        ];

        // $data = $this->request->getPost();

        $url = site_url('restapi/pasien');
        akses_restapi('POST', $url, $data);

        // dd($namaKTP);

        return redirect()->to(site_url('pasien/tampil'))->with('success', 'Data Berhasil Disimpan');
    }

    public function pemeriksaan()
    {
        $data['dok'] = $this->dok->getAll();
        $data['poli'] = $this->poli->getAll();

        return view('pasien/pemeriksaan', $data);
    }
}
