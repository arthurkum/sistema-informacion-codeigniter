<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTelefonosTable extends Migration
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
            'tipo_telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'Móvil',
            ],
            'indicativo' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'default'    => '+57',
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
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
        $this->forge->createTable('telefonos', true);
    }

    public function down()
    {
        $this->forge->dropTable('telefonos', true);
    }
}
