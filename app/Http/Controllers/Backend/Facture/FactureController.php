<?php

namespace App\Http\Controllers\Backend\Facture;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Facture;
use App\Models\FactureProduit;
use App\Models\Fraisairsi;
use App\Models\ParamModepaiement;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\Tva;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['listefacturesliquide.view']);
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
         $factures = Facture::with('client')->latest()->get();
        // $totalfactemb = FactureProduit::where('facture_num', $factures['facture_num'])
        //                         ->sum('prix_vente_totalemb');
        // return view('backend.pages.facture.index', compact('factures', 'totalfactemb'));
        return view('backend.pages.facture.index', compact('factures'));
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['listefacturesliquide.view']);
        $facture = Facture::with(['client', 'tva', 'fraisairsi', 'parammodepaiement'])->findOrFail($id);
        $facture_produit = FactureProduit::with(['produit', 'tariftypeproduitclient'])
            ->where([
                ['facture_num', '=', $facture['facture_num']],
            ])
            ->get();/*where('facture_num', $facture['facture_num'])->get();*/
        $client = Client::where('id', $facture['client_id'])->get();
        $parammodepaiement = ParamModepaiement::where('id', $facture['parammodepaiement_id'])->get();

        
        // $client_id = Traitementclientvente::first();
        // $clientsinfo = Client::where('id', $client_id['client_id'])->get();
       
        return view('backend.pages.facture.show', [
            'factures' => $facture,
            'facture_produits' => $facture_produit,
            'clients' => $client,
            'clientsinfos' => $client,
            'totalht' => FactureProduit::where('facture_num', $facture['facture_num'])->sum('prix_vente_totalliquide'),
            'tvas' => Tva::where('status', 1)->get(),
            'fraisairsis' => Fraisairsi::where('status', 1)->get(),
            'fraisports' => $facture['fraisport'],
            'parammodepaiements' => $parammodepaiement,
        ]);
    }

    public function download($id)
    {
        $invoice = Facture::with('sale.products')->findOrFail($id);
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('facture_' . $invoice->id . '.pdf');
    }
}
