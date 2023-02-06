<?php

namespace App\Controllers\Restapi;

use App\Models\DokterModel;
use App\Models\NamaDokModel;
use CodeIgniter\RESTful\ResourceController;

class Dokter extends ResourceController
{
    function __construct()
    {
        $this->dok = new DokterModel();
        $this->namaDok = new NamaDokModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->dok->getAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $dataDok = [
            'sip'           => $this->request->getVar('sip'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat'        => $this->request->getVar('alamat'),
            'spesialis'     => $this->request->getVar('spesialis')
        ];

        $dataNamaDok = [
            'sip'               => $this->request->getVar('sip'),
            'gelar_depan'       => $this->request->getVar('gelar_depan'),
            'nama_depan'        => $this->request->getVar('nama_depan'),
            'nama_tengah'       => $this->request->getVar('nama_tengah'),
            'nama_belakang'     => $this->request->getVar('nama_belakang'),
            'gelar_belakang'    => $this->request->getVar('gelar_belakang')
        ];

        $this->dok->insert($dataDok);
        $this->namaDok->insert($dataNamaDok);

        if ($this->dok->affectedRows() > 0) {
            if ($this->namaDok->affectedRows() > 0) {
                return $this->respondCreated('Data berhasil tersimpan');
            } else {
                return $this->fail($this->namaDok->errors());
            }
        } else {
            return $this->fail($this->dok->errors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
