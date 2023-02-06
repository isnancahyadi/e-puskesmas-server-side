<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokterModel;
use App\Models\PoliModel;
use CodeIgniter\API\ResponseTrait;

class JadwalDokter extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        helper(['restclient']);
        date_default_timezone_set('Asia/Jakarta');

        $this->dok = new DokterModel();
        $this->poli = new PoliModel();
    }

    public function index()
    {
        //
    }

    public function tampil()
    {
        $url = site_url('restapi/jadwaldokter');
        $data = [];
        $response['jadwal_dokter'] = akses_restapi('GET', $url, $data);

        return view('dokter/jadwal/index', (array)$response);
    }

    public function add()
    {
        $data['dok'] = $this->dok->getAll();
        $data['poli'] = $this->poli->getAll();
        // dd($data);

        return view('dokter/jadwal/new', $data);
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
            'ID_poli' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Poli tidak boleh kosong!'
                ],
            ],
            'hari' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hari tidak boleh kosong!'
                ],
            ],
            'jam' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jam tidak boleh kosong!'
                ],
            ]
        ]);

        if (!$validate) {
            return redirect()->back()->withInput();
        }

        $old_time_timestamp = strtotime($this->request->getVar('jam'));
        $new_time = date('H:i:s', $old_time_timestamp);

        $data = [
            'sip' => $this->request->getVar('sip'),
            'ID_poli' => $this->request->getVar('ID_poli'),
            'hari' => $this->request->getVar('hari'),
            'jam' => $new_time
        ];

        $url = site_url('restapi/jadwaldokter');
        akses_restapi('POST', $url, $data);

        return redirect()->to(site_url('jadwaldokter/tampil'))->with('success', 'Data Berhasil Disimpan');
    }
}
