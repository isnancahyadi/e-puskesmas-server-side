<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalDokterModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'jadwal_dokter';
    protected $primaryKey       = 'ID_jadwal';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['sip', 'hari', 'ID_poli', 'jam'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'sip'       => 'required',
        'hari'      => 'required',
        'ID_poli'   => 'required',
        'jam'       => 'required'
    ];
    protected $validationMessages   = [
        'sip'       => ['required' => 'SIP harus diisi'],
        'hari'      => ['required' => 'Hari harus diisi'],
        'ID_poli'   => ['required' => 'Poli harus diisi'],
        'jam'       => ['required' => 'Jam harus diisi']
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
        $builder = $this->db->table('jadwal_dokter');
        $builder->join('dokter', 'dokter.sip = jadwal_dokter.sip');
        $builder->join('ca_nama_dokter', 'ca_nama_dokter.sip = dokter.sip');
        $builder->join('poli', 'poli.ID_poli = jadwal_dokter.ID_poli');

        $query = $builder->get();
        return $query->getResult();
    }

    function getSpecified($id)
    {
        $builder = $this->db->table('jadwal_dokter');
        $builder->join('dokter', 'dokter.sip = jadwal_dokter.sip');
        $builder->join('ca_nama_dokter', 'ca_nama_dokter.sip = dokter.sip');
        $builder->join('poli', 'poli.ID_poli = jadwal_dokter.ID_poli');
        $builder->where('poli.nama_poli', $id);

        $query = $builder->get();
        return $query->getResult();
    }

    function getScheduleFromDay($day, $poly)
    {
        $builder = $this->db->table('jadwal_dokter');
        $builder->join('dokter', 'dokter.sip = jadwal_dokter.sip');
        $builder->join('ca_nama_dokter', 'ca_nama_dokter.sip = dokter.sip');
        $builder->where('jadwal_dokter.hari', $day);
        $builder->where('jadwal_dokter.poli', $poly);

        $query = $builder->get();
        return $query->getRow();
    }
}
