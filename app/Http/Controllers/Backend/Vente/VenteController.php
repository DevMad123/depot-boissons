<?php

namespace App\Http\Controllers\Backend\Vente;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenteRequest;
use App\Models\Approvisionnement;
use App\Models\Emballage;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Traitementclientvente;
use App\Models\TraitementVente;
use App\Models\vente;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VenteController extends Controller
{
    // Afficher la liste des ventes
    //  public function index()
    //  {
    //      $sales = vente::with('product')->latest()->get();
    //      return view('sales.index', compact('sales'));
    //  }
    public function index()
    {
        $this->checkAuthorization(auth()->user(), ['ventes.view']);
        $traitementventes = TraitementVente::all();
        $counttraitementventes = $traitementventes->count();
        if ($counttraitementventes > 0) {
            $traitementvente = TraitementVente::truncate();
        }
        $traitementclientventes = Traitementclientvente::all();
        $counttraitementclientventes = $traitementclientventes->count();
        if ($counttraitementclientventes > 0) {
            $traitementclientvente = Traitementclientvente::truncate();
        }
        $ventes = Vente::with(['produit', 'tariftypeproduitclient', 'tariftypeproduitembclient'])->latest()->get();
        return view('backend.pages.vente.index', compact('ventes'));
    }

    // Afficher le formulaire pour créer une nouvelle vente

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['ventes.create']);
        $traitementventes = TraitementVente::all();
        $counttraitementventes = $traitementventes->count();
        if ($counttraitementventes > 0) {
            $traitementvente = TraitementVente::truncate();
        }
        $traitementclientventes = Traitementclientvente::all();
        $counttraitementclientventes = $traitementclientventes->count();
        if ($counttraitementclientventes > 0) {
            $traitementclientvente = Traitementclientvente::truncate();
        }

        return view('backend.pages.vente.create', [
            'produits' => Produit::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function store(StoreVenteRequest $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['ventes.create']);

        $stock = Stock::where('produit_id', $request->produit_id)->first();

        $produit = Produit::where('id', $request->produit_id)->first();

        $quantiteEmballage = Emballage::where('id', $produit->emballage_id)->first();

        $approvisionnementStock = $quantiteEmballage->qte_par_emballage * $request->quantite_vendu;

        // Vérifier le stock disponible
        if ($stock->quantite_disponible < $approvisionnementStock) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        //$totalPrice = $request->quantite * $request->prix_achat;

        $ventes = new vente();

        $prixVenteApprovisionnements = Approvisionnement::where('produit_id', $request->produit_id)->first();

        $prixVenteTotal = $prixVenteApprovisionnements->vente_unitaire * $request->quantite_vendu;

        $ventes->produit_id = $request->produit_id;
        $ventes->quantite_vendu = $request->quantite_vendu;
        $ventes->prix_vente_total = $prixVenteTotal;
        $ventes->date_vente = $request->date_vente;
        $ventes->save();

        // Ajouter l'approvisionnement au stock
        // Vérifier si le produit existe déjà dans le stock

        //dd($stock);
        if ($stock) {
            // Si le produit existe dans le stock, ajouter la quantité
            $stock->quantite_disponible -= $approvisionnementStock;
            $stock->save();
        }

        if ($request->roles) {
            $ventes->assignRole($request->roles);
        }

        session()->flash('success', __('Vente éffectuée avec succès.'));
        return redirect()->route('admin.ventes.index');
    }

    public function destroy(Approvisionnement $approvisionnement)
    {
        // Ajuster le stock avant suppression
        $approvisionnement->produit->stock->decrement('quantite_disponible', $approvisionnement->quantite);
        $approvisionnement->delete();

        return redirect()->route('approvisionnements.index')->with('success', 'Approvisionnement supprimé avec succès.');
    }
    // Stocker une nouvelle vente
    public function storeOld(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Produit::findOrFail($request->product_id);
        $total_price = $request->quantity * $product->unit_sale_price;

        // Vérifier le stock disponible
        if ($product->stock->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        // Créer la vente
        $sale = vente::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        // Réduire le stock
        $product->stock->decrement('quantity', $request->quantity);

        return redirect()->route('sales.index')->with('success', 'Vente enregistrée avec succès.');
    }
}
