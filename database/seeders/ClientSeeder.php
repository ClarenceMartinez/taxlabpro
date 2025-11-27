<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client; // Importa el modelo Client

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cuántos clientes quieres crear
        $numberOfClients = 50; // Puedes ajustar este número

        $this->command->info("Creando {$numberOfClients} clientes de prueba...");

        // Usa la factoría para crear los clientes
        Client::factory()->count($numberOfClients)->create();

        $this->command->info("¡Se han creado {$numberOfClients} clientes!");
    }
}