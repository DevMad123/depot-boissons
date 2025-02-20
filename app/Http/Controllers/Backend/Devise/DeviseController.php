<?php

namespace App\Http\Controllers\Backend\Devise;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeviseRequest;
use App\Models\Devise;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviseController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['devise.view']);
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
       return view('backend.pages.devise.index', [
        'devise' => Devise::orderBy('status', 'desc')->get(),
    ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['devise.create']);
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
        return view('backend.pages.devise.create');
    }
    public function store(StoreDeviseRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['devise.create']);
 
         $devises = new Devise();
         $devises->libelle = $request->libelle;
         $devises->code_devise = $request->code_devise;
         $devises->status = 0;
         $devises->save();

        if ($request->roles) {
            $devises->assignRole($request->roles);
        }

        session()->flash('success', __('Devise ajouter avec succès.'));
        return redirect()->route('admin.devises.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['devise.delete']);
          
        $devises = Devise::where('status', 1)->get();

       if($devises->count() > 0){
       
        foreach ($devises as $devise) {
            $devise->status = 0;
            $devise->save();
        }

        $devises = Devise::findOrFail($id);
        $devises->status = 1;
        $devises->save();
       }else{
        $devises = Devise::findOrFail($id);
        $devises->status = 1;
        $devises->save();
       }

       
        

       
        session()->flash('success', 'Tva active avec succès.');
        return back();
    }
    public function destroys(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['devise.delete']);

        $devises = FraisPort::findOrFail($id);
        $devises->delete();
        session()->flash('error', 'Frais de port supprimer avec succès.');
        return back();
    }
}
