<?php

namespace App\Models;

use CodeIgniter\Model;

class BpjsModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'bpjs';
    protected $primaryKey       = 'ID_bpjs';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['ID_bpjs', 'nik', 'tingkat_faskes', 'nama_tingkat_faskes', 'foto_bpjs'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'ID_bpjs'               => 'required',
        'nik'                   => 'required',
        'tingkat_faskes'        => 'required',
        'nama_tingkat_faskes'   => 'required'
    ];
    protected $validationMessages   = [
        'ID_bpjs'               => ['required' => 'ID BPJS harus diisi'],
        'nik'                   => ['required' => 'NIK harus diisi'],
        'tingkat_faskes'        => ['required' => 'Tingkat faskes harus diisi'],
        'nama_tingkat_faskes'   => ['required' => 'Nama tingkat faskes harus diisi']
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

    function getSpecified($id)
    {
        $builder = $this->db->table('bpjs');
        $builder->where('nik', $id);

        $query = $builder->get();
        return $query->getResult();
    }
}
