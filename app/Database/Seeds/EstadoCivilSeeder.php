<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EstadoCivilSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre'      => 'Soltero(a)',
                'descripcion' => 'Persona que no ha contraído matrimonio legalmente',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Casado(a)',
                'descripcion' => 'Persona que ha contraído matrimonio civil o religioso',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Unión Libre',
                'descripcion' => 'Convivencia marital sin vínculo matrimonial formal',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Divorciado(a)',
                'descripcion' => 'Persona con disolución legal de matrimonio',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Viudo(a)',
                'descripcion' => 'Persona cuyo cónyuge ha fallecido',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('estados_civiles')->insertBatch($data);
    }
}

