<?php

namespace App\Http\Controllers\Backend\Tva;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTvaRequest;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Tva;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TvaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['tva.view']);
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
       return view('backend.pages.tva.index', [
        'tvas' => Tva::orderBy('status', 'desc')->get(),
    ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['tva.create']);
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

        return view('backend.pages.tva.create');
    }
    public function store(StoreTvaRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['tva.create']);
 
         $tvas = new Tva();
         $tvas->taux = $request->taux;
         $tvas->symbol = '%';
         $tvas->status = 0;
         $tvas->save();

        if ($request->roles) {
            $tvas->assignRole($request->roles);
        }

        session()->flash('success', __('Tva ajouter avec succès.'));
        return redirect()->route('admin.tvas.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['tva.delete']);
          
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
        $this->checkAuthorization(auth()->user(), ['tva.delete']);

        $tva = Tva::findOrFail($id);
        $tva->delete();
        session()->flash('error', 'Frais de port supprimer avec succès.');
        return back();
    }
}
