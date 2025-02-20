<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Client\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Fournisseur\FournisseurController;
use App\Http\Controllers\Backend\Produit\ProduitController;
use App\Http\Controllers\Backend\Typeproduit\TypeproduitController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\Taille\TailleController;
use App\Http\Controllers\Backend\Approvisionnement\ApprovisionnementController;
use App\Http\Controllers\Backend\Inventaire\InventaireController;
use App\Http\Controllers\Backend\Cloture\ClotureController;
use App\Http\Controllers\Backend\Devise\DeviseController;
use App\Http\Controllers\Backend\Emballage\EmballageController;
use App\Http\Controllers\Backend\Facture\FactureController;
use App\Http\Controllers\Backend\FactureProduit\FactureProduitController;
use App\Http\Controllers\Backend\Fraisairsi\FraisairsiController;
use App\Http\Controllers\Backend\Listevente\ListeventeController;
use App\Http\Controllers\Backend\ParamGeneral\ParamGeneralController;
use App\Http\Controllers\Backend\ParamModepaiement\ParamModepaiementController;
use App\Http\Controllers\Backend\seuilcritique\seuilcritiqueController;
use App\Http\Controllers\Backend\Stock\StockController;
use App\Http\Controllers\Backend\tarifclient\TarifclientController;
use App\Http\Controllers\Backend\tarifclientemb\TarifclientembController;
use App\Http\Controllers\Backend\tariffournisseur\TariffournisseurController;
use App\Http\Controllers\Backend\tariffournisseuremb\TariffournisseurembController;
use App\Http\Controllers\Backend\tariftypeproduitclient\TariftypeproduitclientController;
use App\Http\Controllers\Backend\tariftypeproduitembclient\tariftypeproduitembclientController;
use App\Http\Controllers\Backend\tariftypeproduitembfournisseur\tariftypeproduitembfournisseurController;
use App\Http\Controllers\Backend\tariftypeproduitfournisseur\TariftypeproduitfournisseurController;
use App\Http\Controllers\Backend\TraitementVente\TraitementVenteClientController;
use App\Http\Controllers\Backend\TraitementVente\TraitementVenteClientdefiniController;
use App\Http\Controllers\Backend\TraitementVente\TraitementVenteController;
use App\Http\Controllers\Backend\TraitementVente\VenteValiderController;
use App\Http\Controllers\Backend\Tva\TvaController;
use App\Http\Controllers\Backend\typeclient\typeclientController;
use App\Http\Controllers\Backend\typefournisseur\typefournisseurController;
use App\Http\Controllers\Backend\Vente\VenteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', RolesController::class);

    Route::resource('admins', AdminsController::class);

    Route::get('tariftypeproduitclients/listeproduit/{id1}/{id2}', [TariftypeproduitclientController::class, 'listeproduit'])->name('tariftypeproduitclients.listeproduit');

    Route::get('tariftypeproduitfournisseurs/listeproduit/{id1}/{id2}', [TariftypeproduitfournisseurController::class, 'listeproduit'])->name('tariftypeproduitfournisseurs.listeproduit');

    Route::get('tariftypeproduitembclients/listeproduit/{id1}/{id2}', [tariftypeproduitembclientController::class, 'listeproduit'])->name('tariftypeproduitembclients.listeproduit');

    
    Route::resource('tariftypeproduitclients', TariftypeproduitclientController::class);

    Route::resource('tariftypeproduitfournisseurs', TariftypeproduitfournisseurController::class);

    Route::resource('tariftypeproduitembclients', tariftypeproduitembclientController::class);

    Route::resource('tariftypeproduitembfournisseurs', tariftypeproduitembfournisseurController::class);

    Route::resource('typeclients', typeclientController::class);

    Route::resource('typefournisseurs', typefournisseurController::class);

    Route::resource('factures', FactureController::class);

    Route::resource('listeventes', ListeventeController::class);

    Route::get('listeventes/listevalidervente/{id}', [ListeventeController::class, 'listevalidervente'])->name('listeventes.listevalidervente');

    Route::get('listeventes/annulervente/{id}', [ListeventeController::class, 'annulervente'])->name('listeventes.annulervente');

    //Route::resource('factureemballages', Factureemb::class);

    Route::resource('facturesproduits', FactureProduitController::class);

    Route::resource('emballages', EmballageController::class);

    Route::resource('traitementventeclientdefinis', TraitementVenteClientdefiniController::class);

    Route::resource('traitementventeclients', TraitementVenteClientController::class);

    Route::resource('traitementventes', TraitementVenteController::class);

    Route::get('traitementventes/gettarifproduitclient/{id}', [TraitementVenteController::class, 'gettarifproduitclient'])->name('traitementventes.gettarifproduitclient');

    Route::get('traitementventes/produitcasier/{id}', [TraitementVenteController::class, 'produitcasier'])->name('traitementventes.produitcasier');

    Route::get('traitementventes/prixventeembcasier/{id}', [TraitementVenteController::class, 'prixventeembcasier'])->name('traitementventes.prixventeembcasier');

    Route::resource('ventevaliders', VenteValiderController::class);

    Route::resource('ventes', VenteController::class);

    Route::resource('clotures', ClotureController::class);

    Route::resource('approvisionnements', ApprovisionnementController::class);

    Route::get('approvisionnements/gettypefournisseur/{id}', [ApprovisionnementController::class, 'gettypefournisseur'])->name('approvisionnements.gettypefournisseur');

    Route::resource('inventaires', InventaireController::class);

    Route::resource('produits', ProduitController::class);

    Route::resource('stocks', StockController::class);

    Route::resource('seuilcritiques', seuilcritiqueController::class);

    Route::get('seuilcritiques/edit/{id1}/{id2}', [SeuilcritiqueController::class, 'edit'])->name('seuilcritiques.edit');

    Route::put('seuilcritiques/update/{id1}/{id2}', [SeuilcritiqueController::class, 'update'])->name('seuilcritiques.update');

    Route::resource('tailles', TailleController::class);

    Route::resource('typeproduits', TypeproduitController::class);

    Route::resource('fournisseurs', FournisseurController::class);

    Route::resource('clients', ClientController::class);

    // PARAMETRE
    Route::resource('devises', DeviseController::class);

    Route::resource('tvas', TvaController::class);

    Route::resource('fraisairsis', FraisairsiController::class);

    Route::resource('paramgenerals', ParamGeneralController::class);

    Route::resource('parammodepaiements', ParamModepaiementController::class);

    // Login Routes.
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

    // Logout Routes.
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');

    // Forget Password Routes.
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    Route::post('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('password.update');

})->middleware('auth:admin');

Route::get('/getinfo/{id}', [TraitementVenteController::class, 'getinfos']);
