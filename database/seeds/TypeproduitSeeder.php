<?php

namespace Database\Seeders;

use App\Models\Typeproduit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeproduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeproduits = [['libelle' => 'Alcool'], ['libelle' => 'Sucrerie sans Alcool'], ['libelle' => 'Sucrerie avec Alcool']];
        foreach ($typeproduits as $typeproduits) {
            $typeproduit = new Typeproduit();
            $typeproduit->libelle = $typeproduits['libelle'];
            $typeproduit->save();
        }
    }
}
