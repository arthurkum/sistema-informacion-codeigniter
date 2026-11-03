<?php

namespace App\Controllers;

use App\Models\SexoModel;

class SexoController extends BaseController
{
    protected $sexoModel;

    public function __construct()
    {
        $this->sexoModel = new SexoModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gestión de Sexo Biológico',
            'sexos'  => $this->sexoModel->orderBy('id', 'ASC')->findAll(),
        ];
        return view('sexos/index', $data);
    }

    public function new()
    {
        $data = [
            'titulo'     => 'Registrar Nuevo Sexo',
            'sexo'       => null,
            'validation' => \Config\Services::validation(),
        ];
        return view('sexos/form', $data);
    }

    public function create()
    {
        $rules = [
            'nombre'      => 'required|min_length[3]|max_length[50]|is_unique[sexos.nombre]',
            'abreviatura' => 'permit_empty|max_length[10]',
            'descripcion' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->sexoModel->insert([
            'nombre'      => trim($this->request->getPost('nombre')),
            'abreviatura' => trim($this->request->getPost('abreviatura')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'estado'      => $this->request->getPost('estado') ?? 1,
        ]);

        return redirect()->to('/sexos')->with('success', 'Registro de sexo creado satisfactoriamente.');
    }

    public function edit($id = null)
    {
        $sexo = $this->sexoModel->find($id);
        if (!$sexo) {
            return redirect()->to('/sexos')->with('error', 'El registro de sexo solicitado no existe.');
        }

        $data = [
            'titulo'     => 'Editar Sexo: ' . esc($sexo['nombre']),
            'sexo'       => $sexo,
            'validation' => \Config\Services::validation(),
        ];
        return view('sexos/form', $data);
    }

    public function update($id = null)
    {
        $sexo = $this->sexoModel->find($id);
        if (!$sexo) {
            return redirect()->to('/sexos')->with('error', 'Registro no encontrado.');
        }

        $rules = [
            'nombre'      => "required|min_length[3]|max_length[50]|is_unique[sexos.nombre,id,{$id}]",
            'abreviatura' => 'permit_empty|max_length[10]',
            'descripcion' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->sexoModel->update($id, [
            'nombre'      => trim($this->request->getPost('nombre')),
            'abreviatura' => trim($this->request->getPost('abreviatura')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'estado'      => $this->request->getPost('estado') ? 1 : 0,
        ]);

        return redirect()->to('/sexos')->with('success', 'Registro de sexo actualizado correctamente.');
    }

    public function delete($id = null)
    {
        $sexo = $this->sexoModel->find($id);
        if (!$sexo) {
            return redirect()->to('/sexos')->with('error', 'El registro no existe.');
        }

        if ($this->sexoModel->tienePersonasAsociadas((int)$id)) {
            return redirect()->to('/sexos')->with('error', 'No es posible eliminar el sexo "' . esc($sexo['nombre']) . '" porque existen personas asociadas a esta opción. Modifique o reasigne esas personas primero.');
        }

        $this->sexoModel->delete($id);
        return redirect()->to('/sexos')->with('success', 'Registro de sexo eliminado correctamente.');
    }
}

