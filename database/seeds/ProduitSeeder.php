<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
      /**
    * Run the database seeds.
    */
   public function run(): void
   {
       // Liste des données à insérer
       $produits = [
           [
               'matriproduit' => 'Prod000001',
               'libelle' => 'Coca Cola',
               'emballage_id' => 1,
               'typeproduit_id' => 1,
               'format_id' => 1,
           ],
           [
               'matriproduit' => 'Prod000002',
               'libelle' => 'Bock',
               'emballage_id' => 6,
               'typeproduit_id' => 1,
               'format_id' => 1,
           ],
           [
               'matriproduit' => 'Prod000003',
               'libelle' => 'Heineken',
               'emballage_id' => 1,
               'typeproduit_id' => 2,
               'format_id' => 1,
           ],
           [
            'matriproduit' => 'Prod000004',
            'libelle' => 'Guiness',
            'emballage_id' => 2,
            'typeproduit_id' => 2,
            'format_id' => 1,
        ],
       ];

       // Boucle pour insérer les données
       foreach ($produits as $data) {
           $produit = new Produit();
           $produit->fill($data); // Utilise la méthode fill pour assigner les données
           $produit->save(); // Sauvegarde l'instance dans la base de données
       }
   }
}
