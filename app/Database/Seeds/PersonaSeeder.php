<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersonaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'                 => 1,
                'tipo_documento'     => 'CC',
                'numero_documento'   => '1020304050',
                'nombres'            => 'Carlos Andrés',
                'apellidos'          => 'Gómez Restrepo',
                'fecha_nacimiento'   => '1992-05-14',
                'correo_electronico' => 'carlos.gomez@example.com',
                'sexo_id'            => 1, // Masculino
                'estado_civil_id'    => 2, // Casado
                'genero_id'          => 1, // Cisgénero Masc
                'foto'               => null,
                'estado'             => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'id'                 => 2,
                'tipo_documento'     => 'CC',
                'numero_documento'   => '1098765432',
                'nombres'            => 'María Fernanda',
                'apellidos'          => 'López Salazar',
                'fecha_nacimiento'   => '1995-11-23',
                'correo_electronico' => 'maria.lopez@example.com',
                'sexo_id'            => 2, // Femenino
                'estado_civil_id'    => 1, // Soltera
                'genero_id'          => 2, // Cisgénero Fem
                'foto'               => null,
                'estado'             => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'id'                 => 3,
                'tipo_documento'     => 'CE',
                'numero_documento'   => '5544332211',
                'nombres'            => 'Alex',
                'apellidos'          => 'Martínez Peña',
                'fecha_nacimiento'   => '1998-08-30',
                'correo_electronico' => 'alex.martinez@example.com',
                'sexo_id'            => 1,
                'estado_civil_id'    => 3, // Unión Libre
                'genero_id'          => 4, // No Binario
                'foto'               => null,
                'estado'             => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('personas')->insertBatch($data);
    }
}

