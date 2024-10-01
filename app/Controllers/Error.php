<?php

namespace App\Controllers;

class Error extends BaseController
{
    public function index(): string
    {
        return view('error_message');
    }
}
