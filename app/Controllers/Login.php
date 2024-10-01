<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\WykonawcaModel;

class Login extends BaseController
{
    public function index()
    {
        if (!empty($_GET['idu']) AND !empty($_GET['idapps']))
		{
            $UserModel = new UserModel();
            $user = $UserModel->where('idusers', $_GET['idu'])->first();
            
            $data = array(
                'id_user' => $_GET['idu'],
                'id_apps' => $_GET['idapps'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => explode(',', $user['role']),
            );
            session()->set($data);

            return redirect()->to('/home');
        }
        else
        {
            return redirect()->to('/error');
        }
    }
}
