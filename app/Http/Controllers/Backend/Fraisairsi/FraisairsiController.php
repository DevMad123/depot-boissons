<?php

namespace App\Http\Controllers\Backend\Fraisairsi;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFraisairsiRequest;
use App\Models\Fraisairsi;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FraisairsiController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['fraisairsi.view']);
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
       return view('backend.pages.fraisairsi.index', [
        'fraisairsis' => Fraisairsi::orderBy('status', 'desc')->get(),
    ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['fraisairsi.create']);
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

        return view('backend.pages.fraisairsi.create');
    }
    public function store(StoreFraisairsiRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['fraisairsi.create']);
 
         $fraisairsis = new Fraisairsi();
         $fraisairsis->taux = $request->taux;
         $fraisairsis->symbol = '%';
         $fraisairsis->status = 0;
         $fraisairsis->save();

        if ($request->roles) {
            $fraisairsis->assignRole($request->roles);
        }

        session()->flash('success', __('Frais de port enregistré avec succès.'));
        return redirect()->route('admin.fraisairsis.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['fraisairsi.delete']);
          
        
        $fraisairsis = Fraisairsi::where('status', 1)->get();

       if($fraisairsis->count() > 0){
       
        foreach ($fraisairsis as $fraisairsis) {
            $fraisairsis->status = 0;
            $fraisairsis->save();
        }

        $fraisairsis = Fraisairsi::findOrFail($id);
        $fraisairsis->status = 1;
        $fraisairsis->save();
       }else{
        $fraisairsis = Fraisairsi::findOrFail($id);
        $fraisairsis->status = 1;
        $fraisairsis->save();
       }

        session()->flash('success', 'Frais Airsi active avec succès.');
        return back();
    }
    public function destroys(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['fraisairsi.delete']);

        $fraisairsis = Fraisairsi::findOrFail($id);
        $fraisairsis->delete();
        session()->flash('error', 'Frais Airsi supprimer avec succès.');
        return back();
    }
}
