<?php

namespace App\Controllers\Restapi;

use App\Models\JadwalDokterModel;
use CodeIgniter\RESTful\ResourceController;

class JadwalDokter extends ResourceController
{
    function __construct()
    {
        $this->jadwalDok = new JadwalDokterModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->jadwalDok->getAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->jadwalDok->getSpecified($id);
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
        $data = $this->request->getPost();

        $this->jadwalDok->insert($data);

        if ($this->jadwalDok->affectedRows() > 0) {
            return $this->respondCreated('Data berhasil disimpan');
        } else {
            return $this->fail($this->jadwalDok->errors());
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
