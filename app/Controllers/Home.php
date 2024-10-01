<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect('orfeusz');
        $query = $db->table('zlecenie_element')->like('plik','-zlecenie-')->orderBy('id','DESC')->get(10);

        $zk_array = [];
        foreach ($query->getResult() as $row) {
           $zk_array[] = $row->plik;
        }

        $data_home = [
            'zk_array' => $zk_array,
        ];

        echo view('templates/header');
        echo view('templates/home/index',$data_home);
        echo view('templates/footer');
    }
}
