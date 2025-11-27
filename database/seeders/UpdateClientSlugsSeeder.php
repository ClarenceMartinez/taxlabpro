<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Str;

class UpdateClientSlugsSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            $slug = Str::slug($client->first_name . ' ' .$client->last_name  . ' ' . $client->id);
            
            // Solo actualiza si el slug está vacío o diferente
            if ($client->slug !== $slug) {
                $client->slug = $slug;
                $client->save();
            }
        }
    }
}
