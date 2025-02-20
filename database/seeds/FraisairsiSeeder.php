<?php

namespace Database\Seeders;

use App\Models\Fraisairsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FraisairsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fraisairsir = [['taux' => '5', 'symbol' => '%', 'status' => 1], ['taux' => '3', 'symbol' => '%', 'status' => 0], ['taux' => '2', 'symbol' => '%', 'status' => 0], ['taux' => '6', 'symbol' => '%', 'status' => 0], ['taux' => '15', 'symbol' => '%', 'status' => 0], ['taux' => '9', 'symbol' => '%', 'status' => 0]];
        foreach ($fraisairsir as $fraisairsis) {
            $fraisairsi = new Fraisairsi();
            $fraisairsi->taux = $fraisairsis['taux'];
            $fraisairsi->symbol = $fraisairsis['symbol'];
            $fraisairsi->status = $fraisairsis['status'];
            $fraisairsi->save();
        }
    }
}
