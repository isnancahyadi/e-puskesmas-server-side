<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Dokter extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        helper(['restclient']);
    }

    public function index()
    {
        //
    }

    public function tampil()
    {
        $url = site_url('restapi/dokter');
        $data = [];
        $response['dokter'] = akses_restapi('GET', $url, $data);

        return view('dokter/index', (array)$response);
    }

    public function add()
    {
        return view('dokter/new');
    }

    public function store()
    {
        $validate = $this->validate([
            'sip' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'SIP tidak boleh kosong!'
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
            ],
            'spesialis' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Spesialis tidak boleh kosong!'
                ],
            ],
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $data = $this->request->getPost();
        $url = site_url('restapi/dokter');
        akses_restapi('POST', $url, $data);

        return redirect()->to(site_url('dokter/tampil'))->with('success', 'Data Berhasil Disimpan');
    }
}
