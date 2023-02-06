<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'pemeriksaan';
    protected $primaryKey       = 'ID';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['hari', 'tanggal', 'nik', 'ID_poli', 'sip', 'keluhan', 'diagnosis', 'obat', 'catatan'];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'hari'      => 'required',
        'tanggal'   => 'required',
        'nik'       => 'required',
        'ID_poli'   => 'required',
        'sip'       => 'required',
        'keluhan'   => 'required',
        'diagnosis' => 'required',
        'obat'      => 'required',
        'catatan'   => 'required'
    ];
    protected $validationMessages   = [
        'hari'      => ['required' => 'Hari tidak boleh kosong'],
        'tanggal'   => ['required' => 'Tanggal tidak boleh kosong'],
        'nik'       => ['required' => 'NIK tidak boleh kosong'],
        'ID_poli'   => ['required' => 'Poli tidak boleh kosong'],
        'sip'       => ['required' => 'Dokter tidak boleh kosong'],
        'keluhan'   => ['required' => 'Keluhan tidak boleh kosong'],
        'diagnosis' => ['required' => 'Diagnosis tidak boleh kosong'],
        'obat'      => ['required' => 'Resep obat tidak boleh kosong'],
        'catatan'   => ['required' => 'Catatan tidak boleh kosong']
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
        $builder = $this->db->table('pemeriksaan');
        $builder->select('pemeriksaan.hari, pemeriksaan.tanggal, pemeriksaan.nik, pemeriksaan.keluhan, pemeriksaan.diagnosis, pemeriksaan.obat, pemeriksaan.catatan, poli.nama_poli, ca_nama_pasien.nama_depan AS pas_nama_depan, ca_nama_pasien.nama_tengah AS pas_nama_tengah, ca_nama_pasien.nama_belakang AS pas_nama_belakang, ca_nama_dokter.gelar_depan AS dok_gelar_depan, ca_nama_dokter.nama_depan AS dok_nama_depan, ca_nama_dokter.nama_tengah AS dok_nama_tengah, ca_nama_dokter.nama_belakang AS dok_nama_belakang, ca_nama_dokter.gelar_belakang AS dok_gelar_belakang');
        $builder->join('pasien', 'pasien.nik = pemeriksaan.nik');
        $builder->join('ca_nama_pasien', 'ca_nama_pasien.nik = pasien.nik');
        $builder->join('dokter', 'dokter.sip = pemeriksaan.sip');
        $builder->join('ca_nama_dokter', 'ca_nama_dokter.sip = dokter.sip');
        $builder->join('poli', 'poli.ID_poli = pemeriksaan.ID_poli');

        $query = $builder->get();

        return $query->getResult();
    }

    function getSpecified($id)
    {
        $builder = $this->db->table('pemeriksaan');
        $builder->select('pemeriksaan.*, poli.nama_poli, ca_nama_pasien.nama_depan AS pas_nama_depan, ca_nama_pasien.nama_tengah AS pas_nama_tengah, ca_nama_pasien.nama_belakang AS pas_nama_belakang, ca_nama_dokter.gelar_depan AS dok_gelar_depan, ca_nama_dokter.nama_depan AS dok_nama_depan, ca_nama_dokter.nama_tengah AS dok_nama_tengah, ca_nama_dokter.nama_belakang AS dok_nama_belakang, ca_nama_dokter.gelar_belakang AS dok_gelar_belakang');
        $builder->join('pasien', 'pasien.nik = pemeriksaan.nik');
        $builder->join('ca_nama_pasien', 'ca_nama_pasien.nik = pasien.nik');
        $builder->join('dokter', 'dokter.sip = pemeriksaan.sip');
        $builder->join('ca_nama_dokter', 'ca_nama_dokter.sip = dokter.sip');
        $builder->join('poli', 'poli.ID_poli = pemeriksaan.ID_poli');
        $builder->where('pemeriksaan.nik', $id);

        $query = $builder->get();

        return $query->getResult();
    }
}
