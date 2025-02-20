<?php

namespace App\Http\Controllers\Backend\Statistique;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        // Boissons les plus vendues
        $topDrinks = Produit::withSum('sales', 'quantity')
            ->orderBy('sales_sum_quantity', 'desc')
            ->take(5)
            ->get();

        // Emballages les plus utilisés
        $topPackagings = Produit::select('packaging', Produit::raw('SUM(quantity) as total_quantity'))
            ->groupBy('packaging')
            ->orderBy('total_quantity', 'desc')
            ->take(5)
            ->get();

        return view('statistics.index', compact('topDrinks', 'topPackagings'));
    }
}
