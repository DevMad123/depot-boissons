<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitementVente extends Model
{
   
    use HasFactory;
    
    protected $table = 'traitement_ventes';
    protected $guarded = []; 
    
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id','id'); // Exemple de relation
    }

    /**
     * Obtenir la relation TarifFournisseur.
     */
    public function tariftypeproduitclient()
    {
        return $this->belongsTo(Tariftypeproduitclient::class, 'tariftypeproduitclient_id','id');
    }
    /**
     * Obtenir la relation TarifFournisseur.
     */
    public function tariftypeproduitembclient()
    {
        return $this->belongsTo(Tariftypeproduitembclient::class, 'tariftypeproduitembclient_id','id');
    }
}
