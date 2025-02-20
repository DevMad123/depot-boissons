<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typeclient;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    // Afficher la liste des clients
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['client.view']);
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
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('backend.pages.client.index', compact('clients'));
    }
    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['client.create']);
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
            'typeclients' => Typeclient::all(),
        ]);
    }
    public function store(StoreClientRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['client.create']);
        // Initialiser le chemin de l'image à null
        $path = null;
          //dd($request);
        // Si une image est téléchargée
        // if ($request->hasFile('photo')) {
        //     // Redéfinir le nom de l'image
        //     $imagefile = $request->file('photo');
        //     $newName = Str::uuid() . '.' . $imagefile->getClientOriginalExtension(); // Nom unique
        //     $path = $imagefile->storeAs('uploads/clients', $newName, 'public'); // Stockage avec le nouveau nom
        // }

        /**
         * CODE CLIENT
         */
           // Récupérer le dernier numéro d'incrément de la base de données
           $dernierId = Client::orderBy('id', 'desc')->first();

           // Si une facture existe déjà, incrémenter le dernier numéro, sinon commencer à 1
           $incrementId = $dernierId ? $dernierId->id + 1 : 1;
           // Générer un numéro aléatoire unique à 8 chiffres
        $numeroAleatoire = random_int(10000000, 99999999); 
   
           // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
           $lettres = 'CLT'; // Vous pouvez également générer ceci aléatoirement si nécessaire
           
           // Formater le code avec un numéro à 8 chiffres (en ajoutant des zéros devant si nécessaire)
           $formatNumero = str_pad((string)$incrementId, 6, '0', STR_PAD_LEFT);
   
           // Combiner le préfixe et le numéro formaté
           $NouveauNumMat = $lettres . $numeroAleatoire;
    
         $clients = new Client();
         $clients->matriclient = $NouveauNumMat;
         $clients->nom = strtoupper($request->nom);
         $clients->email = $request->email;
         $clients->telephone = $request->telephone;
         $clients->adresse = $request->adress;
         $clients->solde = $request->solde;
         $clients->exonerertva = $request->fraistva;
         $clients->exonererairsi = $request->fraisairsi;
         $clients->typeclient_id = $request->typeclient_id;
         $clients->image = 'pas d\'imade';
         $clients->save();

        if ($request->roles) {
            $clients->assignRole($request->roles);
        }

        session()->flash('success', __('Client enregistré avec succès.'));
        return redirect()->route('admin.clients.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['client.edit']);

        $admin = Client::findOrFail($id);
        return view('backend.pages.admins.edit', [
            'admin' => $admin,
            'roles' => Role::all(),
        ]);
    }

    public function update(StoreClientRequest $request, int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['client.edit']);

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
        $this->checkAuthorization(auth()->user(), ['client.delete']);

        $client = Client::findOrFail($id);
        $client->delete();
        session()->flash('error', 'Client supprimé avec succès.');
        return back();
    }
}
