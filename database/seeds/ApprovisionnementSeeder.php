<?php

namespace Database\Seeders;

use App\Models\Approvisionnement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovisionnementSeeder extends Seeder
{ 
    /**
    * Run the database seeds.
    */
   public function run(): void
   {
       // Liste des données à insérer
       $approvisionnements = [
           [
               'tariftypeproduitfournisseur_id' => 3,
               'quantite' => 5,
               'date_approvisionnement'=> now(),
           ],
           [
              'tariftypeproduitfournisseur_id' => 4,
               'quantite' => 10,
               'date_approvisionnement'=> now(),
           ]
       ];

       // Boucle pour insérer les données
       foreach ($approvisionnements as $data) {
           $approvisionnement = new Approvisionnement();
           $approvisionnement->fill($data); // Utilise la méthode fill pour assigner les données
           $approvisionnement->save(); // Sauvegarde l'instance dans la base de données
       }
   }
}
