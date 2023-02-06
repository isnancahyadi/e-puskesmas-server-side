<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Antrian extends BaseController
{
    function __construct()
    {
        helper(['restclient']);
    }

    public function index()
    {
        //
    }

    public function tampil($poly)
    {
        $url = site_url('restapi/antrian/show/' . $poly);
        $data = [];
        $response['antrian'] = akses_restapi('GET', $url, $data);

        return view('antrian/poli', (array)$response);
    }
}
