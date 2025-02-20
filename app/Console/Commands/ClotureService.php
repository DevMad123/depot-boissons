<?php

namespace App\Console\Commands;

use App\Models\Cloture;
use App\Models\vente;
use Illuminate\Console\Command;

class ClotureService extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clôture les transactions de la journée';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->toDateString();

        $totalSales = vente::whereDate('created_at', $today)->sum('total');
        $totalPurchases = Replenishment::whereDate('created_at', $today)->sum('total');

        Cloture::create([
            'date' => $today,
            'total_sales' => $totalSales,
            'total_purchases' => $totalPurchases,
        ]);

        $this->info('Journée clôturée avec succès.');
    }
}
