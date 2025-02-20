<?php

namespace App\Http\Controllers\Backend\Fournisseur;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFournisseurRequest;
use App\Models\Fournisseur;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FournisseurController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['fournisseur.view']);
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
        return view('backend.pages.fournisseur.index', [
         'fournisseurs' => Fournisseur::orderBy('created_at', 'desc')->get(),
     ]);
    }
    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['fournisseur.create']);
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

        return view('backend.pages.fournisseur.create', [
            'fournisseurs' => Fournisseur::all(),
        ]);
    }
    public function store(StoreFournisseurRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['fournisseur.create']);
        // Initialiser le chemin de l'image à null
        // $path = null;

        // // Si une image est téléchargée
        // if ($request->hasFile('logo')) {
        //     // Redéfinir le nom de l'image
        //     $imagefile = $request->file('logo');
        //     $newName = Str::uuid() . '.' . $imagefile->getClientOriginalExtension(); // Nom unique
        //     $path = $imagefile->storeAs('uploads/fournisseurs', $newName, 'public'); // Stockage avec le nouveau nom
        // }
         
         /**
         * CODE CLIENT
         */
           // Récupérer le dernier numéro d'incrément de la base de données
           $dernierId = Fournisseur::orderBy('id', 'desc')->first();

           // Si une facture existe déjà, incrémenter le dernier numéro, sinon commencer à 1
           $incrementId = $dernierId ? $dernierId->id + 1 : 1;
           
        // Générer un numéro aléatoire unique à 8 chiffres
        $numeroAleatoire = random_int(10000000, 99999999); 
   
           // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
           $lettres = 'FRN'; // Vous pouvez également générer ceci aléatoirement si nécessaire
           
           // Formater le code avec un numéro à 8 chiffres (en ajoutant des zéros devant si nécessaire)
           $formatNumero = str_pad((string)$incrementId, 6, '0', STR_PAD_LEFT);
   
           // Combiner le préfixe et le numéro formaté
           $NouveauNumMat = $lettres . $numeroAleatoire;

         $fournisseurs = new Fournisseur();
         $fournisseurs->matrifournisseur =  $NouveauNumMat ;
         $fournisseurs->nom = strtoupper($request->nom);
         $fournisseurs->email = $request->email;
         $fournisseurs->telephone = $request->telephone;
         $fournisseurs->adresse = $request->adress;
         $fournisseurs->solde = $request->solde;
         $fournisseurs->logo = 'pas d\'image';
         $fournisseurs->save();

        if ($request->roles) {
            $fournisseurs->assignRole($request->roles);
        }

        session()->flash('success', __('Fournisseur enregistré avec succès.'));
        return redirect()->route('admin.fournisseurs.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['admin.edit']);

        $admin = Fournisseur::findOrFail($id);
        return view('backend.pages.admins.edit', [
            'admin' => $admin,
            'roles' => Role::all(),
        ]);
    }

    public function update(StoreClientRequest $request, int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['fournisseur.edit']);

        $admin = Fournisseur::findOrFail($id);
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
        $this->checkAuthorization(auth()->user(), ['fournisseur.delete']);

        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();
        session()->flash('error', 'Fournisseur supprimé avec succès.');
        return back();
    }
}
