<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariftypeproduitclient extends Model
{
    use HasFactory;
    
     /**
     * La table associé avec le modèle.
     *
     * @var string
     */
    protected $table = 'tariftypeproduitclients';

    /**
     * Les attributs de masse assignés.
     *
     * @var array
     */
    protected $fillable = [
        'fournisseur_id',
        'produit_id',
        'tarif_id',
    ];

    /**
     * Obtenir la relation Fournisseur.
     */
    public function typeclient()
    {
        return $this->belongsTo(Typeclient::class, 'typeclient_id');
    }

    /**
     * Obtenir la relation Produit.
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }


    /**
     * Obtenir la relation Approvisionnements.
     */
    public function approvisionnements()
    {
        return $this->hasMany(Approvisionnement::class, 'tariftypeproduitfournisseur_id');
    }

    public function traitementVente()
    {
        return $this->hasMany(traitementVente::class, 'traitementVente_id');
    }

    public function vente()
    {
        return $this->hasMany(vente::class, 'vente_id');
    }
    public function factureproduit()
    {
        return $this->hasMany(FactureProduit::class, 'factureproduit__id');
    }
}
