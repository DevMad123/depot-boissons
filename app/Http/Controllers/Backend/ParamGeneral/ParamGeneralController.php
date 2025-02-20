<?php

namespace App\Http\Controllers\Backend\ParamGeneral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParamGeneralController extends Controller
{
   
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['admin.view']);
       return view('backend.pages.tva.index', [
        'tvas' => Tva::orderBy('status', 'desc')->get(),
    ]);
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['admin.create']);

        return view('backend.pages.tva.create');
    }
    public function store(StoreTvaRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['admin.create']);
 
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
        $this->checkAuthorization(auth()->user(), ['admin.delete']);
          
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
        $this->checkAuthorization(auth()->user(), ['admin.delete']);

        $fraisports = FraisPort::findOrFail($id);
        $fraisports->delete();
        session()->flash('success', 'Frais de port supprimer avec succès.');
        return back();
    }


}
