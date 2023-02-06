<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'dokter';
    protected $primaryKey       = 'sip';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['sip', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'spesialis'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'sip'           => 'required',
        'jenis_kelamin' => 'required',
        'tempat_lahir'  => 'required',
        'tanggal_lahir' => 'required',
        'alamat'        => 'required',
        'spesialis'     => 'required'
    ];
    protected $validationMessages   = [
        'sip'           => ['required' => 'SIP tidak boleh kosong'],
        'jenis_kelamin' => ['required' => 'Jenis kelamin tidak boleh kosong'],
        'tempat_lahir'  => ['required' => 'Tempat lahir tidak boleh kosong'],
        'tanggal_lahir' => ['required' => 'Tanggal lahir tidak boleh kosong'],
        'alamat'        => ['required' => 'Alamat tidak boleh kosong'],
        'spesialis'     => ['required' => 'Spesialis tidak boleh kosong'],
    ];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    function getAll()
    {
        $builder = $this->db->table('dokter');
        $builder->join('ca_nama_dokter', 'ca_nama_dokter.sip = dokter.sip');

        $query = $builder->get();
        return $query->getResult();
    }
}
