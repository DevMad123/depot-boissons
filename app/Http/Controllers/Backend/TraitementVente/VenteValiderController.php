<?php

namespace App\Http\Controllers\Backend\TraitementVente;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenteValiderRequest;
use App\Models\Detailsventeavalider;
use App\Models\Facture;
use App\Models\FactureProduit;
use App\Models\Fraisairsi;
use App\Models\FraisPort;
use App\Models\Listevente;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\JourneeOperations;
use App\Models\Journee;
use App\Models\Tva;
use App\Models\vente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VenteValiderController extends Controller
{
    // Vente valisée appelé StoreValider

    public function store(StoreVenteValiderRequest $request)
    {
        $journeeOuverte = Journee::where('statut', 'ouverte')->get();
        if ($journeeOuverte->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'Veuillez ouvrir une journée avant toute operation.']);
        }
        $this->checkAuthorization(auth()->user(), ['ventes.create']);
        $traitementventes = TraitementVente::all();

        $tvas = Tva::where('status', 1)->get();

        $traitementclientventes = Traitementclientvente::where('id', 1)->latest()->get();

        $fraisairsis = Fraisairsi::where('status', 1)->get();

        // Récupérer le dernier numéro d'incrément de la base de données
        $dernierId = Vente::orderBy('id', 'desc')->first();

        // Si une facture existe déjà, incrémenter le dernier numéro, sinon commencer à 1
        $incrementId = $dernierId ? $dernierId->id + 1 : 1;

        // Générer un numéro aléatoire unique à 8 chiffres
        $numeroAleatoire = random_int(10000000, 99999999);

        // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
        $lettresfacture = 'FACT'; // Vous pouvez également générer ceci aléatoirement si nécessaire

        // Ajouter un préfixe de lettres (3 lettres fixes ou générées)
        $lettrescodevente = 'VTE'; // Vous pouvez également générer ceci aléatoirement si nécessaire

        // Formater le code avec un numéro à 8 chiffres (en ajoutant des zéros devant si nécessaire)
        $formatNumero = str_pad($incrementId, 8, '0', STR_PAD_LEFT);

        // Combiner le préfixe et le numéro formaté
        $NouveauNumFact = $lettresfacture . $numeroAleatoire;


        $CodeVente = $lettrescodevente . $numeroAleatoire;

        $radio_defini = $request->radio_defini;
        $mode_paiement_ids = $request->mode_paiement_id;

        // Diviser la chaîne en tableau
        $array = explode(',', $mode_paiement_ids);

        // Récupérer le premier élément
        $mode_paiement_id = $array[1];

        $numtransaction = $request->numtransaction;
        $reference = $request->reference;
        $especerecu = $request->recuespece;
        $Description = $request->Description;

       // $montanttotalfacture = number_format(intval($request->totalfacture), 0, ',', ' ');

        $formattedNumber = $request->totalfacture;

        // Supprimer les espaces et remplacer la virgule par un point
        $number = str_replace(' ', '', $formattedNumber); // On enlève les espaces
        $number = str_replace(',', '.', $number); // On remplace la virgule par un point

        // Convertir en float ou int si nécessaire
        $montanttotalfacture = (float) $number; // Ou (int) si vous voulez un entier




        //dd($mode_paiement_id.' '.$request->reference.' '.$especerecu.' '.$montanttotalfacture.'  '.$request->totalfacture );

        $listeventes = new Listevente();

        // CONDITIONS SELON LE MODE DE PAIEMENT

        if (empty($numtransaction) && empty($especerecu) && empty($reference) && empty($Description)) {
            // edbut if num

            $listeventes->num_paiement = $numtransaction;
            $listeventes->code_reference = $reference;
            $listeventes->espece_receptionne = $especerecu;
            $listeventes->notes = $Description;
            // end if num
        } elseif (empty($especerecu) && empty($Description)) {
            // edbut if num

            $listeventes->num_paiement = $numtransaction;
            $listeventes->code_reference = $reference;
            $listeventes->espece_receptionne = 'Null';
            $listeventes->notes = 'Null';
            // end if num
        } elseif (empty($especerecu)) {
            // edbut if num

            $listeventes->num_paiement = $numtransaction;
            $listeventes->code_reference = $reference;
            $listeventes->espece_receptionne = 'Null';
            $listeventes->notes = $Description;
            // end if num
        } elseif (empty($numtransaction) && empty($reference) && empty($Description)) {
            // edbut if num

            $listeventes->num_paiement = 'Null';
            $listeventes->code_reference = 'Null';
            $listeventes->espece_receptionne = $especerecu;
            $listeventes->notes = 'Null';
            // end if num
        } elseif (empty($numtransaction) && empty($reference)) {
            // edbut if num

            $listeventes->num_paiement = 'Null';
            $listeventes->code_reference = 'Null';
            $listeventes->espece_receptionne = $especerecu;
            $listeventes->notes = $Description;
            // end if num
        }
        // END CONDITIONS SELON LE MODE DE PAIEMENT

        $totalPrixVenteLiquide = TraitementVente::sum('prix_vente_totalliquide');


        $totalPrixVenteemballage = TraitementVente::sum('prix_vente_totalemb');


        $listeventes->code_vente = $CodeVente;
        $listeventes->facture_num = $NouveauNumFact;
        $listeventes->client_id = $traitementclientventes[0]['client_id'];
        $listeventes->montant_totalhtliquide =  $totalPrixVenteLiquide;
        $listeventes->montant_totalhtemballage = $totalPrixVenteemballage;
        $listeventes->fraisport = $traitementclientventes[0]['fraisport'];
        $listeventes->tva_id = $tvas[0]['id'];
        $listeventes->fraisairsi_id = $fraisairsis[0]['id'];
        $listeventes->parammodepaiement_id = $mode_paiement_id;
        $listeventes->validervente = 'encours';

        $listeventes->save();

        // Vérification que les produits ont été créés dans la base de données
        foreach ($traitementventes as $traitementvente) {

            $detailsventeavaliders = new Detailsventeavalider();
            $detailsventeavaliders->code_vente = $CodeVente;
            $detailsventeavaliders->facture_num = $NouveauNumFact;
            $detailsventeavaliders->produit_id = $traitementvente['produit_id'];
            $detailsventeavaliders->tariftypeproduitclient_id  = $traitementvente['tariftypeproduitclient_id'];
            $detailsventeavaliders->tariftypeproduitembclient_id  = $traitementvente['tariftypeproduitembclient_id'];
            $detailsventeavaliders->quantite = $traitementvente['quantite'];
            $detailsventeavaliders->quantite_emb_retour = $traitementvente['quantite_emb_retour'];
            $detailsventeavaliders->prix_vente_totalliquide = $traitementvente['prix_vente_totalliquide'];
            $detailsventeavaliders->prix_vente_totalemb = $traitementvente['prix_vente_totalemb'];
            $detailsventeavaliders->date_vente = $traitementvente['date_vente'];
            $detailsventeavaliders->save();


            if ($journeeOuverte->isEmpty()) {
                $journneeoperations = new JourneeOperations();
                $journneeoperations->user_id = 1;
                $journneeoperations->journee_id = $journeeOuverte->first()->id;
                $journneeoperations->produit_id = $traitementvente['produit_id'];
                $journneeoperations->type_operation = 'vente';
                $journneeoperations->quantite = $traitementvente['quantite'];
                $journneeoperations->montant = $traitementvente['prix_vente_totalliquide'];;
                $journneeoperations->created_at = now();
                $journneeoperations->save();
            }
        }

        /*$stock = Stock::where('produit_id', $request->produit_id)->first();

        $produit = Produit::where('id', $request->produit_id)->first();

        $quantiteEmballage = Emballage::where('id', $produit->emballage_id)->first();

        $approvisionnementStock = $quantiteEmballage->qte_par_emballage * $request->quantite_vendu;*/

        //   Retirer l'approvisionnement au stock
        //  Vérifier si le produit existe déjà dans le stock

        /*  if ($stock) {
              // Si le produit existe dans le stock, ajouter la quantité
              $stock->quantite_disponible -= $approvisionnementStock;
              $stock->save();
          }
         */
        $traitementventes = TraitementVente::truncate();

        session()->flash('success', __('Vente éffectué  avec succès.'));
        return redirect()->route('admin.listeventes.index');
    }
}
