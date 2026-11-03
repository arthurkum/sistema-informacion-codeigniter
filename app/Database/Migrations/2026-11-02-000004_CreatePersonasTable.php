<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersonasTable extends Migration
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
            'tipo_documento' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'CC',
            ],
            'numero_documento' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'nombres' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'apellidos' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'fecha_nacimiento' => [
                'type' => 'DATE',
            ],
            'correo_electronico' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'sexo_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'estado_civil_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'genero_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'estado' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
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
        $this->forge->addUniqueKey('numero_documento');
        $this->forge->addUniqueKey('correo_electronico');
        $this->forge->addForeignKey('sexo_id', 'sexos', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('estado_civil_id', 'estados_civiles', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('genero_id', 'generos', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('personas', true);
    }

    public function down()
    {
        $this->forge->dropTable('personas', true);
    }
}

