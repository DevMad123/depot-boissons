<?php

namespace App\Http\Controllers\Backend\Inventaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventaire;
use App\Models\Journee;

class InventaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventaires = Inventaire::all();
        return view('backend.pages.inventaire.index', compact('inventaires'));
    }

    public function inventaireForm($id){

        $journee = Journee::findOrFail($id);
        $inventaires = Inventaire::with('produit')->where('journee_id', $id)->get();

        return view('backend.pages.inventaire.create', compact('journee', 'inventaires'));
    }

    public function inventaireVerification($id){
        $journee = Journee::findOrFail($id);
        $inventaires = Inventaire::with('produit')->where('journee_id', $id)->where('statut', 'to_check')->get();

        return view('backend.pages.inventaire.verification', compact('journee', 'inventaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
