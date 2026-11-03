<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TelefonoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'persona_id'    => 1,
                'tipo_telefono' => 'Móvil',
                'indicativo'    => '+57',
                'numero'        => '3001234567',
                'es_principal'  => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'persona_id'    => 1,
                'tipo_telefono' => 'Oficina',
                'indicativo'    => '+57',
                'numero'        => '6044445555',
                'es_principal'  => 0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'persona_id'    => 2,
                'tipo_telefono' => 'Móvil',
                'indicativo'    => '+57',
                'numero'        => '3159876543',
                'es_principal'  => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'persona_id'    => 3,
                'tipo_telefono' => 'WhatsApp',
                'indicativo'    => '+57',
                'numero'        => '3205556677',
                'es_principal'  => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('telefonos')->insertBatch($data);
    }
}
