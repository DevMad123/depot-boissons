<?php

namespace App\Http\Controllers\Backend\tariftypeproduitfournisseur;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTariftypeproduitfournisseurRequest;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Tariftypeproduitfournisseur;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typeproduit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TariftypeproduitfournisseurController extends Controller
{
      // Afficher la liste des clients
      public function index()
      {
          $this->checkAuthorization(auth()->user(), ['tariftypeproduitfournisseur.view']);
          $traitementventes = TraitementVente::all(); 
          $counttraitementventes = $traitementventes->count(); 
          if ($counttraitementventes>0) {
          $traitementvente = TraitementVente::truncate();
          }
          $traitementclientventes = Traitementclientvente::all(); 
          $counttraitementclientventes = $traitementclientventes->count(); 
          if ($counttraitementclientventes>0) {
          $traitementclientvente = Traitementclientvente::truncate();
          }
          $tariftypeproduitfournisseurs = Tariftypeproduitfournisseur::with(['fournisseur', 'produit'])
          ->orderBy('created_at', 'desc')
          ->get();
          return view('backend.pages.tariftypeproduitfournisseur.index', compact('tariftypeproduitfournisseurs'));
      }
      public function create(): Renderable
      {
          $this->checkAuthorization(auth()->user(), ['tariftypeproduitfournisseur.create']);
          $traitementventes = TraitementVente::all(); 
          $counttraitementventes = $traitementventes->count(); 
          if ($counttraitementventes>0) {
          $traitementvente = TraitementVente::truncate();
          }
          $traitementclientventes = Traitementclientvente::all(); 
          $counttraitementclientventes = $traitementclientventes->count(); 
          if ($counttraitementclientventes>0) {
          $traitementclientvente = Traitementclientvente::truncate();
          }
  
          return view('backend.pages.tariftypeproduitfournisseur.create', [
            'produit' => Produit::with(['emballage', 'typeproduit', 'format'])
            ->orderBy('created_at', 'desc')
            ->get(),
            'fournisseur' => Fournisseur::all(),
            'typeproduit' => Typeproduit::all(),
          ]);
      }
    
    public function listeproduit(int $id1, int $id2)
{
    $listeproduits = Produit::where('typeproduit_id', $id1)->get();

    if ($listeproduits->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Aucun produit trouvé pour ce type de produit.',
        ], 404);
    }

    $produitsTarifes = Tariftypeproduitfournisseur::whereIn('produit_id', $listeproduits->pluck('id'))
        ->where('fournisseur_id', $id2)
        ->with('produit.format', 'produit.emballage')
        ->get();

    $produitsTarifIds = $produitsTarifes->pluck('produit_id')->toArray();
    $produitsNonTarifes = $listeproduits->reject(fn($produit) => in_array($produit->id, $produitsTarifIds));

    // Ajouter un log pour voir le contenu
    \Log::info('Produits non tarifés :', $produitsNonTarifes->toArray());

    $listeProduitsTarifes = $produitsTarifes->map(function ($tarif) {
        $produit = $tarif->produit;
        return [
            'id' => $produit->id,
            'matriproduit' => $produit->matriproduit,
            'libelle' => trim("{$produit->libelle} " . ($produit->format->format ?? '') . " " . ($produit->emballage->libelle ?? '')),
            'tarifliquide' => $tarif->tarifliquide ?? '',
        ];
    })->toArray(); // Convertir en tableau

    $listeProduitsNonTarifes = $produitsNonTarifes->map(function ($produit) {
        return [
            'id' => $produit->id,
            'matriproduit' => $produit->matriproduit,
            'libelle' => trim("{$produit->libelle} " . ($produit->format->format ?? '') . " " . ($produit->emballage->libelle ?? '')),
            'tarifliquide' => '', // Pas de tarif
        ];
    })->toArray(); // Convertir en tableau

    return response()->json([
        'success' => true,
        'listeProduitsTarifes' => $listeProduitsTarifes,
        'listeProduitsNonTarifes' => $listeProduitsNonTarifes,
    ]);
}
  
public function store(StoreTariftypeproduitfournisseurRequest $request): RedirectResponse
{
    $this->checkAuthorization(auth()->user(), ['tariftypeproduitclient.create']);

    // Vérifier si `fournisseur_id` est présent
    if (!$request->filled('fournisseur_id')) {
        return redirect()->back()->with('error', __('Fournisseur requis.'));
    }

    if (!is_array($request->produit_id) || !is_array($request->tarifliquide)) {
        return redirect()->back()->with('error', __('Données invalides.'));
    }

    foreach ($request->produit_id as $index => $produitId) {
        // Vérifier si le tarif existe déjà pour ce produit et ce type de client
        $tarif = Tariftypeproduitfournisseur::where('fournisseur_id', $request->fournisseur_id)
            ->where('produit_id', $produitId)
            ->first();

        if ($tarif) {
            // Si le tarif existe, on met à jour
            $tarif->tarifliquide = $request->tarifliquide[$index];
        } else {
            // Sinon, on crée un nouveau tarif
            $tarif = new Tariftypeproduitfournisseur();
 
            
             $tarif->fournisseur_id  = $request->fournisseur_id;
             $tarif->produit_id = $produitId;
             $tarif->tarifliquide  = $request->tarifliquide[$index] ;
             $tarif->save();

    
        }

        // Sauvegarde de l'enregistrement
        $tarif->save();
    }

    session()->flash('success', __('Tarifs enregistrés ou mis à jour avec succès.'));
    return redirect()->route('admin.tariftypeproduitfournisseurs.index');
}

      public function edit(int $id): Renderable
      {
          $this->checkAuthorization(auth()->user(), ['tariftypeproduitfournisseur.edit']);
  
          $admin = Client::findOrFail($id);
          return view('backend.pages.admins.edit', [
              'admin' => $admin,
              'roles' => Role::all(),
          ]);
      }
  
      public function update(StoreClientRequest $request, int $id): RedirectResponse
      {
          $this->checkAuthorization(auth()->user(), ['tariftypeproduitfournisseur.edit']);
  
          $admin = Client::findOrFail($id);
          $admin->name = $request->name;
          $admin->email = $request->email;
          $admin->username = $request->username;
          if ($request->password) {
              $admin->password = Hash::make($request->password);
          }
          $admin->save();
  
          $admin->roles()->detach();
          if ($request->roles) {
              $admin->assignRole($request->roles);
          }
  
          session()->flash('success', 'Admin has been updated.');
          return back();
      }
  
      public function destroy(int $id): RedirectResponse
      {
          $this->checkAuthorization(auth()->user(), ['tariftypeproduitfournisseur.delete']);
  
          $tariftypeproduitfournisseurs = Tariftypeproduitfournisseur::findOrFail($id);
          $tariftypeproduitfournisseurs->delete();
          session()->flash('error', 'Tarif type produit fournisseur supprimé avec succès.');
          return back();
      }
}
