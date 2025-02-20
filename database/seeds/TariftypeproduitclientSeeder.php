<?php

namespace Database\Seeders;

use App\Models\Tariftypeproduitclient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TariftypeproduitclientSeeder extends Seeder
{ 
    /**
    * Run the database seeds.
    */
   public function run(): void
   {
       // Liste des données à insérer
       $tariftypeproduitclients = [
           [
               'typeclient_id' => 1,
               'produit_id' => 1,
               'tarifliquide' => 8000,
           ],
           [
               'typeclient_id' => 1,
               'produit_id' => 2,
               'tarifliquide' => 6500,
           ],
           [
               'typeclient_id' => 2,
               'produit_id' => 1,
               'tarifliquide' => 2500,
           ],
       ];

       // Boucle pour insérer les données
       foreach ($tariftypeproduitclients as $data) {
           $tariftypeproduitclient = new Tariftypeproduitclient();
           $tariftypeproduitclient->fill($data); // Utilise la méthode fill pour assigner les données
           $tariftypeproduitclient->save(); // Sauvegarde l'instance dans la base de données
       }
   }
}
