<?php

namespace App\Controllers;

use App\Models\EstadoCivilModel;

class EstadoCivilController extends BaseController
{
    protected $estadoCivilModel;

    public function __construct()
    {
        $this->estadoCivilModel = new EstadoCivilModel();
    }

    public function index()
    {
        $data = [
            'titulo'          => 'Gestión de Estado Civil',
            'estadosCiviles'  => $this->estadoCivilModel->orderBy('id', 'ASC')->findAll(),
        ];
        return view('estados_civiles/index', $data);
    }

    public function new()
    {
        $data = [
            'titulo'      => 'Registrar Nuevo Estado Civil',
            'estadoCivil' => null,
            'validation'  => \Config\Services::validation(),
        ];
        return view('estados_civiles/form', $data);
    }

    public function create()
    {
        $rules = [
            'nombre'      => 'required|min_length[3]|max_length[50]|is_unique[estados_civiles.nombre]',
            'descripcion' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->estadoCivilModel->insert([
            'nombre'      => trim($this->request->getPost('nombre')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'estado'      => $this->request->getPost('estado') ?? 1,
        ]);

        return redirect()->to('/estados-civiles')->with('success', 'Estado civil registrado exitosamente.');
    }

    public function edit($id = null)
    {
        $estadoCivil = $this->estadoCivilModel->find($id);
        if (!$estadoCivil) {
            return redirect()->to('/estados-civiles')->with('error', 'Registro de estado civil no encontrado.');
        }

        $data = [
            'titulo'      => 'Editar Estado Civil: ' . esc($estadoCivil['nombre']),
            'estadoCivil' => $estadoCivil,
            'validation'  => \Config\Services::validation(),
        ];
        return view('estados_civiles/form', $data);
    }

    public function update($id = null)
    {
        $estadoCivil = $this->estadoCivilModel->find($id);
        if (!$estadoCivil) {
            return redirect()->to('/estados-civiles')->with('error', 'Registro no encontrado.');
        }

        $rules = [
            'nombre'      => "required|min_length[3]|max_length[50]|is_unique[estados_civiles.nombre,id,{$id}]",
            'descripcion' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->estadoCivilModel->update($id, [
            'nombre'      => trim($this->request->getPost('nombre')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'estado'      => $this->request->getPost('estado') ? 1 : 0,
        ]);

        return redirect()->to('/estados-civiles')->with('success', 'Estado civil actualizado satisfactoriamente.');
    }

    public function delete($id = null)
    {
        $estadoCivil = $this->estadoCivilModel->find($id);
        if (!$estadoCivil) {
            return redirect()->to('/estados-civiles')->with('error', 'Registro no encontrado.');
        }

        if ($this->estadoCivilModel->tienePersonasAsociadas((int)$id)) {
            return redirect()->to('/estados-civiles')->with('error', 'No es posible eliminar el estado civil "' . esc($estadoCivil['nombre']) . '" porque existen personas vinculadas a este registro.');
        }

        $this->estadoCivilModel->delete($id);
        return redirect()->to('/estados-civiles')->with('success', 'Estado civil eliminado correctamente.');
    }
}
