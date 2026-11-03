<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table            = 'personas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'correo_electronico',
        'sexo_id',
        'estado_civil_id',
        'genero_id',
        'foto',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'tipo_documento'     => 'required|in_list[CC,TI,CE,PASAPORTE,DNI]',
        'numero_documento'   => 'required|min_length[4]|max_length[30]|is_unique[personas.numero_documento,id,{id}]',
        'nombres'            => 'required|min_length[2]|max_length[100]',
        'apellidos'          => 'required|min_length[2]|max_length[100]',
        'fecha_nacimiento'   => 'required|valid_date[Y-m-d]',
        'correo_electronico' => 'required|valid_email|max_length[150]|is_unique[personas.correo_electronico,id,{id}]',
        'sexo_id'            => 'required|is_natural_no_zero',
        'estado_civil_id'    => 'required|is_natural_no_zero',
        'genero_id'          => 'required|is_natural_no_zero',
        'estado'             => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'tipo_documento' => [
            'required' => 'El tipo de documento es obligatorio.',
            'in_list'  => 'El tipo de documento seleccionado no es válido.',
        ],
        'numero_documento' => [
            'required'   => 'El número de documento es obligatorio.',
            'min_length' => 'El número de documento debe tener al menos 4 caracteres.',
            'is_unique'  => 'Ya existe una persona registrada con este número de documento.',
        ],
        'nombres' => [
            'required'   => 'Los nombres son obligatorios.',
            'min_length' => 'Los nombres deben tener al menos 2 caracteres.',
        ],
        'apellidos' => [
            'required'   => 'Los apellidos son obligatorios.',
            'min_length' => 'Los apellidos deben tener al menos 2 caracteres.',
        ],
        'fecha_nacimiento' => [
            'required'   => 'La fecha de nacimiento es obligatoria.',
            'valid_date' => 'La fecha de nacimiento no tiene un formato válido (YYYY-MM-DD).',
        ],
        'correo_electronico' => [
            'required'    => 'El correo electrónico es obligatorio.',
            'valid_email' => 'Ingrese una dirección de correo electrónico válida.',
            'is_unique'   => 'Ya existe una persona con este correo electrónico registrado.',
        ],
        'sexo_id' => [
            'required'            => 'Debe seleccionar un sexo.',
            'is_natural_no_zero' => 'Seleccione una opción válida para sexo.',
        ],
        'estado_civil_id' => [
            'required'            => 'Debe seleccionar un estado civil.',
            'is_natural_no_zero' => 'Seleccione una opción válida para estado civil.',
        ],
        'genero_id' => [
            'required'            => 'Debe seleccionar un género.',
            'is_natural_no_zero' => 'Seleccione una opción válida para género.',
        ],
    ];

    /**
     * Obtiene el listado completo de personas con sus entidades relacionadas
     */
    public function getPersonasConRelaciones()
    {
        return $this->select('personas.*, 
                              sexos.nombre as sexo_nombre, 
                              sexos.abreviatura as sexo_abreviatura, 
                              estados_civiles.nombre as estado_civil_nombre, 
                              generos.nombre as genero_nombre,
                              (SELECT COUNT(*) FROM telefonos WHERE telefonos.persona_id = personas.id) as total_telefonos,
                              (SELECT COUNT(*) FROM direcciones WHERE direcciones.persona_id = personas.id) as total_direcciones')
                    ->join('sexos', 'sexos.id = personas.sexo_id', 'left')
                    ->join('estados_civiles', 'estados_civiles.id = personas.estado_civil_id', 'left')
                    ->join('generos', 'generos.id = personas.genero_id', 'left')
                    ->orderBy('personas.id', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene el detalle de una persona específica con sus relaciones
     */
    public function getPersonaDetalle(int $id)
    {
        return $this->select('personas.*, 
                              sexos.nombre as sexo_nombre, 
                              sexos.abreviatura as sexo_abreviatura, 
                              estados_civiles.nombre as estado_civil_nombre, 
                              generos.nombre as genero_nombre')
                    ->join('sexos', 'sexos.id = personas.sexo_id', 'left')
                    ->join('estados_civiles', 'estados_civiles.id = personas.estado_civil_id', 'left')
                    ->join('generos', 'generos.id = personas.genero_id', 'left')
                    ->where('personas.id', $id)
                    ->first();
    }

    /**
     * Calcula métricas y estadísticas para el Dashboard general
     */
    public function getEstadisticasDashboard(): array
    {
        $db = \Config\Database::connect();

        $totalPersonas    = $this->countAllResults();
        $totalTelefonos   = $db->table('telefonos')->countAllResults();
        $totalDirecciones = $db->table('direcciones')->countAllResults();
        $totalSexos       = $db->table('sexos')->countAllResults();
        $totalGeneros     = $db->table('generos')->countAllResults();
        $totalEstados     = $db->table('estados_civiles')->countAllResults();

        // Distribución por Sexo
        $porSexo = $this->select('sexos.nombre, COUNT(personas.id) as total')
                        ->join('sexos', 'sexos.id = personas.sexo_id', 'right')
                        ->groupBy('sexos.id, sexos.nombre')
                        ->findAll();

        // Distribución por Género
        $porGenero = $this->select('generos.nombre, COUNT(personas.id) as total')
                          ->join('generos', 'generos.id = personas.genero_id', 'right')
                          ->groupBy('generos.id, generos.nombre')
                          ->findAll();

        // Distribución por Estado Civil
        $porEstadoCivil = $this->select('estados_civiles.nombre, COUNT(personas.id) as total')
                               ->join('estados_civiles', 'estados_civiles.id = personas.estado_civil_id', 'right')
                               ->groupBy('estados_civiles.id, estados_civiles.nombre')
                               ->findAll();

        return [
            'total_personas'    => $totalPersonas,
            'total_telefonos'   => $totalTelefonos,
            'total_direcciones' => $totalDirecciones,
            'total_sexos'       => $totalSexos,
            'total_generos'     => $totalGeneros,
            'total_estados'     => $totalEstados,
            'por_sexo'          => $porSexo,
            'por_genero'        => $porGenero,
            'por_estado_civil'  => $porEstadoCivil,
        ];
    }
}

