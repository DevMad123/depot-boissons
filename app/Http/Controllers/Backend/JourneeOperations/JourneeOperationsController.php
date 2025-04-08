<?php

namespace App\Http\Controllers\Backend\JourneeOperations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journee;
use App\Models\JourneeOperations;

class JourneeOperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['journees.view']);

        $journee = Journee::where('statut', 'ouverte')->first();
        if (!$journee) {
            return view('backend.pages.journeeOperations.index', [
                'operations' => collect(),
                'emptyMessage' => 'Aucune journée n\'est actuellement ouverte.',
            ]);
        }else{
            $operations = JourneeOperations::where('journee_id', $journee->id)->get();
            return view('backend.pages.journeeOperations.index', compact('operations', 'journee'));
        }
    }

    public function operationsParJourneeId(int $id)
    {
        $operations = JourneeOperations::with(['user', 'produit'])->where('journee_id', $id)->get();

        if ($operations->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune opérations trouvé pour cette journée.',
            ], 404);
        }

        $listeOperations = $operations->map(function ($operation) {
            return [
                'id' => $operation->id,
                'user' => $operation->user->name,
                'produit' => $operation->produit->libelle,
                'type_operation' => $operation->type_operation,
                'quantite' => $operation->quantite,
                'montant' => $operation->montant,
                'created_at' => $operation->created_at,
            ];
        })->toArray();

        return response()->json([
            'success' => true,
            'listeOperations' => $listeOperations,
        ]);
    }

    public function all(){
        // dd('kjhskjfhskdj');
        $journees = Journee::all();
        return view('backend.pages.journeeOperations.index', ['journees' => $journees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('kjhskjfhskdj');
        $journees = Journee::all();
        return view('backend.pages.journeeOperations.new', ['journees' => $journees]);
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
