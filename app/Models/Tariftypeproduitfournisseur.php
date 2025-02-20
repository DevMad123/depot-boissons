<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariftypeproduitfournisseur extends Model
{
    use HasFactory;
    
     /**
     * La table associé avec le modèle.
     *
     * @var string
     */
    protected $table = 'tariftypeproduitfournisseurs';

    /**
     * Les attributs de masse assignés.
     *
     * @var array
     */
    protected $fillable = [
        'fournisseur_id',
        'produit_id',
    ];

    /**
     * Obtenir la relation Fournisseur.
     */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
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
    
}
