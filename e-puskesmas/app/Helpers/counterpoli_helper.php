<?php

function counterPoliUmum()
{
    $db = \Config\Database::connect();
    return $db->table('counter_p_umum')->get()->getRow();
}

function counterPoliKb()
{
    $db = \Config\Database::connect();
    return $db->table('counter_p_kb')->get()->getRow();
}

function counterPoliKia()
{
    $db = \Config\Database::connect();
    return $db->table('counter_p_kia')->get()->getRow();
}

function counterPoliAnak()
{
    $db = \Config\Database::connect();
    return $db->table('counter_p_anak')->get()->getRow();
}
