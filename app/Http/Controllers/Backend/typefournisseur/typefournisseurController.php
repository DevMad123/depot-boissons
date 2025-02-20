<?php

namespace App\Http\Controllers\Backend\typefournisseur;

use App\Http\Controllers\Controller;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typefournisseur;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class typefournisseurController extends Controller
{
   // Afficher la liste des clients
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
       $typefournisseurs = Typefournisseur::orderBy('created_at', 'desc')->get();
       return view('backend.pages.typefournisseur.index', compact('typefournisseurs'));
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

       return view('backend.pages.client.create', [
           'clients' => Client::all(),
       ]);
   }
   public function store(StoreClientRequest $request): RedirectResponse
   {
       $this->checkAuthorization(auth()->user(), ['admin.create']);
       // Initialiser le chemin de l'image à null
       $path = null;

       // Si une image est téléchargée
       if ($request->hasFile('photo')) {
           // Redéfinir le nom de l'image
           $imagefile = $request->file('photo');
           $newName = Str::uuid() . '.' . $imagefile->getClientOriginalExtension(); // Nom unique
           $path = $imagefile->storeAs('uploads/clients', $newName, 'public'); // Stockage avec le nouveau nom
       }
   
        $clients = new Client();
        $clients->nom = $request->nom.' '.$request->prenom;
        $clients->email = $request->email;
        $clients->telephone = $request->telephone;
        $clients->adresse = $request->adresse;
        $clients->solde = $request->solde;
        $clients->image = $path;
        $clients->save();

       if ($request->roles) {
           $clients->assignRole($request->roles);
       }

       session()->flash('success', __('Client enregistré avec succès.'));
       return redirect()->route('admin.clients.index');
   }

   public function edit(int $id): Renderable
   {
       $this->checkAuthorization(auth()->user(), ['admin.edit']);

       $admin = Client::findOrFail($id);
       return view('backend.pages.admins.edit', [
           'admin' => $admin,
           'roles' => Role::all(),
       ]);
   }

   public function update(StoreClientRequest $request, int $id): RedirectResponse
   {
       $this->checkAuthorization(auth()->user(), ['admin.edit']);

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
       $this->checkAuthorization(auth()->user(), ['admin.delete']);

       $typefournisseurs = Typefournisseur::findOrFail($id);
       $typefournisseurs->delete();
       session()->flash('error', 'Type Fournisseur supprimé avec succès.');
       return back();
   }
}
