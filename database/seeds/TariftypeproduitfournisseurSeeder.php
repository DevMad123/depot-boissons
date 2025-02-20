<?php

namespace Database\Seeders;

use App\Models\Tariftypeproduitfournisseur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TariftypeproduitfournisseurSeeder extends Seeder
{
     /**
    * Run the database seeds.
    */
   public function run(): void
   {
       // Liste des données à insérer
       $tariftypeproduitfournisseurs = [
           [
               'fournisseur_id' => 1,
               'produit_id' => 1,
               'tarifliquide' => 17000,
           ],
           [
               'fournisseur_id' => 1,
               'produit_id' => 1,
               'tarifliquide' => 2000,
           ],
           [
               'fournisseur_id' => 2,
               'produit_id' => 3,
               'tarifliquide' => 1000,
           ],
           [
               'fournisseur_id' => 1,
               'produit_id' => 4,
               'tarifliquide' => 2000,
           ],
           [
               'fournisseur_id' => 2,
               'produit_id' => 1,
               'tarifliquide' => 3000,
           ],
       ];

       // Boucle pour insérer les données
       foreach ($tariftypeproduitfournisseurs as $data) {
           $tariftypeproduitfournisseur = new Tariftypeproduitfournisseur();
           $tariftypeproduitfournisseur->fill($data); // Utilise la méthode fill pour assigner les données
           $tariftypeproduitfournisseur->save(); // Sauvegarde l'instance dans la base de données
       }
   }
}
