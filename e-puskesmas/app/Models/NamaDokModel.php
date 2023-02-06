<?php

namespace App\Models;

use CodeIgniter\Model;

class NamaDokModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'ca_nama_dokter';
    protected $primaryKey       = 'sip';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['sip', 'gelar_depan', 'nama_depan', 'nama_tengah', 'nama_belakang', 'gelar_belakang'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'sip'           => 'required',
        'nama_depan'    => 'required'
    ];
    protected $validationMessages   = [
        'sip'           => ['required' => 'SIP harus diisi'],
        'nama_depan'    => ['required' => 'Nama depan harus diisi']
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
}
