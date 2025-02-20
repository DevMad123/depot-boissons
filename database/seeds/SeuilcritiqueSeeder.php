<?php

namespace Database\Seeders;

use App\Models\Seuilcritique;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeuilcritiqueSeeder extends Seeder
{
    
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des données à insérer
        $seuilcritiques = [
            [
                'produit_id' => 1,
                'seuil_critique' => 5,
            ],
            [
                'produit_id' => 2,
                'seuil_critique' => 10,
            ],
            [
                'produit_id' => 3,
                'seuil_critique' => 5,
            ], [
                'produit_id' => 4,
                'seuil_critique' => 10
            ]
        ];

        // Boucle pour insérer les données
        foreach ($seuilcritiques as $data) {
            $seuilcritique = new Seuilcritique();
            $seuilcritique->fill($data); // Utilise la méthode fill pour assigner les données
            $seuilcritique->save(); // Sauvegarde l'instance dans la base de données
        }
    }
}
