<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariftypeproduitembclient extends Model
{
    
    use HasFactory;

    protected $table = 'tariftypeproduitembclients';

    protected $fillable = [
        'typeclientemb_id',
        'produit_id',
    ];

   

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    // Relation avec le client (si nécessaire)
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    // Relation avec le client (si nécessaire)
    public function typeclient()
    {
        return $this->belongsTo(Typeclient::class, 'typeclient_id');
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
