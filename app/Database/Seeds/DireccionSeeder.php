<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DireccionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'persona_id'          => 1,
                'tipo_direccion'      => 'Residencia',
                'direccion'           => 'Calle 45 # 12-34 Apto 502',
                'barrio'              => 'Laureles',
                'ciudad'              => 'Medellín',
                'departamento_estado' => 'Antioquia',
                'codigo_postal'       => '050031',
                'es_principal'        => 1,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'persona_id'          => 1,
                'tipo_direccion'      => 'Trabajo',
                'direccion'           => 'Carrera 43A # 1Sur-50 Oficina 801',
                'barrio'              => 'El Poblado',
                'ciudad'              => 'Medellín',
                'departamento_estado' => 'Antioquia',
                'codigo_postal'       => '050022',
                'es_principal'        => 0,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'persona_id'          => 2,
                'tipo_direccion'      => 'Residencia',
                'direccion'           => 'Carrera 7 # 72-41 Torre B',
                'barrio'              => 'Rosales',
                'ciudad'              => 'Bogotá D.C.',
                'departamento_estado' => 'Cundinamarca',
                'codigo_postal'       => '110221',
                'es_principal'        => 1,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'persona_id'          => 3,
                'tipo_direccion'      => 'Residencia',
                'direccion'           => 'Avenida 6N # 28N-15',
                'barrio'              => 'Santa Mónica',
                'ciudad'              => 'Cali',
                'departamento_estado' => 'Valle del Cauca',
                'codigo_postal'       => '760026',
                'es_principal'        => 1,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('direcciones')->insertBatch($data);
    }
}
