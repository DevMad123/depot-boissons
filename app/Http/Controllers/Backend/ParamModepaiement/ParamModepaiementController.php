<?php

namespace App\Http\Controllers\Backend\ParamModepaiement;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParamModepaiementRequest;
use App\Models\ParamModepaiement;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParamModepaiementController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['mode_paiement.view']);
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
       return view('backend.pages.parammodepaiement.index', [
        'parammodepaiement' => ParamModepaiement::orderBy('created_at', 'desc')->get(),
    ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['mode_paiement.create']);
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

        return view('backend.pages.parammodepaiement.create');
    }
    public function store(StoreParamModepaiementRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['mode_paiement.create']);
         $parammodepaiements = new ParamModepaiement();
         $parammodepaiements->mode_paiement = $request->mode_paiement;
         $parammodepaiements->categorie = $request->categorie;
         $parammodepaiements->save();

        if ($request->roles) {
            $parammodepaiements->assignRole($request->roles);
        }

        session()->flash('success', __('Mode de paiement  ajouteée avec succès.'));
        return redirect()->route('admin.parammodepaiements.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['mode_paiement.delete']);
          
        $tvas = Tva::where('status', 1)->get();

       if($tvas->count() > 0){
       
        foreach ($tvas as $tva) {
            $tva->status = 0;
            $tva->save();
        }

        $tvas = Tva::findOrFail($id);
        $tvas->status = 1;
        $tvas->save();
       }else{
        $tvas = Tva::findOrFail($id);
        $tvas->status = 1;
        $tvas->save();
       }

       
        

       
        session()->flash('success', 'Tva active avec succès.');
        return back();
    }
    public function destroys(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['mode_paiement.delete']);

        $fraisports = FraisPort::findOrFail($id);
        $fraisports->delete();
        session()->flash('error', 'Frais de port supprimer avec succès.');
        return back();
    }
}
