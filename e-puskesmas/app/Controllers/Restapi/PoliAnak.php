<?php

namespace App\Controllers\Restapi;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class PoliAnak extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        //
    }

    public function counter($kode)
    {
        $getCount = $this->db->table('counter_p_anak')->get()->getRow();

        if ($kode == 0) {
            $dataCount = ['num_count' => 0];
        } elseif ($kode == 1) {
            $count = $getCount->num_count + 1;
            $dataCount = ['num_count' => $count];
        }

        $this->db->table('counter_p_anak')->update($dataCount);

        return redirect()->to(site_url('home'));
    }

    public function showCounter()
    {
        return $this->respond($this->db->table('counter_p_anak')->get()->getRow());
    }
}
