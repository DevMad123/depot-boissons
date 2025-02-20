<?php

namespace App\Http\Controllers\Backend\Typeproduit;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeProduitRequest;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typeproduit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeproduitController extends Controller
{
   // Afficher la liste des types de produits ( Ex: Sucrerie,Bière etc.)
   public function index()
   {
       $this->checkAuthorization(auth()->user(), ['admin.view']);
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
       return view('backend.pages.typeproduit.index', [
        'typeproduit' => Typeproduit::orderBy('created_at', 'desc')->get(),
    ]);
   }
   public function create(): Renderable
   {
       $this->checkAuthorization(auth()->user(), ['admin.create']);
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

       return view('backend.pages.typeproduit.create', [
           'typeproduit' => Typeproduit::all(),
       ]);
   }
   public function store(StoreTypeProduitRequest $request): RedirectResponse
   {
       $this->checkAuthorization(auth()->user(), ['admin.create']);
           
        $typeproduits = new Typeproduit();
        $typeproduits->libelle =  ucwords(strtolower($request->libelle));
        $typeproduits->save();

       if ($request->roles) {
           $typeproduits->assignRole($request->roles);
       }

       session()->flash('success', __('Taille enregistré avec succès.'));
       return redirect()->route('admin.typeproduits.index');
   }


   public function destroy(int $id): RedirectResponse
   {
       $this->checkAuthorization(auth()->user(), ['admin.delete']);

       $typeproduits = Typeproduit::findOrFail($id);
       $typeproduits->delete();
       session()->flash('error', 'Type de produit supprimer avec succès.');
       return back();
   }
}
