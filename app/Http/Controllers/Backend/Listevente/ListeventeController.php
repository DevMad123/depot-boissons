<?php

namespace App\Http\Controllers\Backend\Listevente;

use App\Http\Controllers\Controller;
use App\Models\Detailsventeavalider;
use App\Models\Facture;
use App\Models\Factureemb;
use App\Models\FactureProduit;
use App\Models\Listevente;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\vente;
use Illuminate\Http\Request;

class ListeventeController extends Controller
{

    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['listeventes.view']);
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
         $listevente = Listevente::with('client')->latest()->get();
        // $totalfactemb = FactureProduit::where('facture_num', $factures['facture_num'])
        //                         ->sum('prix_vente_totalemb');
        // return view('backend.pages.facture.index', compact('factures', 'totalfactemb'));
        return view('backend.pages.listevente.index', compact('listevente'));
    }

    public function show($id)
    {
        // $facture = Facture::with(['client', 'tva', 'fraisairsi', 'parammodepaiement'])->findOrFail($id);
        // $facture_produit = FactureProduit::with(['produit', 'tariftypeproduitclient'])
        //     ->where([
        //         ['facture_num', '=', $facture['facture_num']],
        //     ])
        //     ->get();/*where('facture_num', $facture['facture_num'])->get();*/
        // $client = Client::where('id', $facture['client_id'])->get();
        // $parammodepaiement = ParamModepaiement::where('id', $facture['parammodepaiement_id'])->get();


        // // $client_id = Traitementclientvente::first();
        // // $clientsinfo = Client::where('id', $client_id['client_id'])->get();

        // return view('backend.pages.facture.show', [
        //     'factures' => $facture,
        //     'facture_produits' => $facture_produit,
        //     'clients' => $client,
        //     'clientsinfos' => $client,
        //     'totalht' => FactureProduit::where('facture_num', $facture['facture_num'])->sum('prix_vente_totalliquide'),
        //     'tvas' => Tva::where('status', 1)->get(),
        //     'fraisairsis' => Fraisairsi::where('status', 1)->get(),
        //     'fraisports' => $facture['fraisport'],
        //     'parammodepaiements' => $parammodepaiement,
        // ]);
    }
 // Vente valisée appelé StoreValider

 public function listevalidervente($id)
 {
    $this->checkAuthorization(auth()->user(), ['listeventes.validervente']);

    $listeventes = Listevente::where('code_vente', $id)->get();


    $detailsventeavaliders = Detailsventeavalider::where('code_vente', $id)->get();




    //dd($listeventes .'   '. $detailsventeavaliders);

    foreach ( $detailsventeavaliders as $key => $value) {
        $ventes = new vente();

         $ventes->code_vente = $value['code_vente'];
         $ventes->facture_num = $value['facture_num'];
         $ventes->produit_id = $value['produit_id'];
         $ventes->tariftypeproduitclient_id  = $value['tariftypeproduitclient_id'];
         $ventes->tariftypeproduitembclient_id  = $value['tariftypeproduitembclient_id'];
         $ventes->quantite = $value['quantite'];
         $ventes->quantite_emb_retour = $value['quantite_emb_retour'];
         $ventes->prix_vente_totalliquide = $value['prix_vente_totalliquide'];
         $ventes->prix_vente_totalemb = $value['prix_vente_totalemb'];
         $ventes->date_vente = $value['date_vente'];
         $ventes->save();

          $factureproduits = new FactureProduit();


         $factureproduits->code_vente = $value['code_vente'];
         $factureproduits->facture_num = $value['facture_num'];
         $factureproduits->produit_id = $value['produit_id'];
         $factureproduits->tariftypeproduitclient_id  = $value['tariftypeproduitclient_id'];
         $factureproduits->tariftypeproduitembclient_id  = $value['tariftypeproduitembclient_id'];
         $factureproduits->quantite = $value['quantite'];
         $factureproduits->quantite_emb_retour = $value['quantite_emb_retour'];
         $factureproduits->prix_vente_totalliquide = $value['prix_vente_totalliquide'];
         $factureproduits->prix_vente_totalemb = $value['prix_vente_totalemb'];
         $factureproduits->date_vente = $value['date_vente'];
         $factureproduits->save();

            $stock = Stock::where('produit_id',$value['produit_id'])->first();

     $produit = Produit::where('id', $value['produit_id'])->first();

    //  $quantiteEmballage = Emballage::where('id', $produit->emballage_id)->first();

    //  $approvisionnementStock = $quantiteEmballage->qte_par_emballage * $request->quantite_vendu;

     //   Retirer l'approvisionnement au stock
     //  Vérifier si le produit existe déjà dans le stock

      if ($stock) {
           // Si le produit existe dans le stock, ajouter la quantité
           $stock->quantite_disponible -=  $value['quantite'];
           $stock->save();
       }



         Listevente::where('code_vente', $id)->update(['validervente' => 'valider']);

    }

    foreach ( $listeventes as $key => $value) {

        $factures = new Facture();
        $factures->num_paiement = $value['num_paiement'];
        $factures->code_reference = $value['code_reference'];
        $factures->espece_receptionne = $value['espece_receptionne'];
        $factures->notes = $value['notes'];
        $factures->facture_num = $value['facture_num'];
        $factures->client_id = $value['client_id'];
        $factures->montant_total =  $value['montant_totalhtliquide'];
        $factures->fraisport = $value['fraisport'];
        $factures->tva_id = $value['tva_id'];
        $factures->fraisairsi_id = $value['fraisairsi_id'];
        $factures->parammodepaiement_id = $value['parammodepaiement_id'];
        $factures->save();

        $factureembs = new Factureemb();
        $factureembs->num_paiement = $value['num_paiement'];
        $factureembs->code_reference = $value['code_reference'];
        $factureembs->espece_receptionne = $value['espece_receptionne'];
        $factureembs->notes = $value['notes'];
        $factureembs->facture_num = $value['facture_num'];
        $factureembs->client_id = $value['client_id'];
        $factureembs->montant_totalhtemballage = $value['montant_totalhtemballage'];
        $factureembs->fraisport = $value['fraisport'];
        $factureembs->tva_id = $value['tva_id'];
        $factureembs->fraisairsi_id = $value['fraisairsi_id'];
        $factureembs->parammodepaiement_id = $value['parammodepaiement_id'];
        $factureembs->save();
    }

     session()->flash('success', __('Vente éffectué  avec succès.'));
     return redirect()->route('admin.factures.index');
 }


 // ANNULER VENTE

 public function annulervente($id)
 {
    $this->checkAuthorization(auth()->user(), ['listeventes.annulervente']);
    $listeventes = Listevente::where('code_vente', $id)->get();

    foreach ( $listeventes as $key => $value) {
        Listevente::where('code_vente', $id)->update(['validervente' => 'annuler']);
    }

     session()->flash('success', __('Vente annulée  avec succès.'));
     return redirect()->route('admin.listeventes.index');
 }

}
