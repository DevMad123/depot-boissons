<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vente extends Model
{
    use HasFactory;
    protected $guarded= ['*'];
    public function produit()
    {
        return $this->belongsTo(Produit::class); // Exemple de relation
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

    public function journee()
    {
        return $this->belongsTo(Journee::class);
    }
}
