<?php

namespace App\Models;

use CodeIgniter\Model;

class DireccionModel extends Model
{
    protected $table            = 'direcciones';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'tipo_direccion',
        'direccion',
        'barrio',
        'ciudad',
        'departamento_estado',
        'codigo_postal',
        'es_principal',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'persona_id'          => 'required|is_natural_no_zero',
        'tipo_direccion'      => 'required|min_length[3]|max_length[50]',
        'direccion'           => 'required|min_length[4]|max_length[255]',
        'barrio'              => 'permit_empty|max_length[100]',
        'ciudad'              => 'required|min_length[2]|max_length[100]',
        'departamento_estado' => 'required|min_length[2]|max_length[100]',
        'codigo_postal'       => 'permit_empty|max_length[20]',
        'es_principal'        => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'persona_id' => [
            'required'           => 'Debe asociar la dirección a una persona.',
            'is_natural_no_zero' => 'Seleccione una persona válida.',
        ],
        'tipo_direccion' => [
            'required'   => 'El tipo de dirección es obligatorio (ej. Residencia, Trabajo).',
            'min_length' => 'El tipo de dirección debe tener al menos 3 caracteres.',
        ],
        'direccion' => [
            'required'   => 'La dirección física es obligatoria.',
            'min_length' => 'La dirección debe tener al menos 4 caracteres.',
        ],
        'ciudad' => [
            'required'   => 'La ciudad o municipio es obligatorio.',
            'min_length' => 'El nombre de la ciudad debe tener al menos 2 caracteres.',
        ],
        'departamento_estado' => [
            'required'   => 'El departamento, estado o provincia es obligatorio.',
            'min_length' => 'El nombre del departamento debe tener al menos 2 caracteres.',
        ],
    ];

    /**
     * Obtiene todas las direcciones con la información de la persona vinculada
     */
    public function getDireccionesConPersona()
    {
        return $this->select('direcciones.*, personas.nombres, personas.apellidos, personas.tipo_documento, personas.numero_documento')
                    ->join('personas', 'personas.id = direcciones.persona_id')
                    ->orderBy('direcciones.id', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene las direcciones pertenecientes a una persona específica
     */
    public function getPorPersona(int $personaId)
    {
        return $this->where('persona_id', $personaId)
                    ->orderBy('es_principal', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    /**
     * Si la nueva dirección o editada es principal, desmarca las demás de esa persona
     */
    public function asegurarUnicaPrincipal(int $direccionId, int $personaId)
    {
        $this->where('persona_id', $personaId)
             ->where('id !=', $direccionId)
             ->set(['es_principal' => 0])
             ->update();
    }
}
