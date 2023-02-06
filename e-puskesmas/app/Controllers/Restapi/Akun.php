<?php

namespace App\Controllers\Restapi;

use App\Models\AkunModel;
use CodeIgniter\RESTful\ResourceController;

class Akun extends ResourceController
{
    function __construct()
    {
        $this->akun = new AkunModel();
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
        $post = $this->request->getPost();

        if ($post['username'] == null) {
            return $this->fail('Username tidak boleh kosong');
        } elseif ($this->akun->find($post['username'])) {
            return $this->failResourceExists('User telah tersedia');
        } else {
            $data = [
                'username' => $post['username'],
                'password' => password_hash($post['password'], PASSWORD_DEFAULT),
                'hak_akses' => '2'
            ];

            $this->akun->insert($data);

            if ($this->akun->affectedRows() > 0) {
                return $this->respondCreated('Akun berhasil dibuat');
            } else {
                return $this->fail($this->akun->errors());
            }
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
