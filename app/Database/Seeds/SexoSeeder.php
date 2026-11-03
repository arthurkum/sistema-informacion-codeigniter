<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SexoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre'      => 'Masculino',
                'abreviatura' => 'M',
                'descripcion' => 'Sexo biológico masculino',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Femenino',
                'abreviatura' => 'F',
                'descripcion' => 'Sexo biológico femenino',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Intersexual',
                'abreviatura' => 'I',
                'descripcion' => 'Variaciones biológicas de características sexuales',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('sexos')->insertBatch($data);
    }
}
