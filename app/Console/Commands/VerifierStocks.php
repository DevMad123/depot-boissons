<?php

namespace App\Console\Commands;

use App\Models\Stock;
use Illuminate\Console\Command;

class VerifierStocks extends Command
{
    protected $signature = 'stocks:verifier';
    protected $description = 'Vérifie les stocks faibles et envoie des alertes.';

    public function handle()
    {
        $stocksCritiques = Stock::whereColumn('quantite_disponible', '<', 'seuil_critique')->get();

        if ($stocksCritiques->isEmpty()) {
            $this->info('Aucun stock critique détecté.');
        } else {
            foreach ($stocksCritiques as $stock) {
                // Logique pour alerter (par email, notification, etc.)
                $this->warn("Stock faible détecté : {$stock->produit->nom} ({$stock->quantite_disponible} restants)");
            }
        }
    }
}
