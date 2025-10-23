<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un administrateur
        $admin = new Admin([
            "departement" => "IT",
            "fonction" => "Administrateur Système"
        ]);
        $admin->save();

        $admin->user()->create([
            "prenom" => "Admin",
            "nom" => "System",
            "email" => "admin@example.com",
            "password" => Hash::make("password123"),
            "telephone" => "+221777777777",
            "adresse" => "Dakar, Sénégal"
        ]);

        // Création d'un client
        $client = new Client([
            "type_client" => "Particulier",
            "numero_client" => "CLI00001"
        ]);
        $client->save();

        $client->user()->create([
            "prenom" => "Client",
            "nom" => "Test",
            "email" => "client@example.com",
            "password" => Hash::make("password123"),
            "telephone" => "+221766666666",
            "adresse" => "Dakar, Sénégal"
        ]);
    }
}
