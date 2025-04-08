<?php

namespace App\Http\Controllers\Backend\TraitementVente;

use App\Http\Controllers\Controller;
use App\Models\Traitementclientvente;
use App\Models\Journee;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TraitementVenteClientdefiniController extends Controller
{


      public function store(Request $request): RedirectResponse
      {

          $this->checkAuthorization(auth()->user(), ['ventes.create']);
        $journeeOuverte = Journee::where('statut', 'ouverte')->exists();
        if (!$journeeOuverte) {
            return redirect()->route('admin.journees.index')->with('error', 'Veuillez ouvrir une journée avant toute operation.');
        }
           // Logique pour cette nouvelle méthode
    $validated = $request->validate([
        'client_id' => 'required',
        'fraisport' => 'required',

    ]);


          //$totalPrice = $request->quantite * $request->prix_achat;

          $traitementclientventes = new Traitementclientvente();

          $traitementclientventes->client_id = $request->client_id;
          $traitementclientventes->fraisport = $request->fraisport;
          $traitementclientventes->save();

         if ($request->roles) {
             $traitementclientventes->assignRole($request->roles);
         }
         return redirect()->route('admin.traitementventes.create');

      }




}
