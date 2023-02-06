<?php

function akses_restapi($method, $url, $data)
{
    $client = \Config\Services::curlrequest();

    $response = $client->request($method, $url, ['http_errors' => false, 'form_params' => $data]);
    return $response->getBody();
}
