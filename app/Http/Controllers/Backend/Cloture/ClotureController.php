<?php

namespace App\Http\Controllers\Backend\Cloture;

use App\Http\Controllers\Controller;
use App\Models\Cloture;
use Illuminate\Http\Request;

class ClotureController extends Controller
{
    // public function index()
    // {
    //     $clotures = Cloture::orderBy('date_cloture', 'desc')->get();
    //     return view('clotures.index', compact('clotures'));
    // }
    public function index()
   {
       $this->checkAuthorization(auth()->user(), ['admin.view']);
       return view('backend.pages.cloture.index', [
        'clotures' =>Cloture::orderBy('date_cloture', 'desc')->get(),
    ]);
   }

    public function create()
    {
        return view('clotures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_cloture' => 'required|date',
            'total_vente' => 'required|numeric|min:0',
            'total_achat' => 'required|numeric|min:0',
            'observation' => 'nullable|string',
        ]);

        Cloture::create($validated);

        return redirect()->route('clotures.index')->with('success', 'Clôture enregistrée avec succès.');
    }
}
