<?php

namespace App\Http\Controllers\Backend\Approvisionnement;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApprovisionnementRequest;
use App\Models\Approvisionnement;
use App\Models\Emballage;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Tariftypeproduitfournisseur;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['approvisionnement.view']);
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

        return view('backend.pages.approvisionnement.index', [
            'approvisionnement' =>  Approvisionnement::with('taritypeproduitfournisseur.fournisseur', 'taritypeproduitfournisseur.produit', 'taritypeproduitfournisseur.produit.emballage', 'taritypeproduitfournisseur.produit.format')->get(),
        
        ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['approvisionnement.create']);
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

        return view('backend.pages.approvisionnement.create', [
            'produits' => Produit::all(),
            'tariftypeproduitfournisseurs' => Tariftypeproduitfournisseur::all(),
        ]);
    }

    public function store(StoreApprovisionnementRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['approvisionnement.create']);

        //$totalPrice = $request->quantite * $request->prix_achat;

        $approvisionnements = new Approvisionnement();

        $produit = Produit::where('id', $request->produit_id)->first();

        //$quantiteEmballage = Emballage::where('id', $produit->emballage_id)->first();

        $approvisionnementStock = $request->quantite;

        $approvisionnements->tariftypeproduitfournisseur_id  = $request->tariftypeproduitfournisseur_id;
        $approvisionnements->quantite =  $approvisionnementStock;
        $approvisionnements->date_approvisionnement = \Carbon\Carbon::parse($request->date_approvisionnement)->format('Y-m-d H:i');
        $approvisionnements->save();

        // Ajouter l'approvisionnement au stock
        // Vérifier si le produit existe déjà dans le stock
        $stock = Stock::where('produit_id', $request->produit_id)->first();
        if ($stock) {
            // Si le produit existe dans le stock, ajouter la quantité
            $stock->quantite_disponible += $approvisionnementStock;
            $stock->save();
        }

        if ($request->roles) {
            $approvisionnements->assignRole($request->roles);
        }

        session()->flash('success', __('Approvisionnement éffectué avec succès.'));
        return redirect()->route('admin.approvisionnements.index');
    }
    public function gettypefournisseur($id)
    {
        // Récupérer tous les enregistrements correspondants avec leur relation
        $tariftypeproduitfournisseurs = Tariftypeproduitfournisseur::with(['fournisseur'])->where('produit_id', $id)->get();

        // Vérifier si la collection est vide
        if ($tariftypeproduitfournisseurs->isEmpty()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Type fournisseur introuvable.',
                ],
                404,
            );
        }

        // Extraire les `typefournisseur` de chaque élément
        $typefournisseurs = $tariftypeproduitfournisseurs->map(function ($item) {
            return [
                'id' => $item->id,
                'fournisseur_id' => $item->fournisseur->id,
                'nom' => $item->fournisseur->nom,
                'tarif' => $item->tarifliquide,
            ];
        });

        return response()->json([
            'success' => true,
            'fournisseurs' => $typefournisseurs,
        ]);
    }

    public function show($id)
    {
        $approvisionnement = Approvisionnement::find($id);

        if (!$approvisionnement) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Approvisionnement introuvable.',
                ],
                404,
            );
        }

        return response()->json([
            'success' => true,
            'data' => $approvisionnement,
        ]);
    }

    public function destroy(Approvisionnement $approvisionnement)
    {
        dd($approvisionnement);
        // Ajuster le stock avant suppression
        $approvisionnement->produit->stock->decrement('quantite_disponible', $approvisionnement->quantite);
        $approvisionnement->delete();

        return redirect()->route('approvisionnements.index')->with('success', 'Approvisionnement supprimé avec succès.');
    }
}
