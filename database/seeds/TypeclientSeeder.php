<?php

namespace Database\Seeders;

use App\Models\Typeclient;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeclientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifer = [['type' => 'Grossisse', 'observation' => 'un grossisse'], ['type' => 'Détaillant', 'observation' => 'Détaillant '], ['type' => 'Grossisse Moyen', 'observation' => 'Grossisse moyen'], ['type' => 'Détaillant Moyen', 'observation' => 'Détaillant moyen']];
        foreach ($tarifer as $tarif) {
            $tarifclientembs = new Typeclient();
            $tarifclientembs->type = $tarif['type'];
            $tarifclientembs->observation = $tarif['observation'];
            $tarifclientembs->save();
        }
    }
}
