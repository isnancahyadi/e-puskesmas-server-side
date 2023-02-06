<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pemeriksaan extends BaseController
{
    function __construct()
    {
        helper(['restclient']);
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        //
    }

    public function store()
    {
        $validate = $this->validate([
            'hari' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hari tidak boleh kosong!'
                ],
            ],
            'tanggal' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal tidak boleh kosong!'
                ],
            ],
            'nik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong!'
                ],
            ],
            'ID_poli' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Poli tidak boleh kosong!'
                ],
            ],
            'sip' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Dokter tidak boleh kosong!'
                ],
            ],
            'keluhan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Keluhan tidak boleh kosong!'
                ],
            ],
            'diagnosis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Diagnosis tidak boleh kosong!'
                ],
            ],
            'obat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Resep obat tidak boleh kosong!'
                ],
            ],
            'catatan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Catatan tidak boleh kosong!'
                ],
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $data = $this->request->getPost();
        // dd($data);
        $url = site_url('restapi/pemeriksaan');
        akses_restapi('POST', $url, $data);

        return redirect()->to(site_url('pemeriksaan/riwayat'))->with('success', 'Data Berhasil Disimpan');
    }

    public function riwayat()
    {
        $data = [];
        $url = site_url('restapi/pemeriksaan');
        $response['riwayat'] = akses_restapi('GET', $url, $data);

        return view('pasien/riwayat', (array)$response);
    }
}
