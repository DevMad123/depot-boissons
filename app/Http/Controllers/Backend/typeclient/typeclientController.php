<?php

namespace App\Http\Controllers\Backend\typeclient;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeclientRequest;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Typeclient;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class typeclientController extends Controller
{
    // Afficher la liste des clients
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['typeclient.view']);
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
        $typeclients = Typeclient::orderBy('created_at', 'desc')->get();
        return view('backend.pages.typeclient.index', compact('typeclients'));
    }
    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['typeclient.create']);
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

        return view('backend.pages.typeclient.create');
    }
    public function store(StoreTypeclientRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['typeclient.create']);
        
         $typeclients = new Typeclient();
         $typeclients->type = $request->typeclient;
         $typeclients->observation = $request->observation;
         $typeclients->save();

        if ($request->roles) {
            $typeclients->assignRole($request->roles);
        }

        session()->flash('success', __('Client enregistré avec succès.'));
        return redirect()->route('admin.typeclients.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['typeclient.edit']);

        $admin = Client::findOrFail($id);
        return view('backend.pages.admins.edit', [
            'admin' => $admin,
            'roles' => Role::all(),
        ]);
    }

    public function update(StoreClientRequest $request, int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['typeclient.edit']);

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
        $this->checkAuthorization(auth()->user(), ['typeclient.delete']);

        $typeclients = Typeclient::findOrFail($id);
        $typeclients->delete();
        session()->flash('error', 'Type Client supprimé avec succès.');
        return back();
    }
}
