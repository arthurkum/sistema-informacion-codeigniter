<?php

namespace App\Controllers;

class ScrumController extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'Metodología Scrum - Gestión del Proyecto',
        ];
        return view('scrum/index', $data);
    }
}

