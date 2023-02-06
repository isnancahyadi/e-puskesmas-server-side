<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'akun';
    protected $primaryKey       = 'ID_akun';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'hak_akses'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username' => 'required|is_unique[akun.username,username,{username}]',
        'password' => 'required'
    ];
    protected $validationMessages   = [
        'username' => [
            'required' => 'Username harus diisi',
            'is_unique' => 'Username telah digunakan'
        ],
        'password' => ['required' => 'Password harus diisi']
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
