<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect('orfeusz');
        $query = $db->table('zlecenie_element')->join('zlecenie','zlecenie_element.id_zlecenie = zlecenie.id_zlecenie')->like('plik','-zlecenie-')->orderBy('zlecenie.id_zlecenie','DESC')->get(100);

        $zk_array = [];
        foreach ($query->getResult() as $row) {
            // Podziel numer na części
            $nr_parts = explode('M', $row->numer);
            
            // Pierwsza część numeru przed "M" będzie kluczem
            $nr = $nr_parts[0];
        
            // Sprawdź, czy klucz już istnieje w tablicy
            if (array_key_exists($nr, $zk_array)) {
                continue; // Jeśli klucz już istnieje, pomiń ten element
            } else {
                // Jeśli klucz nie istnieje, dodaj do tablicy
                $zk_array[$nr] = $row;
            }
        }

        $data_home = [
            'zk_array' => $zk_array,
        ];

        echo view('templates/header');
        echo view('templates/home/index',$data_home);
        echo view('templates/footer');
    }

    public function show($id)
    {
        $db = \Config\Database::connect('orfeusz');
        $query = $db->table('zlecenie_element')->join('zlecenie','zlecenie_element.id_zlecenie = zlecenie.id_zlecenie')->like('plik','-zlecenie-')->where('zlecenie.id_zlecenie',$id)->get();

        $zk_array = [];
        //get one row from query
        $row = $query->getRow();
        //explode M from numer
        $nr_parts = explode('M', $row->numer);

        $nr = $nr_parts[0];

        //get ofe_oferta_element_skladowe from orfeusz by numer sprawy (nr)

        $query = $db->table('ofe_oferta_element_skladowe')->select('ofe_oferta_element_skladowe.*,rec_skladnik.nazwa, rec_skladnik.typ')->join('ofe_oferta','ofe_oferta.id_oferta = ofe_oferta_element_skladowe.id_oferta')->join('rec_skladnik','rec_skladnik.id = ofe_oferta_element_skladowe.id_skladnik')->where('ofe_oferta.numer_historyczny',$nr)->get();
        $skladowe = $query->getResult();

        //get all preferential skladniki
        $query = $db->table('rec_receptura_preferencyjny')->get();
        $pref = [];
        foreach($query->getResult() as $row)
        {
            $pref[] = $row->id_skladnik;
        }

        $id_user = session()->get('id_user');

        $data_show = [
            'skladowe' => $skladowe,
            'nr' => $nr,
            'pref' => $pref,
            'id_user' => $id_user,
        ];

        echo view('templates/header');
        echo view('templates/home/show',$data_show);
        echo view('templates/footer');
    }
}
