<?php

namespace App\Controllers;

use App\Models\DireccionModel;
use App\Models\PersonaModel;

class DireccionController extends BaseController
{
    protected $direccionModel;
    protected $personaModel;

    public function __construct()
    {
        $this->direccionModel = new DireccionModel();
        $this->personaModel   = new PersonaModel();
    }

    public function index()
    {
        $data = [
            'titulo'      => 'Gestión de Direcciones',
            'direcciones' => $this->direccionModel->getDireccionesConPersona(),
        ];
        return view('direcciones/index', $data);
    }

    public function new()
    {
        $selectedPersonaId = $this->request->getGet('persona_id');

        $data = [
            'titulo'            => 'Registrar Nueva Dirección',
            'direccion'         => null,
            'personas'          => $this->personaModel->orderBy('nombres', 'ASC')->findAll(),
            'selectedPersonaId' => $selectedPersonaId,
            'validation'        => \Config\Services::validation(),
        ];
        return view('direcciones/form', $data);
    }

    public function create()
    {
        $rules = [
            'persona_id'          => 'required|is_natural_no_zero',
            'tipo_direccion'      => 'required|min_length[3]|max_length[50]',
            'direccion'           => 'required|min_length[4]|max_length[255]',
            'barrio'              => 'permit_empty|max_length[100]',
            'ciudad'              => 'required|min_length[2]|max_length[100]',
            'departamento_estado' => 'required|min_length[2]|max_length[100]',
            'codigo_postal'       => 'permit_empty|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $personaId   = (int)$this->request->getPost('persona_id');
        $esPrincipal = $this->request->getPost('es_principal') ? 1 : 0;

        $insertId = $this->direccionModel->insert([
            'persona_id'          => $personaId,
            'tipo_direccion'      => trim($this->request->getPost('tipo_direccion')),
            'direccion'           => trim($this->request->getPost('direccion')),
            'barrio'              => trim($this->request->getPost('barrio')),
            'ciudad'              => trim($this->request->getPost('ciudad')),
            'departamento_estado' => trim($this->request->getPost('departamento_estado')),
            'codigo_postal'       => trim($this->request->getPost('codigo_postal')),
            'es_principal'        => $esPrincipal,
        ]);

        if ($esPrincipal) {
            $this->direccionModel->asegurarUnicaPrincipal($insertId, $personaId);
        }

        $origen = $this->request->getPost('origen');
        if ($origen === 'persona') {
            return redirect()->to('/personas/' . $personaId)->with('success', 'Dirección agregada exitosamente a la persona.');
        }

        return redirect()->to('/direcciones')->with('success', 'Dirección registrada exitosamente.');
    }

    public function edit($id = null)
    {
        $direccion = $this->direccionModel->find($id);
        if (!$direccion) {
            return redirect()->to('/direcciones')->with('error', 'Registro de dirección no encontrado.');
        }

        $data = [
            'titulo'            => 'Editar Dirección: ' . esc($direccion['direccion']),
            'direccion'         => $direccion,
            'personas'          => $this->personaModel->orderBy('nombres', 'ASC')->findAll(),
            'selectedPersonaId' => $direccion['persona_id'],
            'validation'        => \Config\Services::validation(),
        ];
        return view('direcciones/form', $data);
    }

    public function update($id = null)
    {
        $direccion = $this->direccionModel->find($id);
        if (!$direccion) {
            return redirect()->to('/direcciones')->with('error', 'Dirección no encontrada.');
        }

        $rules = [
            'persona_id'          => 'required|is_natural_no_zero',
            'tipo_direccion'      => 'required|min_length[3]|max_length[50]',
            'direccion'           => 'required|min_length[4]|max_length[255]',
            'barrio'              => 'permit_empty|max_length[100]',
            'ciudad'              => 'required|min_length[2]|max_length[100]',
            'departamento_estado' => 'required|min_length[2]|max_length[100]',
            'codigo_postal'       => 'permit_empty|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $personaId   = (int)$this->request->getPost('persona_id');
        $esPrincipal = $this->request->getPost('es_principal') ? 1 : 0;

        $this->direccionModel->update($id, [
            'persona_id'          => $personaId,
            'tipo_direccion'      => trim($this->request->getPost('tipo_direccion')),
            'direccion'           => trim($this->request->getPost('direccion')),
            'barrio'              => trim($this->request->getPost('barrio')),
            'ciudad'              => trim($this->request->getPost('ciudad')),
            'departamento_estado' => trim($this->request->getPost('departamento_estado')),
            'codigo_postal'       => trim($this->request->getPost('codigo_postal')),
            'es_principal'        => $esPrincipal,
        ]);

        if ($esPrincipal) {
            $this->direccionModel->asegurarUnicaPrincipal($id, $personaId);
        }

        $origen = $this->request->getPost('origen');
        if ($origen === 'persona') {
            return redirect()->to('/personas/' . $personaId)->with('success', 'Dirección actualizada correctamente.');
        }

        return redirect()->to('/direcciones')->with('success', 'Dirección modificada correctamente.');
    }

    public function delete($id = null)
    {
        $direccion = $this->direccionModel->find($id);
        if (!$direccion) {
            return redirect()->to('/direcciones')->with('error', 'Registro no encontrado.');
        }

        $personaId = $direccion['persona_id'];
        $this->direccionModel->delete($id);

        $volverA = $this->request->getGet('volver');
        if ($volverA === 'persona') {
            return redirect()->to('/personas/' . $personaId)->with('success', 'Dirección eliminada correctamente.');
        }

        return redirect()->to('/direcciones')->with('success', 'Dirección eliminada correctamente.');
    }
}
