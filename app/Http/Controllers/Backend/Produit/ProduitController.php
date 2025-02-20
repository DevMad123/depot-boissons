<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend\Produit;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduitRequest;
use App\Models\Emballage;
use App\Models\Format;
use App\Models\Produit;
use App\Models\Seuilcritique;
use App\Models\Stock;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typeproduit;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        
        $this->checkAuthorization(auth()->user(), ['produit.view']);
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
        $produit = Produit::with(['emballage', 'typeproduit', 'format'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.pages.produits.index', compact('produit'));
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['produit.create']);
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
        return view('backend.pages.produits.create', [
            'emballages' => Emballage::all(),
            'typeproduits' => Typeproduit::all(),
            'formats' => Format::all(),
        ]);
    }
    public function store(StoreProduitRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['produit.create']);


        /**
         * CODE PRODUIT
         */
           // Récupérer le dernier numéro d'incrément de la base de données
        $dernierId = Produit::orderBy('id', 'desc')->first();

        // Si une facture existe déjà, incrémenter le dernier numéro, sinon commencer à 1
        $incrementId = $dernierId ? $dernierId->id + 1 : 1;
         // Générer un numéro aléatoire unique à 8 chiffres
         $numeroAleatoire = random_int(10000000, 99999999); 

        // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
        $lettres = 'PRD'; // Vous pouvez également générer ceci aléatoirement si nécessaire
        
        // Formater le code avec un numéro à 8 chiffres (en ajoutant des zéros devant si nécessaire)
        $formatNumero = str_pad((string)$incrementId, 6, '0', STR_PAD_LEFT);

        // Combiner le préfixe et le numéro formaté
        $NouveauNumMat = $lettres . $numeroAleatoire;
         /**
          * END CODE PRODUIT
          */

        $produits = new Produit();
        $produits->matriproduit = $NouveauNumMat;
        $produits->libelle = ucwords(strtolower($request->libelle));
        $produits->emballage_id = $request->emballage;
        $produits->typeproduit_id = $request->typeproduit;
        $produits->format_id = $request->taille;
        $produits->save();

        //  ENREGISTREMENT DU PRODUIT DANS STOCK
        $stocks = new Stock();
        $stocks->produit_id = $produits->id;
        $stocks->quantite_disponible = 0;
        $stocks->save();
        //  ENREGISTREMENT SEUIL CRITIQUE DU PRODUIT DANS STOCK
        $seuilcritiques = new Seuilcritique();
        $seuilcritiques->produit_id = $produits->id;
        $seuilcritiques->seuil_critique = 0;
        $seuilcritiques->save();

        if ($request->roles) {
            $produits->assignRole($request->roles);
        }

        session()->flash('success', __('Produit enregistré avec succès.'));
        return redirect()->route('admin.produits.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['produit.edit']);

        $admin = Client::findOrFail($id);
        return view('backend.pages.admins.edit', [
            'admin' => $admin,
            'roles' => Role::all(),
        ]);
    }

    public function update(StoreClientRequest $request, int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['produit.edit']);

        $admin = Produit::findOrFail($id);
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
        $this->checkAuthorization(auth()->user(), ['produit.delete']);

        $produits = Produit::findOrFail($id);
        $produits->delete();
        session()->flash('error', 'Produit supprimé avec succès.');
        return back();
    }
}
