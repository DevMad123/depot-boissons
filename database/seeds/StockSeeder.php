<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{ 
    /**
    * Run the database seeds.
    */
   public function run(): void
   {
       // Liste des données à insérer
       $stocks = [
           [
               'produit_id' => 1,
               'quantite_disponible' => 500,
           ],
           [
               'produit_id' => 2,
               'quantite_disponible' => 500,
           ],
           [
               'produit_id' => 3,
               'quantite_disponible' => 500,
           ], [
               'produit_id' => 4,
               'quantite_disponible' => 500
           ]
       ];

       // Boucle pour insérer les données
       foreach ($stocks as $data) {
           $stock = new Stock();
           $stock->fill($data); // Utilise la méthode fill pour assigner les données
           $stock->save(); // Sauvegarde l'instance dans la base de données
       }
   }
}
