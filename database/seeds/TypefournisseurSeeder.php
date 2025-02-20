<?php

namespace Database\Seeders;

use App\Models\Typefournisseur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypefournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifer = [['type' => 'Grande entreprise', 'observation' => 'un grossisse'], ['type' => 'Moyen entreprise', 'observation' => 'Détaillant '], ['type' => 'Grossisse Moyen', 'observation' => 'Grossisse moyen'], ['type' => 'Détaillant Moyen', 'observation' => 'Détaillant moyen']];
        foreach ($tarifer as $tarif) {
            $tarifclientembs = new Typefournisseur();
            $tarifclientembs->type = $tarif['type'];
            $tarifclientembs->observation = $tarif['observation'];
            $tarifclientembs->save();
        }
    }
}
