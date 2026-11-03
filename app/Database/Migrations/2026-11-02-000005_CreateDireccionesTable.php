<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDireccionesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'persona_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tipo_direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'Residencia',
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'barrio' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'ciudad' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'departamento_estado' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'codigo_postal' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'es_principal' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('persona_id', 'personas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('direcciones', true);
    }

    public function down()
    {
        $this->forge->dropTable('direcciones', true);
    }
}
