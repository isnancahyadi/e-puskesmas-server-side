<?php

namespace App\Models;

use CodeIgniter\Model;

class NamaPasienModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'ca_nama_pasien';
    protected $primaryKey       = 'nik';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['nik', 'nama_depan', 'nama_tengah', 'nama_belakang'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nik' => 'required',
        'nama_depan' => 'required'
    ];
    protected $validationMessages   = [
        'nik' => ['required' => 'NIK harus diisi'],
        'nama_depan' => ['required' => 'Nama depan harus diisi']
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
