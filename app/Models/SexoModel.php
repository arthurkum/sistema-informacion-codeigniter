<?php

namespace App\Models;

use CodeIgniter\Model;

class SexoModel extends Model
{
    protected $table            = 'sexos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'abreviatura', 'descripcion', 'estado'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[50]|is_unique[sexos.nombre,id,{id}]',
        'estado' => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'    => 'El nombre del sexo es obligatorio.',
            'min_length'  => 'El nombre debe tener al menos 3 caracteres.',
            'max_length'  => 'El nombre no puede exceder 50 caracteres.',
            'is_unique'   => 'Este sexo ya se encuentra registrado.',
        ],
    ];

    /**
     * Verifica si el registro tiene personas asociadas antes de eliminar
     */
    public function tienePersonasAsociadas(int $id): bool
    {
        $db = \Config\Database::connect();
        $count = $db->table('personas')->where('sexo_id', $id)->countAllResults();
        return $count > 0;
    }
}
