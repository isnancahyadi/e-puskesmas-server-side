<?php

namespace App\Controllers\Restapi;

use App\Models\BpjsModel;
use CodeIgniter\RESTful\ResourceController;

class Bpjs extends ResourceController
{
    function __construct()
    {
        $this->bpjs = new BpjsModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->bpjs->getSpecified($id);
        return $this->respond($data);
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
        $fileBpjs = $this->request->getPost('foto_bpjs');
        $fileBpjsForWeb = $this->request->getVar('foto_bpjs_web');

        if ($fileBpjsForWeb) {
            $namaBpjs = $fileBpjsForWeb;
        } else {
            $namaBpjs = rand() . $this->request->getVar('nik') . ".jpeg";
            file_put_contents("img/bpjs/" . $namaBpjs, base64_decode($fileBpjs));
        }

        $dataBpjs = [
            'ID_bpjs'               => $this->request->getVar('ID_bpjs'),
            'nik'                   => $this->request->getVar('nik'),
            'tingkat_faskes'        => $this->request->getVar('tingkat_faskes'),
            'nama_tingkat_faskes'   => $this->request->getVar('nama_tingkat_faskes'),
            'foto_bpjs'             => $namaBpjs
        ];

        $this->bpjs->insert($dataBpjs);

        if ($this->bpjs->affectedRows() > 0) {
            return $this->respondCreated('Data berhasil tersimpan');
        } else {
            return $this->fail($this->bpjs->errors());
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
