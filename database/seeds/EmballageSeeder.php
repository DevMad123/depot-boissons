<?php

namespace Database\Seeders;

use App\Models\Emballage;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmballageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emballages = [['matriemb' => 'EMB000001', 'libelle' => 'Casier de 6', 'qte_par_emballage' => 6], ['matriemb' => 'EMB000002', 'libelle' => 'Casier de 12', 'qte_par_emballage' => 12], ['matriemb' => 'EMB000003', 'libelle' => 'Casier de 24', 'qte_par_emballage' => 24], ['matriemb' => 'EMB000004', 'libelle' => 'Carton de 12', 'qte_par_emballage' => 12], ['matriemb' => 'EMB000005', 'libelle' => 'Carton de 24', 'qte_par_emballage' => 24], ['matriemb' => 'EMB000006', 'libelle' => 'Emballage plastique de 12', 'qte_par_emballage' => 12]];
        foreach ($emballages as $emballages) {
            $emballage = new Emballage();
            $emballage->matriemb = $emballages['matriemb'];
            $emballage->libelle = $emballages['libelle'];
            $emballage->qte_par_emballage = $emballages['qte_par_emballage'];
            $emballage->save();
        }
    }
}
