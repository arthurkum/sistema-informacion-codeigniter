<?php

namespace App\Controllers;

use App\Models\PersonaModel;
use App\Models\DireccionModel;
use App\Models\TelefonoModel;

class Home extends BaseController
{
    public function index(): string
    {
        $personaModel   = new PersonaModel();
        $direccionModel = new DireccionModel();
        $telefonoModel  = new TelefonoModel();

        $stats = $personaModel->getEstadisticasDashboard();
        $ultimasPersonas = $personaModel->getPersonasConRelaciones();
        $ultimasPersonas = array_slice($ultimasPersonas, 0, 5);

        $ultimosTelefonos = $telefonoModel->getTelefonosConPersona();
        $ultimosTelefonos = array_slice($ultimosTelefonos, 0, 5);

        $ultimasDirecciones = $direccionModel->getDireccionesConPersona();
        $ultimasDirecciones = array_slice($ultimasDirecciones, 0, 5);

        $data = [
            'titulo'             => 'Panel de Control - Sistema de Información Web',
            'stats'              => $stats,
            'ultimasPersonas'    => $ultimasPersonas,
            'ultimosTelefonos'   => $ultimosTelefonos,
            'ultimasDirecciones' => $ultimasDirecciones,
        ];

        return view('dashboard', $data);
    }
}
