<?php

namespace App\Controllers\Restapi;

use App\Models\NamaPasienModel;
use App\Models\PasienModel;
use CodeIgniter\Files\File;
use CodeIgniter\RESTful\ResourceController;
use PhpParser\Node\Stmt\Echo_;

class Pasien extends ResourceController
{
    function __construct()
    {
        $this->pasien       = new PasienModel();
        $this->namaPasien   = new NamaPasienModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = $this->pasien->getAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->pasien->getSpecified($id);
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
        $fileKTP = $this->request->getPost('foto_ktp');
        $fileKTPForWeb = $this->request->getVar('foto_ktp_web');

        if ($fileKTPForWeb) {
            $namaKTP = $fileKTPForWeb;
        } else {
            $namaKTP = rand() . $this->request->getVar('nik') . ".jpeg";
            file_put_contents("img/ktp/" . $namaKTP, base64_decode($fileKTP));
        }

        $gender = $this->request->getVar('jenis_kelamin');
        if ($gender == "Pria") {
            $genderDB = "1";
        } else if ($gender == "Wanita") {
            $genderDB = "0";
        }

        $dataPasien = [
            'nik'           => $this->request->getVar('nik'),
            'jenis_kelamin' => $genderDB,
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat'        => $this->request->getVar('alamat'),
            'foto_ktp'      => $namaKTP
        ];

        $dataNamaPasien = [
            'nik'           => $this->request->getVar('nik'),
            'nama_depan'    => $this->request->getVar('nama_depan'),
            'nama_tengah'   => $this->request->getVar('nama_tengah'),
            'nama_belakang' => $this->request->getVar('nama_belakang')
        ];

        $this->pasien->insert($dataPasien);

        if ($this->pasien->affectedRows() > 0) {
            $this->namaPasien->insert($dataNamaPasien);
            if ($this->namaPasien->affectedRows() > 0) {
                return $this->respondCreated('Data berhasil tersimpan');
            } else {
                return $this->fail($this->namaPasien->errors());
            }
        } else {
            return $this->fail($this->pasien->errors());
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
