<?php

namespace App\Controllers;

use App\Models\TelefonoModel;
use App\Models\PersonaModel;

class TelefonoController extends BaseController
{
    protected $telefonoModel;
    protected $personaModel;

    public function __construct()
    {
        $this->telefonoModel = new TelefonoModel();
        $this->personaModel  = new PersonaModel();
    }

    public function index()
    {
        $data = [
            'titulo'    => 'Gestión de Teléfonos',
            'telefonos' => $this->telefonoModel->getTelefonosConPersona(),
        ];
        return view('telefonos/index', $data);
    }

    public function new()
    {
        $selectedPersonaId = $this->request->getGet('persona_id');

        $data = [
            'titulo'            => 'Registrar Nuevo Teléfono',
            'telefono'          => null,
            'personas'          => $this->personaModel->orderBy('nombres', 'ASC')->findAll(),
            'selectedPersonaId' => $selectedPersonaId,
            'validation'        => \Config\Services::validation(),
        ];
        return view('telefonos/form', $data);
    }

    public function create()
    {
        $rules = [
            'persona_id'    => 'required|is_natural_no_zero',
            'tipo_telefono' => 'required|min_length[3]|max_length[50]',
            'indicativo'    => 'permit_empty|max_length[10]',
            'numero'        => 'required|min_length[6]|max_length[30]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $personaId   = (int)$this->request->getPost('persona_id');
        $esPrincipal = $this->request->getPost('es_principal') ? 1 : 0;

        $insertId = $this->telefonoModel->insert([
            'persona_id'    => $personaId,
            'tipo_telefono' => trim($this->request->getPost('tipo_telefono')),
            'indicativo'    => trim($this->request->getPost('indicativo') ?: '+57'),
            'numero'        => trim($this->request->getPost('numero')),
            'es_principal'  => $esPrincipal,
        ]);

        if ($esPrincipal) {
            $this->telefonoModel->asegurarUnicaPrincipal($insertId, $personaId);
        }

        $origen = $this->request->getPost('origen');
        if ($origen === 'persona') {
            return redirect()->to('/personas/' . $personaId)->with('success', 'Teléfono agregado exitosamente a la persona.');
        }

        return redirect()->to('/telefonos')->with('success', 'Teléfono registrado exitosamente.');
    }

    public function edit($id = null)
    {
        $telefono = $this->telefonoModel->find($id);
        if (!$telefono) {
            return redirect()->to('/telefonos')->with('error', 'Registro de teléfono no encontrado.');
        }

        $data = [
            'titulo'            => 'Editar Teléfono: ' . esc($telefono['numero']),
            'telefono'          => $telefono,
            'personas'          => $this->personaModel->orderBy('nombres', 'ASC')->findAll(),
            'selectedPersonaId' => $telefono['persona_id'],
            'validation'        => \Config\Services::validation(),
        ];
        return view('telefonos/form', $data);
    }

    public function update($id = null)
    {
        $telefono = $this->telefonoModel->find($id);
        if (!$telefono) {
            return redirect()->to('/telefonos')->with('error', 'Teléfono no encontrado.');
        }

        $rules = [
            'persona_id'    => 'required|is_natural_no_zero',
            'tipo_telefono' => 'required|min_length[3]|max_length[50]',
            'indicativo'    => 'permit_empty|max_length[10]',
            'numero'        => 'required|min_length[6]|max_length[30]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $personaId   = (int)$this->request->getPost('persona_id');
        $esPrincipal = $this->request->getPost('es_principal') ? 1 : 0;

        $this->telefonoModel->update($id, [
            'persona_id'    => $personaId,
            'tipo_telefono' => trim($this->request->getPost('tipo_telefono')),
            'indicativo'    => trim($this->request->getPost('indicativo') ?: '+57'),
            'numero'        => trim($this->request->getPost('numero')),
            'es_principal'  => $esPrincipal,
        ]);

        if ($esPrincipal) {
            $this->telefonoModel->asegurarUnicaPrincipal($id, $personaId);
        }

        $origen = $this->request->getPost('origen');
        if ($origen === 'persona') {
            return redirect()->to('/personas/' . $personaId)->with('success', 'Teléfono actualizado correctamente.');
        }

        return redirect()->to('/telefonos')->with('success', 'Teléfono modificado exitosamente.');
    }

    public function delete($id = null)
    {
        $telefono = $this->telefonoModel->find($id);
        if (!$telefono) {
            return redirect()->to('/telefonos')->with('error', 'Registro no encontrado.');
        }

        $personaId = $telefono['persona_id'];
        $this->telefonoModel->delete($id);

        $volverA = $this->request->getGet('volver');
        if ($volverA === 'persona') {
            return redirect()->to('/personas/' . $personaId)->with('success', 'Teléfono eliminado correctamente.');
        }

        return redirect()->to('/telefonos')->with('success', 'Teléfono eliminado exitosamente.');
    }
}
