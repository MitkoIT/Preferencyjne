<?php
namespace App\Controllers;

class PanelController extends BaseController{
    public function index(){
        return view('templates/header')
            . view('templates/panel')
            . view('templates/footer');
    }
}