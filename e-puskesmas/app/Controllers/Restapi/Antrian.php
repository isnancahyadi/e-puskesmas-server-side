<?php

namespace App\Controllers\Restapi;

use App\Controllers\BaseController;
use App\Models\AntrianModel;
use App\Models\JadwalDokterModel;
use CodeIgniter\API\ResponseTrait;

class Antrian extends BaseController
{

    use ResponseTrait;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->antri = new AntrianModel();
        $this->jadwalDok = new JadwalDokterModel();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $nik            = $this->request->getVar('nik');
        $jenisPasien    = $this->request->getVar('jenis_pasien');
        $poli           = $this->request->getVar('poli');
        $hari           = $this->request->getVar('hari');
        $tanggal        = $this->request->getVar('tanggal');

        $getIdPoli = $this->db->table('poli')->select('ID_poli')->where('nama_poli', strtoupper($poli))->get();
        $queryIdPoli = $getIdPoli->getRow();

        // foreach ($queryIdPoli as $key => $value) {
        $idPoli = $queryIdPoli->ID_poli;
        // }

        $noAntrian = 0;

        // $queueFromPoly = $this->antri->getPatientQueueFromPoly($poli, $tanggal);
        $maxQueueFromPoly = $this->db->table('antrian')->selectMax('no_antrian')->where('ID_poli', $idPoli)->where('tanggal', $tanggal)->get();
        // $maxQueueFromPoly;
        // $maxQueueFromPoly;
        // $maxQueueFromPoly;
        // $maxQueueFromPoly;
        // $maxQueueFromPoly;
        $queryMaxQueueFromPoly = $maxQueueFromPoly->getRow();

        $queueFromPoly = $this->db->table('antrian')->where('nik', $nik)->where('ID_poli', $idPoli)->where('tanggal', $tanggal)->get();
        // $queueFromPoly;
        // $queueFromPoly;
        // $queueFromPoly;
        // $queueFromPoly;
        $queryQueueFromPoly = $queueFromPoly->getResult();

        if ($queryMaxQueueFromPoly == null) {
            $noAntrian = 1;
        } else {
            // $queue = $this->antri->getQueueFromPoly($poli, $tanggal);
            foreach ($queryQueueFromPoly as $key => $value) {
                if ($value->nik == $nik && $value->ID_poli == $idPoli && $value->tanggal == $tanggal) {
                    return $this->failResourceExists("Data telah tersedia");
                }
            }
            $noAntrian = $queryMaxQueueFromPoly->no_antrian + 1;
        }

        // $sip = $this->jadwalDok->getScheduleFromDay($hari, $poli);

        // return $this->respond($sip->sip);

        $data = [
            'no_antrian'    => $noAntrian,
            'nik'           => $nik,
            'jenis_pasien'  => $jenisPasien,
            'ID_poli'       => $idPoli,
            'hari'          => $hari,
            'tanggal'       => $tanggal
        ];

        $getMaxPatientFromDate = $this->db->table('antrian')->selectCount('no_antrian')->where('ID_poli', $idPoli)->where('tanggal', $tanggal)->get();
        $querygetMaxPatientFromDate = $getMaxPatientFromDate->getRow();

        if ($querygetMaxPatientFromDate->no_antrian < 10) {
            $this->antri->insert($data);

            if ($this->antri->affectedRows() > 0) {
                return $this->respondCreated('Data berhasil disimpan');
            } else {
                return $this->fail($this->antri->errors());
            }
        } else {
            return $this->failForbidden();
        }
    }

    public function show($id = null)
    {
        $tanggal = date('Y-m-d');
        $poly = strtoupper($id);
        $data = $this->antri->getQueue($poly, $tanggal);
        // dd($poly);
        return $this->respond($data);
    }

    public function showSpecifiedPatient($id = null)
    {
        $data = $this->antri->getSpecified($id);
        return $this->respond($data);
    }

    public function updateStatus($id = null)
    {
        $queryGetStatus = $this->db->table('antrian')->select('antrian.status, antrian.ID_poli, poli.nama_poli')->join('poli', 'poli.ID_poli = antrian.ID_poli')->where('ID', $id)->get();
        $getStatus = $queryGetStatus->getRow();
        // dd($getStatus);

        $updateStatus = $getStatus->status;
        // dd($updateStatus);
        $updateStatus = $updateStatus + 1;

        if ($updateStatus > 3) {
            $updateStatus = 0;
        }

        $data = [
            'status' => $updateStatus
        ];

        // dd($data);

        $this->antri->update($id, $data);

        return redirect()->to(site_url('antrian/' . strtolower($getStatus->nama_poli)));
    }
}
