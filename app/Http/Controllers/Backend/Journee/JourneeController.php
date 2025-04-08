<?php

namespace App\Http\Controllers\Backend\Journee;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Journee;
use App\Models\Produit;
use App\Models\Inventaire;
use App\Models\JourneeOperations;
use Illuminate\Http\Request;

class JourneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['journees.view']);
        $journees = Journee::with(['user', 'userFermeture'])->orderBy('created_at', 'desc')->get();
        return view('backend.pages.journee.index', compact('journees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $journeeOuverte = Journee::where('statut', 'ouverte')->exists();
        $journeStandby = Journee::where('statut', 'standby')->exists();
        if ($journeeOuverte) {
            return redirect()->back()->withErrors(['error' => ['Impossible d\'ouvrir une journée.','Une journée est déjà ouverte.']]);
        }elseif ($journeStandby) {
            return redirect()->back()->withErrors(['error' => ['Impossible d\'ouvrir une journée.','Une journée est en cours de vérification veuillez contactez le Super administrateur.']]);
        }else{
            if(!$this->store()){
                return redirect()->route('admin.journees.index')->with('success', 'Impossible d\'ouvrir une journée. Une erreur est survenue lors de l\'ouverture de la journée.');
            }
            return redirect()->route('admin.journees.index')->with('success', 'Journée ouverte avec succès.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $derniereJournee = Journee::where('statut', 'fermée')
            ->orderBy('date_ouverture', 'desc')
            ->first();

            $totalEntrees = 0.00;
            $totalSorties = 0.00;
            $soldeFinancier = 0.00;

            if ($derniereJournee) {
                $totalEntrees = $derniereJournee->total_entrees;
                $totalSorties = $derniereJournee->total_sorties;
                $soldeFinancier = $derniereJournee->solde_financier;
            }

            $journee = Journee::create([
                'user_id' => auth()->user()->id,
                'date_ouverture' => now(),
                'statut' => 'ouverte',
                'total_entrees' => $totalEntrees,
                'total_sorties' => $totalSorties,
                'solde_financier' => $soldeFinancier,
            ]);

            $produits = Produit::with('stock')->get();

            foreach ($produits as $produit) {
                $stockProduit = 0;

                if (!$produit->stock->isEmpty()) {
                    foreach ($produit->stock as $stock) {
                        $stockProduit += $stock->quantite_disponible;
                    }
                }

                Inventaire::create([
                    'journee_id' => $journee->id,
                    'produit_id' => $produit->id,
                    'quantite_ouverture' => $stockProduit,
                    'quantite_fermeture' => null,
                    'commentaire' => null,
                ]);
            }
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function close(Request $request, $journee_id, $force = false){

        $statusJournee = 'fermee';
        $date_fermeture = now();

        if($force){
            $request->validate([
                'quantite.*' => 'required|numeric|min:0',
                'observation' => 'nullable|string|max:1000',
            ]);
        }else{
            $request->validate([
                'quantite.*' => 'required|numeric|min:0',
            ]);
        }

        DB::beginTransaction();
        try {
            $journee = Journee::findOrFail($journee_id);
            $total_entrees = 0;
            $total_sorties = 0;

            $quantitesConcordent = true;

            $journee->update([
                'observation' => $request->input('observation'),
            ]);

            foreach ($request->quantite as $inventaireId => $quantiteFermeture) {
                $inventaire = Inventaire::findOrFail($inventaireId);
                $inventaire->update(['quantite_fermeture' => $quantiteFermeture]);

                $operations = JourneeOperations::where('journee_id', $journee_id)->where('produit_id', $inventaire->produit_id)->get();

                $quantite_theorique = $inventaire->quantite_ouverture;

                if(!empty($operations)){
                    foreach ($operations as $operation) {
                        if ($operation->type_operation === 'approvisionnement') {
                            $quantite_theorique += $operation->quantite;
                            $total_sorties += $operation->montant;
                        } elseif ($operation->type_operation === 'vente') {
                            $quantite_theorique -= $operation->quantite;
                            $total_entrees += $operation->montant;
                        }
                    }
                }

                if(!$force){
                    if ($inventaire->quantite_fermeture != $quantite_theorique) {
                        $inventaire->update(['statut' => 'to_check']);
                        $statusJournee = 'standby';
                        $date_fermeture = null;
                        $quantitesConcordent = false;
                    }else {
                        $inventaire->update(['statut' => 'closed']);
                    }
                }else{
                    $inventaire->update(['statut' => 'forced']);
                    $statusJournee = 'fermee';
                }
            }

            $journee->update([
                'date_fermeture' => $date_fermeture,
                'statut' => $statusJournee,
                'total_entrees' => $total_entrees,
                'total_sorties' => $total_sorties,
                'solde_financier' => $total_entrees - $total_sorties,
                'updated_at' => now()
            ]);
            DB::commit();

            if ($quantitesConcordent) {
                return redirect()->route('admin.journees.index')->with('success', 'Journée fermée avec succès.');
            } else {
                return redirect()->route('admin.journees.index')->with('error', 'La journée a été mise en standby car les quantités ne concordent pas. Veuillez contacter le Super Admin');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Erreur lors de la fermeture de la journée : ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la fermeture de la journée.' .$e]);
        }
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
