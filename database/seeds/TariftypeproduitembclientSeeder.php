<?php

namespace Database\Seeders;

use App\Models\Tariftypeproduitembclient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TariftypeproduitembclientSeeder extends Seeder
{
       /**
    * Run the database seeds.
    */
   public function run(): void
   {
       // Liste des données à insérer
       $tariftypeproduitembclients = [
           [
               'typeclient_id' => 1,
               'produit_id' => 1,
               'tarifemballage' => 1000,
           ],
           [
               'typeclient_id' => 1,
               'produit_id' => 3,
               'tarifemballage' => 3000,
           ],
           [
               'typeclient_id' => 1,
               'produit_id' => 2,
               'tarifemballage' => 5000,
           ],
           [
            'typeclient_id' => 1,
            'produit_id' => 4,
            'tarifemballage' => 4000,
        ],
       ];

       // Boucle pour insérer les données
       foreach ($tariftypeproduitembclients as $data) {
           $tariftypeproduitembclient = new Tariftypeproduitembclient();
           $tariftypeproduitembclient->fill($data); // Utilise la méthode fill pour assigner les données
           $tariftypeproduitembclient->save(); // Sauvegarde l'instance dans la base de données
       }
   }
}
