<?php

namespace App\Http\Controllers\Backend\Stock;

use App\Http\Controllers\Controller;
use App\Models\Seuilcritique;
use App\Models\Stock;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['stock.view']);
        $traitementventes = TraitementVente::all();
        $counttraitementventes = $traitementventes->count();
        if ($counttraitementventes > 0) {
            $traitementvente = TraitementVente::truncate();
        }
        $traitementclientventes = Traitementclientvente::all();
        $counttraitementclientventes = $traitementclientventes->count();
        if ($counttraitementclientventes > 0) {
            $traitementclientvente = Traitementclientvente::truncate();
        }
        $stocks = Stock::with(['produit'])
            ->orderBy('created_at', 'desc')
            ->get();
        // Récupérer les seuils critiques pour les produits concernés
        $seuilcritiques = Seuilcritique::all();

        return view('backend.pages.stock.index', compact(['stocks', 'seuilcritiques']));
    }
}
