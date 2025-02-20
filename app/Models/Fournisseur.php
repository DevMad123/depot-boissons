<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    // Relation inverse avec Produit
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
    public function taritypeproduitfournisseur()
    {
        return $this->hasMany(Tariftypeproduitfournisseur::class);  // Exemple : un emballage appartient à un produit
    }

    public function approvisionnement()
    {
        return $this->hasMany(Approvisionnement::class);  // Exemple : un emballage appartient à un produit
    }
}
