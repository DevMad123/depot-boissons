<?php

namespace App\Http\Controllers\Backend\TraitementVente;

use App\Http\Controllers\Controller;
use App\Models\Approvisionnement;
use App\Models\Client;
use App\Models\Emballage;
use App\Models\Fraisairsi;
use App\Models\ParamModepaiement;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Journee;
use App\Models\Tva;
use App\Models\Typeclient;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TraitementVenteClientController extends Controller
{
    //     public function index()
    //    {
    //        $this->checkAuthorization(auth()->user(), ['admin.view']);
    //        $traitementventes = TraitementVente::with('produit')->latest()->get();
    //        return view('backend.pages.traitementventeclients.index', compact('traitementventes'));
    //    }

    //    public function getinfos($id)
    //     {
    //         //$client = Pa::find($id);
    //         dd($id);
    //         if ($client) {
    //             return response()->json([
    //                 'name' => $client->name,
    //                 'email' => $client->email,
    //             ]);
    //         } else {
    //             return response()->json(['error' => 'Client non trouvé'], 404);
    //         }
    //     }

    // Afficher le formulaire pour créer une nouvelle vente

    public function create()
    {
        $this->checkAuthorization(auth()->user(), ['ventes.create']);
        $journeeOuverte = Journee::where('statut', 'ouverte')->exists();
        if (!$journeeOuverte) {
            return redirect()->route('admin.journees.index')->with('error', 'Veuillez ouvrir une journée avant toute operation.');
        }
        return view('backend.pages.traitementventeclient.create', [
            'typeclients' => Typeclient::all(),
            'produits' => Produit::all(),
            'clients' => Client::all(),
            'totalht' => TraitementVente::sum('prix_vente_totalliquide'),
            'tvas' => Tva::where('status', 1)->get(),
            'fraisairsis' => Fraisairsi::where('status', 1)->get(),
            // 'fraisports' => Traitementclientvente::first(),
            'parammodepaiements' => ParamModepaiement::all(),
            'traitementventes' => TraitementVente::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['ventes.create']);
        $journeeOuverte = Journee::where('statut', 'ouverte')->exists();
        if (!$journeeOuverte) {
            return redirect()->route('admin.journees.index')->with('error', 'Veuillez ouvrir une journée avant toute operation.');
        }
        $numeroAleatoire = random_int(10000000, 99999999);

        // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
        $lettres = 'CLT'; // Vous pouvez également générer ceci aléatoirement si nécessaire


        // Combiner le préfixe et le numéro formaté
        $NouveauNumMat = $lettres . $numeroAleatoire;

        // Logique pour cette nouvelle méthode
        $validated = $request->validate([
            'nom' => 'required|max:50',
            'email' => 'required|max:100|email|unique:clients,email,',
            'telephone' => 'required|max:100',
            'adresse' => 'required|max:100',
            'fraistva' => 'required|max:100',
            'fraisairsi' => 'required|max:100',
            'fraisport' => 'required',
            'typeclient_id' => 'required',
        ]);

        $clients = new Client();

        $clients->matriclient = $NouveauNumMat;
        $clients->nom = strtoupper($request->nom);
        $clients->email = $request->email;
        $clients->telephone = $request->telephone;
        $clients->adresse = $request->adresse;
        $clients->solde = '0';
        $clients->exonerertva = $request->fraistva;
        $clients->exonererairsi = $request->fraisairsi;
        $clients->typeclient_id = $request->typeclient_id;
        $clients->image = 'Null';
        $clients->save();

        //$totalPrice = $request->quantite * $request->prix_achat;

        $traitementclientventes = new Traitementclientvente();

        $traitementclientventes->client_id =  $clients->id;
        $traitementclientventes->fraisport = $request->fraisport;
        $traitementclientventes->save();

        if ($request->roles) {
            $traitementclientventes->assignRole($request->roles);
        }
        return redirect()->route('admin.traitementventes.create');
    }
}
