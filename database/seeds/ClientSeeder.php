<?php

namespace Database\Seeders;

use App\Models\Client;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ClientSeeder extends Seeder
{
   
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des données à insérer
        $clients = [
            [
                'matriclient' => 'CLT000001',
                'nom' => 'Le Duplex ',
                'email' => 'LeDuplex@example.com',
                'telephone' => '0123456789',
                'adresse' => '123 Rue des Lilas, Paris',
                'solde' => 1000.50,
                'exonerertva' => true,
                'exonererairsi' => false,
                'typeclient_id' => 1,
                'image' => 'path/to/image1.jpg',
            ],
            [
                'matriclient' => 'CLT000002',
                'nom' => 'La Pirogue',
                'email' => 'LaPirogue@example.com',
                'telephone' => '0987654321',
                'adresse' => '456 Avenue de la République, Lyon',
                'solde' => 250.00,
                'exonerertva' => false,
                'exonererairsi' => true,
                'typeclient_id' => 2,
                'image' => 'path/to/image2.jpg',
            ],
            [
                'matriclient' => 'CLT000003',
                'nom' => 'Le New York Café',
                'email' => 'LeNewYorkCafe@example.com',
                'telephone' => '0765432109',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000004',
                'nom' => 'Le Patio',
                'email' => 'LePatio@example.com',
                'telephone' => '0765432309',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000005',
                'nom' => 'Le Grillardin',
                'email' => 'LeGrillardin@example.com',
                'telephone' => '0765432409',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000006',
                'nom' => 'Mambo Lounge ',
                'email' => 'MamboLounge@example.com',
                'telephone' => '0765432609',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000007',
                'nom' => 'Le Ti Punch Café ',
                'email' => 'LeTiPunchCafe@example.com',
                'telephone' => '0765442709',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000008',
                'nom' => 'Café de Rome ',
                'email' => 'CafedeRome@example.com',
                'telephone' => '0775462109',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000009',
                'nom' => 'Soho Bar ',
                'email' => 'SohoBar@example.com',
                'telephone' => '0785432109',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
            [
                'matriclient' => 'CLT000010',
                'nom' => 'Le Crystal Lounge ',
                'email' => 'LeCrystalLounge@example.com',
                'telephone' => '0766432129',
                'adresse' => '789 Boulevard Newton, Marseille',
                'solde' => 0.00,
                'exonerertva' => true,
                'exonererairsi' => true,
                'typeclient_id' => 3,
                'image' => null,
            ],
        ];

        // Boucle pour insérer les données
        foreach ($clients as $data) {
            $client = new Client();
            $client->fill($data); // Utilise la méthode fill pour assigner les données
            $client->save(); // Sauvegarde l'instance dans la base de données
        }
    }

}
