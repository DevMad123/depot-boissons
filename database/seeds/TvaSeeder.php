<?php

namespace Database\Seeders;

use App\Models\Tva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tvar = [['taux' => '18', 'symbol' => '%', 'status' => true], ['taux' => '16', 'symbol' => '%', 'status' => false], ['taux' => '14', 'symbol' => '%', 'status' => false], ['taux' => '6', 'symbol' => '%', 'status' => false], ['taux' => '15', 'symbol' => '%', 'status' => false], ['taux' => '9', 'symbol' => '%', 'status' => false]];
        foreach ($tvar as $tvas) {
            $tva = new Tva();
            $tva->taux = $tvas['taux'];
            $tva->symbol = $tvas['symbol'];
            $tva->status = $tvas['status'];
            $tva->save();
        }
    }
}
