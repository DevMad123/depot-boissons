<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariffournisseurproduit extends Model
{
    use HasFactory;
   // protected $fillable = [];
   protected $guarded= ['*'];
    // Autres relations et méthodes du modèle...

    public function taritypeproduitfournisseur()
    {
        return $this->hasMany(Tariftypeproduitfournisseur::class);  // Exemple : un emballage appartient à un produit
    }

    public function approvisionnement()
    {
        return $this->hasMany(Approvisionnement::class);  // Exemple : un emballage appartient à un produit
    }
}
