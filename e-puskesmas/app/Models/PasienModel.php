<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'pasien';
    protected $primaryKey       = 'nik';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'foto_ktp', 'ID_akun'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nik' => 'required|is_unique[pasien.nik,nik,{nik}]',
        'jenis_kelamin' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'alamat' => 'required'
    ];
    protected $validationMessages   = [
        'nik' => [
            'required' => 'NIK harus diisi',
            'is_unique' => 'NIK telah terdaftar'
        ],
        'jenis_kelamin' => ['required' => 'Jenis kelamin harus diisi'],
        'tempat_lahir' => ['required' => 'Tempat lahir harus diisi'],
        'tanggal_lahir' => ['required' => 'Tanggal lahir harus diisi'],
        'alamat' => ['required' => 'Alamat harus diisi']
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
        $builder = $this->db->table('pasien');
        $builder->join('ca_nama_pasien', 'ca_nama_pasien.nik = pasien.nik');

        $query = $builder->get();

        return $query->getResult();
    }

    function getSpecified($id)
    {
        $builder = $this->db->table('pasien');
        $builder->join('ca_nama_pasien', 'ca_nama_pasien.nik = pasien.nik');
        $builder->where('pasien.nik', $id);

        $query = $builder->get();

        return $query->getResult();
    }
}
