<?php

namespace App\Http\Controllers\Backend\seuilcritique;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeuilcritiqueRequest;
use App\Models\Produit;
use App\Models\Seuilcritique;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class seuilcritiqueController extends Controller
{
    // Afficher la liste des tailles ( Ex: 1L, 0.33 L etc.)
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['seuilcritique.view']);
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
        return view('backend.pages.seuilcritique.index', [
            'seuilcritiques' => Seuilcritique::with(['produit','produit.emballage', 'produit.typeproduit', 'produit.format'])
            ->orderBy('created_at', 'desc')
            ->get(),
        ]);
    }
    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['seuilcritique.create']);
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

        return view('backend.pages.seuilcritique.create', [
            'produits' => Produit::with(['emballage', 'typeproduit', 'format'])
            ->orderBy('created_at', 'desc')
            ->get(),
        ]);
    }
    public function store(StoreSeuilcritiqueRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['admin.create']);
            
         $seuilcritiques = new Seuilcritique();
         $seuilcritiques->produit_id = $request->produit_id;
         $seuilcritiques->seuil_critique = $request->seuilcritique;
         $seuilcritiques->save();

        if ($request->roles) {
            $seuilcritiques->assignRole($request->roles);
        }

        session()->flash('success', __('Seuil de Critique enregistré avec succès.'));
        return redirect()->route('admin.seuilcritiques.index');
    }

    public function edit(int $id1,int $id2): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['seuilcritique.edit']);

        $seuilcritiques = Seuilcritique::findOrFail($id1);
        $produits = Produit::findOrFail($id2);
        return view('backend.pages.seuilcritique.edit', [
            'produits' => $produits,
            'seuilcritiques' => $seuilcritiques,
        ]);
    }
    public function update(Request $request, int $id1, int $id2): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['admin.edit']);

        // $seuilcritiques = Seuilcritique::findOrFail($id1);
        // $produits = Produit::findOrFail($id2);

        $seuilcritiques = Seuilcritique::where('id', $id1)->update(['seuil_critique' => $request->seuilcritique]);

        if ($request->roles) {
            $seuilcritiques->assignRole($request->roles);
        }

        session()->flash('error', 'Seuil de critique modifier avec succès.');
        return redirect()->route('admin.seuilcritiques.index');
    }



}
