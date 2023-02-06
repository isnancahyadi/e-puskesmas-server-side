<?php

namespace App\Controllers\Restapi;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        //
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('akun')->getWhere(['username' => $post['username']]);
        $user = $query->getRow();

        if ($post['username'] == null) {
            return $this->fail('Silahkan isi username dan password');
        } else {
            if ($user) {
                if (password_verify($post['password'], $user->password)) {
                    $params = [
                        'ID_akun' => $user->ID_akun,
                        'username' => $user->username,
                        'hak_akses' => $user->hak_akses
                    ];
                    session()->set($params);

                    return $this->respond($params, 200);
                } else {
                    return $this->failValidationErrors('NIK/No.KTP atau password salah');
                }
            } else {
                return $this->failNotFound('NIK/No.KTP tidak ditemukan');
            }
        }
    }

    public function logoutProcess()
    {
        session()->remove('ID_akun');
        return $this->respondDeleted('Berhasil logout');
    }
}
