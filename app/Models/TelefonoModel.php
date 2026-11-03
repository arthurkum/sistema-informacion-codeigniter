<?php

namespace App\Models;

use CodeIgniter\Model;

class TelefonoModel extends Model
{
    protected $table            = 'telefonos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'persona_id',
        'tipo_telefono',
        'indicativo',
        'numero',
        'es_principal',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'persona_id'    => 'required|is_natural_no_zero',
        'tipo_telefono' => 'required|min_length[3]|max_length[50]',
        'indicativo'    => 'permit_empty|max_length[10]',
        'numero'        => 'required|min_length[6]|max_length[30]',
        'es_principal'  => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'persona_id' => [
            'required'           => 'Debe vincular el número a una persona.',
            'is_natural_no_zero' => 'Seleccione una persona válida.',
        ],
        'tipo_telefono' => [
            'required'   => 'El tipo de teléfono es obligatorio (ej. Móvil, Fijo, WhatsApp).',
            'min_length' => 'El tipo de teléfono debe tener al menos 3 caracteres.',
        ],
        'numero' => [
            'required'   => 'El número de teléfono es obligatorio.',
            'min_length' => 'El número debe contener al menos 6 dígitos o caracteres.',
        ],
    ];

    /**
     * Obtiene los teléfonos con los datos de la persona asociada
     */
    public function getTelefonosConPersona()
    {
        return $this->select('telefonos.*, personas.nombres, personas.apellidos, personas.tipo_documento, personas.numero_documento')
                    ->join('personas', 'personas.id = telefonos.persona_id')
                    ->orderBy('telefonos.id', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene todos los teléfonos de una persona específica
     */
    public function getPorPersona(int $personaId)
    {
        return $this->where('persona_id', $personaId)
                    ->orderBy('es_principal', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    /**
     * Si el teléfono es principal, desmarca los demás de esa misma persona
     */
    public function asegurarUnicaPrincipal(int $telefonoId, int $personaId)
    {
        $this->where('persona_id', $personaId)
             ->where('id !=', $telefonoId)
             ->set(['es_principal' => 0])
             ->update();
    }
}

