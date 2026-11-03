<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GeneroSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre'      => 'Masculino (Cisgénero)',
                'descripcion' => 'Identidad de género concordante con el sexo biológico masculino',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Femenino (Cisgénero)',
                'descripcion' => 'Identidad de género concordante con el sexo biológico femenino',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Transgénero',
                'descripcion' => 'Identidad de género que difiere del sexo asignado al nacer',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'No Binario',
                'descripcion' => 'Identidad que no se limita a los géneros binarios hombre/mujer',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nombre'      => 'Prefiero no especificar',
                'descripcion' => 'Reserva el derecho de no declarar su identidad de género',
                'estado'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('generos')->insertBatch($data);
    }
}

