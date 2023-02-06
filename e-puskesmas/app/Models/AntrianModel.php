<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'antrian';
    protected $primaryKey       = 'ID';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['no_antrian', 'nik', 'jenis_pasien', 'ID_poli', 'hari', 'tanggal', 'status'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'no_antrian'    => 'required',
        'nik'           => 'required',
        'jenis_pasien'  => 'required',
        'ID_poli'       => 'required',
        'hari'          => 'required',
        'tanggal'       => 'required'
    ];
    protected $validationMessages   = [
        'no_antrian'    => ['required' => 'No antrian tidak boleh kosong'],
        'nik'           => ['required' => 'NIK tidak boleh kosong'],
        'jenis_pasien'  => ['required' => 'Jenis pasien tidak boleh kosong'],
        'ID_poli'       => ['required' => 'Poli tidak boleh kosong'],
        'hari'          => ['required' => 'Hari tidak boleh kosong'],
        'tanggal'       => ['required' => 'Tanggal tidak boleh kosong']
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

    function getQueueFromPoly($poly, $date)
    {
        $builder = $this->db->table('antrian');
        $builder->where('poli', $poly);
        $builder->where('tanggal', $date);

        $query = $builder->get();
        return $query->getResult();
    }

    function getPatientQueueFromPoly($poly, $date)
    {
        $builder = $this->db->table('antrian');
        $builder->selectMax('no_antrian');
        $builder->where('poli', $poly);
        $builder->where('tanggal', $date);

        $query = $builder->get();
        return $query->getRow();
    }

    function getQueue($poly, $date)
    {
        $builder = $this->db->table('antrian');
        $builder->select('antrian.ID, antrian.no_antrian, pasien.nik, ca_nama_pasien.nama_depan AS pas_nama_depan, ca_nama_pasien.nama_tengah AS pas_nama_tengah, ca_nama_pasien.nama_belakang AS pas_nama_belakang, pasien.jenis_kelamin AS pas_jenis_kelamin, poli.nama_poli, antrian.hari, antrian.tanggal, antrian.status');
        $builder->join('pasien', 'antrian.nik = pasien.nik');
        $builder->join('ca_nama_pasien', 'pasien.nik = ca_nama_pasien.nik');
        $builder->join('poli', 'antrian.ID_poli = poli.ID_poli');
        $builder->where('poli.nama_poli', $poly);
        $builder->where('antrian.tanggal', $date);

        $query = $builder->get();
        return $query->getResult();
    }

    function getSpecified($nik)
    {
        $builder = $this->db->table('antrian');
        $builder->select('antrian.no_antrian, pasien.nik, ca_nama_pasien.nama_depan AS pas_nama_depan, ca_nama_pasien.nama_tengah AS pas_nama_tengah, ca_nama_pasien.nama_belakang AS pas_nama_belakang, pasien.jenis_kelamin AS pas_jenis_kelamin, poli.nama_poli, antrian.hari, antrian.tanggal, antrian.jenis_pasien, antrian.status');
        $builder->join('pasien', 'antrian.nik = pasien.nik');
        $builder->join('ca_nama_pasien', 'pasien.nik = ca_nama_pasien.nik');
        $builder->join('poli', 'antrian.ID_poli = poli.ID_poli');
        $builder->where('pasien.nik', $nik);
        $builder->where('antrian.tanggal >=', date('Y-m-d'));
        $builder->where('antrian.status', '0');

        $query = $builder->get();
        return $query->getResult();
    }
}
