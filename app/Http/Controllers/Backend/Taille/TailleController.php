<?php

namespace App\Http\Controllers\Backend\Taille;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTailleRequest;
use App\Models\Format;
use App\Models\Taille;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TailleController extends Controller
{
    // Afficher la liste des tailles ( Ex: 1L, 0.33 L etc.)
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
        return view('backend.pages.taille.index', [
            'formats' => Format::orderBy('created_at', 'desc')->get(),
        ]);
    }
    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['format.create']);
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

        return view('backend.pages.taille.create', [
            'tailles' => Format::all(),
        ]);
    }
    public function store(StoreTailleRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['format.create']);
            
         $formats = new Format();
         $formats->format = $request->taille.' '.$request->unite;
         $formats->save();

        if ($request->roles) {
            $formats->assignRole($request->roles);
        }

        session()->flash('success', __('Format enregistré avec succès.'));
        return redirect()->route('admin.tailles.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['format.delete']);

        $formats = Format::findOrFail($id);
        $formats->delete();
        session()->flash('error', 'Format supprimer avec succès.');
        return back();
    }
}
