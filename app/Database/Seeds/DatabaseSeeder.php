<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('SexoSeeder');
        $this->call('EstadoCivilSeeder');
        $this->call('GeneroSeeder');
        $this->call('PersonaSeeder');
        $this->call('DireccionSeeder');
        $this->call('TelefonoSeeder');
    }
}

