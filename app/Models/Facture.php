<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'total'];
     // Relation avec le client
    
     public function client()
     {
         return $this->belongsTo(Client::class);
     }
     
     public function tva()
     {
         return $this->belongsTo(Tva::class);
     }
     
     public function fraisairsi()
     {
         return $this->belongsTo(Fraisairsi::class);
     } 

     public function parammodepaiement()
     {
         return $this->belongsTo(ParamModepaiement::class);
     }
     
    public function produit()
    {
        return $this->belongsTo(Produit::class); // Exemple de relation
    }

     // Relation avec les produits (table de jointure)
    //  public function produits()
    //  {
    //      return $this->belongsToMany(Produit::class, 'facture_produit')
    //                  ->withPivot('quantite', 'prix');
    //  }
}
