<?php

namespace App\Http\Controllers\Backend\TraitementVente;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTraitementVenteRequest;
use App\Http\Requests\StoreTraitementVenteValiderRequest;
use App\Models\Approvisionnement;
use App\Models\Client;
use App\Models\Emballage;
use App\Models\Fraisairsi;
use App\Models\ParamModepaiement;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Tariftypeproduitclient;
use App\Models\Tariftypeproduitembclient;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Tva;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TraitementVenteController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['admin.view']);
        $traitementventes = TraitementVente::with(['produit', 'tariftypeproduitclient', 'tariftypeproduitembclient'])
            ->latest()
            ->get();
        return view('backend.pages.traitementventes.index', compact('traitementventes'));
    }

    public function gettarifproduitclient($id)
    {
        $client_id = Traitementclientvente::first(); // Récupère le premier enregistrement
        $clientinfos = Client::where('id', $client_id['client_id'])->first(); // Récupère un seul client

        // Récupérer les tarifs liés au produit et au type de client
        $tariftypeproduitclients = Tariftypeproduitclient::where([
                ['produit_id', '=', $id],
                ['typeclient_id', '=', $clientinfos->typeclient_id], // Utilisation de la flèche pour accéder à l'attribut
            ])
            ->get();

        // Vérifier si la collection est vide
        if ($tariftypeproduitclients->isEmpty()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Type fournisseur introuvable.',
                ],
                404,
            );
        }

        // Extraire les `typefournisseur` de chaque élément
        $typeclients = $tariftypeproduitclients->map(function ($item) {
            return [
                'id' => $item->id,
                'tarif' => $item->tarifliquide,
            ];
        });

        return response()->json([
            'success' => true,
            'typeclients' => $typeclients,
        ]);
    }

    public function produitcasier($id)
    {
        // Récupérer les tarifs liés au produit et au type de client
        $produits = Produit::with(['emballage'])
            ->where('id', $id)
            ->get();

        // Vérifier si la collection est vide
        if ($produits->isEmpty()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Type fournisseur introuvable.',
                ],
                404,
            );
        }

        // Extraire les `typefournisseur` de chaque élément
        $produit = $produits->map(function ($item) {
            // Extraire uniquement la première partie avant "de"
            $emballage = explode(' de', $item->emballage->libelle)[0];
            return [
                'id' => $item->id,
                'emballage' => $emballage,
            ];
        });

        return response()->json([
            'success' => true,
            'typeclients' => $produit,
        ]);
    }

    public function prixventeembcasier($id)
    {
        $client_id = Traitementclientvente::first(); // Récupère le premier enregistrement
        $clientinfos = Client::where('id', $client_id['client_id'])->first(); // Récupère un seul client

        // Récupérer les tarifs liés au produit et au type de client
        $tariftypeproduitembclients = Tariftypeproduitembclient::where([
                ['produit_id', '=', $id],
                ['typeclient_id', '=', $clientinfos->typeclient_id], // Utilisation de la flèche pour accéder à l'attribut
            ])
            ->get();

        // Vérifier si la collection est vide
        if ($tariftypeproduitembclients->isEmpty()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Type fournisseur introuvable.',
                ],
                404,
            );
        }

        // Extraire les `typefournisseur` de chaque élément
        $tarifembclients = $tariftypeproduitembclients->map(function ($item) {
            return [
                'id' => $item->id,
                'tarif' => $item->tarifemballage,
            ];
        });

        return response()->json([
            'success' => true,
            'tarifembclients' => $tarifembclients,
        ]);
    }

    public function getinfos($id)
    {
        //$client = Pa::find($id);
        if ($client) {
            return response()->json([
                'name' => $client->name,
                'email' => $client->email,
            ]);
        } else {
            return response()->json(['error' => 'Client non trouvé'], 404);
        }
    }

    // Afficher le formulaire pour créer une nouvelle vente

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['ventes.create']);
        /* return view('backend.pages.traitementvente.create', [
             'produits' => Produit::all(),
             'clients' => Client::all(),
             'totalht' => TraitementVente::sum('prix_vente_totalliquide'),
             'tvas' => Tva::where('status', 1)->get(),
             'fraisairsis' => Fraisairsi::where('status', 1)->get(),
             'clientsinfos' => $clientsinfo,
             'fraisports' => Traitementclientvente::firstOrFail(),
             'parammodepaiements' => ParamModepaiement::all(),
             'traitementventes' => TraitementVente::all(),
         ]);*/
        $client_id = Traitementclientvente::first();
        $clientsinfos = Client::where('id', $client_id['client_id'])->get();
        $produits = Produit::all();
        $clients = Client::all();
        $totalht = TraitementVente::sum('prix_vente_totalliquide');
        $totalhtemb = TraitementVente::sum('prix_vente_totalemb');
        $tvas = Tva::where('status', 1)->get();
        $fraisairsis = Fraisairsi::where('status', 1)->get();
        $fraisports = Traitementclientvente::first();
        $parammodepaiements = ParamModepaiement::all();
        $traitementventes = TraitementVente::all();

        // Puis appelez la vue
        return view('backend.pages.traitementvente.create', compact('produits', 'clientsinfos', 'clients', 'totalht','totalhtemb', 'tvas', 'fraisairsis', 'fraisports', 'parammodepaiements', 'traitementventes'));
    }

    public function store(StoreTraitementVenteRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['ventes.create']);

        $stock = Stock::where('produit_id', $request->produit_id)->first();

        // Récupérer le produit avec son emballage
        $produit = Produit::with('emballage')->find($request->produit_id);

        // Vérifier si le produit et son emballage existent
        if (!$produit || !$produit->emballage) {
            session()->flash('error', 'Produit ou emballage non trouvé.');
            return redirect()->back();
        }

        // Extraire la première partie du libellé de l'emballage
        $emballageCasier = explode(' de', $produit->emballage->libelle)[0];

        if ($emballageCasier === 'Casier') {
            // Vérifier si les champs "quantiteachete" et "quantiteretourne" sont remplis
            if (empty($request->quantiteachete) || empty($request->quantiteretourne)) {
                session()->flash('error', 'Les champs quantiteachete et quantiteretourne sont requis.');
                return redirect()->back();
            }

            // Comparer "quantiteachete" et "quantiteretourne"
            if ($request->quantiteachete > $request->quantiteretourne) {

                // Vérifier si le prix unitaire d'emballage est renseigné
                if (!empty($request->prixventeunitemb)) {
                    
                    // Vérifier si le stock est suffisant
                    if ($stock->quantite_disponible < $request->quantiteachete) {
                        return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
                    }

                    // Récupérer le premier client pour la vente
                    $clientVente = Traitementclientvente::first();
                    if (!$clientVente) {
                        return redirect()->back()->with('error', 'Aucun client associé à cette vente.');
                    }

                    $clientInfos = Client::find($clientVente->client_id);
                    if (!$clientInfos) {
                        return redirect()->back()->with('error', 'Client introuvable.');
                    }


                    // Récupérer les tarifs pour les emballages
                    $tarifTypeProduitEmbClients = Tariftypeproduitembclient::where([['produit_id', '=', $request->produit_id], ['typeclient_id', '=', $clientInfos->typeclient_id]])
                        ->first(); // On suppose qu'il y a un seul enregistrement pertinent

                    if (!$tarifTypeProduitEmbClients) {
                        dd('error');
                        //return redirect()->back()->with('error', 'Tarif pour les emballages introuvable.');
                    }

                    // Vérifier si la relation 'tarif' et 'tarifemballage' existent
                    if ($tarifTypeProduitEmbClients->tarifemballage && isset($tarifTypeProduitEmbClients->tarifemballage)) {
                        $tarifEmb = $tarifTypeProduitEmbClients->tarifemballage; // Accéder à tarifemballage
                    } else {
                        return redirect()->back()->with('error', 'Tarif pour l\'emballage introuvable.');
                    }

                    // Calculer le nombre total de casiers à acheter
                    $nbreTotalCasierAcheter = $request->quantiteachete - $request->quantiteretourne;

                    // Calculer le total hors taxes pour les emballages
                    $totalHtEmb = $tarifEmb * $nbreTotalCasierAcheter;

                    // Récupérer les tarifs pour le liquide
                    $tarifTypeProduitClients = Tariftypeproduitclient::where([['produit_id', '=', $request->produit_id], ['typeclient_id', '=', $clientInfos->typeclient_id]])
                        ->first(); // On suppose qu'il y a un seul enregistrement pertinent

                    if (!$tarifTypeProduitClients) {
                        return redirect()->back()->with('error', 'Tarif pour le liquide introuvable.');
                    }

                    // Vérifier si la relation 'tarif' existe et récupérer le tarifliquide
                    if ($tarifTypeProduitClients->tarifliquide && isset($tarifTypeProduitClients->tarifliquide)) {
                        $totalHtLiquide = $tarifTypeProduitClients->tarifliquide * $request->quantiteachete;
                    } else {
                        return redirect()->back()->with('error', 'Tarif liquide introuvable.');
                    }
                    //dd($tarifEmb .'* '.$nbreTotalCasierAcheter . ' = ' . $totalHtEmb . ' / ' . $tarifTypeProduitClients->tarif->tarifliquide .'*'.$request->quantiteachete .'  ' . $totalHtLiquide);
                    // Enregistrer la vente
                    $traitementVentes = new TraitementVente();
                    $traitementVentes->produit_id = $request->produit_id;
                    $traitementVentes->tariftypeproduitclient_id = $tarifTypeProduitClients->id;
                    $traitementVentes->tariftypeproduitembclient_id = $tarifTypeProduitEmbClients->id;
                    $traitementVentes->quantite = $request->quantiteachete;
                    $traitementVentes->quantite_emb_retour = $request->quantiteretourne;
                    $traitementVentes->prix_vente_totalliquide = $totalHtLiquide;
                    $traitementVentes->prix_vente_totalemb = $totalHtEmb;
                    $traitementVentes->date_vente = \Carbon\Carbon::parse($request->date_vente)->format('Y-m-d');
                    $traitementVentes->save();

                    // Assigner les rôles si fournis
                    if (!empty($request->roles)) {
                        $traitementVentes->assignRole($request->roles);
                    }

                    session()->flash('success', __('Produit ajouté avec succès.'));
                    return redirect()->back();

                } else {
                    session()->flash('error', 'Veillez choisir le prix de vente unitaire de l\'emballage.');
                    return redirect()->back();
                }
            } else {






             // Vérifier si le stock est suffisant
             if ($stock->quantite_disponible < $request->quantiteachete) {
                return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
            }

            // Récupérer le premier client pour la vente
            $clientVente = Traitementclientvente::first();
            if (!$clientVente) {
                return redirect()->back()->with('error', 'Aucun client associé à cette vente.');
            }

            $clientInfos = Client::find($clientVente->client_id);
            if (!$clientInfos) {
                return redirect()->back()->with('error', 'Client introuvable.');
            }


            // Récupérer les tarifs pour les emballages
            $tarifTypeProduitEmbClients = Tariftypeproduitembclient::where([['produit_id', '=', $request->produit_id], ['typeclient_id', '=', $clientInfos->typeclient_id]])
                ->first(); // On suppose qu'il y a un seul enregistrement pertinent

            if (!$tarifTypeProduitEmbClients) {
                //dd('error');
                return redirect()->back()->with('error', 'Tarif pour les emballages de ce produit pour ce type de client introuvable.');
            }

            // Vérifier si la relation 'tarif' et 'tarifemballage' existent
            if ($tarifTypeProduitEmbClients->tarifemballage && isset($tarifTypeProduitEmbClients->tarifemballage)) {
                $tarifEmb = $tarifTypeProduitEmbClients->tarifemballage; // Accéder à tarifemballage
            } else {
                return redirect()->back()->with('error', 'Tarif pour l\'emballage introuvable.');
            }

            // Calculer le nombre total de casiers à acheter
            $nbreTotalCasierAcheter = $request->quantiteachete - $request->quantiteretourne;

            // Calculer le total hors taxes pour les emballages
            $totalHtEmb = $tarifEmb * $nbreTotalCasierAcheter;

            // Récupérer les tarifs pour le liquide
            $tarifTypeProduitClients = Tariftypeproduitclient::where([['produit_id', '=', $request->produit_id], ['typeclient_id', '=', $clientInfos->typeclient_id]])
                ->first(); // On suppose qu'il y a un seul enregistrement pertinent

            if (!$tarifTypeProduitClients) {
                return redirect()->back()->with('error', 'Tarif pour le liquide introuvable.');
            }

            // Vérifier si la relation 'tarif' existe et récupérer le tarifliquide
            if ($tarifTypeProduitClients->tarifliquide && isset($tarifTypeProduitClients->tarifliquide)) {
                $totalHtLiquide = $tarifTypeProduitClients->tarifliquide * $request->quantiteachete;
            } else {
                return redirect()->back()->with('error', 'Tarif liquide introuvable.');
            }
            //dd($tarifEmb .'* '.$nbreTotalCasierAcheter . ' = ' . $totalHtEmb . ' / ' . $tarifTypeProduitClients->tarif->tarifliquide .'*'.$request->quantiteachete .'  ' . $totalHtLiquide);
            // Enregistrer la vente
            $traitementVentes = new TraitementVente();
            $traitementVentes->produit_id = $request->produit_id;
            $traitementVentes->tariftypeproduitclient_id = $tarifTypeProduitClients->id;
            $traitementVentes->tariftypeproduitembclient_id = $tarifTypeProduitEmbClients->id;
            $traitementVentes->quantite = $request->quantiteachete;
            $traitementVentes->quantite_emb_retour = $request->quantiteretourne;
            $traitementVentes->prix_vente_totalliquide = $totalHtLiquide;
            $traitementVentes->prix_vente_totalemb = 0;
            $traitementVentes->date_vente = \Carbon\Carbon::parse($request->date_vente)->format('Y-m-d');
            $traitementVentes->save();

            // Assigner les rôles si fournis
            if (!empty($request->roles)) {
                $traitementVentes->assignRole($request->roles);
            }

            session()->flash('success', __('Produit ajouté avec succès.'));
            return redirect()->back();










                // session()->flash('success', 'Produit sans emballage enregistré.');
                // return redirect()->back();
            }
        } else {




        // Vérifier si le stock est suffisant
        if ($stock->quantite_disponible < $request->quantiteachete) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        // Récupérer le premier client pour la vente
        $clientVente = Traitementclientvente::first();
        if (!$clientVente) {
            return redirect()->back()->with('error', 'Aucun client associé à cette vente.');
        }

        $clientInfos = Client::find($clientVente->client_id);
        if (!$clientInfos) {
            return redirect()->back()->with('error', 'Client introuvable.');
        }


        // Récupérer les tarifs pour les emballages
        $tarifTypeProduitEmbClients = Tariftypeproduitembclient::where([['produit_id', '=', $request->produit_id], ['typeclient_id', '=', $clientInfos->typeclient_id]])
            ->first(); // On suppose qu'il y a un seul enregistrement pertinent

        if (!$tarifTypeProduitEmbClients) {
           // dd('error');
            return redirect()->back()->with('error', 'Tarif pour les emballages pour ce produit non renseigné.');
        }

        // Vérifier si la relation 'tarif' et 'tarifemballage' existent
        if ($tarifTypeProduitEmbClients->tarifemballage && isset($tarifTypeProduitEmbClients->tarifemballage)) {
            $tarifEmb = $tarifTypeProduitEmbClients->tarifemballage; // Accéder à tarifemballage
        } else {
            return redirect()->back()->with('error', 'Tarif pour l\'emballage introuvable.');
        }

        // Calculer le nombre total de casiers à acheter
        $nbreTotalCasierAcheter = $request->quantiteachete - $request->quantiteretourne;

        // Calculer le total hors taxes pour les emballages
        $totalHtEmb = $tarifEmb * $nbreTotalCasierAcheter;

        // Récupérer les tarifs pour le liquide
        $tarifTypeProduitClients = Tariftypeproduitclient::where([['produit_id', '=', $request->produit_id], ['typeclient_id', '=', $clientInfos->typeclient_id]])
            ->first(); // On suppose qu'il y a un seul enregistrement pertinent

        if (!$tarifTypeProduitClients) {
            return redirect()->back()->with('error', 'Tarif pour le liquide introuvable.');
        }

        // Vérifier si la relation 'tarif' existe et récupérer le tarifliquide
        if ($tarifTypeProduitClients->tarifliquide && isset($tarifTypeProduitClients->tarifliquide)) {
            $totalHtLiquide = $tarifTypeProduitClients->tarifliquide * $request->quantiteachete;
        } else {
            return redirect()->back()->with('error', 'Tarif liquide introuvable.');
        }
        //dd($tarifEmb .'* '.$nbreTotalCasierAcheter . ' = ' . $totalHtEmb . ' / ' . $tarifTypeProduitClients->tarif->tarifliquide .'*'.$request->quantiteachete .'  ' . $totalHtLiquide);
        // Enregistrer la vente
        $traitementVentes = new TraitementVente();
        $traitementVentes->produit_id = $request->produit_id;
        $traitementVentes->tariftypeproduitclient_id = $tarifTypeProduitClients->id;
        $traitementVentes->tariftypeproduitembclient_id = NULL;
        $traitementVentes->quantite = $request->quantiteachete;
        $traitementVentes->quantite_emb_retour = $request->quantiteretourne;
        $traitementVentes->prix_vente_totalliquide = $totalHtLiquide;
        $traitementVentes->prix_vente_totalemb = 0;
        $traitementVentes->date_vente = \Carbon\Carbon::parse($request->date_vente)->format('Y-m-d');
        $traitementVentes->save();

        // Assigner les rôles si fournis
        if (!empty($request->roles)) {
            $traitementVentes->assignRole($request->roles);
        }

        session()->flash('success', __('Produit ajouté avec succès.'));
        return redirect()->back();








            // session()->flash('error', 'Autre type d\'emballage.');
            // return redirect()->back();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['ventes.delete']);

        $traitementventes = TraitementVente::findOrFail($id);
        $traitementventes->delete();
        session()->flash('success', 'Produit supprimé avec succès.');
        return back();
    }
    // Stocker une nouvelle vente
    //  public function storeOld(Request $request)
    //  {
    //      $request->validate([
    //          'product_id' => 'required|exists:products,id',
    //          'quantity' => 'required|integer|min:1',
    //      ]);

    //      $product = Produit::findOrFail($request->product_id);
    //      $total_price = $request->quantity * $product->unit_sale_price;

    //      // Vérifier le stock disponible
    //      if ($product->stock->quantity < $request->quantity) {
    //          return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
    //      }

    //      // Créer la vente
    //      $sale = TraitementVente::create([
    //          'product_id' => $request->product_id,
    //          'quantity' => $request->quantity,
    //          'total_price' => $total_price,
    //      ]);

    //      // Réduire le stock
    //      $product->stock->decrement('quantity', $request->quantity);

    //      return redirect()->route('sales.index')->with('success', 'Vente enregistrée avec succès.');
    //  }
}
