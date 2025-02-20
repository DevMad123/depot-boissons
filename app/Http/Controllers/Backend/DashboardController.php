<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Approvisionnement;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Seuilcritique;
use App\Models\Stock;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['dashboard.view']);

        // Récupère l'année et le mois actuels
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        return view('backend.pages.dashboard.index', [
            'total_clients' => Client::count(),
            'total_fournisseurs' => Fournisseur::count(),
            'total_admins' => Admin::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'alertstock' => Stock::with(['produit'])
                ->orderBy('created_at', 'desc')
                ->get(),
            'seuilcritiques' => Seuilcritique::all(),
            'approvisionnement' => Approvisionnement::with(
        'taritypeproduitfournisseur.fournisseur',
        'taritypeproduitfournisseur.produit',
        'taritypeproduitfournisseur.produit.emballage',
        'taritypeproduitfournisseur.produit.format'
    )
    ->whereYear('date_approvisionnement', $currentYear)
    ->whereMonth('date_approvisionnement', $currentMonth)
    ->get(),
        ]);
    }
}
