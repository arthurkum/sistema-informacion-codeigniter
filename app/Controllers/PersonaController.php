<?php

namespace App\Controllers;

use App\Models\PersonaModel;
use App\Models\SexoModel;
use App\Models\EstadoCivilModel;
use App\Models\GeneroModel;
use App\Models\DireccionModel;
use App\Models\TelefonoModel;

class PersonaController extends BaseController
{
    protected $personaModel;
    protected $sexoModel;
    protected $estadoCivilModel;
    protected $generoModel;
    protected $direccionModel;
    protected $telefonoModel;

    public function __construct()
    {
        $this->personaModel     = new PersonaModel();
        $this->sexoModel        = new SexoModel();
        $this->estadoCivilModel = new EstadoCivilModel();
        $this->generoModel      = new GeneroModel();
        $this->direccionModel   = new DireccionModel();
        $this->telefonoModel    = new TelefonoModel();
    }

    public function index()
    {
        $data = [
            'titulo'   => 'Gestión de Personas',
            'personas' => $this->personaModel->getPersonasConRelaciones(),
        ];
        return view('personas/index', $data);
    }

    public function show($id = null)
    {
        $persona = $this->personaModel->getPersonaDetalle((int)$id);
        if (!$persona) {
            return redirect()->to('/personas')->with('error', 'La persona solicitada no existe.');
        }

        $direcciones = $this->direccionModel->getPorPersona((int)$id);
        $telefonos   = $this->telefonoModel->getPorPersona((int)$id);

        $data = [
            'titulo'      => 'Detalle de Persona: ' . esc($persona['nombres'] . ' ' . $persona['apellidos']),
            'persona'     => $persona,
            'direcciones' => $direcciones,
            'telefonos'   => $telefonos,
        ];
        return view('personas/show', $data);
    }

    public function new()
    {
        $data = [
            'titulo'         => 'Registrar Nueva Persona',
            'persona'        => null,
            'sexos'          => $this->sexoModel->where('estado', 1)->orderBy('nombre', 'ASC')->findAll(),
            'estadosCiviles' => $this->estadoCivilModel->where('estado', 1)->orderBy('nombre', 'ASC')->findAll(),
            'generos'        => $this->generoModel->where('estado', 1)->orderBy('nombre', 'ASC')->findAll(),
            'validation'     => \Config\Services::validation(),
        ];
        return view('personas/form', $data);
    }

    public function create()
    {
        $rules = [
            'tipo_documento'     => 'required|in_list[CC,TI,CE,PASAPORTE,DNI]',
            'numero_documento'   => 'required|min_length[4]|max_length[30]|is_unique[personas.numero_documento]',
            'nombres'            => 'required|min_length[2]|max_length[100]',
            'apellidos'          => 'required|min_length[2]|max_length[100]',
            'fecha_nacimiento'   => 'required|valid_date[Y-m-d]',
            'correo_electronico' => 'required|valid_email|max_length[150]|is_unique[personas.correo_electronico]',
            'sexo_id'            => 'required|is_natural_no_zero',
            'estado_civil_id'    => 'required|is_natural_no_zero',
            'genero_id'          => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->personaModel->insert([
            'tipo_documento'     => $this->request->getPost('tipo_documento'),
            'numero_documento'   => trim($this->request->getPost('numero_documento')),
            'nombres'            => trim($this->request->getPost('nombres')),
            'apellidos'          => trim($this->request->getPost('apellidos')),
            'fecha_nacimiento'   => $this->request->getPost('fecha_nacimiento'),
            'correo_electronico' => trim(strtolower($this->request->getPost('correo_electronico'))),
            'sexo_id'            => $this->request->getPost('sexo_id'),
            'estado_civil_id'    => $this->request->getPost('estado_civil_id'),
            'genero_id'          => $this->request->getPost('genero_id'),
            'estado'             => $this->request->getPost('estado') ?? 1,
        ]);

        $nuevoId = $this->personaModel->getInsertID();

        return redirect()->to('/personas/' . $nuevoId)->with('success', 'Persona registrada exitosamente. Ahora puede agregar sus teléfonos y direcciones.');
    }

    public function edit($id = null)
    {
        $persona = $this->personaModel->find($id);
        if (!$persona) {
            return redirect()->to('/personas')->with('error', 'Registro de persona no encontrado.');
        }

        $data = [
            'titulo'         => 'Editar Persona: ' . esc($persona['nombres'] . ' ' . $persona['apellidos']),
            'persona'        => $persona,
            'sexos'          => $this->sexoModel->where('estado', 1)->orderBy('nombre', 'ASC')->findAll(),
            'estadosCiviles' => $this->estadoCivilModel->where('estado', 1)->orderBy('nombre', 'ASC')->findAll(),
            'generos'        => $this->generoModel->where('estado', 1)->orderBy('nombre', 'ASC')->findAll(),
            'validation'     => \Config\Services::validation(),
        ];
        return view('personas/form', $data);
    }

    public function update($id = null)
    {
        $persona = $this->personaModel->find($id);
        if (!$persona) {
            return redirect()->to('/personas')->with('error', 'Persona no encontrada.');
        }

        $rules = [
            'tipo_documento'     => 'required|in_list[CC,TI,CE,PASAPORTE,DNI]',
            'numero_documento'   => "required|min_length[4]|max_length[30]|is_unique[personas.numero_documento,id,{$id}]",
            'nombres'            => 'required|min_length[2]|max_length[100]',
            'apellidos'          => 'required|min_length[2]|max_length[100]',
            'fecha_nacimiento'   => 'required|valid_date[Y-m-d]',
            'correo_electronico' => "required|valid_email|max_length[150]|is_unique[personas.correo_electronico,id,{$id}]",
            'sexo_id'            => 'required|is_natural_no_zero',
            'estado_civil_id'    => 'required|is_natural_no_zero',
            'genero_id'          => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->personaModel->update($id, [
            'tipo_documento'     => $this->request->getPost('tipo_documento'),
            'numero_documento'   => trim($this->request->getPost('numero_documento')),
            'nombres'            => trim($this->request->getPost('nombres')),
            'apellidos'          => trim($this->request->getPost('apellidos')),
            'fecha_nacimiento'   => $this->request->getPost('fecha_nacimiento'),
            'correo_electronico' => trim(strtolower($this->request->getPost('correo_electronico'))),
            'sexo_id'            => $this->request->getPost('sexo_id'),
            'estado_civil_id'    => $this->request->getPost('estado_civil_id'),
            'genero_id'          => $this->request->getPost('genero_id'),
            'estado'             => $this->request->getPost('estado') ? 1 : 0,
        ]);

        return redirect()->to('/personas/' . $id)->with('success', 'Datos de la persona actualizados exitosamente.');
    }

    public function delete($id = null)
    {
        $persona = $this->personaModel->find($id);
        if (!$persona) {
            return redirect()->to('/personas')->with('error', 'Registro de persona no encontrado.');
        }

        $this->personaModel->delete($id);
        return redirect()->to('/personas')->with('success', 'Persona y sus registros vinculados han sido eliminados correctamente.');
    }
}

