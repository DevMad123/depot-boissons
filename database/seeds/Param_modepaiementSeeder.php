<?php

namespace Database\Seeders;

use App\Models\ParamModepaiement;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Param_modepaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parammodepaiementss = [['mode_paiement' => 'Espèces', 'categorie' => 'Paiements en espèces'], ['mode_paiement' => 'Wave', 'categorie' => 'Paiements mobiles'], ['mode_paiement' => 'Orange Money', 'categorie' => 'Paiements mobiles'], ['mode_paiement' => 'MTN Mobile Money', 'categorie' => 'Paiements mobiles'], ['mode_paiement' => 'Moov Money', 'categorie' => 'Paiements mobiles'], ['mode_paiement' => 'Carte bancaire Visa', 'categorie' => 'Paiements électroniques et en ligne'], ['mode_paiement' => 'Carte bancaire  Mastercard', 'categorie' => 'Paiements électroniques et en ligne'], ['mode_paiement' => 'Virement bancaire', 'categorie' => 'Paiements bancaires'], ['mode_paiement' => 'Chèque', 'categorie' => 'Paiements bancaires'], ['mode_paiement' => 'Paiement à crédit', 'categorie' => 'Paiements différés ou à crédit']];
        foreach ($parammodepaiementss as $parammodepaiements) {
            $parammodepaiement = new ParamModepaiement();
            $parammodepaiement->mode_paiement = $parammodepaiements['mode_paiement'];
            $parammodepaiement->categorie = $parammodepaiements['categorie'];
            $parammodepaiement->save();
        }
    }
}
