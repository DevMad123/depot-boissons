<?php

namespace App\Http\Controllers\Backend\Emballage;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmballageRequest;
use App\Models\Emballage;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EmballageController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['emballage.view']);
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
       return view('backend.pages.emballage.index', [
        'emballages' => Emballage::orderBy('created_at', 'desc')->get(),
    ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['emballage.create']);
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

        return view('backend.pages.emballage.create', [
            'emballages' => Emballage::all(),
        ]);
    }
    public function store(StoreEmballageRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['emballage.create']);
         /**
         * CODE PRODUIT
         */
           // Récupérer le dernier numéro d'incrément de la base de données
           $dernierId = Emballage::orderBy('id', 'desc')->first();

           // Si une facture existe déjà, incrémenter le dernier numéro, sinon commencer à 1
           $incrementId = $dernierId ? $dernierId->id + 1 : 1;
            // Générer un numéro aléatoire unique à 8 chiffres
         $numeroAleatoire = random_int(10000000, 99999999); 
   
           // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
           $lettres = 'EMB'; // Vous pouvez également générer ceci aléatoirement si nécessaire
           
           // Formater le code avec un numéro à 8 chiffres (en ajoutant des zéros devant si nécessaire)
           $formatNumero = str_pad((string)$incrementId, 6, '0', STR_PAD_LEFT);
   
           // Combiner le préfixe et le numéro formaté
           $NouveauNumMat = $lettres . $numeroAleatoire;
            /**
             * END CODE PRODUIT
             */
            
         $emballages = new Emballage();
         $emballages->matriemb = $NouveauNumMat;
         $emballages->libelle = $request->libelle.' de '.$request->qte_par_emballage;
         $emballages->qte_par_emballage = $request->qte_par_emballage;
         $emballages->save();

        if ($request->roles) {
            $emballages->assignRole($request->roles);
        }

        session()->flash('success', __('Emballage enregistré avec succès.'));
        return redirect()->route('admin.emballages.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['emballage.delete']);

        $emballage = Emballage::findOrFail($id);
        $emballage->delete();
        session()->flash('error', 'Emballage supprimer avec succès.');
        return back();
    }
}
