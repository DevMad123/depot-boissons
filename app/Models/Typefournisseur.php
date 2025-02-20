<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typefournisseur extends Model
{
    use HasFactory;
    protected $fillable = [];
    // Autres relations et méthodes du modèle...

    public function taritypeproduitfournisseur()
    {
        return $this->hasMany(Tariftypeproduitfournisseur::class);  // Exemple : un emballage appartient à un produit
    }
}
