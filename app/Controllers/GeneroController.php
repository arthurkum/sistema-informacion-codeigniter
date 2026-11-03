<?php

namespace App\Controllers;

use App\Models\GeneroModel;

class GeneroController extends BaseController
{
    protected $generoModel;

    public function __construct()
    {
        $this->generoModel = new GeneroModel();
    }

    public function index()
    {
        $data = [
            'titulo'  => 'Gestión de Género',
            'generos' => $this->generoModel->orderBy('id', 'ASC')->findAll(),
        ];
        return view('generos/index', $data);
    }

    public function new()
    {
        $data = [
            'titulo'     => 'Registrar Nuevo Género',
            'genero'     => null,
            'validation' => \Config\Services::validation(),
        ];
        return view('generos/form', $data);
    }

    public function create()
    {
        $rules = [
            'nombre'      => 'required|min_length[3]|max_length[50]|is_unique[generos.nombre]',
            'descripcion' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->generoModel->insert([
            'nombre'      => trim($this->request->getPost('nombre')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'estado'      => $this->request->getPost('estado') ?? 1,
        ]);

        return redirect()->to('/generos')->with('success', 'Registro de género creado exitosamente.');
    }

    public function edit($id = null)
    {
        $genero = $this->generoModel->find($id);
        if (!$genero) {
            return redirect()->to('/generos')->with('error', 'Registro de género no encontrado.');
        }

        $data = [
            'titulo'     => 'Editar Género: ' . esc($genero['nombre']),
            'genero'     => $genero,
            'validation' => \Config\Services::validation(),
        ];
        return view('generos/form', $data);
    }

    public function update($id = null)
    {
        $genero = $this->generoModel->find($id);
        if (!$genero) {
            return redirect()->to('/generos')->with('error', 'Registro no encontrado.');
        }

        $rules = [
            'nombre'      => "required|min_length[3]|max_length[50]|is_unique[generos.nombre,id,{$id}]",
            'descripcion' => 'permit_empty|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->generoModel->update($id, [
            'nombre'      => trim($this->request->getPost('nombre')),
            'descripcion' => trim($this->request->getPost('descripcion')),
            'estado'      => $this->request->getPost('estado') ? 1 : 0,
        ]);

        return redirect()->to('/generos')->with('success', 'Registro de género actualizado con éxito.');
    }

    public function delete($id = null)
    {
        $genero = $this->generoModel->find($id);
        if (!$genero) {
            return redirect()->to('/generos')->with('error', 'Registro no encontrado.');
        }

        if ($this->generoModel->tienePersonasAsociadas((int)$id)) {
            return redirect()->to('/generos')->with('error', 'No es posible eliminar el género "' . esc($genero['nombre']) . '" porque existen personas vinculadas a este registro.');
        }

        $this->generoModel->delete($id);
        return redirect()->to('/generos')->with('success', 'Registro de género eliminado correctamente.');
    }
}
