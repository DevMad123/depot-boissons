<?php

namespace App\Http\Controllers\Backend\tariftypeproduitembclient;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTariftypeproduitembclientRequest;
use App\Models\Produit;
use App\Models\Tarifclientemb;
use App\Models\Tariftypeproduitembclient;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typeclient;
use App\Models\Typeproduit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class tariftypeproduitembclientController extends Controller
{
     // Afficher la liste des clients
     public function index()
     {
         $this->checkAuthorization(auth()->user(), ['tariftypeproduitembclient.view']);
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
         $tariftypeproduitembclients = Tariftypeproduitembclient::with(['typeclient', 'produit'])
         ->orderBy('created_at', 'desc')
         ->get();
         return view('backend.pages.tariftypeproduitembclient.index', compact('tariftypeproduitembclients'));
     }
     public function create(): Renderable
     {
         $this->checkAuthorization(auth()->user(), ['tariftypeproduitembclient.create']);
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
 
         return view('backend.pages.tariftypeproduitembclient.create', [
             'produit' => Produit::with(['emballage', 'typeproduit', 'format'])
             ->orderBy('created_at', 'desc')
             ->get(),
             'typeclient' => Typeclient::all(),
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

    $produitsTarifes = Tariftypeproduitembclient::whereIn('produit_id', $listeproduits->pluck('id'))
        ->where('typeclient_id', $id2)
        ->with('produit.format', 'produit.emballage')
        ->get();

    $produitsTarifIds = $produitsTarifes->pluck('produit_id')->toArray();
    $produitsNonTarifes = $listeproduits->reject(fn($produit) => in_array($produit->id, $produitsTarifIds));

    // Ajouter un log pour voir le contenu
    \Log::info('Produits non tarifés :', $produitsNonTarifes->toArray());

    $listeProduitsTarifes = $produitsTarifes->map(function ($tarif) {
        $produit = $tarif->produit;
        $typeemballage = explode(' de', $produit->emballage->libelle)[0];
        return [
            'id' => $produit->id,
            'matriproduit' => $produit->matriproduit,
            'libelle' => trim("{$produit->libelle} " . ($produit->format->format ?? '') . " " . ($produit->emballage->libelle ?? '')),
            'tarifemballage' => $tarif->tarifemballage ?? '',
            'typeemballage' => $typeemballage,
        ];
    })->toArray(); // Convertir en tableau

    $listeProduitsNonTarifes = $produitsNonTarifes->map(function ($produit) {
        $typeemballage = explode(' de', $produit->emballage->libelle)[0];
        return [
            'id' => $produit->id,
            'matriproduit' => $produit->matriproduit,
            'libelle' => trim("{$produit->libelle} " . ($produit->format->format ?? '') . " " . ($produit->emballage->libelle ?? '')),
            'tarifemballage' => '', // Pas de tarif
            'typeemballage' => $typeemballage,
        ];
    })->toArray(); // Convertir en tableau

    return response()->json([
        'success' => true,
        'listeProduitsTarifes' => $listeProduitsTarifes,
        'listeProduitsNonTarifes' => $listeProduitsNonTarifes,
    ]);
}

    
public function store(StoreTariftypeproduitembclientRequest $request): RedirectResponse
{
    $this->checkAuthorization(auth()->user(), ['tariftypeproduitembclient.create']);

    // Vérifier si `typeclient_id` est présent
    if (!$request->filled('typeclient')) {
        return redirect()->back()->with('error', __('Type de client requis.'));
    }

    if (!is_array($request->produit_id) || !is_array($request->tarifemballage)) {
        return redirect()->back()->with('error', __('Données invalides.'));
    }

    foreach ($request->produit_id as $index => $produitId) {
        // Vérifier si le tarif existe déjà pour ce produit et ce type de client
        $tarif = Tariftypeproduitembclient::where('typeclient_id', $request->typeclient)
            ->where('produit_id', $produitId)
            ->first();

        if ($tarif) {
            // Si le tarif existe, on met à jour
            $tarif->tarifemballage = $request->tarifemballage[$index];
        } else {
            // Sinon, on crée un nouveau tarif
            $tarif = new Tariftypeproduitembclient();
            $tarif->typeclient_id = $request->typeclient;
            $tarif->produit_id = $produitId;
            $tarif->tarifemballage = $request->tarifemballage[$index];
        }

        // Sauvegarde de l'enregistrement
        $tarif->save();
    }

    session()->flash('success', __('Tarifs enregistrés ou mis à jour avec succès.'));
    return redirect()->route('admin.tariftypeproduitembclients.index');
}

 
     public function edit(int $id): Renderable
     {
         $this->checkAuthorization(auth()->user(), ['tariftypeproduitembclient.edit']);
 
         $admin = Client::findOrFail($id);
         return view('backend.pages.admins.edit', [
             'admin' => $admin,
             'roles' => Role::all(),
         ]);
     }
 
     public function update(StoreClientRequest $request, int $id): RedirectResponse
     {
         $this->checkAuthorization(auth()->user(), ['tariftypeproduitembclient.edit']);
 
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
         $this->checkAuthorization(auth()->user(), ['tariftypeproduitembclient.delete']);
 
         $tariftypeproduitembclients = Tariftypeproduitembclient::findOrFail($id);
         $tariftypeproduitembclients->delete();
         session()->flash('error', 'TTPEC supprimé avec succès.');
         return back();
     }
}
